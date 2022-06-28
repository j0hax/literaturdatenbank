<?php
function get_db()
{
 $host = 'db';
 $db   = 'ikm';
 $user = getenv('DB_USER');
 $pass = getenv('DB_PASSWORD');

 $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
 try {
  $pdo = new PDO($dsn, $user, $pass);

  // Execute setup script
  $setup  = file_get_contents(__DIR__ . "/setup.sql");
  $result = $pdo->exec($setup);

  $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  return $pdo;
 } catch (PDOException $e) {
  die('Database Error; Code ' . $e->getCode() . ": " . $e->getMessage());
 }
}
