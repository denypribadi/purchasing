<?php

if (isset($_GET['id'])) {
    include('koneksi.php');
    $id = $_GET['id'];
    $cek = mysql_query("SELECT id_item FROM m_item WHERE id_item ='$id'") or die(mysql_error());
    if (mysql_num_rows($cek) == 0) {
        echo '<script>window.history.back()</script>';
    } else {
        mysql_query("DELETE FROM m_item WHERE id_item ='$id'");
        header('location:item.php');
    }
} else {
    header('location:item.php');
}
?>