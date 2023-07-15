<?php 
include '../koneksi.php';
$nmfas  = $_POST['nmfas'];
$hrgfas  = $_POST['hrgfas'];

mysqli_query($koneksi, "insert into fasilitas values (NULL,'$nmfas','$hrgfas')");
header("location:fasilitas.php");