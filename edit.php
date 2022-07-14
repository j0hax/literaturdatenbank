<?php

require_once __DIR__ . '/include/database.php';

// Update the database item with given parameters
if (isset($_POST["title"])) {

 $pdo = get_db();

 // check if there is a hash
 $stmt  = $pdo->prepare('SELECT password FROM publications WHERE id = :docid');
 $query = [":docid" => $_POST["id"]];
 $stmt->execute($query);
 $existing = $stmt->fetch()['password'];

 if (is_null($existing) || password_verify($_POST["password"], $existing)) {
  $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
  $stmt     = $pdo->prepare('UPDATE publications SET title = :title, author = :auth, date = :date, abstract = :abstract, type = :type, keyword = :keywords, password = :password WHERE id = :docid');
  $query    = [":docid" => intval($_POST["id"]), ":title" => $_POST["title"], ":auth" => $_POST["author"], ":date" => $_POST["date"], ":abstract" => $_POST["abstract"], ":type" => $_POST["pubtype"], ":keywords" => $_POST["keywords"], ":password" => $password];
  $stmt->execute($query);

  header("Location: /document.php?id=" . $query[":docid"]);
  exit();
 } else {
  exit("Fehler: falsches Passwort! Bitte nochmal versuchen.");
 }
}
