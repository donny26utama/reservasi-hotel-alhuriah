<?php 
include '../koneksi.php';
$nama  = $_POST['nama'];
$username = $_POST['username'];
$password = md5($_POST['password']);




	mysqli_query($koneksi, "insert into admin (admin_username, admin_nama, admin_password) values ('$username', '$nama','$password')");
	header("location:admin.php");


