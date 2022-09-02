<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/include/database.php';

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader, [
    'cache' => '/tmp',
]);

use Twig\Extra\String\StringExtension;
$twig->addExtension(new StringExtension());

// Step 1: check if parameters have been passed
if (isset($_GET["title"])) {

    $couch = get_db();

    // Prcess our inputs
    $title = $_GET['title'];
    $author = ucwords($_GET["author"]);
    $begin = intval($_GET["begin"]) . "-01-01";
    $end = intval($_GET["end"]) + 1 . "-01-01";
    $type = strtolower($_GET["pubtype"]);
    $searchType = $_GET["searchtype"];

    // Check if we are searching for title/keywords or the full text
    $selector = [
        'year' => ['$gte' => $begin, '$lte' => $end],
    ];

    //$pubs = $couch->find([year => ""]);

    $pubs = [];
    $all = $couch->getAllDocs();

    foreach ($all->rows as $row) {
        $doc = $couch->asArray()->getDoc($row->id);
        array_push($pubs, $doc);
    }

    echo $twig->render('index.html', ['doctypes' => DOC_TYPES, 'publications' => $pubs, 'qtitle' => $title, 'qauth' => $author, 'qstart' => $begin, 'qend' => $end, 'qtype' => $type, 'stype' => $searchType]);
} else {
    echo $twig->render('index.html', ['doctypes' => DOC_TYPES]);
}
