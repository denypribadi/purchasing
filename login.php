<?php
session_start();
if (isset($_SESSION['iduser'])) {
    header('location:index.php');
}
require_once("koneksi.php");
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

        <title>Login | denypribadi</title>

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-reset.css" rel="stylesheet">
        <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link href="css/style.css" rel="stylesheet">
        <link href="css/style-responsive.css" rel="stylesheet" />
    </head>

    <body class="login-body">
        <div class="container">
            <form class="form-signin" action="proseslogin.php" method="post">
                <h2 class="form-signin-heading">sign in now</h2>
                <div class="login-wrap">
                    <input type="text" name="username" class="form-control" placeholder="Username" autofocus>
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <button class="btn btn-lg btn-login btn-block" type="submit">Sign in</button>
                </div>
            </form>
        </div>
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
