<?php 
include '../koneksi.php';
$nokamar  = $_POST['nokamar'];
$lantai  = $_POST['lantai'];
$kamar_id  = $_POST['kamar_id'];
mysqli_query($koneksi, "insert into nokamar
(nokamar, lantai, kamar_id)
 values ('$nokamar', '$lantai', '$kamar_id')");
header("location:nokamar.php");

