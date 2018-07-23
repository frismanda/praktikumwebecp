<?php
    include "../admin/config.php";
    include '../template/header_view.php';
    
    $file = 'kata-kata.txt';
    $bukafile = fopen($file, 'r');


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
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    </div>
</div>
<script type="text/javascript">
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
</script>

</body>

<?php include '../template/footer_view.php' ?>