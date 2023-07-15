<?php 
include '../koneksi.php';
$kamar_nama  = $_POST['kamar_nama'];
$kamar_ranjang = $_POST['kamar_ranjang'];
$kamar_ukuran = $_POST['kamar_ukuran'];
$kamar_kategori = $_POST['kamar_kategori'];
$kamar_harga = $_POST['kamar_harga'];
$kamar_jumlah = $_POST['kamar_jumlah'];

$rand = rand();
$allowed =  array('gif','png','jpg','jpeg');

$filename1 = $_FILES['kamar_foto1']['name'];


mysqli_query($koneksi, "insert into kamar (kamar_id, kamar_nama, kamar_ranjang, kamar_ukuran, kamar_kategori, kamar_harga, kamar_foto1, kamar_jumlah) values (NULL, '$kamar_nama','$kamar_ranjang','$kamar_ukuran','$kamar_kategori',$kamar_harga,'', $kamar_jumlah)");


// update fasilitas kamar

$last_id = mysqli_insert_id($koneksi);





if($filename1 != ""){
	$ext = pathinfo($filename1, PATHINFO_EXTENSION);

	if(in_array($ext,$allowed) ) {
		move_uploaded_file($_FILES['kamar_foto1']['tmp_name'], '../gambar/kamar/'.$rand.'_'.$filename1);
		$file_gambar = $rand.'_'.$filename1;

		mysqli_query($koneksi,"update kamar set kamar_foto1='$file_gambar' where kamar_id='$last_id'");
	}
}



header("location:kamar.php");