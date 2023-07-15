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
				
				<h4><b>GANTI PASSWORD</b></h4>
				<br>

				<div>
					<?php 
					if(isset($_GET['alert'])){
						if($_GET['alert'] == "sukses"){
							echo "<div class='alert alert-success'>Password anda berhasil diganti!</div>";
						}
					}
					?>

					<form action="customer_password_act.php" method="post">
						<div class="checkout__input">
							<label for="">Masukkan Password Baru</label>
							<input type="password" class="input" required="required" name="password" placeholder="Masukkan password .." min="5">
						</div>

						<div class="form-group">
							<input type="submit" class="site-btn" value="Ganti Password">
						</div>
					</form>

				</div>

			</div>
		</div>
	</div>
</section>
<!-- Checkout Section End -->

<?php include 'footer.php'; ?>