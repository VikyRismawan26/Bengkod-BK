<?php
session_start();
//koneksi ke database
include('koneksi.php')
?>

<?php
if(isset($_POST['login'])){
    $ambil = $koneksi->query("SELECT * FROM admin WHERE username='$_POST[user]' AND password='$_POST[pass]'");
    $yangcocok = $ambil->num_rows;

    if($yangcocok == 1){
        $_SESSION['admin'] = $ambil->fetch_assoc();
        echo "<div class='alert alert-info'>Login sukses</div>";
        echo "<meta http-equiv='refresh' content='1;url=index.php'>";
    }
    else{
        echo "<div class='alert alert-danger'>Login gagal!</div>";
        echo "<meta http-equiv='refresh' content='1;url=login.php'>";
    }
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Admin</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <style>
        body {
            background-color: #f8f9fa;
        }
        h2, .panel-heading {
            color: #dc3545;
        }
        .panel-default {
            border-color: #dc3545;
        }
        .panel-default > .panel-heading {
            background-color: #dc3545;
            color: white;
        }
        .btn-primary {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-primary:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
        .input-group-addon {
            background-color: #dc3545;
            color: white;
            border-color: #dc3545;
        }
        .form-control:focus {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
        }
        .alert-info {
            background-color: #d1ecf1;
            border-color: #bee5eb;
            color: #0c5460;
        }
        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }
        a {
            color: #dc3545;
        }
        a:hover {
            color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row text-center">
            <div class="col-md-12">
                <br /><br />
                <h2>Login Sebagai Admin</h2>
                <h5></h5>
                <br />
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>Silahkan Isi Form Berikut</strong>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post"><br />
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                <input type="text" class="form-control" name="user" placeholder="Username" />
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" class="form-control" name="pass" placeholder="Password" />
                            </div>
                            <div class="form-group">
                                <label class="checkbox-inline">
                                    <input type="checkbox" /> Ingat Saya
                                </label>
                            </div>
                            <button class="btn btn-primary btn-block" name="login">Login</button>
                            <hr />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SCRIPTS AT THE BOTTOM TO REDUCE LOAD TIME -->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
