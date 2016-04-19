<?php

require_once("koneksi.php");
$iditem = mysql_real_escape_string($_GET['iditem']);
$iname = mysql_real_escape_string($_GET['itemname']);
$wh = mysql_real_escape_string($_GET['warehouse']);
$cekdata = mysql_query("SELECT * FROM m_item WHERE id_item = '$iditem'");
echo $iditem . ' | ' .$iname . ' | ' .$wh . ' | ' .$cekdata;
if (mysql_num_rows($cekdata) != 0) {
    $row = mysql_fetch_array($cekdata);
    echo '=== ' . $row['id_item'];
    if ($row['id_item'] == $iditem) {
        $sql = "UPDATE m_item SET item_name = '$iname', warehouse = '$wh' WHERE id_item = '$iditem' ";
        mysql_query($sql);
    }
    header('location:item.php');
} else {
    mysql_query("INSERT INTO m_item(id_item, item_name, warehouse) VALUES('$iditem','$iname', '$wh')");
    header('location:item.php');
}
?>