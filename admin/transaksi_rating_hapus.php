<?php 
include '../koneksi.php';

date_default_timezone_set('Asia/Jakarta');

$invoice = $_GET['id'];

mysqli_query($koneksi, "delete from rating where rating_invoice='$invoice'") or die(mysqli_error($koneksi));	

header("location:transaksi_rating.php?id=$invoice&alert=hapus");
