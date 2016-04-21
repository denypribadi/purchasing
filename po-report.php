<?php
session_start();
ob_start();
include_once("koneksi.php");
$pocode = $_GET['pocode'];
$sql = "SELECT * FROM t_po ";
$sql .= "JOIN t_pr_header ON id_pr = pr_header ";
$sql .= "JOIN m_supplier ON id_supplier = supplier ";
$sql .= "WHERE id_po = '$pocode'";
$getPO = mysql_query($sql);
$cekPO = mysql_fetch_array($getPO);
?>  
<html xmlns="http://www.w3.org/1999/xhtml"> 
    <head>  
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />  
        <title>Purchase Request</title>
    </head>  
    <body>  
        <br>
            <br>
                <h1 align="center">Purchase Order</h1>
                <br>
                    <table border="0">  
                        <tr>  
                            <td width="120">PO Code</td>  
                            <td width="10">:</td>  
                            <td width="300"><?php echo $pocode; ?></td>  
                            <td width="130">Deny Pribadi</td> 
                        </tr>  
                        <tr>  
                            <td>Date</td>  
                            <td>:</td>  
                            <?php
                            $tgl = $cekPO['date'];
                            $tgl = date("d M Y", strtotime($tgl));
                            ?>
                            <td><?php echo $tgl; ?></td> 
                            <td>JL. Krukah Timur VII / 1 b</td> 
                        </tr>  
                        <tr>  
                            <td>To Supplier</td>  
                            <td>:</td>  
                            <td><strong><?php echo strtoupper($cekPO['supplier_name']); ?></strong></td>  
                            <td>Surabaya</td> 
                        </tr>
                    </table>
                    <p><strong>Item Details</strong></p>
                    <table rules="all" style="border: 1px;">
                        <tr style="background-color: grey;">
                            <td width="100"><strong>Item Code</strong></td>  
                            <td width="400"><strong>Item</strong></td>  
                            <td width="100" align="right"><strong>Quantity</strong></td> 
                        </tr>
                        <?php
                        $listDetailQuery = "SELECT * FROM t_pr_detail ";
                        $listDetailQuery .= "JOIN m_item ON m_item.id_item = t_pr_detail.item ";
                        $listDetailQuery .= "WHERE t_pr_detail.pr_header = '" . $cekPO['pr_header'] . "' ORDER BY id_pr_detail ";
                        $queryPRList = mysql_query($listDetailQuery);
                        while ($row = mysql_fetch_array($queryPRList, MYSQL_ASSOC)) {
                            $icode = $row['id_item'];
                            $iname = $row['item_name'];
                            $iqty = $row['qty'];
                            echo '<tr><td>' . $icode . '</td><td>' . $iname . '</td><td align="right" >' . $iqty . '</td></tr>';
                        }
                        ?>
                    </table>
                    <p align="right">Head Of Department<br><br><br><br><br><br>(Deny Setiawan)   </p>
                                                </body>  
                                                </html> 
                                                <?php
                                                $filename = "PO-" . $pocode . ".pdf";
                                                $content = ob_get_clean();
                                                $content = '<page style="font-family: freeserif">' . nl2br($content) . '</page>';
                                                require_once(dirname(__FILE__) . '/html2pdf/html2pdf.class.php');
                                                try {
                                                    $html2pdf = new HTML2PDF('P', 'A4', 'en', false, 'ISO-8859-15', array(30, 0, 20, 0));
                                                    $html2pdf->setDefaultFont('Arial');
                                                    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
                                                    $html2pdf->Output($filename);
                                                } catch (HTML2PDF_exception $e) {
                                                    echo $e;
                                                }
                                                ?>