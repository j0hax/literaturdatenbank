<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/include/database.php';
require_once __DIR__ . '/include/mail.php';

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader, [
    'cache' => '/tmp',
]);

use Twig\Extra\String\StringExtension;
$twig->addExtension(new StringExtension());

// Check if a file has been uploaded
if (isset($_FILES["files"])) {

    $doc = new stdClass();

    $doc->title = $_POST["title"];
    $doc->author = $_POST["author"];
    $doc->date = $_POST["date"];
    $doc->abstract = $_POST["abstract"];
    $doc->keywords = array_map('trim', explode(',', $_POST["keywords"]));
    $doc->type = $_POST["pubtype"];
    $doc->password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $couch = get_db();

    // Store the document entry first and get its metadata
    $response = $couch->storeDoc($doc);

    $total = count($_FILES['files']['name']);

    for ($i = 0; $i < $total; $i++) {
        $doc = $couch->getDoc($response->id);

        $name = $_FILES['files']['name'][$i];
        $loc = $_FILES['files']['tmp_name'][$i];
        $type = $_FILES['files']['type'][$i];

        $response = $couch->storeAttachment($doc, $loc, $type, $name);
    }

    if ($response->ok) {
        $id = $response->id;

        // Redirect to the new document page
        header("Location: /document.php?id=" . $id);
    } else {
        var_dump($response);
    }

    die();
}

echo $twig->render('submit.html', ['doctypes' => DOC_TYPES]);
