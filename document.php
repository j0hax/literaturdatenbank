<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/include/database.php';

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig   = new \Twig\Environment($loader, [
 'cache' => '/tmp',
]);

use Twig\Extra\String\StringExtension;
$twig->addExtension(new StringExtension());

function fix_url(?string &$url)
{
 if (is_null($url)) {
  $url = "";
  return;
 }

 $url = implode('/', array_map('rawurlencode', explode('/', $url)));
}

// Step 1: check if parameters have been passed
if (isset($_GET["id"])) {

 $pdo  = get_db();
 $stmt = $pdo->prepare('SELECT * FROM publications WHERE id = :docid');

 $query = [":docid" => intval($_GET["id"])];

 $stmt->execute($query);

 $pub = $stmt->fetch();

 fix_url($pub['path']);
 fix_url($pub['path_img']);
 fix_url($pub['path_zip']);
 fix_url($pub['path_url']);

 echo $twig->render('document.html', array('document' => $pub));

} else {
 header('Location: /');
 exit;
}
