<?php 
include '../koneksi.php';
$no_ktp    = $_POST['no_ktp'];
$customer_nama  = $_POST['customer_nama'];
$customer_email  = $_POST['customer_email'];
$customer_hp  = $_POST['customer_hp'];
$customer_alamat  = $_POST['customer_alamat'];
$customer_password  = $_POST['customer_password'];

mysqli_query($koneksi, "insert into customer (no_ktp, customer_nama, customer_email, customer_hp, customer_alamat, customer_password) 
	values ('$no_ktp','$customer_nama','$customer_email','$customer_hp','$customer_alamat',md5('$customer_password') )");
header("location:customer.php");