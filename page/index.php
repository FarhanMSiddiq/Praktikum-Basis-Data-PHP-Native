
<?php session_start();?>

<!DOCTYPE html>
<!--
Profile Author: 
Nama : Farhan Maulana Siddiq
NIM : 20107002
Prodi : Teknik Informatika
-->
<html lang="en">
<?php include 'partials/head.php';?>
<body>
	<?php

	$sql="select barang.*,supplier.* from barang inner join supplier ON barang.kode_supplier=supplier.kode_supplier;";
	$select=mysqli_query($kon,$sql);

	$sql_supplier="select * from supplier";
	$select_supplier=mysqli_query($kon,$sql_supplier);

	$no=1;

	if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['aksi'])) {

       if($_GET['aksi']=="tambah"){
		$kode_barang=input($_POST["kode_barang"]);
        $nama_barang=input($_POST["nama_barang"]);
        $kode_supplier=input($_POST["kode_supplier"]);
        $jumlah_barang=input($_POST["jumlah_barang"]);
        $price=input($_POST["price"]);

        //Query input menginput data kedalam tabel anggota
        $sql_tambah="insert into barang (kode_barang,nama_barang,kode_supplier,jumlah_barang,price) values
		('$kode_barang','$nama_barang','$kode_supplier','$jumlah_barang','$price')";

        $cek_kode_barang=mysqli_num_rows(mysqli_query($kon,"select * from barang where kode_barang='$kode_barang'"));

        if($cek_kode_barang>0){
			echo "<script>alert('Kode Barang Sudah Pernah Digunakan');window.location.href='index.php';</script>";
		}else{

			$hasil=mysqli_query($kon,$sql_tambah);

			//Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
			if ($hasil) {
				$_SESSION['message'] = "Berhasil Menambahkan Data Barang.";
				header("Location:index.php");
			}
			else {
				echo mysqli_error($kon);
	
			}

		}

	


	   }elseif($_GET['aksi']=="ubah"){
		
		$kode_barang=$_POST["kode_barang"];
        $nama_barang=input($_POST["nama_barang"]);
        $kode_supplier=input($_POST["kode_supplier"]);
        $jumlah_barang=input($_POST["jumlah_barang"]);
        $price=input($_POST["price"]);
        
        //Query input menginput data kedalam tabel anggota
		$sql_update="update barang set
		nama_barang='$nama_barang',
		kode_supplier='$kode_supplier',
		jumlah_barang='$jumlah_barang',
		price='$price'
		where kode_barang='$kode_barang'";

        //Mengeksekusi/menjalankan query diatas
        $hasil=mysqli_query($kon,$sql_update);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
			$_SESSION['message'] = "Berhasil Mengubah Data Barang.";
            header("Location:index.php");
        }
        else {
            echo mysqli_error($kon);

        }
		   
	   }elseif($_GET['aksi']=="hapus"){

		$kode_barang=input($_POST["kode_barang"]);

		$cek_penjualan=mysqli_num_rows(mysqli_query($kon,"select * from penjualan where kode_barang='$kode_barang'"));

		if($cek_penjualan>0){
			echo "<script>alert('Data Tidak Dapat Dihapus Karena Sudah Ada didata Penjualan');window.location.href='index.php';</script>";
		}else{
			$sql_hapus="delete from barang where kode_barang='$kode_barang'";
			$hasil=mysqli_query($kon,$sql_hapus);
			echo "<script>alert('Data Berhasil Dihapus');window.location.href='index.php';</script>";
		}

		

	   }

    }
	
	?>

	<?php foreach ($select as $k) {?>
	<div class="modal fade modal-supplier-<?= $k['kode_supplier'];?>" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                  <div class="modal-content">
              
                    <div class="modal-header">
                      <h5 class="modal-title h4" id="myLargeModalLabel"><?= $k['kode_supplier'];?></h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close">
                      </button>
                    </div>
                    <div class="modal-body">
							<div class="mb-3">
								<label for="exampleInputUsername1" class="form-label">Kode Supplier</label>
								<input type="text" class="form-control" value="<?= $k['kode_supplier'];?>" readonly>
							</div>
							<div class="mb-3">
								<label for="exampleInputUsername1" class="form-label">Nama Supplier</label>
								<input type="text" class="form-control" value="<?= $k['nama_supplier'];?>" readonly>
							</div>
							<div class="mb-3">
								<label for="exampleInputUsername1" class="form-label">Lokasi Supplier</label>
								<input type="text" class="form-control" value="<?= $k['lokasi'];?>" readonly>
							</div>
                    </div>
					<div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                  </div>
                </div>
    </div>
	<?php } ?>

	<div class="modal fade modal-tambah" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                  <div class="modal-content">
              
                    <div class="modal-header">
                      <h5 class="modal-title h4" id="myLargeModalLabel">Tambah Barang</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close">
                      </button>
                    </div>
					<form action="<?php echo $_SERVER["PHP_SELF"];?>?aksi=tambah" method="post">
                    <div class="modal-body">
							<div class="mb-3">
								<label for="exampleInputUsername1" class="form-label">Kode Barang</label>
								<input type="text" class="form-control" placeholder="Masukkan Kode Barang" name="kode_barang" required>
							</div>
							<div class="mb-3">
								<label for="exampleInputUsername1" class="form-label">Nama Barang</label>
								<input type="text" class="form-control" placeholder="Masukkan Nama Barang" name="nama_barang" required>
							</div>
							<div class="mb-3">
								<label for="exampleInputUsername1" class="form-label">Kode Supplier</label>
								<select class="form-control"  name="kode_supplier" required>
									<?php foreach ($select_supplier as $k) {?>
										<option value="<?= $k['kode_supplier'];?>"><?= $k['nama_supplier'];?></option>
									<?php } ?>
								</select>
							</div>
							<div class="mb-3">
								<label for="exampleInputUsername1" class="form-label">Jumlah</label>
								<input type="number" class="form-control" placeholder="Masukkan Jumlah Barang" name="jumlah_barang" required>
							</div>
							<div class="mb-3">
								<label for="exampleInputUsername1" class="form-label">Harga</label>
								<input type="number" class="form-control" placeholder="Masukkan Harga Barang" name="price" required>
							</div>
							
                    </div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">Kirim</button>
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
					</form>
                  </div>
                </div>
    </div>

	<?php foreach ($select as $k) {?>
	<div class="modal fade modal-update-<?= $k['kode_barang'];?>" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                  <div class="modal-content">
              
                    <div class="modal-header">
                      <h5 class="modal-title h4" id="myLargeModalLabel">Update Barang</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close">
                      </button>
                    </div>
					<form action="<?php echo $_SERVER["PHP_SELF"];?>?aksi=ubah" method="post">
                    <div class="modal-body">
							<div class="mb-3">
								<label for="exampleInputUsername1" class="form-label">Kode Barang</label>
								<input type="text" class="form-control" placeholder="Masukkan Kode Barang" name="kode_barang" value="<?= $k['kode_barang'];?>" required readonly>
							</div>
							<div class="mb-3">
								<label for="exampleInputUsername1" class="form-label">Nama Barang</label>
								<input type="text" class="form-control" placeholder="Masukkan Nama Barang" name="nama_barang"  value="<?= $k['nama_barang'];?>" required>
							</div>
							<div class="mb-3">
								<label for="exampleInputUsername1" class="form-label">Kode Supplier</label>
								<select class="form-control"  name="kode_supplier" required>
									<?php foreach ($select_supplier as $s) {?>
										<option value="<?= $s['kode_supplier'];?>" <?php if($k['kode_supplier']==$s['kode_supplier']){?> selected <?php } ?> ><?= $s['nama_supplier'];?></option>
									<?php } ?>
								</select>
							</div>
							<div class="mb-3">
								<label for="exampleInputUsername1" class="form-label">Jumlah</label>
								<input type="number" class="form-control" placeholder="Masukkan Jumlah Barang" name="jumlah_barang" value="<?= $k['jumlah_barang'];?>" required>
							</div>
							<div class="mb-3">
								<label for="exampleInputUsername1" class="form-label">Harga</label>
								<input type="number" class="form-control" placeholder="Masukkan Harga Barang" name="price" value="<?= $k['price'];?>" required>
							</div>
							
                    </div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">Kirim</button>
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
					</form>
                  </div>
                </div>
    </div>
	<?php } ?>

	<?php foreach ($select as $k) {?>
	<div class="modal fade modal-delete-<?= $k['kode_barang'];?>" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                  <div class="modal-content">
              
                    <div class="modal-header">
                      <h5 class="modal-title h4" id="myLargeModalLabel">Hapus Barang</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close">
                      </button>
                    </div>
					<form action="<?php echo $_SERVER["PHP_SELF"];?>?aksi=hapus" method="post">
					<input type="hidden" class="form-control"  name="kode_barang" value="<?= $k['kode_barang'];?>" required readonly>
                    <div class="modal-body">
						<h5>Apakah Anda Ingin Menghapus Data Ini?</h5>
                    </div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-danger">Ya</button>
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
					</form>
                  </div>
                </div>
    </div>
	<?php } ?>


	<div class="main-wrapper">

  <?php include 'partials/sidebar.php';?>
	
		<div class="page-wrapper">
				
      <?php include 'partials/navbar.php';?>

			<div class="page-content">
			<?php if(isset($_SESSION['message'])){ ?>
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
					<?= $_SESSION['message']?>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
				</div>
				<?php unset($_SESSION["message"]);?>
			<?php } ?>

			<nav class="page-breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">Menu</li>
						<li class="breadcrumb-item active" aria-current="page">Barang</li>
					</ol>
				</nav>

				<div class="row">
					<div class="col-md-12 grid-margin stretch-card">
						<div class="card">
						<div class="card-body">
							
							<div class="d-flex justify-content-between align-items-baseline mb-4 mb-md-3">
								<h6 class="card-title mb-0">Data Barang </h6>
								<div class="dropdown">
									<button class="btn btn-primary " data-bs-toggle="modal" data-bs-target=".modal-tambah">
										Tambah Barang
									</button>
								</div>
								</div>
								<p class="text-muted mb-3">Berikut ini adalah list data barang , anda dapat menambahkan data , merubah data , dan menghapus data.</p>
							<div class="table-responsive">
							<table id="dataTableExample" class="table">
								<thead>
								<tr>
									<th>#</th>
									<th>Kode Barang</th>
									<th>Nama Barang</th>
									<th>Kode Supplier</th>
									<th>Tanggal Masuk</th>
									<th>Jumlah Barang</th>
									<th>Harga</th>
									<th >Action</th>
								</tr>
								</thead>
								<tbody>
								<?php foreach ($select as $k) {?>
								<tr>
									<td><?= $no++; ?></td>
									<td><?= $k['kode_barang'];?></td>
									<td><?= $k['nama_barang'];?></td>
									<td><a href="#"  data-bs-toggle="modal" data-bs-target=".modal-supplier-<?= $k['kode_supplier'];?>"><?= $k['kode_supplier'];?></a></td>
									<td><?= $k['tanggal_masuk'];?></td>
									<td><?= $k['jumlah_barang'];?> pcs</td>
									<td>Rp.<?= number_format($k['price']);?></td>
									<td>
										<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".modal-update-<?= $k['kode_barang'];?>">Ubah</button>
										<button class="btn btn-danger" data-bs-toggle="modal" data-bs-target=".modal-delete-<?= $k['kode_barang'];?>">Hapus</button>
									</td>
								</tr>	
								<?php } ?>
								</tbody>
							</table>
							</div>
						</div>
						</div>
					</div>
				</div>

			</div>

      	<?php include 'partials/footer.php';?>
	
		</div>
	</div>

	<?php include 'partials/jsBody.php';?>

	<script>
    
    setTimeout(function() {
        let alert = document.querySelector(".alert");
        alert.remove();
    }, 10000);
    
    </script>	
</body>
</html>