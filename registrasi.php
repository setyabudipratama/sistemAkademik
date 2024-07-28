<?php

//(2) registrasi.php
//panggil file functions.php
require 'functions.php';

//(3) registrasi.php
//cek apakah tombol registrasi sudah ditekan
if ( isset($_POST["register"]) ) {

    //(4) registrasi.php
    //cek apakah data berhasil ditambahkan atau tidak
    if (registrasi($_POST) > 0) {

        //(5) registrasi.php
        //jika berhasil
        echo "<script>
                alert('user baru ditambahkan');
            </script>";
    } else {

        //(6) registrasi.php
        //jika gagal
        echo mysqli_error($db);
    }
}
?>


<!-- (1) registrasi.php
membuat halaman registrasi dan buat tabel 'user' sebagai daftar admin-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman registrasi</title>
    <style>
        label {
        display: block;
        }
    </style>
</head>
<body>
    <form action="" method="post" class="form">
        <h1>Registrasi</h1>

            <label for="username">username</label>
            <input type="text" name="username" id="username" class="box" required>
        
            <label for="password">password</label>
            <input type="password" name="password" id="password" class="box" required>
        
            <label for="password2">konfirmasi password</label>
            <input type="password" name="password2" id="password2" class="box" required>
        
            <button style="color:black; font-size:17px;" type="submit" name="register" class="btn" 
            >registrasi</button>
        
        <p>sudah punya akun?</p>
        
            <button style="color:black; font-size:17px;" type="button" 
            onclick="window.location.href='login.php'" class="btn">login</button>
        
    </form>
</body>
</html>