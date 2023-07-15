<?php 
include '../koneksi.php';

$id  = $_POST['id'];
$nama  = $_POST['nama'];
$ranjang = $_POST['ranjang'];
$ukuran = $_POST['ukuran'];
$kategori = $_POST['kategori'];
$harga = $_POST['harga'];
$jumlah = $_POST['jumlah'];
$keterangan = $_POST['keterangan'];
$fasilitas = $_POST['fasilitas'];

$rand = rand();
$allowed =  array('gif','png','jpg','jpeg');

$filename1 = $_FILES['foto1']['name'];
$filename2 = $_FILES['foto2']['name'];
$filename3 = $_FILES['foto3']['name'];

mysqli_query($koneksi, "update kamar set kamar_nama='$nama', kamar_ranjang='$ranjang', kamar_ukuran='$ukuran', kamar_kategori='$kategori', kamar_harga='$harga', kamar_jumlah='$jumlah', kamar_keterangan='$keterangan' where kamar_id='$id'");

// update fasilitas kamar
mysqli_query($koneksi,"delete from kamar_fasilitas where kf_kamar='$id'");

for($a = 0; $a < count($fasilitas); $a++){
	$f = $fasilitas[$a];
	mysqli_query($koneksi,"insert into kamar_fasilitas values(NULL,'$id','$f')");
}


// hapus foto lama
$lama = mysqli_query($koneksi, "select * from kamar where kamar_id='$id'");
$l = mysqli_fetch_assoc($lama);

if($filename1 != ""){
	$ext = pathinfo($filename1, PATHINFO_EXTENSION);

	if(in_array($ext,$allowed) ) {
		move_uploaded_file($_FILES['foto1']['tmp_name'], '../gambar/kamar/'.$rand.'_'.$filename1);
		$file_gambar = $rand.'_'.$filename1;

		// hapus foto lama
		$foto = $l['kamar_foto1'];
		unlink("../gambar/kamar/$foto");

		mysqli_query($koneksi,"update kamar set kamar_foto1='$file_gambar' where kamar_id='$id'");
	}
}

if($filename2 != ""){
	$ext = pathinfo($filename2, PATHINFO_EXTENSION);

	if(in_array($ext,$allowed) ) {
		move_uploaded_file($_FILES['foto2']['tmp_name'], '../gambar/kamar/'.$rand.'_'.$filename2);
		$file_gambar = $rand.'_'.$filename2;

		// hapus foto lama
		$foto = $l['kamar_foto2'];
		unlink("../gambar/kamar/$foto");

		mysqli_query($koneksi,"update kamar set kamar_foto2='$file_gambar' where kamar_id='$id'");
	}
}

if($filename3 != ""){
	$ext = pathinfo($filename3, PATHINFO_EXTENSION);

	if(in_array($ext,$allowed) ) {
		move_uploaded_file($_FILES['foto3']['tmp_name'], '../gambar/kamar/'.$rand.'_'.$filename3);
		$file_gambar = $rand.'_'.$filename3;

		// hapus foto lama
		$foto = $l['kamar_foto3'];
		unlink("../gambar/kamar/$foto");

		mysqli_query($koneksi,"update kamar set kamar_foto3='$file_gambar' where kamar_id='$id'");
	}
}

header("location:kamar.php");