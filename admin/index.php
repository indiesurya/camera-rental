<?php
session_start();
//koneksi ke database
include '../koneksi.php';
if(!isset($_SESSION['admin'])){
    echo "<script>alert('Anda Harus Login');</script>";
    echo "<script>location='login.php';</script>";
    exit();
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Dashboard Admin</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/vendor/linearicons/style.css">
    <link rel="stylesheet" href="assets/vendor/chartist/css/chartist-custom.css">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="assets/css/main.css">
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <!-- ICONS -->
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/logo-tittle.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/img/logo-tittle.png">
        <!-- Javascript -->
        <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
    <script src="assets/scripts/klorofil-common.js"></script>
    <script>
        $(document).ready(function() {
            $("ul li a").on("click",function(){
                $('li a').removeClass("active");
                $(this).addClass("active");
            });
        });
    </script>
</head>

<body>
    <!-- WRAPPER -->
    <div id="wrapper">
        <!-- NAVBAR -->
        <nav class="navbar navbar-default navbar-fixed-top">
            <!-- Logo Sisuka -->
            <div class="brand">
                <a href="index.php"><img src="assets/img/logo.png" alt="Klorofil Logo" class="img-responsive logo"></a>
            </div>
            <div class="container-fluid">
                <div class="navbar-btn">
                    <button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
                </div>
                <div id="navbar-menu">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                                <i class="lnr lnr-alarm"></i>
                                <span class="badge bg-danger">5</span>
                            </a>
                            <ul class="dropdown-menu notifications">
                                <li><a href="#" class="notification-item"><span class="dot bg-warning"></span>System space is almost full</a></li>
                                <li><a href="#" class="notification-item"><span class="dot bg-danger"></span>You have 9 unfinished tasks</a></li>
                                <li><a href="#" class="notification-item"><span class="dot bg-success"></span>Monthly report is available</a></li>
                                <li><a href="#" class="notification-item"><span class="dot bg-warning"></span>Weekly meeting in 1 hour</a></li>
                                <li><a href="#" class="notification-item"><span class="dot bg-success"></span>Your request has been approved</a></li>
                                <li><a href="#" class="more">See all notifications</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="assets/img/admin.jpeg" class="img-circle" alt="Avatar"> <span>Admin</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="#"><i class="lnr lnr-user"></i> <span>My Profile</span></a></li>
                                <li><a href="index.php?halaman=logout"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
        <!-- END NAVBAR -->
        <!-- LEFT SIDEBAR -->
        <div id="sidebar-nav" class="sidebar">
            <div class="sidebar-scroll">
                <nav>
                    <ul class="nav">
                        <br>
                        <div class="text-center mt-5">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img style="width: 150px;" src="assets/img/admin.jpeg" class="img-circle" alt="Avatar">
                        </div>
                        <li><a href="index.php" class="sidebar-menu"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
                        <li><a href="index.php?halaman=produk" class="sidebar-menu"><i class="lnr lnr-camera"></i> <span>Produk</span></a></li>
                        <li><a href="index.php?halaman=kategori" class="sidebar-menu"><i class="lnr lnr-store"></i> <span>Kategori</span></a></li>
                        <li><a href="index.php?halaman=pembelian" class="sidebar-menu"><i class="lnr lnr-cart"></i> <span>Pembelian</span></a></li>
                        <li><a href="index.php?halaman=laporan_pembelian" class="sidebar-menu"><i class="lnr lnr-book"></i> <span>Laporan Pembelian</span></a></li>
                        <li><a href="index.php?halaman=user" class="sidebar-menu"><i class="lnr lnr-users"></i> <span>User</span></a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- END LEFT SIDEBAR -->
        <!-- MAIN -->
        <div class="main">
            <!-- MAIN CONTENT -->
                <div class="main-content">
                    <div class="container-fluid">
                        <div class="panel">
                        <?php
                 if(isset($_GET['halaman'])){
                    if($_GET['halaman']=="produk"){
                        include 'produk.php';
                    }
                    else if($_GET['halaman']=="pembelian"){
                        include 'pembelian.php';
                    }
                    else if($_GET['halaman']=="kategori"){
                        include 'kategori.php';
                    }
                    else if($_GET['halaman']=="user"){
                        include 'user.php';
                    }
                    else if($_GET['halaman']=="tambahproduk"){
                        include 'tambahproduk.php';
                    }
                    else if($_GET['halaman']=="hapusproduk"){
                        include 'hapusproduk.php';
                    }
                    else if($_GET['halaman']=="editproduk"){
                        include 'editproduk.php';
                    }
                    else if($_GET['halaman']=="detailpembelian"){
                        include 'detailpembelian.php';
                    }
                    else if($_GET['halaman']=="hapususer"){
                        include 'hapususer.php';
                    }
                    else if($_GET['halaman']=="edituser"){
                        include 'edituser.php';
                    }
                    else if($_GET['halaman']=="logout"){
                        include 'logout.php';
                    }
                    else if($_GET['halaman']=="pembayaran"){
                        include 'pembayaran.php';
                    }
                    else if($_GET['halaman']=="laporan_pembelian"){
                        include 'laporan_pembelian.php';
                    }
                    else if($_GET['halaman']=="kategori"){
                        include 'kategori.php';
                    }
                    else if($_GET['halaman']=="tambahkategori"){
                        include 'tambahkategori.php';
                    }
                    else if($_GET['halaman']=="hapuskategori"){
                        include 'hapuskategori.php';
                    }
                    else if($_GET['halaman']=="editkategori"){
                        include 'editkategori.php';
                    }
                    else if($_GET['halaman']=="detailproduk"){
                        include 'detailproduk.php';
                    }
                    else if($_GET['halaman']=="hapusfotoproduk"){
                        include 'hapusfotoproduk.php';
                    }


                 }
                 else{
                     include 'home.php';
                 }
                 ?> 
                        </div>
                    </div>
                </div>
            <!-- END MAIN CONTENT -->
        </div>
        <!-- END MAIN -->
        <div class="clearfix"></div>
        <footer>
            <div class="container-fluid">
                <p class="copyright">Created by Sisuka Team <i class="fa fa-love"></i>
                </p>
            </div>
        </footer>
    </div>
    <!-- END WRAPPER -->

</body>

</html>