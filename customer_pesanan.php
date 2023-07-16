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
						<span>Pesanan</span>
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
				<?php include 'customer_sidebar.php'; ?>
			</div>
			<div id="main" class="col-md-9">
				<h4><b>KAMAR SAYA</b></h4>
				<br>
				<div>
					<?php
						if (isset($_GET['alert'])) {
							if ($_GET['alert'] == "gagal") {
								echo "<div class='alert alert-danger'>Gambar gagal diupload!</div>";
							} elseif ($_GET['alert'] == "sukses") {
								echo "<div class='alert alert-success'>Pesanan berhasil dibuat, silahkan melakukan pembayaran!</div>";
							} elseif ($_GET['alert'] == "upload") {
								echo "<div class='alert alert-success'>Konfirmasi pembayaran berhasil tersimpan, silahkan menunggu konfirmasi dari admin!</div>";
							}
						}
					?>
					<small class="text-muted">
						Semua data kamar yang anda booking / invoice.
					</small>
					<br/>
					<br/>
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>#</th>
									<th>No.Faktur</th>
									<th>Customer</th>
									<th class="text-center">Status</th>
									<th class="text-center">OPSI</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$no = 1;
									$id = $_SESSION['customer_id'];
									$query_kamar = "select harga * lama_inap from punya where punya.id_transaksi = check_in.id_transaksi";
									$query_layanan = "select sum(ambil.harga) from ambil where ambil.id_transaksi = check_in.id_transaksi";
									$query = "
										select
											check_in.*,
											customer.customer_nama,
											($query_kamar) as harga_kamar,
											($query_layanan) as biaya_layanan
										from check_in
										inner join customer on customer.no_ktp = check_in.no_ktp
										where check_in.no_ktp='$id'
										order by check_in.id_transaksi desc";
									$invoice = mysqli_query($koneksi,$query);
									while($i = mysqli_fetch_array($invoice)):
										$total_bayar = $i['harga_kamar'] + $i['biaya_layanan'];
								?>
									<tr>
										<td><?php echo $no++ ?></td>
										<td>
											<small class="text-muted"><?php echo date('d/m/Y', strtotime($i['tgl_transaksi'])) ?></small><br>
											<?php echo $i['invoice_no'] ?><br>
											<small><?php echo "Rp. ".number_format($total_bayar)." ,-" ?></small>
										</td>
										<td><?php echo $i['customer_nama'] ?></td>
										<td class="text-center">
											<?php
												if ($i['invoice_status'] == 0) {
													echo "<span class='badge badge-warning'>Menunggu Pembayaran</span>";
												} elseif($i['invoice_status'] == 1) {
													echo "<span class='badge badge-info'>Menunggu Konfirmasi</span>";
												} elseif($i['invoice_status'] == 2) {
													echo "<span class='badge badge-danger'>Ditolak</span>";
												} elseif($i['invoice_status'] == 3) {
													echo "<span class='badge badge-primary'>Dikonfirmasi</span>";
												} elseif($i['invoice_status'] == 4) {
													echo "<span class='badge badge-success'>Selesai</span>";
												}
											?>
										</td>
										<td class="text-center">
											<?php if(in_array($i['invoice_status'], array(0, 1))): ?>
												<a class='btn btn-sm btn-primary mb-1'
													href="customer_pembayaran.php?id=<?php echo $i['id_transaksi']; ?>">
													<i class="fa fa-money"></i> Konfirmasi Pembayaran
												</a><br>
											<?php endif; ?>
											<?php if($i['invoice_status'] == 1): ?>
												<a class='btn btn-sm btn-warning mb-1'
													href="<?php echo $i['invoice_bukti']; ?>"
													target="_blank">
													<i class="fa fa-file-image-o"></i> Lihat Bukti Bayar
												</a><br>
											<?php endif; ?>
											<?php if($i['invoice_status'] == 4): ?>
												<a class='btn btn-sm btn-danger mb-1'
													href="customer_rating.php?id=<?php echo $i['id_transaksi']; ?>">
													<i class="fa fa-star"></i> Beri Rating & Review
												</a><br>
											<?php endif; ?>
											<a class='btn btn-sm btn-success mb-1'
												href="customer_invoice.php?id=<?php echo $i['id_transaksi']; ?>">
												<i class="fa fa-print"></i> Faktur
											</a>
										</td>
									</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
					</div>
					<small class="text-muted">
						Jika status sudah berubah jadi "Dikonfirmasi", silahkan berikan NO INVOICE dan
						Kartu Identitas (KTP/SIM dll) pada resepsionis saat CHECK-IN.
					</small>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Checkout Section End -->

<?php include 'footer.php'; ?>
