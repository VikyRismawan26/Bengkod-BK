<?php
session_start();

//koneksi ke database
include('koneksi.php');

// if(!isset($_SESSION['pasien'])){
// 	// echo "<script>location='login.php';</script>";
// 	header('location:loginpasien.php');
// }

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />	
	<title>Poliklinik | Pasien</title>
	<!-- BOOTSTRAP STYLES-->
	<link href="assets/css/bootstrap.css" rel="stylesheet" />
	<!-- FONTAWESOME STYLES-->
	<link href="assets/css/font-awesome.css" rel="stylesheet" />
	<!-- MORRIS CHART STYLES-->
	<link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
	<!-- CUSTOM STYLES-->
	<link href="assets/css/custom.css" rel="stylesheet" />
	<!-- GOOGLE FONTS-->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
	<!-- JQUERY SCRIPTS -->
	<script src="assets/js/jquery-1.10.2.js"></script>
</head>
<body>

<div id="wrapper">
	<nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<!-- <a class="navbar-brand" href="index.php"><img src= "./assets/img/UMKMZone.png" alt="UMKMZone" width="" height="80"></a>  -->
			<a class="navbar-brand" href="index.php">Sistem Poliklinik</a> 
		</div>
		<div style="color: white;
		padding: 15px 50px 5px 50px;
		float: right;
		font-size: 16px;"> &nbsp; <a href="index.php?halaman=logout" class="btn btn-danger square-btn-adjust">Logout</a> 
		</div>
	</nav>

    <!-- /. NAV TOP  -->
    <nav class="navbar-default navbar-side" role="navigation">
			<div class="sidebar-collapse">
				<ul class="nav" id="main-menu">
					<!-- <li class="text-center">
						<img src="assets/img/logo_kota.png" class="user-image img-responsive"/>
					</li> -->
					<li>
						<a href="index.php"><i class="fa fa-dashboard"></i>Home</a>
					</li>
					<li>
						<a href="index.php?halaman=daftarpoli"><i class="fa fa-cube"></i> Daftar Poli</a>
					</li>
					<li>
						<a href="index.php?halaman=kelolapasien"><i class="fa fa-question-circle"></i>Kelola Pasien Pasien</a>
					</li>
					<li>
						<a href="index.php?halaman=faq"><i class="fa fa-question-circle"></i>Kelola Poli</a>
					</li>
					<li>
						<a href="index.php?halaman=faq"><i class="fa fa-question-circle"></i>Kelola Obat</a>
					</li>
					<li>
						<a href="index.php?halaman="><i class="fa fa-sign-out"></i>Profil</a>
					</li>      
					<li>
						<a href="index.php?halaman=logout"><i class="fa fa-sign-out"></i>Logout</a>
					</li>      
				</ul>
			</div>   
    </nav>  
    <!-- /. NAV SIDE  -->

    <!-- konten -->
    <div id="page-wrapper" >
			<div id="page-inner">
				<?php	
					if(isset($_GET["halaman"])){
						if($_GET["halaman"] == "keloladokter"){
							include 'keloladokter.php';
						}elseif($_GET["halaman"] == "kelolapasien"){
							include 'kelolapasien.php';
						}elseif($_GET["halaman"] == "survei"){
							include 'survei.php';
						}
					}
					else{
						include 'home.php';
					}
				?>                        
			</div>
    </div>
    <!-- akhir konten -->

</div>
	<!-- /. WRAPPER  -->

	<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
	<!-- BOOTSTRAP SCRIPTS -->
	<script src="assets/js/bootstrap.min.js"></script>
	<!-- METISMENU SCRIPTS -->
	<script src="assets/js/jquery.metisMenu.js"></script>
	<!-- MORRIS CHART SCRIPTS -->
	<script src="assets/js/morris/raphael-2.1.0.min.js"></script>
	<script src="assets/js/morris/morris.js"></script>
	<!-- CUSTOM SCRIPTS -->
	<script src="assets/js/custom.js"></script>
    
</body>
</html>
