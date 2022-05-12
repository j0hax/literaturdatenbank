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
$stmt  = $pdo->query('SELECT * FROM publications ORDER BY year DESC, author');
$pubs  = $stmt->fetchAll();
$end   = microtime(true);

echo $twig->render('index.html', array('publications' => $pubs, 'queryTime' => ($end - $start)));
