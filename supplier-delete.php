<?php

if (isset($_GET['id'])) {
    include('koneksi.php');
    $id = $_GET['id'];
    $cek = mysql_query("SELECT id_supplier FROM m_supplier WHERE id_supplier ='$id'") or die(mysql_error());
    if (mysql_num_rows($cek) == 0) {
        echo '<script>window.history.back()</script>';
    } else {
        mysql_query("DELETE FROM m_supplier WHERE id_supplier ='$id'");
        header('location:supplier.php');
    }
} else {
    header('location:supplier.php');
}
?>