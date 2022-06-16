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
 // Spaces to underscores
 $result = str_replace(" ", "_", $filename);

 // Allow only alphanumeric, underscore, period and dash
 return preg_replace("/[^a-zA-Z0-9_.\-]+/", "", $result);
}

// Check if a file has been uploaded
if (isset($_FILES["pdf"])) {

 if ($_FILES["pdf"]["error"] != UPLOAD_ERR_OK) {
  die("Fehler beim hochladen der Datei");
 }

 {
  $order = [date("Y"), sanitize($_POST["author"])];
 }

 $dir = join(DIRECTORY_SEPARATOR, $order);

 # TODO: configurable data dir
 $datadir = "data" . DIRECTORY_SEPARATOR;

 if (!file_exists($datadir . $dir)) {
  mkdir($datadir .  $dir, recursive: true);
 }

 $tmp_name = $_FILES["pdf"]["tmp_name"];
 $file_location = join(DIRECTORY_SEPARATOR, [$dir, sanitize($_FILES["pdf"]["name"])]);

 move_uploaded_file($tmp_name,  $datadir . $file_location);

 // Add entry to database
 $pdo = get_db();
 $stmt = $pdo->prepare('INSERT INTO publications (title, author, year, abstract, path, type) VALUES (:title, :author, :year, :abstract, :path, :type)');
 $query = [":title" => $_POST["title"], ":author" => $_POST["author"], ":year" => $_POST["year"], ":abstract" => $_POST["abstract"], ":path" => $file_location, "type" => $_POST["pubtype"]];
 $stmt->execute($query);

 $id = $pdo->lastInsertId();


 // Redirect to the new document page
 header("Location: /document.php?id=".$id);
 die();
}

echo $twig->render('submit.html');
