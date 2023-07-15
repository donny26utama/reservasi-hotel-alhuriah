<?php 
include '../koneksi.php';
$nama  = $_POST['nama'];
$tanggal = $_POST['tanggal']
$email  = $_POST['email'];
$hp  = $_POST['hp'];
$alamat  = $_POST['alamat'];
$password  = md5($_POST['password']);

mysqli_query($koneksi, "insert into customer values (NULL,'$nama','$tanggal',
	'$email','$hp','$alamat','$password')");
header("location:check_in.php,customer.php");