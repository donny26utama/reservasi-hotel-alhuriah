<?php
include '../koneksi.php';

$trx_id = $_GET['id'];
$update_checkin = "
    update check_in
    set
        status='checkout',
        invoice_status='4'
    where id_transaksi='$trx_id'";
mysqli_query($koneksi, $update_checkin);

$query = "select * from punya where id_transaksi='$trx_id'";
$get_punya = mysqli_query($koneksi, $query);
$punya = mysqli_fetch_assoc($get_punya);
$nokamar = $punya['nokamar'];

$update_nokamar = "update nokamar set kosong='Y' where nokamar='$nokamar'";
mysqli_query($koneksi, $update_nokamar);

header("location:transaksi.php");
