<?php 
include '../koneksi.php';
$id = $_GET['id'];

mysqli_query($koneksi, "delete from customer where no_ktp='$id'");

/*$data = mysqli_query($koneksi, "select * from invoice where invoice_customer='$id'");
while($d=mysqli_fetch_array($data)){
	$id_invoice = $d['invoice_id'];

	mysqli_query($koneksi,"delete from transaksi where transaksi_invoice='$id_invoice'");

	mysqli_query($koneksi,"delete from invoice_layanan_tambahan where ilt_invoice='$id_invoice'");

}

mysqli_query($koneksi, "delete from invoice where invoice_customer='$id'");*/

header("location:customer.php");