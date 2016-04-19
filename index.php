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
        <meta name="keyword" content="">
        <link rel="shortcut icon" href="img/favicon.png">

        <title>Dashboard | denypribadi</title>

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-reset.css" rel="stylesheet">
        <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link href="assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
        <link rel="stylesheet" href="css/owl.carousel.css" type="text/css">
        <link href="css/style.css" rel="stylesheet">
        <link href="css/style-responsive.css" rel="stylesheet" />
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
                            <a class="active" href="index.php">
                                <i class="fa fa-dashboard"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;" >
                                <i class="fa fa-users"></i>
                                <span>Users</span>
                            </a>
                            <ul class="sub">
                                <li><a  href="department.php">Departments</a></li>
                                <li><a  href="user.php">Users</a></li>
                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;" >
                                <i class="fa fa-list"></i>
                                <span>Inventories</span>
                            </a>
                            <ul class="sub">
                                <li><a  href="item.php">Items</a></li>
                                <li><a  href="supplier.php">Suppliers</a></li>
                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;" >
                                <i class="fa fa-shopping-cart"></i>
                                <span>Purchasing</span>
                            </a>
                            <ul class="sub">
                                <li><a  href="pr.php">Purchase Request</a></li>
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
                    <h2><i class="fa fa-wrench"></i> Modul Purchasing Masih Dalam Pengembangan</h2>
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

        <!-- js placed at the end of the document so the pages load faster -->
        <script src="js/jquery.js"></script>
        <script src="js/jquery-1.8.3.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script class="include" type="text/javascript" src="js/jquery.dcjqaccordion.2.7.js"></script>
        <script src="js/jquery.scrollTo.min.js"></script>
        <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
        <script src="js/jquery.sparkline.js" type="text/javascript"></script>
        <script src="assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
        <script src="js/owl.carousel.js" ></script>
        <script src="js/jquery.customSelect.min.js" ></script>
        <script src="js/respond.min.js" ></script>

        <!--common script for all pages-->
        <script src="js/common-scripts.js"></script>

        <!--script for this page-->
        <script src="js/sparkline-chart.js"></script>
        <script src="js/easy-pie-chart.js"></script>
        <script src="js/count.js"></script>

        <script>

            //owl carousel

            $(document).ready(function() {
                $("#owl-demo").owlCarousel({
                    navigation: true,
                    slideSpeed: 300,
                    paginationSpeed: 400,
                    singleItem: true,
                    autoPlay: true

                });
            });

            //custom select box

            $(function() {
                $('select.styled').customSelect();
            });

        </script>

    </body>
</html>
