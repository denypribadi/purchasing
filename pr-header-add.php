<?php
require_once("koneksi.php");
$idpr = mysql_real_escape_string($_GET['idpr']);
$user = mysql_real_escape_string($_GET['user']);
$dept = mysql_real_escape_string($_GET['department']);
$cekdata = mysql_query("SELECT * FROM t_pr_header WHERE id_pr = '$idpr'");
if (mysql_num_rows($cekdata) != 0) {
    $row = mysql_fetch_array($cekdata);
    if ($row['id_pr'] == $idpr) {
        $sql = "UPDATE t_pr_headr SET user = '$user', department = '$dept' ";
        $sql .=" WHERE id_pr = '$idpr'";
        mysql_query($sql);
    }
    header('location:pr-detail.php');
} else {
    $date = date('Y-m-d H:i:s');
    mysql_query("INSERT INTO t_pr_header(id_pr, user, department, date) VALUES('$idpr','$user', '$dept', '$date')");
    echo $idpr .' - '. $user . ' - ' . $dept . ' - ' . $date;
    header('location:pr-detail.php?id='.$idpr);
}
?>