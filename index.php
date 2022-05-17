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

$start = microtime(true);

// Step 1: check if parameters have been passed
if (isset($_POST["title"])) {
 $stmt = $pdo->prepare('SELECT * FROM publications WHERE title LIKE :title ORDER BY year DESC, author');

 $title = "%" . $_POST["title"] . "%";

 $query = [":title" => $title];

 $stmt->execute($query);

 $pubs = $stmt->fetchAll();
 $end  = microtime(true);
 echo $twig->render('index.html', array('publications' => $pubs, 'query' => $query, 'queryTime' => ($end - $start)));
} else {
 echo $twig->render('index.html');
}
