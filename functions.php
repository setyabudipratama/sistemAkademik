<?php

//(2) index.php
//koneksi ke database dan ambil variabel sebagai 'db'
$db = mysqli_connect("", "", "", "");

//(5) index.php
//membuat function query untuk menerima parameter query
function query($query){

    //(6) index.php
    //global db berfungsi untuk mengakses variabel db yang ada di file functions.php diatas
    global $db;

    //(7) index.php
    //panggil query
    $result = mysqli_query($db, $query);

    //(8) index.php
    //ambil data dari function diatas
    $rows=[];

    //(9) index.php
    //mengambil data menggunakan looping 'while'
    while( $row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    
    //(10) index.php
    //mengembalikan data
    return $rows;
}


//(6) tambah.php
//membuat function tambah pada file 'tambah.php'
function tambah($data) {

    //(7) tambah.php
    //global db berfungsi untuk mengakses variabel db yang ada di file functions.php diatas
    global $db;

    //(8) tambah.php
    //ambil data dari tiap elemen dalam form
    //htmlspecialchars() berfungsi untuk mengamankan input dariuser yang tidak bertanggung jawab
    $nim = htmlspecialchars($data["NIM"]);
    $nama = htmlspecialchars($data["Nama"]);
    $alamat = htmlspecialchars($data["Alamat"]);
    $fakultas = htmlspecialchars($data["Fakultas"]);

    //(9) tambah.php
    //query untuk menambahkan data mahasiswa
    $query = "INSERT INTO mahasiswa(nim, nama, alamat, fakultas) VALUES ('$nim', '$nama', '$alamat', '$fakultas')";
    
    //(10) tambah.php
    //panggil database dasar dan panggil query
    mysqli_query($db, $query);

    //(11) tambah.php
    //mengembalikan nilai berapa baris yang diubah
    return mysqli_affected_rows($db);
}


//(7) hapus.php
//membuat function hapus pada file 'hapus.php'
function hapus($id){

    //(8) hapus.php
    //global db berfungsi untuk mengakses variabel db yang ada di file functions.php diatas
    global $db;

    //(9) hapus.php
    //query untuk menghapus data mahasiswa
    mysqli_query($db, "DELETE FROM mahasiswa WHERE id = $id");

    //(10) hapus.php
    //mengembalikan nilai berapa baris yang diubah
    return mysqli_affected_rows($db);
}


//(10) update.php
//membuat function ubah pada file update.php
function update($data){

    //(11) update.php
    //global db berfungsi untuk mengakses variabel db yang ada di file functions.php diatas
    global $db;
    
    //(12) update.php
    //ambil data dari tiap elemen dalam form
    //htmlspecialchars() berfungsi untuk mengamankan input dari user yang tidak bertanggung jawab
    $id = $data["id"];
    $nim = htmlspecialchars($data["NIM"]);
    $nama = htmlspecialchars($data["Nama"]);
    $alamat = htmlspecialchars($data["Alamat"]);
    $fakultas = htmlspecialchars($data["Fakultas"]);

    //(13) update.php
    //query untuk mengubah data mahasiswa
    $query = "UPDATE mahasiswa SET 
            nim = '$nim',
            nama = '$nama',
            alamat = '$alamat',
            fakultas = '$fakultas'
            WHERE id =  $id";
    mysqli_query($db, $query);

    //(14) update.php
    //mengembalikan nilai berapa baris yang diubah
    return mysqli_affected_rows($db);
}


//(4) cari.php (file tidak diperlukan)
//buat function cari yang ada di file index.php
function cari($keyword){

    //(5) cari.php (file tidak diperlukan)
    //membuat query untuk mencari data mahasiswa
    $query = "SELECT * FROM mahasiswa WHERE 
    nama LIKE '%$keyword%' OR 
    nim LIKE '%$keyword%' OR 
    alamat LIKE '%$keyword%' OR
    fakultas LIKE '%$keyword%'";

    //(6) cari.php (file tidak diperlukan)
    //mengembalikan data
    return query($query);
}


//(7) registrasi.php
//membuat function registrasi pada file registrasi.php
function registrasi($data){

    //(8) registrasi.php
    //global db berfungsi untuk mengakses variabel db yang ada di file functions.php diatas
    global $db;

    //(9) registrasi.php
    //ambil data dari tiap elemen dalam form
    //stripslashes berfungsi untuk menghilangkan backslash (\) pada data yang dikirimkan oleh user
    //strtolower berfungsi untuk mengubah semua karakter menjadi huruf kecil
    $username = strtolower(stripslashes($data["username"]));
    //mysqli_real_escape_string() berfungsi untuk memastikan input dari user tidak mengandung karakter khusus
    $password = mysqli_real_escape_string($db, $data["password"]);
    $password2 = mysqli_real_escape_string($db, $data["password2"]);

    //(10) registrasi.php
    //cek username sudah ada apa belum dengan query 'SELECT' dan buat variabel 'result'
    $result = mysqli_query($db, "SELECT username FROM user WHERE username = '$username'");
    if ( mysqli_fetch_assoc($result) ) {
        echo "<script>
                alert('username sudah terdaftar');
            </script>";
            return false;
    }

    //(11) registrasi.php
    //cek konfirmasi 'password' dengan 'password2'
    if($password !== $password2){

        //(12) registrasi.php
        //jika password tidak sesuai
        echo "<script>
                alert('konfirmasi password tidak sesuai!');
            </script>";
            return false;
    } else {

        //(13) registrasi.php
        //jika password sesuai
        echo mysqli_error($db);
    }

    //(14) registrasi.php
    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    //(15) registrasi.php
    //tambahkan user baru ke database dengan query untuk insert
    mysqli_query($db, "INSERT INTO user (username, password) VALUES('$username', '$password')");

    //(16) registrasi.php
    //mengembalikan nilai berapa baris yang diubah
    return mysqli_affected_rows($db);

}
?>
