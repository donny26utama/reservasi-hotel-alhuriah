<?php include 'header.php'; ?>


<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="breadcrumb__text">
					<h4>Login Customer</h4>
					<div class="breadcrumb__links">
						<a href="index.php">Home</a>
						<a href="#">Customer</a>
						<span>Login</span>
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
		<div class="checkout__form">
			<form action="masuk_act.php" method="post">
				<div class="row justify-content-center">
					<div class="col-lg-6 col-md-6">
						<?php
							if (isset($_GET['alert'])) {
								if($_GET['alert'] == "terdaftar"){
									echo "<div class='alert alert-success text-center'>Selamat akun anda telah disimpan, silahkan login.</div>";
								}elseif($_GET['alert'] == "gagal"){
									echo "<div class='alert alert-danger text-center'>Email dan Password tidak sesuai, coba lagi.</div>";
								}elseif($_GET['alert'] == "login-dulu"){
									echo "<div class='alert alert-warning text-center'>Silahkan login terlebih dulu untuk booking.</div>";
								}
							}
						?>

						<h6 class="coupon__code"><span class="icon_tag_alt"></span> Belum punya akun? <a href="daftar.php" class="text-success">Klik Di Sini</a> untuk daftar.</h6>
						<h6 class="checkout__title">Login</h6>

						<div class="checkout__input">
							<p>Akun<span>*</span></p>
							<input type="text" class="input" required="required" name="customer_email" placeholder="Masukkan email / No. KTP ..">

						</div>
						<div class="checkout__input">
							<p>Password<span>*</span></p>
							<input type="password" class="input" required="required" name="customer_password" placeholder="Masukkan password ..">
						</div>
						<button type="submit" class="site-btn">LOGIN SEKARANG</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>
<!-- Checkout Section End -->

<?php include 'footer.php'; ?>