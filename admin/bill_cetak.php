<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<?php 
	session_start();
	include '../koneksi.php';
	?>

	<style>

		body{
			font-family: sans-serif;
		}

		.table{
			border-collapse: collapse;
			width: 100%;
		}
		.table th,
		.table td{
			padding: 5px 10px;
			border: 1px solid black;
		}
	</style>

	<center>
		<h2>ROYALE HOTEL</h2>
	</center>
	
	<div>

		<?php 
		$id_invoice = mysqli_real_escape_string($koneksi,$_GET['id']);


		$invoice = mysqli_query($koneksi,"select * from invoice where invoice_id='$id_invoice' order by invoice_id desc");
		while($i = mysqli_fetch_array($invoice)){

			$id_kamar = $i['invoice_kamar'];
			$kamar = mysqli_query($koneksi,"SELECT * FROM kamar,kategori where kategori_id=kamar_kategori and kamar_id='$id_kamar' order by kamar_id desc");
			$k = mysqli_fetch_assoc($kamar)
			?>
			<div>
				<h4>INVOICE-00<?php echo $i['invoice_id'] ?></h4>
				<br/>
				<table class="table table-bordered">
					<tr>
						<td width="20%">Nama</td>
						<td><?php echo $i['invoice_nama']; ?></td>
					</tr>
					<tr>
						<td>HP</td>
						<td><?php echo $i['invoice_hp']; ?></td>
					</tr>
					<tr>
						<td>Kamar</td>
						<td>
							<b><?php echo $k['kamar_nama']; ?></b>
						</td>
					</tr>
					<tr>
						<td>Status</td>
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
				</table> 
				<br/>

				<br>
				Detail :
				<br>
				
				<table class="table table-bordered">
					<tbody>
						<tr>
							<td>Harga Kamar</td>
							<td class="text-center"><?php echo "Rp. ".number_format($i['invoice_harga'])." ,-"; ?></td>
						</tr>
						<tr>
							<td>
								Lama Menginap : 
								<small class="text-muted">( <?php echo date('d/m/Y', strtotime($i['invoice_dari'])); ?> - <?php echo date('d/m/Y', strtotime($i['invoice_sampai'])); ?> )</small>
							</td>
							<td class="text-center">
								<?php 
								$tgl_dari = strtotime($i['invoice_dari'] );
								$tgl_sampai = strtotime($i['invoice_sampai'] );
								$jumlah_hari =  $tgl_sampai - $tgl_dari;
								$hari = round($jumlah_hari / (60 * 60 * 24));
								?>
								<?php echo $hari ?> Hari
							</td>
						</tr>
						<tr>
							<td>
								Layanan Tambahan :
								<br>
								<?php   
								$harga_layanan = 0;
								$id_invoice = $i['invoice_id'];
								$layanan = mysqli_query($koneksi,"select * from layanan_tambahan, invoice_layanan_tambahan where ilt_layanan=lt_id and ilt_invoice='$id_invoice'");

								while($l = mysqli_fetch_array($layanan)){
									$harga_layanan += $l['lt_harga'];
									?>
									&nbsp; &nbsp; &nbsp;<small class="text-muted">- <?php echo $l['lt_nama'] ?> &nbsp; - &nbsp; (<?php echo "Rp. ".number_format($l['lt_harga'])." ,-" ?>)</small><br>
									<?php
								}
								?>
							</td>
							<td class="text-center"><?php echo "Rp. ".number_format($harga_layanan)." ,-"; ?></td>
						</tr>
						<tr>
							<td>Total Bayar</td>
							<td class="text-center bg-primary text-white font-weight-bold"><?php echo "Rp. ".number_format($i['invoice_total_bayar'])." ,-"; ?></td>
						</tr>
					</tbody>
				</table>


				<br>
				

			</div>	


			<?php 
		}
		?>
	</div>


	<script>
		window.print();
	</script>
</body>
</html>