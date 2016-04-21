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

        <title>PR List | denypribadi</title>

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
                                <li><a  href="pr.php">Purchase Request</a></li>
                                <li class="active"><a  href="pr-history.php">PR History</a></li>
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
                    <h2><i class="fa fa-shopping-cart"></i> Purchase Request History List</h2>
                    <br>
                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">
                                <div class="panel-body">
                                    <div class="adv-table">
                                        <table  class="display table table-bordered table-striped" id="example">
                                            <thead>
                                                <tr>
                                                    <th>PR Code</th>
                                                    <th>Request Date</th>
                                                    <th>Request By</th>
                                                    <th>Department</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = "SELECT * FROM t_pr_header ";
                                                $sql .= "JOIN m_user ON m_user.id_user = t_pr_header.`user` ";
                                                $sql .= "JOIN m_department ON m_department.id_department = t_pr_header.department ";
                                                $sql .= "WHERE t_pr_header.id_pr IN (SELECT t_po.pr_header FROM t_po)";
                                                $queryPRList = mysql_query($sql);
                                                while ($row = mysql_fetch_array($queryPRList, MYSQL_ASSOC)) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $row['id_pr']; ?></td>
                                                        <?php
                                                        $tgl = $row['date'];
                                                        $tgl = date("d M Y", strtotime($tgl));
                                                        ?>
                                                        <td><?php echo $tgl; ?></td>
                                                        <td><?php echo $row['id_user'] . ' -- ' . strtoupper($row['full_name']); ?></td>
                                                        <td><?php echo $row['department_name']; ?></td>
                                                        <td align='center'>
                                                            <a class="btn btn-info" href="pr-detail.php?id=<?php echo $row['id_pr']; ?>"><i class="fa fa-file"></i> View</a> &nbsp;&nbsp;
                                                            <a class="btn btn-default" href="javascript:void(0);"  
                                                               onclick="window.open('pr-report.php?prcode=<?php echo $row['id_pr']; ?>', 'Print PR #<?php echo $row['id_pr']; ?>', 'fullscreen=yes,scrollbars=yes,resizeable=no')"><i class="fa fa-print"></i> Print</a>  

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
                    <!--TABLE END-->
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
