<?php 
include '../koneksi.php';
$id  = $_POST['id'];
$nokamar  = $_POST['nokamar'];
$lantai  = $_POST['lantai'];
$kamar_id  = $_POST['kamar_id'];

mysqli_query($koneksi, "update nokamar set nokamar='$nokamar', lantai='$lantai', kamar_id='$kamar_id' where nokamar='$id' ");

header("location:nokamar.php");