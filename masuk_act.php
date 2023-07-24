<?php 
// menghubungkan dengan koneksi
include 'koneksi.php';

// menangkap data yang dikirim dari form
$customer_email = mysqli_real_escape_string($koneksi, $_POST['customer_email']);
$customer_password = mysqli_real_escape_string($koneksi, $_POST['customer_password']);

$query = "
	SELECT *
	FROM customer
	WHERE
		(
			customer_email='$customer_email' OR
			no_ktp='$customer_email'
		) AND
		customer_password=md5('$customer_password')";
$login = mysqli_query($koneksi, $query);
$cek = mysqli_num_rows($login);

if($cek > 0){
	session_start();
	$data = mysqli_fetch_assoc($login);

	// hapus session yg lain, agar tidak bentrok dengan session customer
	//unset($_SESSION['id']);
	unset($_SESSION['nama']);
	unset($_SESSION['username']);
	unset($_SESSION['status']);

	// buat session customer
	$_SESSION['customer_id'] = $data['no_ktp'];
	$_SESSION['customer_status'] = "login";


	if(isset($_SESSION['booking_kamar_status'])){
		if($_SESSION['booking_kamar_status'] == "tersedia"){

			header("location:checkout.php?alert=login");

		}
	}else{
		header("location:customer.php");
	}
	
	
}else{
	header("location:masuk.php?alert=gagal");
}
