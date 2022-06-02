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
if (isset($_POST["title"])) {

 // Prepared statement
 $stmt = $pdo->prepare('SELECT * FROM publications WHERE (title LIKE :title OR keyword LIKE :title OR abstract LIKE :title) AND author LIKE :auth AND year BETWEEN :byear AND :eyear AND type LIKE :type ORDER BY year DESC, title');

 $title  = strtolower($_POST["title"]);
 $author = strtolower($_POST["author"]);
 $begin  = intval($_POST["beginyear"]);
 $end    = intval($_POST["endyear"]);
 $type   = strtolower($_POST["pubtype"]);

 $query = [":title" => "%" . $title . "%", ":auth" => "%" . $author . "%", ":byear" => $begin, "eyear" => $end, "type" => $type];

 $stmt->execute($query);

 $pubs    = $stmt->fetchAll();
 $endTime = microtime(true);

 // Path hack
 function fix_path(&$val, $key)
 {
  if (str_starts_with($key, "path")) {
   if ($val[$key][0] != '/') {
    $val[$key] = '/' . $val[$key];
   }
  }
 }

 foreach ($pubs as &$p) {
  if ($p['path'][0] == '/') {
   $p['path'] = substr($p['path'], 1);
  }
 }

 echo $twig->render('index.html', array('publications' => $pubs, 'qtitle' => $title, 'qauth' => $author, 'qstart' => $begin, 'qend' => $end, 'qtype' => $type, 'queryTime' => ($endTime - $time)));
} else {
 echo $twig->render('index.html');
}
