<?php 
require "db.php";

$result_pelanggan = mysqli_query($conn, "SELECT id_pelanggan, nama_pelanggan FROM pelanggan");
$result_buku = mysqli_query($conn, "SELECT id_buku, nama_buku, harga FROM buku");

$options_pelanggan = mysqli_fetch_all($result_pelanggan, MYSQLI_ASSOC );
$options_buku = mysqli_fetch_all($result_buku, MYSQLI_ASSOC );

// $result_pelanggan = mysqli_query($conn, "SELECT id_pelanggan, nama_pelanggan FROM pelanggan");
// $result_buku = mysqli_query($conn, "SELECT id_buku, nama_buku, harga FROM buku");

// $options_pelanggan = mysqli_fetch_all($result_pelanggan, MYSQLI_ASSOC );
// $options_buku = mysqli_fetch_all($result_buku, MYSQLI_ASSOC );

?>

<DOCTYPE html>
<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Penjualan</title>
    <link rel="stylesheet" href="css/bootstrap-grid.css" type="text/css" />
    <link rel="stylesheet" href="css/style.css" type="text/css" />
    <link
      href="https://fonts.googleapis.com/css2?family=Merriweather+Sans&family=Roboto+Condensed&display=swap"
      rel="stylesheet"
    />
</head>

<body>
<nav>
    <ul>
        <li><a href="">Beranda</a></li>
        <li><a href="data_buku.php">Data Buku</a></li>
        <li><a href="data_pelanggan.php">Data Pelanggan</a></li>
        <li><a href="data_transaksi.php">Data Transaksi</a></li>
    </ul>
</nav>
    <h2> Masukkan Data Transaksi </h2>
<form action="insert_transaksi.php" method="post">
    <label for="nama_pelanggan">Nama Pelanggan</label><br>
    <select name="id_pelanggan" id="nama_pelanggan">
        <option disabled selected>Pilih Nama Pelanggan..</option>
        <?php foreach ($options_pelanggan as $option) { ?>
        <option value="<?=$option['id_pelanggan']?>"><?= $option['nama_pelanggan']?></option>
        <?php } ?>
    </select><br>
    <label for="nama_buku">Nama Buku</label><br>
    <select name="id_buku" id="nama_buku">
        <option disabled selected>Pilih Nama Buku..</option>
        <?php foreach ($options_buku as $option) { ?>
        <option value="<?=$option['id_buku']?>"><?=$option['nama_buku'] . ' ' .  "- Rp " . $option['harga']?></option>
        <?php } ?> 
    </select><br>
    <label for="kuantitas">Kuantitas</label><br>
    <input type="number" name="kuantitas" id="kuantitas" placeholder="Masukkan jumlah barang.."/><br>
    <input type="submit" value="Simpan" class="button4">
</form>
</body>
</html>

