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
						<span>Konfirmasi Pembayaran</span>
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
				
				<h4><b>KONFIRMASI PEMBAYARAN</b></h4>
				<br>

				<div>

					<?php 
					if(isset($_GET['alert'])){
						if($_GET['alert'] == "gagal"){
							echo "<div class='alert alert-danger'>Gambar gagal diupload!</div>";
						}elseif($_GET['alert'] == "sukses"){
							echo "<div class='alert alert-success'>Pesanan berhasil dibuat, silahkan melakukan pembayaran!</div>";
						}elseif($_GET['alert'] == "upload"){
							echo "<div class='alert alert-success'>Konfirmasi pembayaran berhasil tersimpan, silahkan menunggu konfirmasi dari admin!</div>";
						}
					}
					?>

					<a href="customer_pesanan.php" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
					<br>
					<br>
					<div class="row">

						<div class="col-lg-12">

							<table class="table table-bordered">
								<tbody>
									<?php 
									$id_invoice = mysqli_escape_string($koneksi, $_GET['id']);
									$id = $_SESSION['customer_id'];
									$invoice = mysqli_query($koneksi,"select * from invoice where invoice_customer='$id' and invoice_id='$id_invoice' order by invoice_id desc");
									while($i = mysqli_fetch_array($invoice)){
										?>
										<tr>
											<th width="20%">No.Invoice</th>	
											<td>INVOICE-00<?php echo $i['invoice_id'] ?></td>
										</tr>
										<tr>
											<th>Tanggal</th>	
											<td><?php echo date('d-m-Y', strtotime($i['invoice_tanggal'])) ?></td>
										</tr>
										<tr>
											<th>Total Bayar</th>	
											<td><?php echo "Rp. ".number_format($i['invoice_total_bayar'])." ,-" ?></td>
										</tr>
										<tr>
											<th>Status</th>	
											<td>

												<?php 
												if($i['invoice_status'] == 0){
													echo "<span class='label label-warning'>Menunggu Pembayaran</span>";
												}elseif($i['invoice_status'] == 1){
													echo "<span class='label label-default'>Menunggu Konfirmasi</span>";
												}elseif($i['invoice_status'] == 2){
													echo "<span class='label label-danger'>Ditolak</span>";
												}elseif($i['invoice_status'] == 3){
													echo "<span class='label label-primary'>Dikonfirmasi</span>";
												}elseif($i['invoice_status'] == 4){
													echo "<span class='label label-success'>Selesai</span>";
												}
												?>
											</td>
										</tr>
										<?php 
									}
									?>
								</tbody>
							</table>

							<br/>
							<p>Silahkan Lakukan Pembayaran Ke Nomor Rekening Berikut :</p>
							<table class="table table-bordered">
								<tr>
									<th width="30%">Nomor Rekening</th>
									<td>123-122-3345</td>
								</tr>
								<tr>
									<th>Atas Nama</th>
									<td>Royal Hotel</td>
								</tr>
								<tr>
									<th>Bank</th>
									<td>BCA</td>
								</tr>
							</table>
							<br/>

							<form action="customer_pembayaran_act.php" method="post" enctype="multipart/form-data">
								<div class="form-group">
									<input type="hidden" name="id" value="<?php echo $id_invoice; ?>">
									<label>Upload Bukti Pembayaran</label>
									<br>
									<input type="file" name="bukti" required="required">
									<small class="text-muted">File yang diperbolehkan hanya file gambar.</small>
								</div>
								<br>
								<input type="submit" value="Upload Bukti Pembayaran" class="site-btn">
							</form>

						</div>	

					</div>

					
				</div>

			</div>
		</div>
	</div>
</section>
<!-- Checkout Section End -->

<?php include 'footer.php'; ?>