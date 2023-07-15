<?php 
include 'koneksi.php';

date_default_timezone_set('Asia/Jakarta');

$invoice = $_POST['invoice'];
$rating = $_POST['rating'];
$review = $_POST['review'];
$date = date('Y-m-d');


$cek = mysqli_query($koneksi,"select * from rating where rating_invoice='$invoice'");
$c = mysqli_num_rows($cek);

if($c > 0){

	mysqli_query($koneksi, "delete from rating where rating_invoice='$invoice'") or die(mysqli_error($koneksi));	

}

for($a = 0; $a < count($rating); $a++){
	$a_rating = $rating[$a];
	$a_review = $review[$a];

	mysqli_query($koneksi, "insert into rating values (NULL,'$date','$invoice','$a_rating','$a_review')") or die(mysqli_error($koneksi));
}



header("location:customer_rating.php?id=$invoice&alert=sukses");
