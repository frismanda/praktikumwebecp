<?php
require_once'functions.php';

 
    /** LOGIN */ 
    if ($mod=='login'){
        $user = esc_field($_POST[user]);
        $pass = esc_field($_POST[pass]);
        
        $row = $db->get_row("SELECT * FROM tb_admin WHERE user='$user' AND pass='$pass'");
        if($row){
            $_SESSION[login] = $row->user;
            $_SESSION[level] = 'admin';
            $_SESSION[akses] = $row->level;
            
            redirect_js("index.php");
        } else{
            print_msg("Salah kombinasi username dan password.");
        }          
    }else if ($mod=='password'){
        $pass1 = $_POST[pass1];
        $pass2 = $_POST[pass2];
        $pass3 = $_POST[pass3];
        
        if($_SESSION['level']=='pemilih')
            $row = $db->get_row("SELECT * FROM tb_pemilih WHERE id_pemilih='$_SESSION[id_pemilih]' AND pass='$pass1'");        
        
        if($pass1=='' || $pass2=='' || $pass3=='')
            print_msg('Field bertanda * harus diisi.');
        elseif(!$row)
            print_msg('Password lama salah.');
        elseif( $pass2 != $pass3 )
            print_msg('Password baru dan konfirmasi password baru tidak sama.');
        else{        
            if($_SESSION['level']=='pemilih')
                $db->query("UPDATE tb_pemilih SET pass='$pass2' WHERE id_pemilih='$_SESSION[id_pemilih]'");
                                                
            print_msg('Password berhasil diubah.', 'success');
        }
    } elseif($act=='logout'){
        session_destroy();
        header("location:index.php");
    }
    
    /** PENCALON **/
    elseif($mod=='pencalon_tambah'){
        $kode_pencalon = $_POST['kode_pencalon'];
        $nama_pencalon = $_POST['nama_pencalon'];
        $gambar = $_FILES['gambar'];
        $keterangan = $_POST['keterangan'];
        
        if(!$kode_pencalon || !$nama_pencalon || !$gambar['tmp_name'])
            print_msg("Field bertanda * tidak boleh kosong!");
        elseif($db->get_results("SELECT * FROM tb_pencalon WHERE kode_pencalon='$kode_pencalon'"))
            print_msg("Kode sudah ada!");
        else{
            $filename = rand(1000, 999) . str_replace(' ', '-', $gambar['name']);
            $img = new SimpleImage($gambar['tmp_name']);               
            $img->thumbnail(640, 480);     
            $img->save('gambar/' . $filename, 100);
            
            $db->query("INSERT INTO tb_pencalon (kode_pencalon, nama_pencalon, gambar, keterangan) VALUES ('$kode_pencalon', '$nama_pencalon', '$filename', '$keterangan')");                 
            redirect_js("index.php?m=pencalon");
        }
    } 
    
    /** PEMILIH */    
    if($mod=='pemilih_tambah'){
        $ktp = $_POST['ktp'];
        $nama_pemilih = $_POST['nama_pemilih'];
        $alamat = $_POST['alamat'];
        $pass = $_POST['pass'];
        
        
        if(!$ktp || !$nama_pemilih || !$pass)
            print_msg("Field bertanda * tidak boleh kosong!");
        elseif(strlen($pass)<4 || strlen($pass)>16)
            print_msg("Password 4-16 karakter!");
        elseif($db->get_results("SELECT * FROM tb_pemilih WHERE ktp='$ktp'"))
            print_msg("No KTP sudah terdaftar!");
        else{
            $db->query("INSERT INTO tb_pemilih (ktp, nama_pemilih, alamat, pass) VALUES ('$ktp', '$nama_pemilih', '$alamat', '$pass')");
            redirect_js("index.php?m=pemilih");
        }    
    } 
    
    
