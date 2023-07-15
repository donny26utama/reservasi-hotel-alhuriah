<?php 
include '../koneksi.php';
$id = $_GET['id'];

mysqli_query($koneksi, "delete from layanan_tambahan where lt_id='$id'");


header("location:layanan_tambahan.php");
