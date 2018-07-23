<?php
    include "admin/config.php";

    // Data Transaksi
    $queryTransaksi = "SELECT * FROM transaksi";
    $resultTransaksi = mysqli_query($koneksi, $queryTransaksi);
    $countTransaksi = mysqli_num_rows($resultTransaksi);

    // Data Barang
    $queryBarang = "SELECT 
                   barang.id_barang,
                   barang.nama_barang AS 'Nama Barang',
                   jenis_barang.nama_jenis_barang AS 'Jenis Barang',
                   supplier.nama_supplier 'Supplier',
                   barang.modal,
                   barang.harga,
                   barang.jumlah
         FROM barang
         INNER JOIN jenis_barang ON jenis_barang.id_jenis_barang = barang.id_jenis_barang
         INNER JOIN supplier ON supplier.id_supplier = barang.id_supplier
         ORDER BY barang.id_barang";
    $resultBarang = mysqli_query($koneksi, $queryBarang);
    $countBarang = mysqli_num_rows($resultBarang);  

    // Akses File
    $file = 'kata-kata.txt';
    $bukafile = fopen($file, 'r');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>SI Penjualan Dashboard</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <script src="assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>

    


    <link href="assets/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
    <link href="assets/css/light-bootstrap-dashboard.css?v=2.0.1" rel="stylesheet" />
    <link href="assets/css/demo.css" rel="stylesheet" />
    <link href="assets/css/fresh-datatables.css" rel="stylesheet" type="text/css" >
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="assets/fonts/fontawesome-webfont.woff">
    <link rel="stylesheet" type="text/css" href="assets/fonts/fontawesome-webfont.woff2">
    <link href="assets/css/css.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css" />
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/light-bootstrap-dashboard.css?v=2.0.1" rel="stylesheet" />
    <link href="assets/css/demo.css" rel="stylesheet" />
</head>

