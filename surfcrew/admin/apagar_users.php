<?php
//apagado_em null
require_once('../src/includes/db.php');
// só o admin pode aceder a esta página
if(!isset($_SESSION['user_tipo']) || $_SESSION['user_tipo'] != "Admin"){
    header("Location: ../auth/nav_acessar.php");
    exit;
}

$id = $_GET['id'];

$stmt = $pdo->prepare("UPDATE Utilizadores SET apagado_em = CURRENT_TIMESTAMP WHERE IdUtilizador = ?");
$stmt->execute([$id]);

header("Location: listar_users.php?status=apagado");
exit;
?>
