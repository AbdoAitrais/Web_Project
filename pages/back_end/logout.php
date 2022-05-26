<?php 
ob_start();
session_start();
$_SESSION['pseudo'] = '';
session_destroy();
//echo $_SESSION['pseudo'];
header('location: ../login.php');
?>