<body>
    <div class="wrapper">
        <div class="sidebar">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

        Tip 2: you can also add an image using data-image tag
    -->
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="#" class="simple-text">
                        SI ALAN
                    </a>
                </div>
                <ul class="nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="">
                            <i class="nc-icon nc-chart-pie-35"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg " color-on-scroll="500">
                <div class=" container-fluid  ">
                    <a class="navbar-brand" href="#"> Dashboard </a>
                    <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        <ul class="nav navbar-nav mr-auto">                    
                        </ul>
                        <ul class="navbar-nav ml-auto">
                            
                            <!-- <li class="nav-item">
                                <a class="nav-link" href="logout.php">
                                    <span class="no-icon">Log out</span>
                                </a>
                            </li> -->
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->

            <!-- TABEL DATA TRANSAKSI -->
            <div class="content">
                <div class="container-fluid">
                    <div class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card strpied-tabled-with-hover">
                                        <div class="card-header ">
                                            <div class="row" style="display: contents;">
                                                <p style="float: left; font-size: 30px;">Kelola Transaksi</p>
                                                <button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#tambahModal">Tambah Data Transaksi
                                                </button>
                                            </div>
                                        </div>
                                        <div class="container">
                                            <div class="container-fluid">
                                                <div class="fresh-datatables toolbar-color-blue">
                                                <table id="fresh-datatables2" class="table table-striped table-no-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Tanggal</th>
                                                            <th>Nama Barang</th>
                                                            <th>Jumlah</th>
                                                            <th>Harga</th>
                                                            <th>Total</th>
                                                            <th>Laba</th>
                                                            <th class="disabled-sorting">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tfoot>
                                                        <tr>
                                                            <th>Tanggal</th>
                                                            <th>Nama Barang</th>
                                                            <th>Jumlah</th>
                                                            <th>Harga</th>
                                                            <th>Total</th>
                                                            <th>Laba</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </tfoot>
                                                    <tbody>
                                                        <?php if($countTransaksi > 0 ){
                                                        while($dataTransaksi = mysqli_fetch_array($resultTransaksi)){
                                                        ?>
                                                        <tr>
                                                            <td><?= "$dataTransaksi[1]"; ?></td>
                                                            <td><?= "$dataTransaksi[2]"; ?></td>
                                                            <td><?= "$dataTransaksi[3]"; ?></td>
                                                            <td><?= "$dataTransaksi[5]"; ?></td>
                                                            <td><?= "$dataTransaksi[5]"; ?></td>
                                                            <td><?= "$dataTransaksi[6]"; ?></td>
                                                            <td>
                                                                <a href="transaksi_edit.php?id_transaksi=<?= "$dataTransaksi[0]" ?>" class="edit"><i class="fa fa-edit"></i></a>
                                                                <a href="transaksi_delete.php?id_transaksi=<?= "$dataTransaksi[0]" ?>" class="remove"><i class="fa fa-times"></i></a>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                            }
                                                            } else {
                                                                echo "<tr>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td align='center'>
                                                                <div>Belum Ada Data Transaksi</div>
                                                                </td>
                                                                </tr>";
                                                            }
                                                        ?>
                                                    </tbody>
                                                </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- TABEL DATA TRANSAKSI -->


            <!-- TABEL DATA BARANG -->
            <div class="content">
            <div class="container-fluid">
            <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <div class="row" style="display: contents;">
                            <p style="float: left; font-size: 30px;">Kelola Data Barang</p>
                            <button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#tambahModal2">Tambah Data Barang
                            </button>
                        </div>
                    </div>
                    <br>
                    <div class="container">
                    <div class="container-fluid">
                    <div class="fresh-datatables toolbar-color-blue">
                    <table id="fresh-datatables" class="table table-striped table-no-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Nama Barang</th>
                            <th>Jenis Barang</th>
                            <th>Supplier</th>
                            <th>Modal</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th class="disabled-sorting">Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama Barang</th>
                            <th>Jenis Barang</th>
                            <th>Supplier</th>
                            <th>Modal</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php if($countBarang > 0 ){
                                 while($dataBarang = mysqli_fetch_array($resultBarang)){
                        ?>
                        <tr>
                            <td><?= "$dataBarang[1]"; ?></td>
                            <td><?= "$dataBarang[2]"; ?></td>
                            <td><?= "$dataBarang[3]"; ?></td>
                            <td><?= "$dataBarang[4]"; ?></td>
                            <td><?= "$dataBarang[5]"; ?></td>
                            <td><?= "$dataBarang[6]"; ?></td>
                            <td>
                                <a href="barang_edit.php?id_barang=<?= "$dataBarang[0]" ?>" class="edit"><i class="fa fa-edit"></i></a>
                                <a href="barang_delete.php?id_barang=<?= "$dataBarang[0]" ?>" class="remove"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                       <?php
                             } 
                                } else {
                                    echo "<tr>
                                            <td></td>
                                            <td align='center'>
                                                <div>Belum Ada Data Barang</div>
                                            </td>
                                          </tr>";
                                }
                                echo "";
                                echo "";
                        ?>
                    </tbody>
                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <!-- TABEL DATA BARANG -->

            <!-- Akses FILE -->
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
                                        <label style="color: #000">Kata kata dari File</label>
                                        <hr/>
                                        <div id="katakata">
                                            <?php 
                                              $myfilename = "kata-kata.txt";
                                                if(file_exists($myfilename)){
                                                  echo file_get_contents($myfilename);
                                                }
                                            ?>
                                        </div>
                                        <hr/>
                                        <form enctype="multipart/form-data" method="POST">
                                            <div class="form-group"> 
                                                <label style="color: #000">Kata kata</label>
                                                <textarea type="text" class="form-control" style="color: gray !important; border-color: gray;" name="textaksesfile" id="textaksesfile"> </textarea>
                                            </div>
                                            
                                            <input type="button" class="btn btn-primary" id="simpankata" value="Save Changes">
                                            <hr/>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <!-- Akses FILE -->



            <footer class="footer">
                <div class="container">
                    <nav>
                        <ul class="footer-menu">
                           
                        </ul>
                        <p class="copyright text-center">
                            ©
                            <script>
                                document.write(new Date().getFullYear())
                            </script>
                            <a href="#">SI Alan</a>
                        </p>
                    </nav>
                </div>
            </footer>


            <!-- Modal untuk Tambah Transaksi -->
            <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Transaksi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                        <div class="modal-body">
                         <form enctype="multipart/form-data" method="POST" class="formTransaksi">
                            <div class="form-group">
                                    <label style="color: #000">Tanggal</label>
                                    <input type="Date" class="form-control" name="tanggal">
                                    <label style="color: #000">Nama Barang</label>
                                    <input type="text" name="nama_barang" id="nama_barang" onkeyup="isi_otomatis()" class="form-control">
                                    <label style="color: #000">Harga</label>
                                    <input type="text" class="form-control" id="harga" name="harga">
                                    <label style="color: #000">Jumlah</label>
                                    <input type="text" class="form-control" name="jumlah">
                                    <label style="color: #000">Bukti Pembayaran</label>
                                    <input type="file" accept=".jpg, .png, .jpeg" name="uploaded_file" id="uploaded_file" class="form-control" />
                            </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" value="Save Changes" class="btn btn-primary" id="simpanTransaksi">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal untuk Tambah Transaksi -->

            <!-- MODAL TAMBAH DATA BARANG -->
            <div class="modal fade" id="tambahModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah data Barang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    <div class="modal-body">
                        <div class="form-group">
                           <form enctype="multipart/form-data" method="post" class="formBarang">
                                <label style="color: #000">Nama Barang</label>
                                <input type="text" class="form-control" name="nama_barang" placeholder="Nama Barang">
                                <label style="color: #000">Jenis Barang</label>
                                <select name="jenis_barang" class="form-control">
                                    <option value="">-- PILIH --</option>
                                    <?php
                                        $queryJB = "SELECT id_jenis_barang, nama_jenis_barang FROM jenis_barang";
                                        $resultJB = mysqli_query($koneksi,$queryJB);
                                        while($dataJB = mysqli_fetch_array($resultJB)){
                                            echo "<option value='$dataJB[0]'>$dataJB[1]</option>";
                                        }
                                    ?>
                                </select>
                                <label style="color: #000">Supplier</label>
                                <select name="supplier" class="form-control">
                                    <option value="">-- PILIH --</option>
                                    <?php
                                        $querySup = "SELECT id_supplier, nama_supplier FROM supplier";
                                        $resultSup = mysqli_query($koneksi,$querySup);
                                        while($dataSup = mysqli_fetch_array($resultSup)){
                                            echo "<option value='$dataSup[0]'>$dataSup[1]</option>";
                                        }
                                    ?>
                                </select>
                                <label style="color: #000">Modal</label>
                                <input type="text" class="form-control" name="modal" placeholder="Contoh : 1000">
                                <label style="color: #000">Harga</label>
                                <input type="text" class="form-control" name="harga" placeholder="Contoh : 5000">
                                <label style="color: #000">Jumlah</label>
                                <input type="text" class="form-control" name="jumlah" placeholder="Jumlah Barang">
                           </form>
                        </div> 
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="simpanBarang">Save changes</button>
                    </div>
                    </div>
                </div>
            </div>
            <!-- MODAL TAMBAH DATA BARANG -->


            <!-- Kelola data transaksi -->
            <?php
                if (isset($_POST['tanggal'])) {

                    $nama_barang = $_POST['nama_barang'];
                    $tanggal = $_POST["tanggal"];
                    $jumlah = $_POST["jumlah"];
                    $harga = $_POST["harga"];

                    // $path = "nota/";
                    // $path = $path . basename( $_FILES['uploaded_file']['name']);
                    // if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $path)) {
                     
                    // } else{
                    //     echo "There was an error uploading the file, please try again!";
                    // }

                    $test = mysqli_query($koneksi, "SELECT * FROM barang WHERE nama_barang = '$nama_barang'");
                    $data = mysqli_fetch_array($test);
                    $sisa = $data['jumlah']-$jumlah;
                    $update_sisa = mysqli_query($koneksi, "UPDATE barang SET jumlah = '$sisa' WHERE nama_barang='$nama_barang'");

                    $modal = $data['modal'];
                    $lab = $harga-$modal;
                    $laba = $lab*$jumlah;
                    $total_harga = $harga*$jumlah;


                    $insertTransaksi = "INSERT INTO transaksi VALUES ('','$tanggal','$nama_barang','$jumlah','$harga','$total_harga','$laba')";
                    $queryTransaksi = mysqli_query($koneksi, $insertTransaksi);
                }
            ?>
            <!-- Kelola data transaksi -->

            <!-- KELOLA BARANG -->
            <?php
                if (isset($_POST['nama_barang'])) {
                    $nama_barang = $_POST['nama_barang'];
                    $jenis_barang = $_POST["jenis_barang"];
                    $supplier = $_POST["supplier"];
                    $modal = $_POST["modal"];
                    $harga = $_POST["harga"];
                    $jumlah = $_POST["jumlah"];
                    $sisa = $_POST["sisa"];
                    $insertBarang = "INSERT INTO barang VALUES ('','$nama_barang','$jenis_barang','$supplier','$modal','$harga','$jumlah','$sisa')";
                    $queryBarang = mysqli_query($koneksi, $insertBarang);
                    print_r($queryBarang);
                    die();
                }
            ?>
            <!-- KELOLA BARANG -->

        </div>
    </div>
