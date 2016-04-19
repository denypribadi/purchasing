<?php

require_once("koneksi.php");
$idsupp = mysql_real_escape_string($_GET['idsupplier']);
$suppname = mysql_real_escape_string($_GET['suppliername']);
$telp = mysql_real_escape_string($_GET['telp']);
$address = mysql_real_escape_string($_GET['address']);
$city = mysql_real_escape_string($_GET['city']);
$cekdata = mysql_query("SELECT * FROM m_supplier WHERE id_supplier = '$idsupp'");
echo $idsupp . ' | ' .$suppname . ' | ' .$telp . ' | ' .$address. ' | ' .$city;
if (mysql_num_rows($cekdata) != 0) {
    $row = mysql_fetch_array($cekdata);
    if ($row['id_supplier'] == $idsupp) {
        $sql = "UPDATE m_supplier SET supplier_name = '$suppname', telphone = '$telp', address = '$address', city = '$city' WHERE id_supplier = '$idsupp' ";
        mysql_query($sql);
    }
    header('location:supplier.php');
} else {
    mysql_query("INSERT INTO m_supplier(id_supplier, supplier_name, telphone, address, city) VALUES('$idsupp','$suppname', '$telp', '$address', '$city')");
    header('location:supplier.php');
}
?>