<?php 
include '../koneksi.php';
$id = $_GET['id'];
$data = mysqli_query($koneksi, "select * from kamar where kamar_id='$id'");
$d = mysqli_fetch_assoc($data);
$foto1 = $d['kamar_foto1'];


unlink("../gambar/kamar/$foto1");


mysqli_query($koneksi, "delete from kamar where kamar_id='$id'");




// $data = mysqli_query($koneksi, "select * from transaksi where transaksi_kamar='$id'");
// while($d=mysqli_fetch_array($data)){
// 	$id_invoice = $d['transaksi_invoice'];

// 	mysqli_query($koneksi, "delete from invoice where invoice_id='$id'");
// }

// mysqli_query($koneksi, "delete from transaksi where transaksi_kamar='$id'");

header("location:kamar.php");
