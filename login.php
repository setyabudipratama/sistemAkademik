<?php


//(1) sesion.php (file tidak diperlukan)
//panggil session
session_start();


//(2) login.php
//panggil file functions.php
require 'functions.php';


//(4) cookie.php (file tidak diperlukan)
//cek cookie
if( isset($_COOKIE['id']) && isset($_COOKIE['key']) ) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    //(5) cookie.php (file tidak diperlukan)
    //ambil username berdasarkan id
    $result = mysqli_query($db, "SELECT username FROM user WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    //(6) cookie.php (file tidak diperlukan)
    //cek cookie dan username
    if( $key === hash('sha256', $row['username'])) {
        $_SESSION['login'] = true;
    }
}


//(12) sesion.php (file tidak diperlukan)
//cek apakah user sudah login
if(isset($_SESSION["login"])){

    //(13) sesion.php (file tidak diperlukan)
    //jika sudah login, user diarahkan ke halaman index.php
    header("Location: index.php");
    exit;
}


//(3) login.php
//cek apakah tombol submit sudah ditekan
if ( isset($_POST["login"]) ) {

    //(4) login.php
    //ambil data dari form
    $username = $_POST["username"];
    $password = $_POST["password"];

    //(5) login.php
    //query ke database menggunakan 'SELECT'
    $result = mysqli_query($db, "SELECT * FROM user WHERE username = '$username'");

    //(6) login.php
    //cek username
    if ( mysqli_num_rows($result) === 1 ) {

        //(7) login.php
        //cek password
        $row= mysqli_fetch_assoc($result);

        //(8) login.php
        //cek apakah sebuah string password sama dengan password_hash (registrasi.php) yang ada di database
        if(password_verify($password, $row["password"])){

            //(2) sesion.php (file tidak diperlukan)
            //set session, untuk mengamankan halaman index.php dan diwajibkan login terlebih dahulu
            $_SESSION["login"] = true;

            //(2) cookie.php (file tidak diperlukan)
            //cek remember me
            if( isset($_POST["remember"]) ) {

                //(3) cookie.php (file tidak diperlukan)
                //set cookie dan enkripsikan username
                setcookie('id', $row['id'], time() + 60);
                setcookie('key', hash('sha256', $row['username']), time() + 60);
            }

            //(9) login.php
            //jika sudah login user diarahkan ke halaman index.php
            header("Location: index.php");
            exit;
        }
    }

    //(10) login.php
    //jika password salah akan muncul pesan kesalahan
    $error = true;
}
?>


<!-- (1) login.php
buat halaman login -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
</head>
<body>
    
    <!-- (11) login.php
    menampilkan pesan kesalahan -->
    <?php if ( isset($error) ) : ?>
        <p style="color: red; font-style: italic;">username / password salah!</p>
    <?php endif; ?>

    <form action="" method="post" class="form">
            <h1>Login</h1>
                <label for="username">Username: </label>
                <input type="text" name="username" id="username" class="box" required>

                <label for="password">Password: </label>
                <input type="password" name="password" id="password" class="box" required>

                <!-- (1) cookie.php (file tidak diperlukan)
                buat list cookie -->
                <label><input type="checkbox" name="remember" id="remember" style="flex: none; margin-right: 10px;" for="remember">Remember Me</label><br>
                

                <button style="color:black; font-size:17px;" type="submit" name="login" class="btn"
                >Login</button>

                <p>Belum punya akun?</p>
                
                <button style="color:black; font-size:17px;" type="submit" name="registrasi" 
                onclick=window.location.href='registrasi.php' class="btn">Registrasi</button>
    </form>
</body>
</html>