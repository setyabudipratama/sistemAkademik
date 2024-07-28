<?php

//(6) sesion.php (file tidak diperlukan)
//panggil session
session_start();

//(7) sesion.php (file tidak diperlukan)
//cek apakah user sudah login
if (!isset($_SESSION["login"])) {

    //(8) sesion.php (file tidak diperlukan)
    //jika belum login, user diarahkan ke halaman login
    header("Location: login.php");
    exit;
}

//(5) tambah.php
//panggil file functions.php
require 'functions.php';

//(4) tambah.php
//cek apakah tombol submit sudah ditekan atau belum
if( isset($_POST["submit"]) ) {
    
    //(12) tambah.php
    //cek apakah data berhasil ditambahkan atau tidak
    if ( tambah($_POST) > 0 ){

        //(13) tambah.php
        //data berhasil ditambahkan
        echo "
            <script>
                alert('data berhasil ditambahkan!');
                document.location.href = 'index.php';
            </script>
        ";
    } else {

        //(14) tambah.php
        //data gagal ditambahkan
        echo "<script>
            alert('data gagal ditambahkan!');
            document.location.href = 'index.php';
            </script>
        ";
    }
}
?>


<!-- (2) tambah.php
membuat form tambah mahasiswa -->
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah data mahasiswa</title>
</head>

<body>
    <h1>Tambah data mahasiswa</h1>
    
    <form action="" method="post">
        <ul>
            <li>
                <!-- (3) tambah.php
                for harus sama dengan id -->
                <label for="NIM">NIM :</label>
                <input style="color: black;" type="text" name="NIM" id="NIM" required>
            </li>
            <br>
            <li>
                <label for="Nama">Nama :</label>
                <input style="color: black;" type="text" name="Nama" id="Nama" required>
            </li>
            <br>
            <li>
                <label for="Alamat">Alamat :</label>
                <input style="color: black;" type="text" name="Alamat" id="Alamat" required>
            </li>
            <br>
            <li>
                <label for="Fakultas">Fakultas :</label>
                <input style="color: black;" type="text" name="Fakultas" id="Fakultas" required>
            </li>
            <br>
            <li>
                <button style="color: blue; background-color: white;" type="submit" name="submit">
                Tambah Data!</button>
            </li>
    </ul>

    </form>

</body>
</html>