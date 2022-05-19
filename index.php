<?php
require_once __DIR__ . '/vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig   = new \Twig\Environment($loader, [
 'cache' => '/tmp',
]);

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
 $stmt = $pdo->prepare('SELECT * FROM publications WHERE (title LIKE :title OR keyword LIKE :title) AND author LIKE :auth ORDER BY year DESC, author');

 $title  = strtolower($_POST["title"]);
 $author = strtolower($_POST["author"]);

 $query = [":title" => "%" . $title . "%", ":auth" => "%" . $author . "%"];

 $stmt->execute($query);

 $pubs = $stmt->fetchAll();
 $end  = microtime(true);

 echo $twig->render('index.html', array('publications' => $pubs, 'qtitle' => $title, 'qauth' => $author, 'queryTime' => ($end - $start)));
} else {
 echo $twig->render('index.html');
}
