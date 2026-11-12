<?php
// O session star é uma função do php que inicia as variaveis $_SESSION que permite guardar dados durante a sessão do utilizador
session_start();
//Ip ou endereço onde se encontra a base de dados 
$host = 'localhost';
//porta onde se encontra o servidor da base de dados
$port = 3306;
//nome da base de dados
// $db = 'formacao_crud';
$db = 'surf'; 

$user = 'root';
$pass = '';

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";

try {

    $pdo = new PDO($dsn, $user, $pass);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}

catch (PDOException $e) {

    die("Erro na ligação à base de dados: " . $e->getMessage());

}
 


// Executa isto uma vez para saber o que colar no SQL
//echo password_hash("1234", PASSWORD_DEFAULT);
?>
