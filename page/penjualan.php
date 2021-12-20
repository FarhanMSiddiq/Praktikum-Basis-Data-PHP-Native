
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

	$sql="select penjualan.*,pelanggan.*,barang.* from penjualan inner join pelanggan ON penjualan.kode_pelanggan=pelanggan.kode_pelanggan inner join barang ON penjualan.kode_barang=barang.kode_barang ORDER BY penjualan.kode_penjualan DESC;	";
	$select=mysqli_query($kon,$sql);

	$sql_pelanggan="select * from pelanggan";
	$select_pelanggan=mysqli_query($kon,$sql_pelanggan);


    $sql_barang="select * from barang";
	$select_barang=mysqli_query($kon,$sql_barang);
    

	$no=1;

	if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['aksi'])) {

       if($_GET['aksi']=="tambah"){
		$kode_penjualan=input($_POST["kode_penjualan"]);
        $kode_barang=input($_POST["kode_barang"]);
        $kode_barangs = explode("(",$kode_barang);
        $kode_pelanggan=input($_POST["kode_pelanggan"]);
        $banyaknya=input($_POST["banyaknya"]);
        $total_transaksi=input($_POST["total_transaksi"]);

        //Query input menginput data kedalam tabel anggota
        $sql_tambah="insert into penjualan (kode_penjualan,kode_barang,kode_pelanggan,banyaknya,total_transaksi) values
		('$kode_penjualan','$kode_barangs[0]','$kode_pelanggan','$banyaknya','$total_transaksi')";

		$hasil=mysqli_query($kon,$sql_tambah);

			//Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
			if ($hasil) {
				$_SESSION['message'] = "Berhasil Menambahkan Data Penjualan.";
				header("Location:penjualan.php");
			}
			else {
				echo mysqli_error($kon);
	
			}

	   }elseif($_GET['aksi']=="ubah"){
		
		$kode_penjualan=input($_POST["kode_penjualan"]);
        $kode_barang=input($_POST["kode_barang"]);
        $kode_barangs = explode("(",$kode_barang);
        $kode_pelanggan=input($_POST["kode_pelanggan"]);
        $banyaknya=input($_POST["banyaknya"]);
        $total_transaksi=input($_POST["total_transaksi"]);
        
        //Query input menginput data kedalam tabel anggota
		$sql_update="update penjualan set
		kode_barang='$kode_barangs[0]',
		kode_pelanggan='$kode_pelanggan',
		banyaknya='$banyaknya',
		total_transaksi='$total_transaksi'
		where kode_penjualan='$kode_penjualan'";

        //Mengeksekusi/menjalankan query diatas
        $hasil=mysqli_query($kon,$sql_update);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
			$_SESSION['message'] = "Berhasil Mengubah Data Penjualan.";
            header("Location:penjualan.php");
        }
        else {
            echo mysqli_error($kon);

        }
		   
	   }elseif($_GET['aksi']=="hapus"){

		$kode_penjualan=input($_POST["kode_penjualan"]);
        $sql_hapus="delete from penjualan where kode_penjualan='$kode_penjualan'";
		$hasil=mysqli_query($kon,$sql_hapus);
		echo "<script>alert('Data Berhasil Dihapus');window.location.href='penjualan.php';</script>";
	
	   }

    }
	
	?>

	<?php foreach ($select as $k) {?>
	<div class="modal fade modal-pelanggan-<?= $k['kode_pelanggan'];?>" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                  <div class="modal-content">
              
                    <div class="modal-header">
                      <h5 class="modal-title h4" id="myLargeModalLabel"><?= $k['kode_pelanggan'];?></h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close">
                      </button>
                    </div>
                    <div class="modal-body">
							<div class="mb-3">
								<label for="exampleInputUsername1" class="form-label">Kode Pelanggan</label>
								<input type="text" class="form-control" value="<?= $k['kode_pelanggan'];?>" readonly>
							</div>
							<div class="mb-3">
								<label for="exampleInputUsername1" class="form-label">Nama Pelanggan</label>
								<input type="text" class="form-control" value="<?= $k['nama'];?>" readonly>
							</div>
							<div class="mb-3">
								<label for="exampleInputUsername1" class="form-label">No.Telpon Pelanggan</label>
								<input type="text" class="form-control" value="<?= $k['no_telp'];?>" readonly>
							</div>
                    </div>
					<div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                  </div>
                </div>
    </div>
	<?php } ?>

    <?php foreach ($select as $k) {?>
	<div class="modal fade modal-barang-<?= $k['kode_barang'];?>" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                  <div class="modal-content">
              
                    <div class="modal-header">
                      <h5 class="modal-title h4" id="myLargeModalLabel"><?= $k['kode_barang'];?></h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close">
                      </button>
                    </div>
                    <div class="modal-body">
							<div class="mb-3">
								<label for="exampleInputUsername1" class="form-label">Kode Barang</label>
								<input type="text" class="form-control" value="<?= $k['kode_barang'];?>" readonly>
							</div>
							<div class="mb-3">
								<label for="exampleInputUsername1" class="form-label">Nama Barang</label>
								<input type="text" class="form-control" value="<?= $k['nama_barang'];?>" readonly>
							</div>
							<div class="mb-3">
								<label for="exampleInputUsername1" class="form-label">Harga Barang</label>
								<input type="text" class="form-control" value="<?= $k['price'];?>" readonly>
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
				  <?php
                    
                    $query = mysqli_query($kon, "select max(kode_penjualan) as kodeTerbesar from penjualan");
                    $data = mysqli_fetch_array($query);
                    $kodePenjualan = $data['kodeTerbesar'];
                    $urutan = (int) substr($kodePenjualan,3, 3);
                    $urutan++;
                    $huruf = "KP";
                    $kodePenjualan = $huruf . sprintf("%03s", $urutan);

                    ?>
                    <div class="modal-header">
                      <h5 class="modal-title h4" id="myLargeModalLabel">Tambah Penjualan</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close">
                      </button>
                    </div>
					<form action="<?php echo $_SERVER["PHP_SELF"];?>?aksi=tambah" method="post">
                    <div class="modal-body">
							<div class="mb-3">
								<label for="exampleInputUsername1" class="form-label">Kode Penjualan</label>
								<input type="text" class="form-control" placeholder="Masukkan Kode Penjualan" name="kode_penjualan"  value="<?= $kodePenjualan?>" readonly required>
							</div>
							<div class="mb-3">
								<label for="exampleInputUsername1" class="form-label">Barang</label>
								<select class="form-control"  name="kode_barang" id="kode_barang" onchange="myFunction2	(this.value)" required>
									<?php foreach ($select_barang as $k) {?>
										<option value="<?= $k['kode_barang'];?>(<?= $k['price'];?>)"><?= $k['nama_barang'];?> (Rp.<?= number_format($k['price']);?>)</option>
									<?php } ?>
								</select>
							</div>
							<div class="mb-3">
								<label for="exampleInputUsername1" class="form-label">Pelanggan</label>
								<select class="form-control"  name="kode_pelanggan" required>
									<?php foreach ($select_pelanggan as $k) {?>
										<option value="<?= $k['kode_pelanggan'];?>"><?= $k['nama'];?></option>
									<?php } ?>
								</select>
							</div>
							<div class="mb-3">
								<label for="exampleInputUsername1" class="form-label">Jumlah</label>
								<input type="number" onchange="myFunction(this.value)" min="1" class="form-control" placeholder="Masukkan Jumlah" name="banyaknya" id="banyaknya" required >
							</div>
							<div class="mb-3">
								<label for="exampleInputUsername1" class="form-label">Harga Total</label>
								<input type="number" class="form-control" placeholder="Masukkan Harga" name="total_transaksi" id="total_transaksi" value="0" required readonly>
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
	<div class="modal fade modal-update-<?= $k['kode_penjualan'];?>" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                  <div class="modal-content">
              
                    <div class="modal-header">
                      <h5 class="modal-title h4" id="myLargeModalLabel">Update Penjualan</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close">
                      </button>
                    </div>
					<form action="<?php echo $_SERVER["PHP_SELF"];?>?aksi=ubah" method="post">
                    <div class="modal-body">
							<div class="mb-3">
								<label for="exampleInputUsername1" class="form-label">Kode Penjualan</label>
								<input type="text" class="form-control" placeholder="Masukkan Kode Penjualan" name="kode_penjualan" value="<?= $k['kode_penjualan'];?>" required readonly>
							</div>
							<div class="mb-3">
								<label for="exampleInputUsername1" class="form-label">Barang</label>
								<select class="form-control" onchange="myFunction2<?= $k['kode_penjualan'];?>(this.value)"  name="kode_barang" id="kode_barang<?= $k['kode_penjualan'];?>" required>
									<?php foreach ($select_barang as $s) {?>
										<option value="<?= $s['kode_barang'];?>(<?= $s['price'];?>)" <?php if($k['kode_barang']==$s['kode_barang']){?> selected <?php } ?> ><?= $s['nama_barang'];?> (Rp.<?= number_format($s['price']);?>)</option>
									<?php } ?>
								</select>
							</div>
							<div class="mb-3">
								<label for="exampleInputUsername1" class="form-label">Pelanggan</label>
								<select class="form-control"  name="kode_pelanggan" required>
									<?php foreach ($select_pelanggan as $s) {?>
										<option value="<?= $s['kode_pelanggan'];?>" <?php if($k['kode_pelanggan']==$s['kode_pelanggan']){?> selected <?php } ?> ><?= $s['nama'];?></option>
									<?php } ?>
								</select>
							</div>
							<div class="mb-3">
								<label for="exampleInputUsername1" class="form-label">Jumlah</label>
								<input type="number" onchange="myFunction<?= $k['kode_penjualan'];?>(this.value)" min="1" class="form-control" placeholder="Masukkan Jumlah" name="banyaknya"  id="banyaknya<?= $k['kode_penjualan'];?>" value="<?= $k['banyaknya'];?>" required >
							</div>
							<div class="mb-3">
								<label for="exampleInputUsername1" class="form-label">Harga Total</label>
								<input type="number" class="form-control" placeholder="Masukkan Harga" name="total_transaksi" id="total_transaksi<?= $k['kode_penjualan'];?>" value="<?= $k['total_transaksi'];?>" required readonly>
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
	<div class="modal fade modal-delete-<?= $k['kode_penjualan'];?>" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                  <div class="modal-content">
              
                    <div class="modal-header">
                      <h5 class="modal-title h4" id="myLargeModalLabel">Hapus Penjualan</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close">
                      </button>
                    </div>
					<form action="<?php echo $_SERVER["PHP_SELF"];?>?aksi=hapus" method="post">
					<input type="hidden" class="form-control"  name="kode_penjualan" value="<?= $k['kode_penjualan'];?>" required readonly>
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
						<li class="breadcrumb-item active" aria-current="page">Penjualan</li>
					</ol>
				</nav>

				<div class="row">
					<div class="col-md-12 grid-margin stretch-card">
						<div class="card">
						<div class="card-body">
							
							<div class="d-flex justify-content-between align-items-baseline mb-4 mb-md-3">
								<h6 class="card-title mb-0">Data Penjualan </h6>
								<div class="dropdown">
									<button class="btn btn-primary " data-bs-toggle="modal" data-bs-target=".modal-tambah">
										Tambah Penjualan
									</button>
								</div>
								</div>
								<p class="text-muted mb-3">Berikut ini adalah list data penjualan , anda dapat menambahkan data , merubah data , dan menghapus data.</p>
							<div class="table-responsive">
							<table id="dataTableExample" class="table">
								<thead>
								<tr>
									<th>#</th>
									<th>Kode Penjualan</th>
									<th>Kode Barang</th>
									<th>Kode Pelanggan</th>
									<th>Jumlah</th>
									<th>Harga Total</th>
									<th >Action</th>
								</tr>
								</thead>
								<tbody>
								<?php foreach ($select as $k) {?>
								<tr>
									<td><?= $no++; ?></td>
									<td><?= $k['kode_penjualan'];?></td>
									<td><a href="#"  data-bs-toggle="modal" data-bs-target=".modal-barang-<?= $k['kode_barang'];?>"><?= $k['kode_barang'];?></a></td>
									<td><a href="#"  data-bs-toggle="modal" data-bs-target=".modal-pelanggan-<?= $k['kode_pelanggan'];?>"><?= $k['kode_pelanggan'];?></a></td>
									<td><?= $k['banyaknya'];?> pcs</td>
									<td>Rp.<?= number_format($k['total_transaksi']);?></td>
									<td>
										<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".modal-update-<?= $k['kode_penjualan'];?>">Ubah</button>
										<button class="btn btn-danger" data-bs-toggle="modal" data-bs-target=".modal-delete-<?= $k['kode_penjualan'];?>">Hapus</button>
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
    <script>
    function myFunction(val) {
        var barang = document.getElementById('kode_barang').value;
        const barangs = barang.split("(");
        const barangsp = barangs[1].split(")");
        var harga = barangsp[0];
        var harga_total = harga*val;
        document.getElementById("total_transaksi").value = harga_total;
    }

	function myFunction2(val) {
        var banyaknya = document.getElementById('banyaknya').value;
		var barang = val;
        const barangs = barang.split("(");
        const barangsp = barangs[1].split(")");
        var harga = barangsp[0];
        var harga_total = harga*banyaknya;
        document.getElementById("total_transaksi").value = harga_total;
    }

	<?php foreach ($select as $k) {?>
	function myFunction<?= $k['kode_penjualan']?>(val) {	
        var barang = document.getElementById("<?php echo 'kode_barang'.$k['kode_penjualan']; ?>").value;
        const barangs = barang.split("(");
        const barangsp = barangs[1].split(")");
        var harga = barangsp[0];
        var harga_total = harga*val;
        document.getElementById("<?php echo 'total_transaksi'.$k['kode_penjualan']; ?>").value = harga_total;
    }
	<?php }  ?>

	<?php foreach ($select as $k) {?>
	function myFunction2<?= $k['kode_penjualan']?>(val) {	
		var banyaknya = document.getElementById("<?php echo 'banyaknya'.$k['kode_penjualan']; ?>").value;
		var barang = val;
        const barangs = barang.split("(");
        const barangsp = barangs[1].split(")");
        var harga = barangsp[0];
		var harga_total = harga*banyaknya;
        document.getElementById("<?php echo 'total_transaksi'.$k['kode_penjualan']; ?>").value = harga_total;
    }
	<?php }  ?>

    </script>
</body>
</html>