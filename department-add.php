<?php

require_once("koneksi.php");
$idDepart = mysql_real_escape_string($_GET['iddepartment']);
$departName = mysql_real_escape_string($_GET['departmentname']);
$cekDepart = mysql_query("SELECT * FROM m_department WHERE id_department = '$idDepart'");
if (mysql_num_rows($cekDepart) != 0) {
    $row = mysql_fetch_array($cekDepart);
    if ($row['id_department'] == $idDepart) {
        mysql_query("UPDATE m_department SET department_name = '$departName' WHERE id_department = '$idDepart'");
    }
    header('location:department.php');
} else {
    mysql_query("INSERT INTO m_department(id_department, department_name) VALUES('$idDepart','$departName')");
    header('location:department.php');
}
?>