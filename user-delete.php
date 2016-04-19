<?php

if (isset($_GET['id'])) {
    include('koneksi.php');
    $id = $_GET['id'];
    $cek = mysql_query("SELECT id_user FROM m_user WHERE id_user ='$id'") or die(mysql_error());
    if (mysql_num_rows($cek) == 0) {
        echo '<script>window.history.back()</script>';
    } else {
        mysql_query("DELETE FROM m_user WHERE id_user ='$id'");
        header('location:user.php');
    }
} else {
    header('location:user.php');
}
?>