<?php include('session.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Warung X RPL | Produk</title>
	<link rel="stylesheet" type="text/css" href="../css/styleadmin.css">
</head>
<body>
	<div class="wrapper">
		<div class="header">
		</div>
		<div class="sidebar">
			<div class="sidebar-title"><b>Jnrtma Admin</b></div>
			<ul>
				<?php include 'sidebar.php' ?>
			</ul>
		</div>
		<div class="section">
			<div class="container">
				<?php
				$query = mysqli_query($conn, "SELECT * FROM tb_admin WHERE admin_id = '" . $_SESSION['id_login'] . "' ");
				$d = mysqli_fetch_object($query);
				?>
				<form action="" method="post" enctype="multipart/form-data">
					<h3>Tambah Data Produk</h3>
					<fieldset>
						<label>Nama Kategori</label>
						<select class="form-control" name="kategori" required>
							<option value="">--Pilih--</option>
							<?php
							$kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
							while ($r = mysqli_fetch_array($kategori)) {
							?>
								<option value="<?php echo $r['category_id'] ?>"><?php echo $r['category_name'] ?></option>
							<?php } ?>
						</select>
					</fieldset>
					<fieldset>
						<label>Nama Produk</label>
						<input type="text" name="nama" placeholder="...Nama Produk..." class="form-control" required>
					</fieldset>
					<fieldset>
						<label>Harga</label>
						<input type="text" name="harga" placeholder="...Harga Produk..." class="form-control" required>
					</fieldset>
					<fieldset>
						<label>Stok</label>
						<input type="number" name="stok" placeholder="...Stok Produk..." class="form-control" required>
					</fieldset>
					<fieldset>
						<label>Gambar Produk</label>
						<input type="file" name="gambar" placeholder="...Gambar Produk..." class="form-control" required>
					</fieldset>
					<fieldset>
						<label>Deskripsi Produk</label>
						<textarea class="form-control" name="deskripsi" placeholder="Deskripsi"></textarea><br>
					</fieldset>
					<fieldset>
						<label>Status</label>
						<select class="form-control" name="status">
							<option value="">--Pilih--</option>
							<option value="1">Aktif</option>
							<option value="0">Tidak Aktif</option>
						</select>
					</fieldset>
					<fieldset>
						<button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Tambah</button>
					</fieldset>
				</form>

				<?php
				if (isset($_POST['submit'])) {
					// menampung inputan dari form
					$kategori 	= $_POST['kategori'];
					$nama 		= $_POST['nama'];
					$harga 		= $_POST['harga'];
					$stok 		= $_POST['stok'];
					$deskripsi 	= $_POST['deskripsi'];
					$status 	= $_POST['status'];

					// menampung data file gambar yang diupload
					$filename = $_FILES['gambar']['name'];
					$tmp_name = $_FILES['gambar']['tmp_name'];

					$type1 = explode('.', $filename);
					$type2 = $type1[1];
					$newname = 'produk' . time() . '.' . $type2;

					// menampung data format file yang diizinkan
					$tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif', 'mp4','PNG','JPG','JPEG','GIF');
					// validasi format file
					if (!in_array($type2, $tipe_diizinkan)) {
						// jika format file tidak ada di dalam tipe diizinkan
						echo '<script>alert("Format file tidak diizinkan")</script>';
					} else {
						// jika format file sesuai dengan yang ada di dalam array tipe diizinkan
						// proses upload file sekaligus insert ke database
						move_uploaded_file($tmp_name, '../produk/' . $newname);

						$insert = mysqli_query($conn, "INSERT INTO tb_product VALUES(null, '$kategori', '$nama', '$harga', '$deskripsi', '$newname', '$status',null, '$stok')");

						if ($insert) {
							echo '<script>alert("Tambah data berhasil")</script>';
							echo '<script>window.location="produk_data.php"</script>';
						} else {
							echo 'gagal ' . mysqli_error($conn);
						}
					}
				}
				?>
			</div>
		</div>
	</div>
</body>
</html>
