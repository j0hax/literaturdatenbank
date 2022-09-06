<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/include/database.php';

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader, [
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
    $doc = get_db()->asArray()->getDoc($_GET["id"]);

    // The hash is nobody's business:
    // We overwrite this value with a simple boolean to tell if a document is protected or not.
    // $doc['password'] = !(is_null($pub["password"]));
    echo $twig->render('document.html', ['document' => $doc, 'doctypes' => DOC_TYPES]);

} else {
    header('Location: /');
    exit;
}