</body>

<script type="text/javascript">
    $(document).ready(function(){
        $("#simpanTransaksi").click(function(){
            dataTransaksi();

            var file_data = $('#uploaded_file').prop('files')[0];   
            var form_data = new FormData();                  
            form_data.append('file', file_data);
            $.ajax({
                url: 'upload.php', // point to server-side PHP script 
                dataType: 'text',  // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,                         
                type: 'post',
                success: function(php_script_response){
                    alert("Tambah data Transaksi berhasil !");
                }
             });
        });

         $("#simpanBarang").click(function(){
            dataBarang();
        });

         $("#simpankata").click(function(){
            var kata = $("#textaksesfile").val()
            var str = kata.replace(/(?:\r\n|\r|\n)/g, '<br>');

            console.log(str);
            $.ajax({
                url: 'upload-kata.php',
                dataType: 'text',  
                data: {str: str},                         
                type: 'post',
                success: function(php_script_response){
                    alert("Tambah kata berhasil !");
                    location.href = "";

                }
             });
        });
    });

    function dataTransaksi(){
        var data = $('.formTransaksi').serialize();
            $.ajax({
                type: 'POST',
                url: "",
                data: data,
                success: function() {
                location.href = "";
                }
            });
         }

         function isi_otomatis(){
                var nama_barang = $("#nama_barang").val();
                $.ajax({
                    url: 'proses-ajax.php',
                    data:"nama_barang="+nama_barang ,
                }).success(function (data) {
                    var json = data,
                    obj = JSON.parse(json);
                    $('#harga').val(obj.harga);
                });
            }

        function dataBarang(){
            var data = $('.formBarang').serialize();
                $.ajax({
                    type: 'POST',
                    url: "",
                    data: data,
                    success: function() {
                    location.href = "";
                    }
                });
             }

            $("#nama_barang").on("change",function(e){
                console.log($(this).val());
                isi_otomatis();
            });
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- <script src="assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/js/plugins/bootstrap-switch.js"></script>
<script src="assets/js/plugins/chartist.min.js"></script>
<script src="assets/js/plugins/bootstrap-notify.js"></script>
<script src="assets/js/light-bootstrap-dashboard.js?v=2.0.1" type="text/javascript"></script>
<script src="assets/js/demo.js"></script>
 -->

    <script type="text/javascript" src="assets/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="assets/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
            $('#fresh-datatables').DataTable();
            $('#fresh-datatables2').DataTable();
        } );
    </script>
    <script src="assets/js/core/popper.min.js" type="text/javascript"></script>
    <script src="assets/js/core/bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/js/plugins/bootstrap-switch.js"></script>
    <script src="assets/js/plugins/bootstrap-notify.js"></script>
    <script src="assets/js/plugins/chartist.min.js"></script>
    <script src="assets/js/light-bootstrap-dashboard.js?v=2.0.1" type="text/javascript"></script>
    <script src="assets/js/demo.js"></script>
</html>