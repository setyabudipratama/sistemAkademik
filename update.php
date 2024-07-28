<?php

//(9) sesion.php (file tidak diperlukan)
//panggil session
session_start();

//(10) sesion.php (file tidak diperlukan)
//cek apakah user sudah login
if (!isset($_SESSION["login"])) {

    //(11) sesion.php (file tidak diperlukan)
    //jika belum login, user diarahkan ke halaman login
    header("Location: login.php");
    exit;
}


//(3) update.php
//panggil file functions.php
require 'functions.php';

//(4) update.php
//ambil data dari URL
$id = $_GET["id"];

//(5) update.php
//query data mahasiswa berdasarkan id dan buat variabel '$mhs'
$mhs = query("SELECT * FROM mahasiswa WHERE id = $id")[0];

//(6) update.php
//cek apakah tombol submit sudah ditekan atau belum
if( isset($_POST["submit"]) ) {
    
    //(7) update.php
    //cek apakah data berhasil diubah atau tidak
    if ( update($_POST) > 0 ){

        //(8) update.php
        //jika data berhasil diubah
        echo "
            <script>
                alert('data berhasil diubah!');
                document.location.href = 'index.php';
            </script>
        ";
    } else {

        //(9) update.php
        //jika data gagal diubah
        echo "<script>
            alert('data gagal diubah!');
            document.location.href = 'index.php';
            </script>
        ";
    }
}
?>


<!-- (2) update.php
buat form update di website -->
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update data mahasiswa</title>
</head>

<body>
    <h1>Update data mahasiswa</h1>
    
    <form action="" method="post">
        <!-- (13) update.php
        buat input id karena id termasuk auto increment -->
        <input type="hidden" name="id" value="<?= $mhs["id"]; ?>">
        <ul>
            <li>
                <!-- (5) update.php
                tambah value untuk menangkap query di atas -->
                <label for="NIM">NIM :</label>
                <input style="color: black;" type="text" name="NIM" id="NIM" required 
                value="<?= $mhs["nim"];?>">
            </li>
            <br>
            <li>
                <label for="Nama">Nama :</label>
                <input style="color: black;" type="text" name="Nama" id="Nama" required 
                value="<?= $mhs["nama"];?>">
            </li>
            <br>
            <li>
                <label for="Alamat">Alamat :</label>
                <input style="color: black;" type="text" name="Alamat" id="Alamat" required 
                value="<?= $mhs["alamat"];?>">
            </li>
            <br>
            <li>
                <label for="Fakultas">Fakultas :</label>
                <input style="color: black;" type="text" name="Fakultas" id="Fakultas" required 
                value="<?= $mhs["fakultas"];?>">
            </li>
            <br>
            <li>
                <button style="color: black;" type="submit" name="submit" class="btn">
                Update Data!</button>
            </li>
    </ul>

    </form>

</body>
</html>