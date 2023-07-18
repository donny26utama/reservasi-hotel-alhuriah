<?php
session_start();
include '../koneksi.php';

$aksi = $_POST['aksi'];
$trx_id = $_POST['trx_id'];
$kamar_id = $_POST['kamar_id'];
$nokamar = $_POST['nokamar'];
$admin_username = $_SESSION['username'];

$status = $aksi == 'Konfirm' ? 'valid' : 'non-valid';
$status_invoice = $aksi == 'Konfirm' ? 3 : 2;
$update_checkin = "
    update check_in
    set
        status='$status',
        invoice_status='$status_invoice',
        admin_username='$admin_username'
    where id_transaksi='$trx_id'";
mysqli_query($koneksi, $update_checkin);

if ($aksi == 'Konfirm') {
    mysqli_query($koneksi, "UPDATE kamar SET kamar_jumlah=(kamar_jumlah-1) WHERE kamar_id='$kamar_id'");
    mysqli_query($koneksi, "UPDATE nokamar SET kosong='T' WHERE nokamar='$nokamar'");
    mysqli_query($koneksi, "UPDATE punya SET nokamar='$nokamar' WHERE id_transaksi='$trx_id'");
}

header("location:transaksi.php");
