<?php 
include '../koneksi.php';
$  = $_POST['nama'];
$email  = $_POST['email'];
$hp  = $_POST['hp'];
$alamat  = $_POST['alamat'];


mysqli_query($koneksi, "insert into check_out values (NULL,'$nama','$email','$hp','$alamat','$password')");
header("location:check_out.php,customer.php");