<?php 
include '../koneksi.php';
$id  = $_POST['id'];
$icon  = $_POST['icon'];
$nama  = $_POST['nama'];

mysqli_query($koneksi, "update fasilitas_hotel set fh_nama='$nama', fh_icon='$icon' where fh_id='$id'");
header("location:fasilitas_hotel.php");