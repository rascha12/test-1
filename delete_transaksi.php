<?php 
require "db.php";

$id_transaksi = $_GET['id_transaksi'];

mysqli_query($conn, "DELETE FROM transaksi WHERE id_transaksi = '$id_transaksi'");
header("location:data_transaksi.php");

?>