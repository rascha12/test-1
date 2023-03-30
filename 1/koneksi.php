<?php 

/** fungsi untuk koneksi ke db */
function conn(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "toko_buku2";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Koneksi error: " . mysqli_connect_error());
    }
    return $conn;
}

/** fungsi untuk menampilkan data buku */
function getBooks() {
    $conn = conn();
    $sql = "SELECT * FROM buku";
    $result = mysqli_query($conn,$sql);
    //biar ketika data di table buku kosong, $rows tidak undefined
    $rows = [];
    while ($row = mysqli_fetch_array($result)){
        $rows[] = $row;
    }
    return $rows;
}

/** fungsi untuk menampilkan data customer */
function getCustomers() {
    $conn = conn();
    $sql = "SELECT * FROM customer";
    $result = mysqli_query($conn,$sql);
    $rows = [];
    while($row = mysqli_fetch_array($result)){
        $rows[] = $row;
    }
    return $rows;
}

/** fungsi untuk menampilkan data transaksi */
function getTransactions(){
    $conn = conn();
    $sql = "SELECT transaksi.id_transaksi, transaksi.kuantitas, transaksi.harga, transaksi.total_pembayaran, customer.id_customer, customer.nama, buku.id_buku, buku.judul FROM customer INNER JOIN transaksi on customer.id_customer = transaksi.id_customer INNER JOIN buku ON buku.id_buku = transaksi.id_buku ORDER by id_transaksi";
    $result = mysqli_query($conn,$sql);
    $rows = [];
    while($row = mysqli_fetch_array($result)){
        $rows[] = $row;
    }
    return $rows;
}


/** fungsi untuk query insert data buku */
function insertBook($judul, $penulis, $penerbit, $tahun, $harga){
    $conn = conn();
    $sql = "INSERT INTO buku (judul, penulis, penerbit, tahun, harga) VALUES ('$judul','$penulis', '$penerbit', '$tahun', '$harga')";
    $result = mysqli_query($conn, $sql);
    return $result;
}

/** fungsi untuk menampilkan data buku berdasarkan id_buku tertentu */
function getBookbyID($id_buku){
    $conn = conn();
    $sql = "SELECT * FROM buku WHERE id_buku = '$id_buku'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    return $row;
}

/** fungsi untuk query edit data buku*/
function updateBook($id_buku, $judul, $penulis, $penerbit, $tahun, $harga){
    $conn = conn();
    $sql = "UPDATE buku SET judul ='$judul', penulis ='$penulis', penerbit ='$penerbit', tahun ='$tahun', harga ='$harga' WHERE id_buku ='$id_buku'";
    $result = mysqli_query($conn, $sql); 
    return $result;
}

/** fungsi untuk query hapus data buku */
function deleteBook($id_buku){
    $conn = conn();
    $sql = "DELETE FROM buku where id_buku = '$id_buku'";
    $result = mysqli_query($conn,$sql);
    return $result;
}

/** fungsi untuk query insert data customer */
function insertCustomers($nama, $email, $no_hp){
    $conn = conn();
    $sql = "INSERT INTO customer (nama, email, no_hp) VALUES ('$nama', '$email', $no_hp)";
    $result = mysqli_query($conn,$sql);
    return $result;
}

/** fungsi untuk menampilkan data vustomer berdasarkan id_customer tertentu */
function getCustomerbyID($id_customer){
    $conn = conn();
    $sql = "SELECT * from customer WHERE id_customer = '$id_customer'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    return $row;
}

/** fungsi untuk query edit data customer */
function updateCustomer($id_customer, $nama, $email, $no_hp){
    $conn = conn();
    $sql = "UPDATE customer SET nama = '$nama', email = '$email', no_hp = '$no_hp' WHERE id_customer = '$id_customer'";
    $result = mysqli_query($conn, $sql);
    return $result;
}

/**fungsi untuk query hapus data customer */
function deleteCustomer($id_customer) {
    $conn = conn();
    $sql = "DELETE FROM customer WHERE id_customer = '$id_customer'";
    $result = mysqli_query($conn, $sql);
    return $result;
}

/** fungsi untuk mendapatkan nilai id_buku, judul dan harga dari tabel buku untuk digunakan sebagai option di form*/
function fetchBooks(){
    $conn = conn();
    $sql = "SELECT id_buku, judul, harga FROM buku";
    $result = mysqli_query($conn, $sql);
    $options = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $options;
}

/** fungsi untuk mendapatkan nilai id_customer, nama dan harga dari tabel customer untuk digunakan sebagai option di form*/
function fetchCustomers(){
    $conn = conn();
    $sql = "SELECT id_customer, nama FROM customer";
    $result = mysqli_query($conn, $sql);
    $options = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $options;
}

/** fungsi untuk menampilkan data transaksi berdasarkan id_transaksi tertentu */
function getTransactionbyID($id_transaksi){
    $conn = conn();
    $sql = "SELECT transaksi.id_transaksi, transaksi.kuantitas, transaksi.harga, transaksi.total_pembayaran, customer.id_customer, customer.nama, buku.id_buku, buku.judul FROM customer INNER JOIN transaksi on customer.id_customer = transaksi.id_customer INNER JOIN buku ON buku.id_buku = transaksi.id_buku ORDER by id_transaksi";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    return $row;
}

/** fungsi untuk mendapat harga buku */
function getHargaBuku($id_buku){
    $conn = conn();
    $sql = "SELECT harga FROM buku WHERE id_buku = '$id_buku'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    return $row;
}

/** fungsi untuk query insert data transaksi */
function insertTransaction($id_customer, $id_buku, $kuantitas, $harga, $total_pembayaran){
    $conn = conn();
    $sql = "INSERT INTO transaksi VALUE ('','$id_customer','$id_buku','$kuantitas','$harga', '$total_pembayaran')";
    $result = mysqli_query($conn, $sql);
    return $result;
}

/** fungsi untuk query edit data transaksi */
function updateTransaction($id_transaksi, $id_customer, $id_buku, $kuantitas, $harga, $total_pembayaran){
    $conn = conn();
    $sql = "UPDATE transaksi SET id_customer = '$id_customer', id_buku = '$id_buku', kuantitas = '$kuantitas', harga = '$harga', total_pembayaran = '$total_pembayaran' WHERE id_transaksi = '$id_transaksi'";
    $result = mysqli_query($conn, $sql);
    return $result;
}

/** fungsi untuk query hapus data transaksi */
function deleteTransaction($id_transaksi){
    $conn = conn();
    $sql = "DELETE FROM transaksi WHERE id_transaksi = '$id_transaksi'";
    $result = mysqli_query($conn, $sql);
    return $result;
}

/** fungsi untuk query cek email dan password ada atau tidak di database */
function cekLogin($email, $password){
    $conn = conn();
    $sql = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $sql);
    return $result;
}

?> 