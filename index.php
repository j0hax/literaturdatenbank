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

$time = microtime(true);

// Step 1: check if parameters have been passed
if (isset($_GET["title"])) {

 // Prepared statement
 $stmt = $pdo->prepare('SELECT * FROM publications WHERE (title LIKE :title OR keyword LIKE :title OR abstract LIKE :title) AND author LIKE :auth AND year BETWEEN :byear AND :eyear AND type LIKE :type ORDER BY year DESC, title');

 $title  = strtolower($_GET["title"]);
 $author = strtolower($_GET["author"]);
 $begin  = intval($_GET["begin"]);
 $end    = intval($_GET["end"]);
 $type   = strtolower($_GET["pubtype"]);

 $query = [":title" => "%" . $title . "%", ":auth" => "%" . $author . "%", ":byear" => $begin, "eyear" => $end, "type" => $type];

 $stmt->execute($query);

 $pubs    = $stmt->fetchAll();
 $endTime = microtime(true);

 echo $twig->render('index.html', array('publications' => $pubs, 'qtitle' => $title, 'qauth' => $author, 'qstart' => $begin, 'qend' => $end, 'qtype' => $type, 'queryTime' => ($endTime - $time)));
} else {
 echo $twig->render('index.html');
}
