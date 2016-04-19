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

        <title>Supplier List | denypribadi</title>

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
                $('.edit-supplier').on('click', function() {
                    var idSUpp = $(this).closest('tr').attr('data-idsupp'),
                            suppName = $(this).closest('tr').attr('data-suppname'),
                            telp = $(this).closest('tr').attr('data-telp'),
                            address = $(this).closest('tr').attr('data-address'),
                            city = $(this).closest('tr').attr('data-city');
                    $('#id-idsupplier-input').val(idSUpp).attr('disabled', 'disabled');
                    $('#id-idsupplier-hidden').val(idSUpp).removeAttr('disabled');
                    $('#id-suppliername-input').val(suppName);
                    $('#id-telp-input').val(telp);
                    $('#id-address-input').val(address);
                    $('#id-city-input').val(city);
                    $('#id-submit').val('Save Change');
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
                            <a href="javascript:;"  class="active">
                                <i class="fa fa-list"></i>
                                <span>Inventories</span>
                            </a>
                            <ul class="sub">
                                <li><a  href="item.php">Items</a></li>
                                <li class="active"><a  href="supplier.php">Suppliers</a></li>
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
                    <h2><i class="fa fa-truck"></i> Supplier List</h2>
                    <br>
                    <!--DEPARTMENT ADD START-->
                    <div class="row">
                        <div class="col-md-12">
                            <section class="panel">
                                <header class="panel-heading">
                                    <a href="javascript:;"> <i class="fa fa-plus-square"></i> Add New Supplier</a>
                                    <span class="tools pull-right">
                                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                                    </span>
                                </header>
                                <div class="panel-body">
                                    <form action="supplier-add.php" class="form-horizontal" method="get">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">ID Supplier</label>
                                            <div class="col-md-3 col-xs-11">
                                                <input class="form-control form-control-inline input-medium" size="16" type="text"maxlength="6" name='idsupplier' id="id-idsupplier-input"/>
                                                <input type="hidden" value="" name="idsupplier" id="id-idsupplier-hidden" disabled="disabled"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Supplier Name</label>
                                            <div class="col-md-3 col-xs-11">
                                                <input class="form-control form-control-inline input-medium"  size="16" type="text" maxlength="50" name='suppliername' id="id-suppliername-input"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Telephone</label>
                                            <div class="col-md-3 col-xs-11">
                                                <input class="form-control form-control-inline input-medium"  size="16" type="text" maxlength="15" name='telp' id="id-telp-input"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Address</label>
                                            <div class="col-md-3 col-xs-11">
                                                <textarea class="form-control form-control-inline input-medium" size="16" maxlength="50" name='address' id="id-address-input"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">City</label>
                                            <div class="col-md-3 col-xs-11">
                                                <input class="form-control form-control-inline input-medium"  size="16" type="text" maxlength="50" name='city' id="id-city-input"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3"></label>
                                            <div class="col-md-3 col-xs-11">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fa fa-save"></i> Save
                                                </button>
                                                <a href="supplier.php" class="btn btn-default hide" id="id-cancel-edit"><i class="fa fa-refresh"></i> Cancel</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </section>
                        </div>
                    </div>
                    <!--DEPARTMENT ADD END-->

                    <!--TABLE START-->

                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">
                                <div class="panel-body">
                                    <div class="adv-table">
                                        <table  class="display table table-bordered table-striped" id="example">
                                            <thead>
                                                <tr>
                                                    <th>ID Supplier</th>
                                                    <th>Supplier Name</th>
                                                    <th>Telephone</th>
                                                    <th>Address</th>
                                                    <th>City</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $queryDepList = mysql_query('SELECT * FROM m_supplier ORDER BY id_supplier DESC');
                                                while ($row = mysql_fetch_array($queryDepList, MYSQL_ASSOC)) {
                                                    ?>
                                                    <tr data-idsupp="<?php echo $row['id_supplier']; ?>" data-suppname="<?php echo $row['supplier_name']; ?>" data-address="<?php echo $row['address']; ?>" data-city="<?php echo $row['city']; ?>" data-telp="<?php echo $row['telphone']; ?>">
                                                        <td><?php echo $row['id_supplier']; ?></td>
                                                        <td><?php echo $row['supplier_name']; ?></td>
                                                        <td><?php echo $row['telphone']; ?></td>
                                                        <td><?php echo $row['address']; ?></td>
                                                        <td><?php echo $row['city']; ?></td>
                                                        <td align='center'>
                                                            <a class="edit-supplier btn btn-warning"><i class="fa fa-edit"></i> Edit</a> &nbsp;&nbsp;
                                                            <a href="supplier-delete.php?id=<?php echo $row['id_supplier']; ?>" class="delete-item btn btn-danger"><i class="fa fa-times"></i> Delete</a>
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
    </body>
</html>
