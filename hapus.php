<?php

//panggil session
session_start();
//cek apakah user sudah login, tidak boleh langsung ke hapus.php
if (!isset($_SESSION["login"])) {
    //jika belum login
    header("Location: login.php");
    exit;
}


//(2) hapus.php
//panggil file functions.php
require 'functions.php';

//(3) hapus.php
//ambil id dari URL
$id = $_GET["id"];

//(4) hapus.php
//jalankan fungsi hapus
if( hapus($id) > 0 ){

    //(5) hapus.php
    //jika berhasil
    echo "
            <script>
                alert('data berhasil dihapus!');
                document.location.href = 'index.php';
            </script>
        ";
} else {

    //(6) hapus.php
    //jika gagal
    echo "
            <script>
                alert('data gagal dihapus!');
                document.location.href = 'index.php';
            </script>
        ";
}
?>