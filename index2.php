<?php
$db = mysqli_connect("localhost", "root", "", "akademik");

$result = mysqli_query($db, "SELECT * FROM mahasiswa"); 

// while($mhs = mysqli_fetch_assoc($result)){
//     var_dump($mhs);
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
</head>
<body>
    <h1>Daftar Mahasiswa</h1>

    <table border="1" cellpadding="10" cellspacing="0">

    <tr>
        <th>No.</th>
        <th>Aksi</th>
        <th>NIM</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>Fakultas</th>
</tr>

<?php $i =1; ?>
<?php while ($row=mysqli_fetch_assoc($result)) : ?>
<tr>
    <td><?php echo $i;?></td>
    <td>
        <a href="">ubah</a>
        <a href="">hapus</a>
    </td>
    <td><?php echo $row ["nim"]; ?></td>
    <td><?php echo $row ["nama"]; ?></td>
    <td><?php echo $row ["alamat"]; ?></td>
    <td><?php echo $row ["fakultas"]; ?></td>
</tr>
<?php $i++; ?>
<?php endwhile; ?>
</body>
</html>