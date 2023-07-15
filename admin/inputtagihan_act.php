<?php 
session_start();
include '../koneksi.php';
$bill_tanggal  = $_POST['bill_tanggal'];
$nokamar  = $_POST['nokamar'];
$id_transaksi  = $_POST['id_transaksi'];
$admin_username = $_SESSION['username'];
$kamar_id = $_POST['kamar_id'];
#echo $kamar_id;
#update jumlah kamar di kamar
mysqli_query($koneksi,"UPDATE kamar SET kamar_jumlah=(kamar_jumlah-1) WHERE kamar_id='$kamar_id'");

#update kosong jadi T di nomor kamar
mysqli_query($koneksi,"UPDATE nokamar SET kosong='T' WHERE nokamar='$nokamar'");

#update status check in dari booking ke tagihan
mysqli_query($koneksi,"UPDATE check_in SET status='tagihan' WHERE id_transaksi='$id_transaksi'");


#simpan ke tabelnya
mysqli_query($koneksi, "INSERT INTO tagihan (bill_id, bill_tanggal, file_bukti, admin_username, id_transaksi, nokamar) 
	values (null, '$bill_tanggal', null, '$admin_username', '$id_transaksi', '$nokamar') ");
header("location:tagihan.php?id=$id_transaksi");