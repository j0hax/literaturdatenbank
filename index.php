<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/include/database.php';

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig   = new \Twig\Environment($loader, [
 'cache' => '/tmp',
]);

use Twig\Extra\String\StringExtension;
$twig->addExtension(new StringExtension());

// Step 1: check if parameters have been passed
if (isset($_GET["title"])) {

 $pdo = get_db();

 // Prepared statement
 $stmt = $pdo->prepare('SELECT * FROM publications WHERE (title LIKE :search OR keyword LIKE :search OR abstract LIKE :search) AND author LIKE :auth AND type LIKE :type AND year BETWEEN :byear AND :eyear ORDER BY year DESC, title');

 $title  = $_GET['title'];
 $author = ucwords($_GET["author"]);
 $begin  = intval($_GET["begin"]);
 $end    = intval($_GET["end"]);
 $type   = strtolower($_GET["pubtype"]);

 $query = [":search" => "%$title%", ":auth" => "%$author%", "type" => $type, ":byear" => $begin, "eyear" => $end];

 $stmt->execute($query);

 $pubs = $stmt->fetchAll();

 echo $twig->render('index.html', array('publications' => $pubs, 'qtitle' => $title, 'qauth' => $author, 'qstart' => $begin, 'qend' => $end, 'qtype' => $type));
} else {
 echo $twig->render('index.html');
}
