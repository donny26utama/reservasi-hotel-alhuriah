<?php 

include 'koneksi.php';

session_start();

unset($_SESSION['customer_id']);
unset($_SESSION['customer_status']);
session_destroy();

header("location:index.php");
?>