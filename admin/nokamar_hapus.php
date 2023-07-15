<?php 
include '../koneksi.php';
$id = $_GET['id'];

mysqli_query($koneksi, "delete from nokamar where nokamar='$id'");


header("location:nokamar.php");
