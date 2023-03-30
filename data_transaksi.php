<?php 
require "db.php";

$sql = "SELECT transaksi.id_transaksi, transaksi.kuantitas, transaksi.harga, transaksi.total_pembayaran, pelanggan.id_pelanggan, pelanggan.nama_pelanggan, buku.id_buku, buku.nama_buku FROM pelanggan INNER JOIN transaksi on pelanggan.id_pelanggan = transaksi.id_pelanggan INNER JOIN buku ON buku.id_buku = transaksi.id_buku ORDER by id_transaksi";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<head>
<meta charset="utf-8" />
    <link rel="stylesheet" href="css/style.css" type="text/css" />
    <link
      href="https://fonts.googleapis.com/css2?family=Merriweather+Sans&family=Roboto+Condensed&display=swap"
      rel="stylesheet"
    />
</head>

<body>
<nav>
    <ul>
        <li><a href="welcome.php">Beranda</a></li>
        <li><a href="data_buku.php">Data Buku</a></li>
        <li><a href="data_pelanggan.php">Data Pelanggan</a></li>
        <li><a href="data_transaksi.php">Data Transaksi</a></li>
    </ul>
</nav>
<div class="container">
    <h2>Data Transaksi Toko ABCDE</h2>
    <a href="insertform_transaksi.php?" class="button3">Tambah Data Transaksi</a>
    <table>
        <tr>
            <th class="aksi">Id Transaksi</th>
            <th>Nama Pelanggan</th>
            <th>Nama Buku</th>
            <th>Qty</th>
            <th>Harga</th>
            <th>Total Harga</th>
            <th class="aksi">Aksi</th>
        </tr>
        <?php while ($row = mysqli_fetch_array($result)): 
            $total_pembayaran = $row['kuantitas']*$row['harga'] 
        ?> 
        <tr>
            <td class="center-align"><?=$row['id_transaksi']?></td>
            <td><?=$row['nama_pelanggan']?></td>
            <td><?=$row['nama_buku']?></td>
            <td><?=$row['kuantitas']?></td>
            <td><?=$row['harga']?></td>
            <td ><?=$total_pembayaran ?></td>
            <td class="center-align">
                <a href="editform_transaksi.php?id_transaksi=<?=$row['id_transaksi']?>" class="button1">Edit</a>
                <a href="delete_transaksi.php?id_transaksi=<?=$row['id_transaksi']?>" class="button2">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>
</body>
</html>