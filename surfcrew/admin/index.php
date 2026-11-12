<?php
     require_once('../src/includes/db.php');
     // só o admin pode aceder a esta página
     if(!isset($_SESSION['user_tipo']) || $_SESSION['user_tipo'] != "Admin"){
         header("Location: ../auth/nav_acessar.php");
         exit;
     }
     require_once('../src/includes/head.php');
     require_once('../src/includes/nav_bar.php');
     
     echo "olá " . $_SESSION['user_name'];
?>
