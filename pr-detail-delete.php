<?php

if (isset($_GET['id'])) {
    include('koneksi.php');
    $id = $_GET['id'];
    $prcode = $_GET['prcode'];
    $cek = mysql_query("SELECT id_pr_detail FROM t_pr_detail WHERE id_pr_detail ='$id'") or die(mysql_error());
    if (mysql_num_rows($cek) == 0) {
        echo '<script>window.history.back()</script>';
    } else {
        mysql_query("DELETE FROM t_pr_detail WHERE id_pr_detail ='$id'");
        header('location:pr-detail.php?id=' . $prcode);
    }
} else {
    header('location:pr-detail.php?id=' . $prcode);
}
?>