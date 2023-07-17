<?php
include 'koneksi.php';

session_start();
date_default_timezone_set('Asia/Jakarta');

function bulanRomawi() {
    $bulan = date('n');

    switch ($bulan) {
        case 1:
        default:
            $romawi = 'I';
            break;
        case 2:
            $romawi = 'II';
            break;
        case 3:
            $romawi = 'III';
            break;
        case 4:
            $romawi = 'IV';
            break;
        case 5:
            $romawi = 'V';
            break;
        case 6:
            $romawi = 'VI';
            break;
        case 7:
            $romawi = 'VII';
            break;
        case 8:
            $romawi = 'VIII';
            break;
        case 9:
            $romawi = 'IX';
            break;
        case 10:
            $romawi = 'X';
            break;
        case 11:
            $romawi = 'XI';
            break;
        case 12:
            $romawi = 'XII';
            break;
    }

    return $romawi;
}

#bahan check_in
$tahun = date('Y');
$bulan = bulanRomawi();
$hari = date('d');
$tgl_transaksi = date('Y-m-d');
$tgl_check_in = mysqli_real_escape_string($koneksi, $_POST['dari']);
$jumlahorang = mysqli_real_escape_string($koneksi, $_SESSION['booking_dewasa']);
$status = "booking";
$keterangan_reservasi = mysqli_real_escape_string($koneksi, $_POST['keterangan_reservasi']);
$noktp = mysqli_real_escape_string($koneksi,$_SESSION['customer_id']);

$insert_checkin = "INSERT into check_in
(id_transaksi, tgl_transaksi, tgl_check_in, jumlahorang, status, keterangan_reservasi, no_ktp, invoice_no)
values
(NULL, '$tgl_transaksi','$tgl_check_in','$jumlahorang','$status','$keterangan_reservasi','$noktp','xxx')";
mysqli_query($koneksi, $insert_checkin)or die(mysqli_error($koneksi));

$cek = mysqli_query($koneksi,"SELECT id_transaksi from check_in where no_ktp='$noktp' and invoice_no='xxx'");
$dtid = mysqli_fetch_object($cek);
$id_transaksi = $dtid->id_transaksi;
$no_urut = str_pad($id_transaksi, 6, "0", STR_PAD_LEFT);
$no_inv = sprintf('FK/%s/%s/%s/AH/%s', $tahun, $bulan, $hari, $no_urut);
$update = mysqli_query($koneksi, "update check_in set invoice_no='$no_inv' where id_transaksi='$id_transaksi'");

#bahan ambil layanan tambahan, setelah tahu id transaksi
$layanan_tambahan = $_POST['layanan_tambahan'];
$total_layanan = 0;
for ($a = 0; $a < count($layanan_tambahan); $a++) {
    $lt_id = $layanan_tambahan[$a];
    $qlayanan = mysqli_query($koneksi,"select * from layanan_tambahan where lt_id='$lt_id'");
    $dtlt = mysqli_fetch_object($qlayanan);
    $hargalt = $dtlt->lt_harga;
    $insert_ambil = "INSERT into ambil (lt_id, id_transaksi, harga) values('$lt_id', '$id_transaksi', '$hargalt')";
    mysqli_query($koneksi, $insert_ambil);
    $total_layanan += $hargalt;
}

#bahan punya detail checkin, setelah tau id transaksi
$kamar_id = $_SESSION['booking_kamar'];
$harga = mysqli_real_escape_string($koneksi, $_POST['harga_per_malam']);
$tgl_dari = strtotime($tgl_check_in );
$tgl_sampai = strtotime(mysqli_real_escape_string($koneksi, $_POST['sampai']));
$jumlah_hari = $tgl_sampai - $tgl_dari;
$lama_inap = round($jumlah_hari / (60 * 60 * 24));
$total_inap = $harga * $lama_inap;

$insert_punya = "
    INSERT into punya (id_transaksi, kamar_id, harga, lama_inap)
    values ('$id_transaksi', '$kamar_id', '$harga', '$lama_inap')";
mysqli_query($koneksi, $insert_punya);

$total_bayar = $total_inap + $total_layanan;
mysqli_query($koneksi, "update check_in set invoice_total='$total_bayar' where id_transaksi = '$id_transaksi'");

unset($_SESSION['booking_kamar_status']);
unset($_SESSION['booking_kamar']);
unset($_SESSION['booking_dari']);
unset($_SESSION['booking_sampai']);
unset($_SESSION['booking_dewasa']);
unset($_SESSION['booking_anak']);

header("location:customer_pesanan.php?alert=sukses");
