<?php

require_once __DIR__ . '/include/database.php';

// Update the database item with given parameters
if (isset($_POST["title"])) {

 $pdo   = get_db();
 $stmt  = $pdo->prepare('UPDATE publications SET title = :title, author = :auth, year = :year, abstract = :abstract, type = :type WHERE id = :docid');
 $query = [":docid" => intval($_POST["id"]), ":title" => $_POST["title"], ":auth" => $_POST["author"], ":year" => intval($_POST["year"]), ":abstract" => $_POST["abstract"], ":type" => $_POST["pubtype"]];
 $stmt->execute($query);

 header("Location: /document.php?id=" . $query[":docid"]);
}
