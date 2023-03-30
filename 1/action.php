<?php
require "koneksi.php";
$aksi = $_GET['action'];

switch ($aksi) {
    // aksi untuk insert ke data buku
    case 'insert_book':
        //insertBook($judul,$penulis,$penerbit,$tahun,$harga)
        $judul = $_POST['judul'];
        $penulis = $_POST['penulis'];
        $penerbit = $_POST['penerbit'];
        $tahun = $_POST['tahun'];
        $harga = $_POST['harga'];
        $result = insertBook($judul,$penulis,$penerbit,$tahun,$harga);
        if ($result) {
            $msg = "Berhasil tambah buku";
            $loc = "data_buku.php";
        } else {
            $msg = "Gagal tambah buku";
            $loc = "data_buku.php";
        }
        break;

    // aksi untuk edit data buku
    case 'update_book':
        // $id_buku = $_POST['id_buku'];
        // $judul = $_POST['judul'];
        // $penulis = $_POST['penulis'];
        // $penerbit = $_POST['penerbit'];
        // $tahun = $_POST['tahun'];
        // $harga = $_POST['harga'];
        // $result = updateBook($id_buku, $judul, $penulis, $penerbit, $tahun, $harga);
        $result = updateBook($_POST['id_buku'], $_POST['judul'], $_POST['penulis'], $_POST['penerbit'], $_POST['tahun'], $_POST['harga']);
        if ($result) {
            $msg = "Edit Buku Berhasil";
            $loc = "data_buku.php";
        } else {
            $msg = "Edit Buku Gagal";
            $loc = "data_buku.php";
        }
        break;
    //aksi untuk delete data buku
    case 'delete_book':
        $result = deleteBook($_GET['id_buku']);
        if ($result) {
            $msg = "Hapus Buku Berhasil";
            $loc = "data_buku.php";
        } else {
            $msg = "Hapus Buku Gagal";
            $loc = "data_buku.php";
        }
        break;
    //aksi untuk insert data customer
    case 'insert_customer':
        $result = insertCustomers($_POST['nama'], $_POST['email'], $_POST['no_hp']);
        if ($result) {
            $msg = "Tambah Customer Berhasil";
            $loc = "data_customer.php";
        } else {
            $msg = "Tambah Customer Gagal";
            $loc = "data_customer.php";
        }
        break;
    //aksi untuk edit data customer
    case 'update_customer':
        $result = updateCustomer($_POST['id_customer'], $_POST['nama'], $_POST['email'], $_POST['no_hp']);
        if ($result) {
            $msg = "Edit Customer Berhasil";
            $loc = "data_customer.php";
        } else {
            $msg = "Edit Customer Gagal";
            $loc = "data_customer.php";
        }
        break;
    //aksi untuk delete data customer
    case 'delete_customer':
        $result = deleteCustomer($_GET['id_customer']);
        if ($result) {
            $msg = "Hapus Customer Berhasil";
            $loc = "data_customer.php";
        } else {
            $msg = "Hapus Customer Gagal";
            $loc = "data_customer.php";
        }
        break;
    //aksi untuk insert data transaksi
    case 'insert_transaction':
        $id_buku = $_POST['id_buku'];
        $row = getHargaBuku($id_buku);
        $harga = $row['harga'];
        $total_pembayaran = $harga * $_POST['kuantitas'];
        $result = insertTransaction($_POST['id_customer'], $_POST['id_buku'], $_POST['kuantitas'], $harga, $total_pembayaran);
        if ($result) {
            $msg = "Tambah Transaksi Berhasil";
            $loc = "data_transaksi.php";
        } else {
            $msg = "Tambah Transaksi Gagal";
            $loc = "data_transaksi.php";
        }
        break;
    //aksi untuk edit data transaksi
    case 'update_transaction':
        $id_buku = $_POST['id_buku'];
        $row = getHargaBuku($id_buku);
        $harga = $row['harga'];
        $total_pembayaran = $harga * $_POST['kuantitas'];
        $result = updateTransaction($_POST['id_transaksi'], $_POST['id_customer'], $_POST['id_buku'], $_POST['kuantitas'], $harga, $total_pembayaran);
        if ($result) {
            $msg = "Edit Transaksi Berhasil";
            $loc = "data_transaksi.php";
        } else {
            $msg = "Edit Transaksi Gagal";
            $loc = "data_transaksi.php";
        }
        break;       
    //aksi untuk delete data transaksi
    case 'delete_transaction':
        $result = deleteTransaction($_GET['id_transaksi']);
        if ($result) {
            $msg = "Hapus Transaksi Berhasil";
            $loc = "data_transaksi.php";
        } else {
            $msg = "Hapus Transaksi Gagal";
            $loc = "data_transaksi.php";
        }
        break; 
 }

if (!empty($msg)){
    echo "<script>
        alert('$msg');
        location.href = '$loc';
    </script>";
}

?>