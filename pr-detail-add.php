<?php
require_once("koneksi.php");
$idpr = mysql_real_escape_string($_GET['prheader']);
$idprdetail = $_GET['idprdetail'];
$item = mysql_real_escape_string($_GET['item']);
$qty = mysql_real_escape_string($_GET['qty']);
if ($idprdetail != '' || $idprdetail != NULL) {
    $cekdataForUpdate = mysql_query("SELECT * FROM t_pr_detail WHERE pr_header = '$idpr' AND id_pr_detail = '$idprdetail'");
    if (mysql_num_rows($cekdataForUpdate) != 0) {
        $updateIdAda = mysql_query("UPDATE t_pr_detail SET qty = '$qty', item = '$item' WHERE id_pr_detail = '$idprdetail'") or die(mysql_error());
        if ($updateIdAda) {
            header("location:pr-detail.php?id='$idpr'");
        } else {
            echo '<strong>1. error update item and/or quantity</strong><br>';
            ?>
            <a href="pr-detail.php?id='<?php echo $idpr; ?>"> << Back </a>
            <?php
        }
    }
} else {
    $cekdata = mysql_query("SELECT * FROM t_pr_detail WHERE pr_header = '$idpr'");
    if (mysql_num_rows($cekdata) != 0) {
        while ($row = mysql_fetch_array($cekdata, MYSQL_ASSOC)) {
            if ($row['item'] == $item) {
                $qtyUpdate = $qty + $row['qty'];
                $idprdetailupdate = $row['id_pr_detail'];
                $updateQty = mysql_query("UPDATE t_pr_detail SET qty = '$qtyUpdate' WHERE id_pr_detail = '$idprdetailupdate' AND pr_header = '$idpr'") or die(mysql_error());
                if ($updateQty) {
                    header('location:pr-detail.php?id=' . $idpr);
                } else {
                    echo '2. error update quantity -> add item but update <br>';
                    ?>
                    <a href="pr-detail.php?id='<?php echo $idpr; ?>"> << Back </a>
                    <?php
                }
            } else {
                continue;
            }
        }
    } else {
        $queryAdd = mysql_query("INSERT INTO t_pr_detail (item, qty, pr_header) VALUES ('$item', '$qty', '$idpr')") or die(mysql_error());
        echo 'masuk add new';
        if ($queryAdd) {
            header('location:pr-detail.php?id=' . $idpr);
        } else {
            echo '4. error add new pr detail<br>';
            ?>
            <a href="pr-detail.php?id='<?php echo $idpr; ?>"> << Back </a>
            <?php
        }
    }
}
?>