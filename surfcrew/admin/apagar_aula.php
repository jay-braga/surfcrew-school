<?php
require_once('../src/includes/db.php');
$id = $_GET['id'];
$stmt = $pdo->prepare("UPDATE Aulas SET apagado_em = CURRENT_TIMESTAMP WHERE IdAula = ?");
$stmt->execute([$id]);
header("Location: listar_aula.php?status=apagado");
exit;
?>