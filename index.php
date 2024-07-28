<?php

//(3) sesion.php (file tidak diperlukan)
//panggil session
session_start();

//(4) sesion.php (file tidak diperlukan)
//cek apakah user sudah login
if (!isset($_SESSION["login"])) {

    //(5) sesion.php (file tidak diperlukan)
    //jika belum login, user diarahkan ke halaman login
    header("Location: login.php");
    exit;
}

//(3) index.php
//panggil file functions.php
require 'functions.php';

//(1) pagination.php (file tidak diperlukan)
//konfigurasi pagination
$jumlahDataPerHalaman = 4;

//(2) pagination.php (file tidak diperlukan)
//count = menghitung data
$jumlahData = count(query("SELECT * FROM mahasiswa"));

//(3) pagination.php (file tidak diperlukan)
//ceil = pembulatan keatas
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);

//(4) pagination.php (file tidak diperlukan)
//halaman aktif dipanggil
$halamanAktif = ( isset($_GET["halaman"]) ) ? $_GET["halaman"] : 1;

//(5) pagination.php (file tidak diperlukan)
//menghitung awal data yang akan ditampilkan
$awalData = ( $jumlahDataPerHalaman * $halamanAktif ) - $jumlahDataPerHalaman;

//(4) index.php
//(6) pagination.php (file tidak diperlukan)
//membuat query untuk ambil data mahasiswa kemudian membuat variabel '$mahasiswa' dan konfigurasi pagination
$mahasiswa = query("SELECT * FROM mahasiswa LIMIT $awalData, $jumlahDataPerHalaman");

//(2) cari.php (file tidak diperlukan)
//jika tombol cari ditekan
if (isset($_POST["cari"])) {

    //(3) cari.php (file tidak diperlukan)
    //panggil fungsi cari dan data ditimpa dengan data pencarian
    $mahasiswa = cari($_POST["keyword"]);    
}
?>


<!-- (1) index.php
buat halaman index atau tabel daftar mahasiswa di database akademik -->
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
</head>
<body>
    <h1>Daftar Mahasiswa</h1>

    <br>

    <!-- (1)logout.php -->
    <a href="logout.php" class="btn">Logout</a>

    <br><br>

    <!-- (1) tambah.php
    buat link tambah mahasiswa -->
    <a href="tambah.php" class="btn">Tambah data mahasiswa</a>

    <br><br>

    <!-- (1) cari.php (file tidak diperlukan)
    membuat form pencarian -->
    <form action="" method="post">
        <input style="color: black;" type="text" name="keyword" size="40" autofocus 
        placeholder="masukkan keyword pencarian..." autocomplete="off">
        <button style="color: black;" type="submit" name="cari" class="btn">Cari</button>
    </form>

    <br><br>

<!-- (7) pagination.php (file tidak diperlukan)
buat navigasi pagination -->
<?php if( $halamanAktif > 1 ) : ?>
    <a href="?halaman=<?= $halamanAktif - 1; ?>">&laquo</a>
<?php endif; ?>

<?php for($i = 1; $i <= $jumlahHalaman; $i++) : ?>
    <?php if($i == $halamanAktif) : ?>
        <a href="?halaman=<?= $i; ?>" style="font-weight: bold; color: red;"><?= $i; ?></a>
    <?php else : ?>
        <a href="?halaman=<?= $i; ?>"><?= $i; ?></a>
    <?php endif; ?>
    <?php endfor; ?>

<?php if( $halamanAktif < $jumlahHalaman ) : ?>
    <a href="?halaman=<?= $halamanAktif + 1; ?>">&raquo</a>
<?php endif; ?>


    <br><br>
    
    <table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>No.</th>
        <th>Aksi</th>
        <th>NIM</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>Fakultas</th>
</tr>

<!-- (4) index.php
lakukan pengulangan untuk menampilkan data yang ada di database menggunakan foreach dan
buat variabel $i untuk melakukan pengulangan pada id dengan sistem auto increment-->
<?php $i = 1; ?>
<?php foreach($mahasiswa as $row) : ?>
<tr>
    <td><?php echo $i;?></td>
    <td>

        <!-- (1) update.php
        buat dan jalankan tombol update -->
        <a href="update.php?id=<?= $row ["id"]; ?>">
        <button style="color:black; font-size:17px;" type="button" name="button" class="btn">update</button></a>
        
        <!-- (1) hapus.php
        buat dan jalankan tombol hapus dan 
        buat konfirmasi hapus menggunakan 'onclick' -->
        <a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('konfirmasi hapus');">
        <button style="color:black; font-size:17px;" type="button" name="button" class="btn">hapus</button></a>
    </td>
    <td><?= $row ["nim"]; ?></td>
    <td><?= $row ["nama"]; ?></td>
    <td><?= $row ["alamat"]; ?></td>
    <td><?= $row ["fakultas"]; ?></td>
</tr>
<?php $i++; ?> 
<?php endforeach; ?>
</body>
</html>