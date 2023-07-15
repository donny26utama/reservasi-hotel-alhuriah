<?php 
$id = $_SESSION['customer_id'];
$customer = mysqli_query($koneksi,"select * from customer where no_ktp='$id'");
$c = mysqli_fetch_assoc($customer)
?>

<div class="shop__sidebar">
	<div class="shop__sidebar__accordion">
		<div class="card">
			<div class="card-heading">
				<h5><b>Hy, <?php echo $c['customer_nama'] ?></b></h5>
			</div>
			<div class="card-body">
				<div class="shop__sidebar__tags">
					<a class="btn-block py-3" href="customer.php"> <i class="fa fa-home"></i> &nbsp; Dashboard</a>
					<a class="btn-block py-3" href="customer_pesanan.php"> <i class="fa fa-list"></i> &nbsp; Pesanan Saya</a>
					<a class="btn-block py-3" href="customer_password.php"> <i class="fa fa-unlock"></i> &nbsp; Ganti Password</a>
					<a class="btn-block py-3" href="customer_logout.php"> <i class="fa fa-sign-out"></i> &nbsp; Keluar</a>
				</div>
			</div>
		</div>
	</div>
</div>