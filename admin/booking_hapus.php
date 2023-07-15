<?php 
include '../koneksi.php';
$id = $_GET['id'];

mysqli_query($koneksi, "delete from invoice where invoice_id='$id'");

mysqli_query($koneksi,"delete from invoice_layanan_tambahan where ilt_invoice='$id'");

mysqli_query($koneksi,"delete from rating where rating_invoice='$id'");

header("location:transaksi.php");