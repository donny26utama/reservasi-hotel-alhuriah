<?php 
include '../koneksi.php';
$id  = $_POST['id'];
$icon  = $_POST['icon'];
$nama  = $_POST['nama'];

mysqli_query($koneksi, "update fasilitas_kamar set fk_nama='$nama', fk_icon='$icon' where fk_id='$id'");
header("location:fasilitas_kamar.php");