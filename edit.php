<?php

$host = 'db';
$db   = 'ikm';
$user = getenv('DB_USER');
$pass = getenv('DB_PASSWORD');

$dsn = "mysql:host=$host;dbname=$db";
try {
 $pdo = new PDO($dsn, $user, $pass);
} catch (\PDOException $e) {
 throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// Update the database item with given parameters
if (isset($_POST["title"])) {

 // Prepared statement
 $stmt = $pdo->prepare('UPDATE publications SET title = :title, author = :auth, year = :year, abstract = :abstract, type = :type WHERE id = :docid');

 $query = [":docid" => intval($_POST["id"]), ":title" => $_POST["title"], ":auth" => $_POST["author"], ":year" => intval($_POST["year"]), ":abstract" => $_POST["abstract"], ":type" => $_POST["pubtype"]];

 $stmt->execute($query);

 header("Location: /document.php?id=" . $query[":docid"]);
}
