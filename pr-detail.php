<?php
session_start();
if (!isset($_SESSION['iduser'])) {
    header('location:login.php');
} else {
    $iduser = $_SESSION['iduser'];
}
require_once("koneksi.php");
$query = mysql_query("SELECT * FROM m_user WHERE id_user = '$iduser'");
$hasil = mysql_fetch_array($query);

$idPR = $_GET['id'];
$sql = "SELECT h.id_pr, h.date ,u.id_user, u.full_name, d.department_name FROM t_pr_header h ";
$sql .= "JOIN m_user u ON u.id_user = h.`user` ";
$sql .= "JOIN m_department d ON d.id_department = h.department ";
$sql .= "WHERE h.id_pr = '$idPR'";
$getPR = mysql_query($sql);
$cekPR = mysql_fetch_array($getPR);
if (!$cekPR) {
    header("location:pr.php");
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Mosaddek">
        <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
        <link rel="shortcut icon" href="img/favicon.png">

        <title>PR Detail | denypribadi</title>

        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-reset.css" rel="stylesheet">
        <!--external css-->
        <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link href="assets/advanced-datatable/media/css/demo_page.css" rel="stylesheet" />
        <link href="assets/advanced-datatable/media/css/demo_table.css" rel="stylesheet" />
        <link rel="stylesheet" href="assets/data-tables/DT_bootstrap.css" />
        <!-- Custom styles for this template -->
        <link href="css/style.css" rel="stylesheet">
        <link href="css/style-responsive.css" rel="stylesheet" />

        <script src="js/jquery-1.8.3.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('.edit-pr-detail').on('click', function() {
                    var prd = $(this).closest('tr').attr('data-idprdetail'),
                            icode = $(this).closest('tr').attr('data-icode'),
                            iqty = $(this).closest('tr').attr('data-iqty');

                    $('#id-item-input').val(icode);
                    $('#id-qty-input').val(iqty);
                    $('#id-idprdetail-hidden').val(prd);
                    $('#id-cancel-edit').removeClass('hide');
                });
            });

        </script>

    </head>

    <body>

        <section id="container" >
            <!--header start-->
            <header class="header white-bg">
                <div class="sidebar-toggle-box">
                    <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
                </div>
                <!--logo start-->
                <a href="index.php" class="logo">deny<span>pribadi</span></a>
                <!--logo end-->

                <div class="top-nav ">
                    <!--search & user info start-->
                    <ul class="nav pull-right top-menu">
                        <!-- user login dropdown start-->
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="username"><?php echo strtoupper($hasil['full_name']); ?></span>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu extended logout">
                                <div class="log-arrow-up"></div>
                                <li><a href="usersetting.php"><i class="fa fa-cog"></i> User Settings</a></li>
                                <li><a href="proseslogout.php"><i class="fa fa-key"></i> Sign Out</a></li>
                            </ul>
                        </li>
                        <!-- user login dropdown end -->
                    </ul>
                    <!--search & user info end-->
                </div>
            </header>
            <!--header end-->
            <!--sidebar start-->
            <aside>
                <div id="sidebar"  class="nav-collapse ">
                    <!-- sidebar menu start-->
                    <ul class="sidebar-menu" id="nav-accordion">
                        <li>
                            <a class="" href="index.php">
                                <i class="fa fa-dashboard"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;" class="" >
                                <i class="fa fa-users"></i>
                                <span>Users</span>
                            </a>
                            <ul class="sub">
                                <li class=""><a  href="department.php">Departments</a></li>
                                <li><a  href="user.php">Users</a></li>
                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-list"></i>
                                <span>Inventories</span>
                            </a>
                            <ul class="sub">
                                <li><a  href="item.php">Items</a></li>
                                <li><a  href="supplier.php">Suppliers</a></li>
                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;" class="active">
                                <i class="fa fa-shopping-cart"></i>
                                <span>Purchasing</span>
                            </a>
                            <ul class="sub">
                                <li class="active"><a  href="pr.php">Purchase Request</a></li>
                                <li><a  href="po.php">Purchase Order</a></li>
                                <li><a  href="rr.php">Receiving Order</a></li>
                            </ul>
                        </li>                  
                        <!--multi level menu end-->
                    </ul>
                    <!-- sidebar menu end-->
                </div>
            </aside>
            <!--sidebar end-->
            <!--main content start-->
            <section id="main-content">
                <section class="wrapper site-min-height">
                    <!--JUDUL-->
                    <h2><i class="fa fa-shopping-cart"></i> Purchase #<?php echo $cekPR['id_pr']; ?></h2>
                    <br>
                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">
                                <header class="panel-heading">
                                    <strong>Details</strong>
                                </header>
                                <div class="panel-body">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td width="100">Request By</td>
                                                <td width="25">:</td>
                                                <td><?php echo strtoupper($cekPR['full_name']); ?></td>
                                            </tr>
                                            <tr>
                                                <td width="100">Department</td>
                                                <td width="25">:</td>
                                                <td><?php echo strtoupper($cekPR['department_name']); ?></td>
                                            </tr>                                            
                                            <tr>
                                                <td width="100">Request Date</td>
                                                <td width="25">:</td>
                                                <?php
                                                $tgl = $cekPR['date'];
                                                $tgl = date("d M Y", strtotime($tgl));
                                                ?>
                                                <td><?php echo $tgl; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </section>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <section class="panel">
                                <header class="panel-heading">
                                    <a href="javascript:;"> <i class="fa fa-plus-square"></i> Add Item Request</a>
                                    <span class="tools pull-right">
                                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                                    </span>
                                </header>
                                <div class="panel-body">
                                    <form action="pr-detail-add.php" class="form-horizontal" method="get">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Item</label>
                                            <div class="col-md-3 col-xs-11">
                                                <select name="item" class="form-control form-control-inline input-medium" id="id-item-input">
                                                    <?php
                                                    $queryItem = mysql_query('SELECT * FROM m_item');
                                                    while ($row = mysql_fetch_array($queryItem, MYSQL_ASSOC)) {
                                                        echo '<option value="' . $row['id_item'] . '">' . $row['id_item'] . ' -- ' . strtoupper($row['item_name']) . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                                <input type="hidden" name="prheader" value="<?php echo $cekPR['id_pr']; ?>"/>
                                                <input type="hidden" name="idprdetail" value="" id="id-idprdetail-hidden"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Quantity</label>
                                            <div class="col-md-3 col-xs-11">
                                                <input type="number" class="form-control form-control-inline input-medium" name="qty" id="id-qty-input" min="1"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3"></label>
                                            <div class="col-md-3 col-xs-11">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fa fa-save"></i> Save
                                                </button>
                                                <a href="pr-detail.php?id=<?php echo $cekPR['id_pr']; ?>" class="btn btn-default hide" id="id-cancel-edit"><i class="fa fa-refresh"></i> Cancel</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </section>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">
                                <div class="panel-body">
                                    <div class="adv-table">
                                        <table  class="display table table-bordered table-striped" id="example">
                                            <thead>
                                                <tr>
                                                    <th>Code</th>
                                                    <th>Item</th>
                                                    <th>Quantity</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $listDetailQuery = "SELECT * FROM t_pr_detail ";
                                                $listDetailQuery .= "JOIN m_item ON m_item.id_item = t_pr_detail.item ";
                                                $listDetailQuery .= "WHERE t_pr_detail.pr_header = '$idPR' ORDER BY id_pr_detail ";
                                                $queryPRList = mysql_query($listDetailQuery);
                                                while ($row = mysql_fetch_array($queryPRList, MYSQL_ASSOC)) {
                                                    $prdetailid = $row['id_pr_detail'];
                                                    $icode = $row['id_item'];
                                                    $iname = $row['item_name'];
                                                    $iqty = $row['qty'];
                                                    echo '<tr data-idprdetail="' . $prdetailid . '" data-icode="' . $icode . '" data-iname="' . $iname . '" data-iqty="' . $iqty . '">';
                                                    ?>
                                                <td><?php echo $row['id_item']; ?></td>
                                                <td><?php echo $row['item_name']; ?></td>
                                                <td><?php echo $row['qty']; ?></td>
                                                <td align='center'>
                                                    <a class="edit-pr-detail btn btn-warning"><i class="fa fa-edit"></i> Edit</a> &nbsp;&nbsp;
                                                    <a href="pr-detail-delete.php?id=<?php echo $row['id_pr_detail']; ?>" class="delete-user btn btn-danger"><i class="fa fa-times"></i> Delete</a>
                                                </td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </section>
            </section>
            <!--main content end-->
            <!--footer start-->
            <footer class="site-footer">
                <div class="text-center">
                    2016 &copy; denypribadi
                    <a href="#" class="go-top">
                        <i class="fa fa-angle-up"></i>
                    </a>
                </div>
            </footer>
            <!--footer end-->
        </section>

        <script type="text/javascript" language="javascript" src="assets/advanced-datatable/media/js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script class="include" type="text/javascript" src="js/jquery.dcjqaccordion.2.7.js"></script>
        <script src="js/jquery.scrollTo.min.js"></script>
        <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
        <script type="text/javascript" language="javascript" src="assets/advanced-datatable/media/js/jquery.dataTables.js"></script>
        <script type="text/javascript" src="assets/data-tables/DT_bootstrap.js"></script>
        <script src="js/respond.min.js" ></script>


        <!--common script for all pages-->
        <script src="js/common-scripts.js"></script>

        <!--script for this page only-->

        <script type="text/javascript" charset="utf-8">
            $(document).ready(function() {
                $('#example').dataTable({
                    "aaSorting": [[4, "desc"]]
                });
            });
        </script>

<!--<script src="js/advanced-form-components.js"></script>-->
    </body>
</html>
