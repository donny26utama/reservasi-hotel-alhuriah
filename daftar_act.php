<?php 
include 'koneksi.php';
$no_ktp  = mysqli_real_escape_string($koneksi, $_POST['no_ktp']);
$customer_nama  = mysqli_real_escape_string($koneksi, $_POST['customer_nama']);
$customer_email = mysqli_real_escape_string($koneksi, $_POST['customer_email']);
$customer_hp = mysqli_real_escape_string($koneksi, $_POST['customer_hp']);
$customer_alamat = mysqli_real_escape_string($koneksi, $_POST['customer_alamat']);
$customer_password = $_POST['customer_password'];




$cek_email = mysqli_query($koneksi,"select * from customer where customer_email='$customer_email'");
if(mysqli_num_rows($cek_email) > 0){
	header("location:daftar.php?alert=duplikat");
}else{
	mysqli_query($koneksi, "insert into customer (no_ktp, customer_nama, customer_email, customer_hp, customer_alamat, customer_password) values ('$no_ktp', '$customer_nama', '$customer_email', '$customer_hp', '$customer_alamat', md5('$customer_password'))");
	header("location:masuk.php?alert=terdaftar");
}
