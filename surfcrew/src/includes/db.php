<?php
session_start();

$host = 'localhost';
$port = 3306;
$db = 'surfcrew';
$user = 'SEU_USER';
$pass = 'SUA_PASSWORD';

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na ligação à base de dados: " . $e->getMessage());
}
?>