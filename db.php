<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "toko_buku";
$conn = mysqli_connect($servername, $username, $password, $dbname);

//jika gagal
if (!$conn) {
    die("Koneksi Gagal: " . mysqli_connect_error());
}
?> 
<!-- Hai Rascha Rakha Pratama -->
