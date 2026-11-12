<?php
require_once('../src/includes/db.php');
// só o admin pode aceder a esta página
if(!isset($_SESSION['user_tipo']) || $_SESSION['user_tipo'] != "Admin"){
    header("Location: ../auth/nav_acessar.php");
    exit;
}
$id = $_GET['id'];
$stmt = $pdo->prepare("UPDATE Aulas SET apagado_em = CURRENT_TIMESTAMP WHERE IdAula = ?");
$stmt->execute([$id]);
header("Location: listar_aula.php?status=apagado");
exit;
?>
