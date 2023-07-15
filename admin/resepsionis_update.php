<?php 
include '../koneksi.php';
$id  = $_POST['id'];
$nama  = $_POST['nama'];
$username = $_POST['username'];
$pwd = $_POST['password'];
$password = md5($_POST['password']);

// cek gambar
$rand = rand();
$allowed =  array('gif','png','jpg','jpeg');
$filename = $_FILES['foto']['name'];
$ext = pathinfo($filename, PATHINFO_EXTENSION);

if($pwd=="" && $filename==""){
	mysqli_query($koneksi, "update resepsionis set resepsionis_nama='$nama', resepsionis_username='$username' where resepsionis_id='$id'");
	header("location:resepsionis.php");
}elseif($pwd==""){
	if(!in_array($ext,$allowed) ) {
		header("location:resepsionis.php?alert=gagal");
	}else{
		move_uploaded_file($_FILES['foto']['tmp_name'], '../gambar/resepsionis/'.$rand.'_'.$filename);
		$x = $rand.'_'.$filename;
		mysqli_query($koneksi, "update resepsionis set resepsionis_nama='$nama', resepsionis_username='$username', resepsionis_foto='$x' where resepsionis_id='$id'");		
		header("location:resepsionis.php?alert=berhasil");
	}
}elseif($filename==""){
	mysqli_query($koneksi, "update resepsionis set resepsionis_nama='$nama', resepsionis_username='$username', resepsionis_password='$password' where resepsionis_id='$id'");
	header("location:resepsionis.php");
}

