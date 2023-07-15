<?php 
include '../koneksi.php';
$Shower  = $_POST['Shower'];
$Closet_Jongkok  = $_POST['Closet_Jongkok'];
$Closet_Duduk  = $_POST['Closet_Duduk'];
$TV  = $_POST['TV'];
$Wifi  = $_POST['Wifi'];
$Breakfast  = $_POST['Breakfast'];
$Lunch  = $_POST['Lunch'];
$Lemari  = $_POST['Lemari'];
$AC  = $_POST['AC'];
$kamar_id  = $_POST['kamar_id'];
mysqli_query($koneksi, "insert into fasilitas_kamar
(id_fk,  Shower, Closet_Jongkok, Closet_Duduk, TV, Wifi, Breakfast, Lunch,  Lemari, AC,  kamar_id)
 values (NULL, '$Shower', '$Closet_Jongkok', '$Closet_Duduk', '$TV', '$Wifi', '$Breakfast', '$Lunch', '$Lemari', '$AC', '$kamar_id')");
header("location:fasilitas_kamar.php");

