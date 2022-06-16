<?php
function get_db()
{
 $host = 'db';
 $db   = 'ikm';
 $user = getenv('DB_USER');
 $pass = getenv('DB_PASSWORD');

 $dsn = "mysql:host=$host;dbname=$db";
 try {
  $pdo = new PDO($dsn, $user, $pass);
  $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  return $pdo;
 } catch (\PDOException $e) {
  throw new \PDOException($e->getMessage(), (int)$e->getCode());
 }
}
