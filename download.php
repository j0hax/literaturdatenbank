<?php
require_once __DIR__ . '/include/database.php';

if (!isset($_GET["id"])) {
    header('Location: /');
    exit;
}

$uri = get_uri();

$id = urlencode($_GET['id']);
$name = urlencode($_GET['file']);

$path = "$uri/literaturdatenbank/$id/$name";

$tmpfile = tempnam(sys_get_temp_dir(), 'litdb');

// Download file
file_put_contents($tmpfile, fopen($path, 'r'));

// Set headers and spit out the file
header("Content-Description: File Transfer");
header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"" . basename($name) . "\"");
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($tmpfile));

readfile($tmpfile);
exit;
