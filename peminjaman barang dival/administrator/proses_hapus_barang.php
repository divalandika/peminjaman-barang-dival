<?php 
// koneksi database
include '../koneksi.php';

// menangkap data id yang di kirim dari url
$id_barang = $_POST['id_barang'];


// menghapus data dari database
mysqli_query($koneksi,"delete from produk where id_barang='$id_barang'");

// mengalihkan halaman kembali ke data_barang.php
header("location:data_barang.php?pesan=hapus");

?>