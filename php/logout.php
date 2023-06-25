<?php
    session_start();
    unset($_SESSION['connecte'],$_SESSION['utilisateur'],$_SESSION["nom"]);
    header('Location: ../index.php');
    exit;
?>