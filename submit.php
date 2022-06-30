<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/include/database.php';

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig   = new \Twig\Environment($loader, [
 'cache' => '/tmp',
]);

use Twig\Extra\String\StringExtension;
$twig->addExtension(new StringExtension());

function sanitize(string $filename)
{
 // Lowercase
 $result = strtolower($filename);

 // Spaces to underscores
 $result = str_replace(" ", "_", $result);

 // Allow only alphanumeric, underscore, period and dash
 return preg_replace("/[^a-z0-9_.\-]+/", "", $result);
}

function store(array $file, array $allowed): string
{
 $errcode = $file["error"];
 if ($errcode != UPLOAD_ERR_OK) {
  die("Fehler beim hochladen der Datei. Fehlercode: " . $errcode);
 }

 $order = [sanitize($_POST["year"]), sanitize($_POST["author"]), sanitize($_POST["title"])];

 $dir = join(DIRECTORY_SEPARATOR, $order);

 # TODO: configurable data dir
 $datadir = "data" . DIRECTORY_SEPARATOR;

 if (!file_exists($datadir . $dir)) {
  mkdir($datadir . $dir, 0755, true);
 }

 $tmp_name = $file["tmp_name"];
 $mtype    = mime_content_type($tmp_name);

 # Ensure the file is of the correct MIME type
 if (!in_array($mtype, $allowed)) {
  die("Fehler: falsche Dateiart für " . $file["name"] . ", erwarte eins von " . implode(", ", $allowed));
 }

 $file_location = join(DIRECTORY_SEPARATOR, [$dir, sanitize($file["name"])]);

 move_uploaded_file($tmp_name, $datadir . $file_location);

 return $file_location;
}

// Check if a file has been uploaded
if (isset($_FILES["pdf"])) {

 $file_location    = store($_FILES["pdf"], ["application/pdf"]);
 $archive_location = store($_FILES["zip"], ["application/zip", "application/x-gzip"]);

 // Add entry to database
 $pdo   = get_db();
 $stmt  = $pdo->prepare('INSERT INTO publications (title, author, year, abstract, keyword, path, path_zip, type, password) VALUES (:title, :author, :year, :abstract, :keyword, :path, :path_zip, :type, :password)');
 $query = [":title" => $_POST["title"], ":author" => $_POST["author"], ":year" => $_POST["year"], ":abstract" => $_POST["abstract"], ":keyword" => $_POST["keywords"], ":path" => $file_location, ":path_zip" => $archive_location, ":type" => $_POST["pubtype"], ":password" => password_hash($_POST["password"], PASSWORD_DEFAULT)];
 $stmt->execute($query);

 $id = $pdo->lastInsertId();

 // Redirect to the new document page
 header("Location: /document.php?id=" . $id);
 die();
}

echo $twig->render('submit.html');
