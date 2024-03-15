
<?php 
// koneksi database
include '../koneksi.php';

// menangkap data yang di kirim dari form
$NamaBarang = $_POST['NamaBarang'];
$kondisi = $_POST['kondisi'];
$Keterangan = $_POST['Keterangan'];
$jumlah = $_POST['jumlah'];


// update data ke database
mysqli_query($koneksi,"update produk set NamaBarang='$NamaBarang', kondisi='$kondisi', Keterangan='$Keterangan',jumlah='$jumlah' where id_barang='$id_barang'");

// mengalihkan halaman kembali ke data_barang.php
header("location:data_barang.php?pesan=update");

?>