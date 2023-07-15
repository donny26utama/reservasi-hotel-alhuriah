<?php 
include '../koneksi.php';
$id = $_GET['id'];
$data = mysqli_query($koneksi, "select * from resepsionis where resepsionis_id='$id'");
$d = mysqli_fetch_assoc($data);
$foto = $d['resepsionis_foto'];
unlink("../gambar/resepsionis/$foto");
mysqli_query($koneksi, "delete from resepsionis where resepsionis_id='$id'");
header("location:resepsionis.php");
