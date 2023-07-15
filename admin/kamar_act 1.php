<?php 
include '../koneksi.php';
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

mysqli_query($koneksi, "insert into kamar values (NULL,'$nama','$ranjang','$ukuran','$kategori','$jumlah','$keterangan','$harga','','','')");

// update fasilitas kamar

$last_id = mysqli_insert_id($koneksi);

for($a = 0; $a < count($fasilitas); $a++){
	$f = $fasilitas[$a];
	mysqli_query($koneksi,"insert into kamar_fasilitas values(NULL,'$last_id','$f')");
}



if($filename1 != ""){
	$ext = pathinfo($filename1, PATHINFO_EXTENSION);

	if(in_array($ext,$allowed) ) {
		move_uploaded_file($_FILES['foto1']['tmp_name'], '../gambar/kamar/'.$rand.'_'.$filename1);
		$file_gambar = $rand.'_'.$filename1;

		mysqli_query($koneksi,"update kamar set kamar_foto1='$file_gambar' where kamar_id='$last_id'");
	}
}

if($filename2 != ""){
	$ext = pathinfo($filename2, PATHINFO_EXTENSION);

	if(in_array($ext,$allowed) ) {
		move_uploaded_file($_FILES['foto2']['tmp_name'], '../gambar/kamar/'.$rand.'_'.$filename2);
		$file_gambar = $rand.'_'.$filename2;

		mysqli_query($koneksi,"update kamar set kamar_foto2='$file_gambar' where kamar_id='$last_id'");
	}
}

if($filename3 != ""){
	$ext = pathinfo($filename3, PATHINFO_EXTENSION);

	if(in_array($ext,$allowed) ) {
		move_uploaded_file($_FILES['foto3']['tmp_name'], '../gambar/kamar/'.$rand.'_'.$filename3);
		$file_gambar = $rand.'_'.$filename3;

		mysqli_query($koneksi,"update kamar set kamar_foto3='$file_gambar' where kamar_id='$last_id'");
	}
}

header("location:kamar.php");