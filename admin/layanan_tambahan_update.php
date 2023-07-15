<?php 
include '../koneksi.php';
$id  = $_POST['id'];
$harga  = $_POST['harga'];
$nama  = $_POST['nama'];

mysqli_query($koneksi, "update layanan_tambahan set lt_nama='$nama', lt_harga='$harga' where lt_id='$id'");
header("location:layanan_tambahan.php");