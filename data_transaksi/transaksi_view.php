<?php
    include "../admin/config.php";
    include '../template/header_view.php';
    if (!isset($_SESSION["username"])) {
     echo '<meta http-equiv="refresh" content="0;URL=../index.php" />';
    }
    $queryTransaksi = "SELECT * FROM transaksi";
    $resultTransaksi = mysqli_query($koneksi, $queryTransaksi);
    $countTransaksi = mysqli_num_rows($resultTransaksi);
?>
    <body>
    <div class="wrapper">
        <div class="sidebar" data-image="../assets/img/sidebar-5.jpg">
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="#" class="simple-text">
                        SI Penjualan
                    </a>
                </div>
                <ul class="nav">
                    <li>
                        <a class="nav-link" href="../index.php">
                            <i class="nc-icon nc-chart-pie-35"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="../data_barang/barang_view.php">
                            <i class="nc-icon nc-notes"></i>
                            <p>Data Barang</p>
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="../data_transaksi/transaksi_view.php">
                            <i class="nc-icon nc-notes"></i>
                            <p>Data Transaksi</p>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="../data_jenis_barang/jenis_barang_view.php">
                            <i class="nc-icon nc-paper-2"></i>
                            <p>Data Jenis Barang</p>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="../data_supplier/supplier_view.php">
                            <i class="nc-icon nc-atom"></i>
                            <p>Data Supplier</p>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="../data_pengeluaran/pengeluaran_view.php">
                            <i class="nc-icon nc-pin-3"></i>
                            <p>Data Pengeluaran</p>
                        </a>
                    </li>
                    <li >
                        <a class="nav-link" href="../data_aksesfile/akses_file.php">
                            <i class="nc-icon nc-pin-3"></i>
                            <p>Akses File</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg " color-on-scroll="500">
                <div class=" container-fluid  ">
                    <a class="navbar-brand" href="#"> Data Transaksi </a>
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





<?php
    if (isset($_POST['nama_barang'])) {

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
    });

    function dataTransaksi(){
        var data = $('.formTransaksi').serialize();
            $.ajax({
                type: 'POST',
                url: "http://localhost/uas_pwl/master_penjualan/data_transaksi/transaksi_view.php",
                data: data,
                success: function() {
                location.href = "http://localhost/uas_pwl/master_penjualan/data_transaksi/transaksi_view.php";
                }
            });
    }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript">
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
            $("#nama_barang").on("change",function(e){
                console.log($(this).val());
                isi_otomatis();
            });
</script>
<?php include '../template/footer_view.php' ?>