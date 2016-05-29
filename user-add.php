<?php

require_once("koneksi.php");
$idUser = mysql_real_escape_string($_POST['iduser']);
$uname = mysql_real_escape_string($_POST['username']);
$fname = mysql_real_escape_string($_POST['fullname']);
$pass = mysql_real_escape_string($_POST['password']);
$passMD5 = '';
$fileName = $_FILES['gambarid']['name'];
echo $fileName;
if (!empty($pass)) {
    $passMD5 = trim(md5($pass));
}
$cekUser = mysql_query("SELECT * FROM m_user WHERE id_user = '$idUser'");
if (mysql_num_rows($cekUser) != 0) {
    $row = mysql_fetch_array($cekUser);
    if ($row['id_user'] == $idUser) {
        $sql = "UPDATE m_user SET username = '$uname', full_name = '$fname', gambar = '$fileName' ";
        if (!empty($pass)) {
            $sql .= " , password = '$passMD5'";
        }
        $sql .=" WHERE id_user = '$idUser'";
        mysql_query($sql);
        move_uploaded_file($_FILES['gambarid']['tmp_name'], "upload/".$_FILES['gambarid']['name']);
    }
    header('location:user.php');
} else {
    mysql_query("INSERT INTO m_user(id_user, username, password, full_name, gambar) VALUES('$idUser','$uname', '$passMD5', '$fname', '$fileName')");
    move_uploaded_file($_FILES['gambarid']['tmp_name'], "upload/".$_FILES['gambarid']['name']);
    header('location:user.php');
}
?>