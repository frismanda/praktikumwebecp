<?php
	include "../admin/config.php";
    if (!isset($_SESSION["username"])) {
     echo '<meta http-equiv="refresh" content="0;URL=../index.php" />';
    }
	$getIdSup = $_GET["id_supplier"];
	$editSup = "SELECT * FROM supplier WHERE id_supplier = '$getIdSup'";
	$resultSup = mysqli_query($koneksi, $editSup);
	$dataSup = mysqli_fetch_array($resultSup);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
        <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>Edit Data Supplier</title>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
        <!--     Fonts and icons     -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
        <!-- CSS Files -->
        <link href="../assets/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
        <link href="../assets/css/light-bootstrap-dashboard.css?v=2.0.1" rel="stylesheet" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
       
    </head>
    <body>
    <div class="wrapper">
        <div class="sidebar" data-image="../assets/img/sidebar-5.jpg">
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="../index.php" class="simple-text">
                        SI Penjualan
                    </a>
                </div>
                <ul class="nav">
                    <li>
                        <a class="nav-link" href="../index.php">
                            <i class="nc-icon nc-chart-pie-35"></i>
                            <p>Dashboard Utama</p>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="../data_supplier/barang_view.php">
                            <i class="nc-icon nc-circle-09"></i>
                            <p>Data Barang</p>
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#">
                            <i class="nc-icon nc-circle-09"></i>
                            <p>Data Supplier</p>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="../data_supplier/supplier_view.php">
                            <i class="nc-icon nc-notes"></i>
                            <p>Data Supplier</p>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="../data_pengeluaran/pengeluaran_view.php">
                            <i class="nc-icon nc-paper-2"></i>
                            <p>Data Pengeluaran</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg " color-on-scroll="500">
                <div class=" container-fluid  ">
                    <a class="navbar-brand" href="#"> Edit data supplier </a>
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        <ul class="nav navbar-nav mr-auto">
                        </ul>
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="../logout.php">
                                    <span class="no-icon">Log out</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
            	<div class="col-md-12">
                	<div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
    </div>
    <br>
    <div class="container">
    	<div class="container-fluid">
    		<div class="fresh-datatables toolbar-color-blue">
    		<?php
				if(!isset($_POST['submit'])){
			?>
    			<form enctype="multipart/form-data" method="post">
    				<div class="form-group row">
    					<div class="form-group col-md-6">
      						<label for="inputEmail4">Nama Supplier</label>
      		<input type="text" hidden="" name="id_supplier" value="<?= $dataSup[0]; ?>">
      		<input type="text" class="form-control" placeholder="Nama Supplier" name="nama_supplier" value="<?= $dataSup[1]; ?>">
    					</div>
  					</div>
  					<input type="submit" class="btn btn-danger" name="submit" value="Update Data Supplier">
    			</form><br>
    		<?php
		} else {
			$kodeSup = $_POST["id_supplier"];
			$namaSup = $_POST["nama_supplier"];

			$updateSup = "UPDATE supplier SET nama_supplier = '$namaSup' WHERE id_supplier = '$kodeSup'";
			
			
			$querySup = mysqli_query($koneksi, $updateSup);

			// echo "<pre>";
			// print_r($updateSup);
			// echo "<pre>";
			// die();

			if($querySup){
				echo "<script>alert('Data Supplier Berhasil Dirubah')</script>";
				echo "<script type='text/javascript'>window.location='supplier_view.php'</script>";
				// print_r($updateSup); 
				// die;
			} else {
				echo "<script>alert('Data Supplier Gagal Dirubah')</script>";
				echo "<script type='text/javascript'>window.location='supplier_view.php'</script>";
				// print_r($updateSup);
				// die;
			}
		}
	?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<footer class="footer">
    <div class="container">
        <nav>
            <p class="copyright text-center">
                ©
                <script>
                    document.write(new Date().getFullYear())
                </script>
                <a href="#">SI Penjualan</a>
            </p>
        </nav>
    </div>
</footer>
</body>

<!--   Core JS Files   -->
<script src="../assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="../assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="../assets/js/plugins/bootstrap-switch.js"></script>
<!--  Chartist Plugin  -->
<script src="../assets/js/plugins/chartist.min.js"></script>
<!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
<script src="../assets/js/light-bootstrap-dashboard.js?v=2.0.1" type="text/javascript"></script>
<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
<script src="../assets/js/demo.js"></script>
</html>