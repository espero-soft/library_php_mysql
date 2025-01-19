<?php
$host = getenv('DB_HOST') ?? 'localhost';
$dbname = getenv('DB_NAME') ?? 'library';
$username = getenv('DB_USER') ?? 'root';
$password = getenv('DB_PASSWORD') ?? '';

try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Erreur de connexion : " . $e->getMessage());
}

require_once 'app/Models/Livre.php';
require_once 'app/Models/User.php';
$livreModel = new Livre($pdo);
$userModel = new User($pdo);
