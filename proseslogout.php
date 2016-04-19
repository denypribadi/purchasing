<?php
session_start();
unset($_SESSION['username']);
unset($_SESSION['iduser']);
header('location:login.php');
?>