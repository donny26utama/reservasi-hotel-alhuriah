<?php 
include '../koneksi.php';
$nama  = $_POST['nama'];
$harga  = $_POST['harga'];

mysqli_query($koneksi, "insert into layanan_tambahan values (NULL,'$nama','$harga')");
header("location:layanan_tambahan.php");