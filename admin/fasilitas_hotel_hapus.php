<?php 
include '../koneksi.php';
$id = $_GET['id'];

mysqli_query($koneksi, "delete from fasilitas_hotel where fh_id='$id'");


header("location:fasilitas_hotel.php");
