<?php

if (isset($_GET['id'])) {
    include('koneksi.php');
    $id = $_GET['id'];
    $cek = mysql_query("SELECT id_department FROM m_department WHERE id_department='$id'") or die(mysql_error());
    if (mysql_num_rows($cek) == 0) {
        echo '<script>window.history.back()</script>';
    } else {
        mysql_query("DELETE FROM m_department WHERE id_department='$id'");
        header('location:department.php');
    }
} else {
    header('location:department.php');
}
?>