<?php
include "header.php";
include "navbar.php";
?>
<div class="card mt-2">
	<div class="card-body">
		
		<?php 
		include '../koneksi.php';
		$PelangganID = $_GET['UserID'];
		$no = 1;
		$data = mysqli_query($koneksi,"SELECT * FROM peminjam INNER JOIN User ON peminjam.PeminjamID=User.UserID");
		while($d = mysqli_fetch_array($data)){
			?>
			<?php if ($d['PeminjamID'] == $PeminjamID) { ?>
				<table>
					<tr>
						<td>ID User</td>
						<td>: <?php echo $d['PeminjamnID']; ?></td>
					</tr>
					<tr>
						<td>Nama Peminjam</td>
						<td>: <?php echo $d['NamaPeminjam']; ?></td>
					</tr>
					<tr>
						<td>No. Telepon</td>
						<td>: <?php echo $d['NomorTelepon']; ?></td>
					</tr>
					<tr>
						<td>Alamat</td>
						<td>: <?php echo $d['Alamat']; ?></td>
					</tr>
					<tr>
						<td>Total Pinjam</td>
						<td>: banyak barang <?php echo $d['Totalpinjam']; ?></td>
					</tr>
				</table>
				<form method="post" action="tambah_detail_penjualan.php">
					<input type="text" name="PenjualanID" value="<?php echo $d['PenjualanID']; ?>" hidden>
					<input type="text" name="PelangganID" value="<?php echo $d['PelangganID']; ?>" hidden>
					<button type="submit" class="btn btn-primary btn-sm mt-2">
						Tambah Barang
					</button>
				</form>
				<table class="table">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama barang</th>
							<th>Jumlah pinjam</th>
							<th>Total pinjam</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						include '../koneksi.php';
						$nos = 1;
						$detailpeminjaman = mysqli_query($koneksi,"SELECT * FROM detailpeminjaman");
						while($d_detailpeminjaman = mysqli_fetch_array($detailpeminjaman)){
							?>
							<?php 
							if ($d_detailpeminjaman['PeminjamanID'] == $d['PeminjamanID']) { ?>
								<tr>
									<td><?php echo $nos++; ?></td>
									<td>
										<form action="simpan_barang_pinjam.php" method="post">
											<div class="form-group">
												<input type="text" name="PeminjamID" value="<?php echo $d['PeminjamID']; ?>" hidden>
												<input type="text" name="DetailID" value="<?php echo $d_detailpenjualan['DetailID']; ?>" hidden>
												<select name="ProdukID" class="form-control" onchange="this.form.submit()">
													<option>--- Pilih Produk ---</option>
													<?php 
													include '../koneksi.php';
													$no = 1;
													$produk = mysqli_query($koneksi,"SELECT * FROM produk");
													while($d_produk = mysqli_fetch_array($produk)){
														?>
														<option value="<?php echo $d_produk['ProdukID']; ?>" <?php if ($d_produk['ProdukID']==$d_detailpenjualan['ProdukID']) { echo "selected"; } ?>><?php echo $d_produk['NamaProduk']; ?></option>
													<?php } ?>
												</select>
											</div>
										</form>
									</td>
									<td>
										<form method="post" action="hitung_subtotal.php">
											<?php 
											include '../koneksi.php';
											$produk = mysqli_query($koneksi,"SELECT * FROM produk");
											while($d_produk = mysqli_fetch_array($produk)){
												?>
												<?php 
												if ($d_produk['ProdukID']==$d_detailpenjualan['ProdukID']) { ?>
													<input type="text" name="banyak" value="<?php echo $d_produk['banyak']; ?>" hidden>
													<input type="text" name="BarangID" value="<?php echo $d_produk['barangID']; ?>" hidden>
													<input type="text" name="Stok" value="<?php echo $d_produk['Stok']; ?>" hidden>
													<?php 
												}
											}
											?>
											<div class="form-group">
												<input type="number" name="Jumlahbarang" value="<?php echo $d_detailpenjualan['Jumlahbarang']; ?>" class="form-control">
											</div>
										</td>
										<td><?php echo $d_detailpenjualan['Subtotal']; ?></td>
										<td>
											<input type="text" name="DetailID" value="<?php echo $d_detailpenjualan['DetailID']; ?>" hidden>
											<input type="text" name="PelangganID" value="<?php echo $d['PelangganID']; ?>" hidden>
											<button type="submit" class="btn btn-warning btn-sm">Proses</button>
										</form>
										<form method="post" action="hapus_detail_pembelian.php">
											<input type="text" name="PeminjamID" value="<?php echo $d['PeminjamID']; ?>" hidden>
											<input type="text" name="DetailID" value="<?php echo $d_detailpenjualan['DetailID']; ?>" hidden>
											<button type="submit" class="btn btn-danger btn-sm">Hapus</button>
										</form>
									</td>
								</tr>
							<?php } else {
								?>
								<?php 
							}
						} 
						?>
					</tbody>
				</table>
				<form method="post" action="simpan_total_pinjam.php">
					<?php 
					include '../koneksi.php';
					$detailpenjualan = mysqli_query($koneksi, "SELECT SUM(Subtotal) AS Totalpinjam FROM detailpeminjaman WHERE 	PeminjamanID='$d[PeminjamanID]'"); 
					$row = mysqli_fetch_assoc($detailpenjualan); 
					$sum = $row['Totalpinjam'];
					?>
					<div class="row">
						<div class="col-sm-10">
							<div class="form-group">
								<input type="text" class="form-control" name="TotalHarga" value="<?php echo $sum; ?>">
								<input type="text" name="peminjamID" value="<?php echo $d['PeminjamID']; ?>" hidden>
								<input type="text" name="UserID" value="<?php echo $d['UserID']; ?>" hidden>
							</div>
						</div>
						<div class="col-sm-2">
							<div class="form-group">
								<button class="btn btn-info btn-sm form-control" type="submit">Simpan</button>
							</div>
						</div>
					</div>
				</form>
			<?php } else { ?>
				<?php 
			} 
		} 
		?>		
	</div>
</div>

<?php
include "footer.php";
?>