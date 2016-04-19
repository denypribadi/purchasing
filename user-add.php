<?php

require_once("koneksi.php");
$idUser = mysql_real_escape_string($_GET['iduser']);
$uname = mysql_real_escape_string($_GET['username']);
$fname = mysql_real_escape_string($_GET['fullname']);
$pass = mysql_real_escape_string($_GET['password']);
$passMD5 = '';
if (!empty($pass)) {
    $passMD5 = md5($pass);
}
$cekUser = mysql_query("SELECT * FROM m_user WHERE id_user = '$idUser'");
if (mysql_num_rows($cekUser) != 0) {
    $row = mysql_fetch_array($cekUser);
    if ($row['id_user'] == $idUser) {
        $sql = "UPDATE m_user SET username = '$uname', full_name = '$fname' ";
        if (!empty($pass)) {
            $sql .= " , password = ' $passMD5 '";
        }
        $sql .=" WHERE id_user = '$idUser'";
        mysql_query($sql);
    }
    header('location:user.php');
} else {
    mysql_query("INSERT INTO m_user(id_user, username, password, full_name) VALUES('$idUser','$uname', '$passMD5', '$fname')");
    header('location:user.php');
}
?>