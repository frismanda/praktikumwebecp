<?php 
// Upload Gambar
if(!empty($_FILES['uploaded_file']))
  {
    $path = "nota/";
    $path = $path . basename( $_FILES['uploaded_file']['name']);
    if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $path)) {
      echo "The file ".  basename( $_FILES['uploaded_file']['name']). 
      " has been uploaded";
    } else{
        echo "There was an error uploading the file, please try again!";
    }
  }

  if (isset($_POST['nama_barang'])) {
        echo "<script>console.log('abcdefg);</script>";

        $nama_barang = $_POST['nama_barang'];
        $tanggal = $_POST["tanggal"];
        $jumlah = $_POST["jumlah"];
        $harga = $_POST["harga"];

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