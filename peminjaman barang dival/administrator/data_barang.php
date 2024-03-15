<?php
include "header.php";
include "navbar.php";
?>
<div class="card mt-2">
	<div class="card-body">
		<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambah-data">
			Tambah Data
		</button>
	</div>
	<div class="card-body">
		<?php 
		if(isset($_GET['pesan'])){
			if($_GET['pesan']=="simpan"){?>
				<div class="alert alert-success" role="alert">
					Data Berhasil Di Simpan
				</div>
			<?php } ?>
			<?php if($_GET['pesan']=="update"){?>
				<div class="alert alert-success" role="alert">
					Data Berhasil Di Update
				</div>
			<?php } ?>
			<?php if($_GET['pesan']=="hapus"){?>
				<div class="alert alert-success" role="alert">
					Data Berhasil Di Hapus
				</div>
			<?php } ?>
			<?php 
		}
		?>
		<table class="table">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama Barang</th>
					<th>kondisi</th>
					<th>Keterangan</th>
					<th>Jumlah</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				include '../koneksi.php';
				$no = 1;
				$data = mysqli_query($koneksi,"select * from produk");
				while($d = mysqli_fetch_array($data)){
					?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $d['NamaBarang']; ?></td>
						<td><?php echo $d['kondisi']; ?></td>
						<td><?php echo $d['Keterangan']; ?></td>
						<td><?php echo $d['jumlah']; ?></td>


						<td>
							<button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit-data<?php echo $d['id_barang']; ?>">
								Edit
							</button>
							<button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus-data<?php echo $d['id_barang']; ?>">
								Hapus
							</button>
						</td>
					</tr>

					<!-- Modal Edit Data-->
					<div class="modal fade" id="edit-data<?php echo $d['id_barang']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data</h1>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<form action="proses_update_barang.php" method="post">
									<div class="modal-body">
									<div class="form-group">
									<label>Nama Barang</label>
											<input type="text" name="NamaBarang" class="form-control" value="<?php echo $d['NamaBarang']; ?>">
										</div>
									<div class="form-group">
										<label>kondisi</label>
										<input type="text" name="kondisi" class="form-control" value="<?php echo $d['kondisi']; ?>">									
									<div class="form-group">
										<label>Keterangan</label>
										<input type="text" name="Keterangan" class="form-control" value="<?php echo $d['Keterangan']; ?>">									</div>
									</div>
									<div class="form-group">
										<label>Jumlah</label>
										<input type="text" name="jumlah" class="form-control" value="<?php echo $d['jumlah']; ?>">								
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
										<button type="submit" class="btn btn-primary">Update</button>
									</div>
								</form>
							</div>
						</div>
					</div>

					<!-- Modal Hapus Data-->
					<div class="modal fade" id="hapus-data<?php echo $d['id_barang']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data</h1>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<form method="post" action="proses_hapus_barang.php">
									<div class="modal-body">
										<input type="hidden" name="id_barang" value="<?php echo $d['id_barang']; ?>">
										Apakah anda yakin akan menghapus data <b><?php echo $d['NamaBarang']; ?></b>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
										<button type="submit" class="btn btn-primary">Hapus</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>

<!-- Modal Tambah Data-->
<div class="modal fade" id="tambah-data" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form action="proses_simpan_barang.php" method="post">
				<div class="modal-body">				
					<div class="form-group">
						<label>Nama Barang</label>
						<input type="text" name="NamaBarang" class="form-control">
					</div>
					<div class="form-group">
						<label>kondisi</label>
						<input type="text" name="kondisi" class="form-control">
					</div>
					<div class="form-group">
						<label>Keterangan</label>
						<input type="text" name="Keterangan" class="form-control">
					</div>
					<div class="form-group">
						<label>Jumlah</label>
						<input type="number" name="jumlah" class="form-control">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
					<button type="submit" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php
include "footer.php";
?>