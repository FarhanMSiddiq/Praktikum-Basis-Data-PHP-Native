
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

	$sql="select * from supplier ;";
	$select=mysqli_query($kon,$sql);


	$no=1;

	if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['aksi'])) {

       if($_GET['aksi']=="tambah"){
		$kode_supplier=input($_POST["kode_supplier"]);
        $nama_supplier=input($_POST["nama_supplier"]);
        $lokasi=input($_POST["lokasi"]);

        //Query input menginput data kedalam tabel anggota
        $sql_tambah="insert into supplier (kode_supplier,nama_supplier,lokasi) values
		('$kode_supplier','$nama_supplier','$lokasi')";

        //Mengeksekusi/menjalankan query diatas
        $hasil=mysqli_query($kon,$sql_tambah);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
			$_SESSION['message'] = "Berhasil Menambahkan Data Supplier.";
            header("Location:supplier.php");
        }
        else {
            echo mysqli_error($kon);

        }
	   }elseif($_GET['aksi']=="ubah"){
		
		$kode_supplier=input($_POST["kode_supplier"]);
        $nama_supplier=input($_POST["nama_supplier"]);
        $lokasi=input($_POST["lokasi"]);
        
        //Query input menginput data kedalam tabel anggota
		$sql_update="update supplier set
		nama_supplier='$nama_supplier',
		lokasi='$lokasi'
		where kode_supplier='$kode_supplier'";

        //Mengeksekusi/menjalankan query diatas
        $hasil=mysqli_query($kon,$sql_update);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
			$_SESSION['message'] = "Berhasil Mengubah Data Supplier.";
            header("Location:supplier.php");
        }
        else {
            echo mysqli_error($kon);

        }
		   
	   }elseif($_GET['aksi']=="hapus"){

		$kode_supplier=input($_POST["kode_supplier"]);

		$cek_penjualan=mysqli_num_rows(mysqli_query($kon,"select * from barang where kode_supplier='$kode_supplier'"));

		if($cek_penjualan>0){
			echo "<script>alert('Data Tidak Dapat Dihapus Karena Sudah Ada didata Penjualan');window.location.href='supplier.php';</script>";
		}else{
			$sql_hapus="delete from supplier where kode_supplier='$kode_supplier'";
			$hasil=mysqli_query($kon,$sql_hapus);
			echo "<script>alert('Data Berhasil Dihapus');window.location.href='supplier.php';</script>";
		}

	   }

    }
	
	?>


	<div class="modal fade modal-tambah" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                  <div class="modal-content">
                    <?php
                    
                    $query = mysqli_query($kon, "select max(kode_supplier) as kodeTerbesar from supplier");
                    $data = mysqli_fetch_array($query);
                    $kodeSupplier = $data['kodeTerbesar'];
                    $urutan = (int) substr($kodeSupplier, 3, 3);
                    $urutan++;
                    $huruf = "SUP";
                    $kodeSupplier = $huruf . sprintf("%01s", $urutan);

                    ?>
                    <div class="modal-header">
                      <h5 class="modal-title h4" id="myLargeModalLabel">Tambah Supplier</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close">
                      </button>
                    </div>
					<form action="<?php echo $_SERVER["PHP_SELF"];?>?aksi=tambah" method="post">
                    <div class="modal-body">
							<div class="mb-3">
								<label for="exampleInputUsername1" class="form-label">Kode Supplier</label>
								<input type="text" class="form-control" placeholder="Masukkan Kode Supplier" name="kode_supplier" value="<?= $kodeSupplier?>" readonly required>
							</div>
							<div class="mb-3">
								<label for="exampleInputUsername1" class="form-label">Nama Supplier</label>
								<input type="text" class="form-control" placeholder="Masukkan Nama Supplier" name="nama_supplier" required>
							</div>
                            <div class="mb-3">
								<label for="exampleInputUsername1" class="form-label">Lokasi Supplier</label>
								<input type="text" class="form-control" placeholder="Masukkan Lokasi Supplier" name="lokasi" required>
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
	<div class="modal fade modal-update-<?= $k['kode_supplier'];?>" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                  <div class="modal-content">
              
                    <div class="modal-header">
                      <h5 class="modal-title h4" id="myLargeModalLabel">Update Supplier</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close">
                      </button>
                    </div>
					<form action="<?php echo $_SERVER["PHP_SELF"];?>?aksi=ubah" method="post">
                    <div class="modal-body">
							<div class="mb-3">
								<label for="exampleInputUsername1" class="form-label">Kode Supplier</label>
								<input type="text" class="form-control" placeholder="Masukkan Kode Supplier" name="kode_supplier" value="<?= $k['kode_supplier'];?>" required readonly>
							</div>
							<div class="mb-3">
								<label for="exampleInputUsername1" class="form-label">Nama Supplier</label>
								<input type="text" class="form-control" placeholder="Masukkan Nama Supplier" name="nama_supplier"  value="<?= $k['nama_supplier'];?>" required>
							</div>
                            <div class="mb-3">
								<label for="exampleInputUsername1" class="form-label">Lokasi Supplier</label>
								<input type="text" class="form-control" placeholder="Masukkan Lokasi Supplier" name="lokasi"  value="<?= $k['lokasi'];?>" required>
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
	<div class="modal fade modal-delete-<?= $k['kode_supplier'];?>" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                  <div class="modal-content">
              
                    <div class="modal-header">
                      <h5 class="modal-title h4" id="myLargeModalLabel">Hapus Supplier</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close">
                      </button>
                    </div>
					<form action="<?php echo $_SERVER["PHP_SELF"];?>?aksi=hapus" method="post">
					<input type="hidden" class="form-control"  name="kode_supplier" value="<?= $k['kode_supplier'];?>" required readonly>
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
						<li class="breadcrumb-item active" aria-current="page">Supplier</li>
					</ol>
				</nav>

				<div class="row">
					<div class="col-md-12 grid-margin stretch-card">
						<div class="card">
						<div class="card-body">
							
							<div class="d-flex justify-content-between align-items-baseline mb-4 mb-md-3">
								<h6 class="card-title mb-0">Data Supplier </h6>
								<div class="dropdown">
									<button class="btn btn-primary " data-bs-toggle="modal" data-bs-target=".modal-tambah">
										Tambah Supplier
									</button>
								</div>
								</div>
								<p class="text-muted mb-3">Berikut ini adalah list data supplier , anda dapat menambahkan data , merubah data , dan menghapus data.</p>
							<div class="table-responsive">
							<table id="dataTableExample" class="table">
								<thead>
								<tr>
									<th>#</th>
									<th>Kode Supplier</th>
									<th>Nama Supplier</th>
                                    <th>Lokasi Supplier</th>
									<th >Action</th>
								</tr>
								</thead>
								<tbody>
								<?php foreach ($select as $k) {?>
								<tr>
									<td><?= $no++; ?></td>
									<td><?= $k['kode_supplier'];?></td>
									<td><?= $k['nama_supplier'];?></td>
									<td><?= $k['lokasi'];?></td>
									<td>
										<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".modal-update-<?= $k['kode_supplier'];?>">Ubah</button>
										<button class="btn btn-danger" data-bs-toggle="modal" data-bs-target=".modal-delete-<?= $k['kode_supplier'];?>">Hapus</button>
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