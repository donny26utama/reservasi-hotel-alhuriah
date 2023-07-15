<?php 
include '../koneksi.php';
$id = $_GET['id'];

mysqli_query($koneksi, "delete from fasilitas_kamar where id_fk='$id'");


header("location:fasilitas_kamar.php");
