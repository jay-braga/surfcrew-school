<?php
//apagado_em null
require_once('../src/includes/db.php');

$id = $_GET['id'];

$stmt = $pdo->prepare("UPDATE Utilizadores SET apagado_em = CURRENT_TIMESTAMP WHERE IdUtilizador = ?");
$stmt->execute([$id]);

header("Location: listar_users.php?status=apagado");
exit;
?>