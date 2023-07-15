<?php 
include '../koneksi.php';
$nama  = $_POST['nama'];
$username = $_POST['hdnuser'];
$password = $_POST['password'];

if ($password==""):
	mysqli_query($koneksi, "update admin set admin_nama='$nama' where admin_username='$username'");
	header("location:admin.php?alert=berhasil");
elseif ($password<>""):	
	mysqli_query($koneksi, "update admin set admin_nama='$nama', admin_password=md5('$password') where admin_username='$username'");
	header("location:admin.php?alert=berhasil");
endif;



