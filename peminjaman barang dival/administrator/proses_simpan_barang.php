<?php 
// koneksi database
include '../koneksi.php';

// menangkap data yang di kirim dari form
$NamaBarang = $_POST['NamaBarang'];
$kondisi = $_POST['kondisi'];
$Keterangan = $_POST['Keterangan'];
$jumlah = $_POST['jumlah'];


// menginput data ke database
mysqli_query($koneksi,"insert into produk values('','$NamaBarang','$kondisi','$Keterangan','$jumlah')");

// mengalihkan halaman kembali ke data_barang.php
header("location:data_barang.php?pesan=simpan");

?>