<?php 
include '../koneksi.php';

$id  = $_POST['id'];
$kamar_nama  = $_POST['nama'];
$kamar_ranjang = $_POST['ranjang'];
$kamar_ukuran = $_POST['ukuran'];
$kamar_kategori = $_POST['kategori'];
$kamar_harga = $_POST['harga'];
$kamar_jumlah = $_POST['kamar_jumlah'];


$rand = rand();
$allowed =  array('gif','png','jpg','jpeg');

$filename1 = $_FILES['kamar_foto1']['name'];

mysqli_query($koneksi, "update kamar set kamar_nama='$kamar_nama', kamar_ranjang='$kamar_ranjang', kamar_ukuran=$kamar_ukuran, kamar_kategori='$kamar_kategori', kamar_harga=$kamar_harga, kamar_jumlah=$kamar_jumlah where kamar_id='$id'");

echo "update kamar set kamar_nama='$kamar_nama', kamar_ranjang='$kamar_ranjang', kamar_ukuran=$kamar_ukuran, kamar_kategori='$kamar_kategori', kamar_harga=$kamar_harga, kamar_jumlah=$kamar_jumlah where kamar_id='$id'";

// hapus foto lama
$lama = mysqli_query($koneksi, "select * from kamar where kamar_id='$id'");
$l = mysqli_fetch_assoc($lama);

if($filename1 != ""){
	$ext = pathinfo($filename1, PATHINFO_EXTENSION);

	if(in_array($ext,$allowed) ) {
		move_uploaded_file($_FILES['kamar_foto1']['tmp_name'], '../gambar/kamar/'.$rand.'_'.$filename1);
		$file_gambar = $rand.'_'.$filename1;

		// hapus foto lama
		$foto = $l['kamar_foto1'];
		unlink("../gambar/kamar/$foto");

		mysqli_query($koneksi,"update kamar set kamar_foto1='$file_gambar' where kamar_id='$id'");
	}
}



header("location:kamar.php");