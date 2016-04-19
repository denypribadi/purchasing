<?php

session_start();
require_once("koneksi.php");
$username = mysql_real_escape_string($_POST['username']);
$pass = mysql_real_escape_string($_POST['password']);
$pass = md5($pass);
$cekuser = mysql_query("SELECT * FROM m_user WHERE username = '$username' AND password = '$pass'");
$jumlah = mysql_num_rows($cekuser);
$hasil = mysql_fetch_array($cekuser);
if ($jumlah == 0) {
    header('location:index.php');
} else {
    $_SESSION['iduser'] = $hasil['id_user'];
    header('location:index.php');
}
?>