<?php

include 'koneksi.php';

$alert = 'gagal';
$id = $_POST['id'];
$rand = rand();
$allowed = array('gif','png','jpg','jpeg');
$filename = $_FILES['bukti']['name'];
$ext = pathinfo($filename, PATHINFO_EXTENSION);

if (in_array($ext, $allowed)) {
    $lama = mysqli_query($koneksi, "select * from check_in where id_transaksi='$id'");
    $l = mysqli_fetch_assoc($lama);
    $foto_lama = $l['invoice_bukti'];

    $foto_baru = sprintf('gambar/bukti_pembayaran/%s.%s', $rand, $ext);
    move_uploaded_file($_FILES['bukti']['tmp_name'], $foto_baru);

    $query = "
        update check_in
        set invoice_bukti='$foto_baru', status='non-valid', invoice_status='1'
        where id_transaksi='$id'";
    $update = mysqli_query($koneksi, $query);
    $error = mysqli_error($koneksi);

    // jika gagal update
    if ($error) {
        unlink($foto_baru);
    } else {
        $alert = 'upload';
        // hapus gambar lama
        unlink($foto_lama);
    }
}

header("location:customer_pesanan.php?alert=$alert");
