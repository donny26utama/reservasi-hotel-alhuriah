<?php 
include '../koneksi.php';
$id  = $_POST['id'];
$Shower  = $_POST['Shower'];
$Closet_Jongkok  = $_POST['Closet_Jongkok'];
$Closet_Duduk  = $_POST['Closet_Duduk'];
$TV  = $_POST['TV'];
$Wifi  = $_POST['Wifi'];
$Breakfast  = $_POST['Breakfast'];
$Lunch  = $_POST['Lunch'];
$Lemari  = $_POST['Lemari'];
$AC  = $_POST['AC'];
#$kamar_id  = $_POST['kamar_id'];

mysqli_query($koneksi, "update fasilitas_kamar set Shower='$Shower', Closet_Jongkok='$Closet_Jongkok', Closet_Duduk='$Closet_Duduk',  TV='$TV', Wifi='$Wifi',  Breakfast='$Breakfast', Lunch='$Lunch', Lemari='$Lemari', AC='$AC' where id_fk='$id'");
header("location:fasilitas_kamar.php");