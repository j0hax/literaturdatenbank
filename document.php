<?php
require_once __DIR__ . '/vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig   = new \Twig\Environment($loader, [
 'cache' => '/tmp',
]);

use Twig\Extra\String\StringExtension;
$twig->addExtension(new StringExtension());

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

// Step 1: check if parameters have been passed
if (isset($_GET["id"])) {

 // Prepared statement
 $stmt = $pdo->prepare('SELECT * FROM publications WHERE id = :docid');

 $query = [":docid" => intval($_GET["id"])];

 $stmt->execute($query);

 $pub = $stmt->fetch();

 echo $twig->render('document.html', array('document' => $pub));
} else {
 header('Location: /');
 exit;
}