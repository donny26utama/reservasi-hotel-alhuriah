<?php 
include 'koneksi.php';

session_start();
date_default_timezone_set('Asia/Jakarta');

// $id_customer = $_SESSION['customer_id'];

$kamar = mysqli_real_escape_string($koneksi, $_POST['kamar']);
$dari = mysqli_real_escape_string($koneksi, $_POST['dari']);
$sampai = mysqli_real_escape_string($koneksi, $_POST['sampai']);
$dewasa = mysqli_real_escape_string($koneksi, $_POST['dewasa']);
#$anak = mysqli_real_escape_string($koneksi, $_POST['anak']);

/*$kk = mysqli_query($koneksi,"SELECT * FROM kamar,booking_kamar,check_in,check_out,pilih,serah,terima where kamar.kamar_id=pilih.kamar_id=serah.kamar_id=terima.kamar_id and  booking_kamar.booking_id=pilih.booking_id and check_in.kd_check_in=terima.kd_check_in and check_out.kd_check_out=serah.kd_check_out ");*/
$kk = mysqli_query($koneksi,"SELECT * FROM kamar where kamar.kamar_id='$kamar'");

$k = mysqli_fetch_assoc($kk);
$jumlah_kamar = $k['kamar_jumlah'];
// echo $jumlah_kamar;

// echo $dari;

$dari = date('Y-m-d', strtotime($dari));
$sampai = date('Y-m-d', strtotime($sampai));
// echo $dari;
$cek = mysqli_query($koneksi,"select * from check_in, punya where punya.id_transaksi=check_in.id_transaksi
 and punya.kamar_id='$kamar' and (tgl_check_in >= '$dari' and tgl_check_in <= '$sampai')");
                    
// $cek = mysqli_query($koneksi,"select * from invoice where (date(invoice_dari) >= '$dari' and date(invoice_dari) <= '$sampai') or ((date(invoice_sampai) >= '$dari' and date(invoice_sampai) <= '$sampai')) and invoice_kamar='$kamar'");

$c = mysqli_num_rows($cek);
echo $c;
if($c >= $jumlah_kamar){
	echo "tidak tersedia";

	$_SESSION['booking_kamar_status'] = "tidak-tersedia";
	$_SESSION['booking_kamar'] = $kamar;
	$_SESSION['booking_dari'] = $dari;
	$_SESSION['booking_sampai'] = $sampai;
	$_SESSION['booking_dewasa'] = $dewasa;
	#$_SESSION['booking_anak'] = $anak;

	header("location:booking.php?id=$kamar&alert=tidak-tersedia");
}else{
	echo "tersedia";

	$_SESSION['booking_kamar_status'] = "tersedia";
	$_SESSION['booking_kamar'] = $kamar;
	$_SESSION['booking_dari'] = $dari;
	$_SESSION['booking_sampai'] = $sampai;
	$_SESSION['booking_dewasa'] = $dewasa;
	#$_SESSION['booking_anak'] = $anak;

	
	header("location:booking.php?id=$kamar&alert=tersedia");
}

