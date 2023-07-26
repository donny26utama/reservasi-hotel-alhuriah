<?php
include '../koneksi.php';

$id = $_POST['id'];
$nokamar = $_POST['nokamar'];
$lantai = $_POST['lantai'];
$kamar_id = $_POST['kamar_id'];

if ($id != $nokamar) {
    $query = "SELECT * FROM nokamar WHERE nokamar='$nokamar'";
    $exists = mysqli_query($koneksi, $query);
    if (mysqli_num_rows($exists) > 0) {
        header("location:nokamar_edit.php?id=$id&alert=duplicate");exit;
    }
}

$query_update = "update nokamar set nokamar='$nokamar', lantai='$lantai', kamar_id='$kamar_id' where nokamar='$id'";
mysqli_query($koneksi, $query_update);

header("location:nokamar.php");
