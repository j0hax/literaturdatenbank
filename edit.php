<?php

require_once __DIR__ . '/include/database.php';

// Update the database item with given parameters
if (isset($_POST["title"])) {

    $doc = get_db()->getDoc($_POST["id"]);

    if (!property_exists($doc, 'password') || password_verify($_POST["password"], $doc->password)) {

        // Update attributes of our document and return it to the database
        $doc->title = $_POST["title"];
        $doc->author = $_POST["author"];
        $doc->date = $_POST["date"];
        $doc->abstract = $_POST["abstract"];
        $doc->type = $_POST["pubtype"];
        $doc->keywords = array_map('trim', explode(',', $_POST["keywords"]));
        $doc->password = password_hash($_POST["password"], PASSWORD_DEFAULT);

        get_db()->storeDoc($doc);

        header("Location: /document.php?id=" . $doc->_id);
        exit();
    } else {
        exit("Fehler: falsches Passwort! Bitte nochmal versuchen.");
    }
}
