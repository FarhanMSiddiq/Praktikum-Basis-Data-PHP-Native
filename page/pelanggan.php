
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

	$sql="select * from pelanggan ;";
	$select=mysqli_query($kon,$sql);


	$no=1;

	if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['aksi'])) {

       if($_GET['aksi']=="tambah"){
		$kode_pelanggan=input($_POST["kode_pelanggan"]);
        $nama=input($_POST["nama"]);
        $no_telp=input($_POST["no_telp"]);

        //Query input menginput data kedalam tabel anggota
        $sql_tambah="insert into pelanggan (kode_pelanggan,nama,no_telp) values
		('$kode_pelanggan','$nama','$no_telp')";

        //Mengeksekusi/menjalankan query diatas
        $hasil=mysqli_query($kon,$sql_tambah);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
			$_SESSION['message'] = "Berhasil Menambahkan Data Pelanggan.";
            header("Location:pelanggan.php");
        }
        else {
            echo mysqli_error($kon);

        }
	   }elseif($_GET['aksi']=="ubah"){
		
		$kode_pelanggan=input($_POST["kode_pelanggan"]);
        $nama=input($_POST["nama"]);
        $no_telp=input($_POST["no_telp"]);
        
        //Query input menginput data kedalam tabel anggota
		$sql_update="update pelanggan set
		nama='$nama',
		no_telp='$no_telp'
		where kode_pelanggan='$kode_pelanggan'";

        //Mengeksekusi/menjalankan query diatas
        $hasil=mysqli_query($kon,$sql_update);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
			$_SESSION['message'] = "Berhasil Mengubah Data Pelanggan.";
            header("Location:pelanggan.php");
        }
        else {
            echo mysqli_error($kon);

        }
		   
	   }elseif($_GET['aksi']=="hapus"){

		$kode_pelanggan=input($_POST["kode_pelanggan"]);

		$cek_penjualan=mysqli_num_rows(mysqli_query($kon,"select * from penjualan where kode_pelanggan='$kode_pelanggan'"));

		if($cek_penjualan>0){
			echo "<script>alert('Data Tidak Dapat Dihapus Karena Sudah Ada didata Penjualan');window.location.href='pelanggan.php';</script>";
		}else{
			$sql_hapus="delete from pelanggan where kode_pelanggan='$kode_pelanggan'";
			$hasil=mysqli_query($kon,$sql_hapus);
			echo "<script>alert('Data Berhasil Dihapus');window.location.href='pelanggan.php';</script>";
		}

	   }

    }
	
	?>


	<div class="modal fade modal-tambah" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                  <div class="modal-content">
                    <?php
                    
                    $query = mysqli_query($kon, "select max(kode_pelanggan) as kodeTerbesar from pelanggan");
                    $data = mysqli_fetch_array($query);
                    $kodePelanggan = $data['kodeTerbesar'];
                    $urutan = (int) substr($kodePelanggan, 1, 3);
                    $urutan++;
                    $huruf = "P";
                    $kodePelanggan = $huruf . sprintf("%03s", $urutan);

                    ?>
                    <div class="modal-header">
                      <h5 class="modal-title h4" id="myLargeModalLabel">Tambah Pelanggan</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close">
                      </button>
                    </div>
					<form action="<?php echo $_SERVER["PHP_SELF"];?>?aksi=tambah" method="post">
                    <div class="modal-body">
							<div class="mb-3">
								<label for="exampleInputUsername1" class="form-label">Kode Pelanggan</label>
								<input type="text" class="form-control" placeholder="Masukkan Kode Pelanggan" name="kode_pelanggan" value="<?= $kodePelanggan?>" readonly required>
							</div>
							<div class="mb-3">
								<label for="exampleInputUsername1" class="form-label">Nama Pelanggan</label>
								<input type="text" class="form-control" placeholder="Masukkan Nama Pelanggan" name="nama" required>
							</div>
                            <div class="mb-3">
								<label for="exampleInputUsername1" class="form-label">No.Telp Pelanggan</label>
								<input type="text" class="form-control" placeholder="Masukkan No.Telp Pelanggan" name="no_telp" required>
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
	<div class="modal fade modal-update-<?= $k['kode_pelanggan'];?>" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                  <div class="modal-content">
              
                    <div class="modal-header">
                      <h5 class="modal-title h4" id="myLargeModalLabel">Update Pelanggan</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close">
                      </button>
                    </div>
					<form action="<?php echo $_SERVER["PHP_SELF"];?>?aksi=ubah" method="post">
                    <div class="modal-body">
							<div class="mb-3">
								<label for="exampleInputUsername1" class="form-label">Kode Pelanggan</label>
								<input type="text" class="form-control" placeholder="Masukkan Kode Pelanggan" name="kode_pelanggan" value="<?= $k['kode_pelanggan'];?>" required readonly>
							</div>
							<div class="mb-3">
								<label for="exampleInputUsername1" class="form-label">Nama Pelanggan</label>
								<input type="text" class="form-control" placeholder="Masukkan Nama Pelanggan" name="nama"  value="<?= $k['nama'];?>" required>
							</div>
                            <div class="mb-3">
								<label for="exampleInputUsername1" class="form-label">No.Telp Pelanggan</label>
								<input type="text" class="form-control" placeholder="Masukkan No.Telp Pelanggan" name="no_telp"  value="<?= $k['no_telp'];?>" required>
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
	<div class="modal fade modal-delete-<?= $k['kode_pelanggan'];?>" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                  <div class="modal-content">
              
                    <div class="modal-header">
                      <h5 class="modal-title h4" id="myLargeModalLabel">Hapus Pelanggan</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close">
                      </button>
                    </div>
					<form action="<?php echo $_SERVER["PHP_SELF"];?>?aksi=hapus" method="post">
					<input type="hidden" class="form-control"  name="kode_pelanggan" value="<?= $k['kode_pelanggan'];?>" required readonly>
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
						<li class="breadcrumb-item active" aria-current="page">Pelanggan</li>
					</ol>
				</nav>

				<div class="row">
					<div class="col-md-12 grid-margin stretch-card">
						<div class="card">
						<div class="card-body">
							
							<div class="d-flex justify-content-between align-items-baseline mb-4 mb-md-3">
								<h6 class="card-title mb-0">Data Pelanggan </h6>
								<div class="dropdown">
									<button class="btn btn-primary " data-bs-toggle="modal" data-bs-target=".modal-tambah">
										Tambah Pelanggan
									</button>
								</div>
								</div>
								<p class="text-muted mb-3">Berikut ini adalah list data pelanggan , anda dapat menambahkan data , merubah data , dan menghapus data.</p>
							<div class="table-responsive">
							<table id="dataTableExample" class="table">
								<thead>
								<tr>
									<th>#</th>
									<th>Kode Pelanggan</th>
									<th>Nama Pelanggan</th>
                                    <th>No.Telpon Pelanggan</th>
									<th >Action</th>
								</tr>
								</thead>
								<tbody>
								<?php foreach ($select as $k) {?>
								<tr>
									<td><?= $no++; ?></td>
									<td><?= $k['kode_pelanggan'];?></td>
									<td><?= $k['nama'];?></td>
									<td><?= $k['no_telp'];?></td>
									<td>
										<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".modal-update-<?= $k['kode_pelanggan'];?>">Ubah</button>
										<button class="btn btn-danger" data-bs-toggle="modal" data-bs-target=".modal-delete-<?= $k['kode_pelanggan'];?>">Hapus</button>
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