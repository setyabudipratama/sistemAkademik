<?php

//(14) session
//untuk memulai session
session_start();

//(15) session
//untuk menghapus semua session
$_SESSION=[];

//(16) session
//untuk memastikakan session benar benar terhapus
session_unset();

//(17) session
//untuk menghapus session
session_destroy();


//(18) session
//redirect mengarahkan ke halaman login
header("Location: login.php");
exit;
?>