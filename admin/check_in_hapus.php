<?php 
include '../koneksi.php';
$id = $_GET['id'];

mysqli_query($koneksi, "delete from check_in where kd_check_in='$id'");

$data = mysqli_query($koneksi, "select * from booking where kategori_kamar='$id'");
while($d=mysqli_fetch_array($data)){
	$kd_booking= $d['kd_booking'];

	mysqli_query($koneksi,"delete from transaksi where booking='$kd_booking'");

	mysqli_query($koneksi,"delete from invoice_layanan_tambahan where ilt_invoice='$id_invoice'");

}

mysqli_query($koneksi, "delete from booking where kategori_kamar='$id'");

header("location:check_in.php");