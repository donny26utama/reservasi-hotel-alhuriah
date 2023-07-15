<?php include 'header.php'; ?>


<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="breadcrumb__text">
					<h4>Dashboard Customer</h4>
					<div class="breadcrumb__links">
						<a href="index.php">Home</a>
						<a href="#">Customer</a>
						<span>Dashboard</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Breadcrumb Section End -->

<!-- Checkout Section Begin -->
<section class="checkout spad">
	<div class="container">
		<div class="row">
			
			<div id="aside" class="col-md-3">
				<?php 
				include 'customer_sidebar.php'; 
				?>
			</div>

			<div id="main" class="col-md-9">
				
				<h4><b>DASHBOARD</b></h4>
				<br>

				<div>

					<table class="table table-bordered">
						<tbody>
							<?php 
							$id = $_SESSION['customer_id'];
							$customer = mysqli_query($koneksi,"select * from customer where no_ktp='$id'");
							while($i = mysqli_fetch_array($customer)){
								?>
								<tr>
									<th width="20%">No KTP</th>	
									<td><?php echo $i['no_ktp'] ?></td>
								</tr>
								<tr>
									<th width="20%">Nama</th>	
									<td><?php echo $i['customer_nama'] ?></td>
								</tr>
								<tr>
									<th width="20%">Email</th>	
									<td><?php echo $i['customer_email'] ?></td>
								</tr>
								<tr>
									<th>HP</th>	
									<td><?php echo $i['customer_hp'] ?></td>
								</tr>
								<tr>
									<th>Alamat</th>	
									<td><?php echo $i['customer_alamat'] ?></td>
								</tr>
								<?php 
							}
							?>
						</tbody>
					</table>

				</div>

			</div>
		</div>
	</div>
</section>
<!-- Checkout Section End -->

<?php include 'footer.php'; ?>