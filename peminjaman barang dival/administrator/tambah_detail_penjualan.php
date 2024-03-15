<?php 
// koneksi database
include '../koneksi.php';

// menangkap data yang di kirim dari form
$PeminjamID = $_POST['PeminjamID'];
$PinjamanID = $_POST['PinjamanID'];

// menginput data ke database
mysqli_query($koneksi,"insert into detailpenjualan values('','$PinjamanID','','','')");

// mengalihkan halaman kembali ke detail_pembelian.php
header("location:detail_pembelian.php?PelangganID=$PeminjamID");
?>