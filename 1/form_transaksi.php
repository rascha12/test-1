<?php
 require "koneksi.php";

 //$id_transaksi = $_GET['id_transaksi'] ?? 0 ;

 if (isset($_GET['id_transaksi'])) {
    $id_transaksi = $_GET['id_transaksi'];
 } else {
    $id_transaksi = 0;
 }

 var_dump($id_transaksi);die;

 if($id_transaksi > 0) {
    $row = getTransactionbyID($id_transaksi);
    $id_transaksi = $row['id_transaksi'];
    $id_customer = $row['id_customer'];
    $id_buku = $row['id_buku'];
    $nama = $row['nama'];
    $judul = $row['judul'];
    $kuantitas = $row['kuantitas'];
    $harga = $row['harga'];
    $total_pembayaran = $row['total_pembayaran'];
    $form_action = "action.php?action=update_transaction";
    $title = "Edit Data Transaksi";
 } else {
    $id_transaksi = '';
    $id_customer = '';
    $id_buku = '';
    $nama = '';
    $judul = '';
    $kuantitas = '';
    $harga = '';
    $total_pembayaran = '';
    $form_action = "action.php?action=insert_transaction";
    $title = "Tambah Data Transaksi";
 }

?>

<!DOCTYPE html> 
<head>
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
            <li><a href="welcome.php">Beranda</a></li>
            <li><a href="data_buku.php">Data Buku</a></li>
            <li><a href="data_customer.php">Data Customer</a></li>
            <li><a href="data_transaksi.php">Data Transaksi</a></li>
        </ul>
    </nav>
    <div class="container">
    <h2 style="margin-bottom:20px"><?=$title; ?></h2>
    <form action="<?=$form_action?>" method="post">
        <input type="hidden" name="id_transaksi" value="<?=$id_transaksi?>">
        <!-- pilih nama customer -->
        <label for="nama">Nama Customer</label>
        <select name="id_customer" id="nama">
            <option disabled selected>Pilih nama customer...</option>
            <?php foreach (fetchCustomers() as $options) {
                //tanda (?) untuk if, tanda (:) untuk else
                $selected = $options['id_customer']==$id_customer ? 'selected': '';
            ?>
            <option value = "<?=$options['id_customer']?>" <?=$selected?>>
                <?=$options['nama']?>
            </option>
            <?php } ?>
        </select>
        <!-- pilih judul buku -->
        <label for="judul">Judul Buku</label>
        <select name="id_buku" id="judul">
            <option disabled selected>Pilih judul buku...</option>
            <?php foreach (fetchBooks() as $options) { 
                $selected = $options['id_buku']==$id_buku ? 'selected' : '';
            ?>
            <option value="<?=$options['id_buku']?>" <?=$selected?>>
                <?=$options['judul']?>
            </option>
            <?php } ?>
        </select>
        <!-- input kuantitas -->
        <label for="kuantitas">Kuantitas</label>
        <input type="number" id="kuantitas" name="kuantitas" value="<?=$kuantitas?>">

         <!-- pilih harga -->
         <label for="harga">Harga</label>
        <select name="id_transaksi" id="harga">
            <option disabled selected>Pilih harga...</option>
            <?php foreach (fetchBooks() as $options) {
                //tanda (?) untuk if, tanda (:) untuk else
                $selected = $options['harga']==$harga ? 'selected': '';
            ?>
            <option value = "<?=$options['harga']?>" <?=$selected?>>
                <?=$options['harga']?>
            </option>
            <?php } ?>
        </select>
       
        <!-- input total_pembayaran -->
        <label for="total_pembayaran">Total Pembayaran</label>
        <input type="total_pembayaran" id="total_pembayaran" name="total_pembayaran" value="<?=$total_pembayaran?>">
        <input type="submit" value="Simpan">
    </form>
</body>
</html