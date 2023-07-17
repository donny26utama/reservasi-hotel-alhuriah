<?php
include '../koneksi.php';

$trx_id = $_GET['id'];
$update_checkin = "
    update check_in
    set status='checkin'
    where id_transaksi='$trx_id'";
mysqli_query($koneksi, $update_checkin);

header("location:transaksi.php");
