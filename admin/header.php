<!DOCTYPE html>
<html lang="id-ID">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Hotel Al-Huriah | Admin WebApp</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="../assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="../assets/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">

  <link rel="stylesheet" href="../assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

  <link rel="stylesheet" href="../assets/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="../assets/bower_components/morris.js/morris.css">
  <link rel="stylesheet" href="../assets/bower_components/jvectormap/jquery-jvectormap.css">
  <link rel="stylesheet" href="../assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="../assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="../assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- Select2 -->
  <link rel="stylesheet" href="../assets/bower_components/select2/dist/css/select2.min.css">

  <?php
  include '../koneksi.php';
  session_start();
  if($_SESSION['status'] != "admin_login"){
    header("location:../login.php?alert=belum_login");
  }
  ?>

</head>
<body class="hold-transition skin-blue-light sidebar-mini">
  <div class="wrapper">

    <header class="main-header">
      <a href="index.php" class="logo">
        <span class="logo-mini"><b>AH</b></span>
        <span class="logo-lg"><b>Al-Huriah </b>HOTEL</span>
      </a>
      <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">

            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <?php
                  $username = $_SESSION['username'];
                  $profil = mysqli_query($koneksi,"select * from admin where admin_username='$username'");
                  $profil = mysqli_fetch_assoc($profil);
                ?>
                <img src="../gambar/sistem/user.png" class="user-image" alt="user-image">
                <span class="hidden-xs"><?php echo $profil['admin_nama']; ?> - Admin</span>
              </a>
            </li>
            <li>
              <a href="logout.php"><i class="fa fa-sign-out"></i> LOGOUT</a>
            </li>
          </ul>
        </div>
      </nav>
    </header>

    <aside class="main-sidebar">
      <section class="sidebar">
        <div class="user-panel">
          <div class="pull-left image">
            <?php
              $username = $_SESSION['username'];
              $profil = mysqli_query($koneksi,"select * from admin where admin_username='$username'");
              $profil = mysqli_fetch_assoc($profil);
            ?>
            <img src="../gambar/sistem/user.png" class="img-circle" alt="user-image">
          </div>
          <div class="pull-left info">
            <p><?php echo $profil['admin_nama']; ?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">MASTER</li>

          <li>
            <a href="index.php">
              <i class="fa fa-dashboard"></i> <span>DASHBOARD</span>
            </a>
          </li>

          <li>
            <a href="admin.php">
              <i class="fa fa-user"></i> <span>DATA ADMIN</span>
            </a>
          </li>

          <li>
            <a href="customer.php">
              <i class="fa fa-users"></i> <span>DATA CUSTOMER</span>
            </a>
          </li>
<!--
          <li>
            <a href="fasilitas.php">
              <i class="fa fa-glass"></i> <span>DATA FASILITAS</span>
            </a>
          </li>
-->
          <li>
            <a href="kamar.php">
              <i class="fa fa-bed"></i> <span>DATA KAMAR</span>
            </a>
          </li>

          <li>
            <a href="nokamar.php">
              <i class="fa fa-bed"></i> <span>DATA NOMOR KAMAR</span>
            </a>
          </li>

          <li>
            <a href="fasilitas_kamar.php">
              <i class="fa fa-folder"></i> <span>FASILITAS KAMAR</span>
            </a>
          </li>

          <li>
            <a href="layanan_tambahan.php">
              <i class="fa fa-file"></i> <span>LAYANAN TAMBAHAN</span>
            </a>
          </li>

          <li class="header">TRANSAKSI</li>

          <li>
            <a href="booking.php">
              <i class="fa fa-retweet"></i> <span>CEK CHECK-IN</span>
            </a>
          </li>

          <li>
            <a href="tagihan.php">
              <i class="fa fa-retweet"></i> <span>LIHAT TAGIHAN</span>
            </a>
          </li>

            <li>
            <a href="invoice.php">
              <i class="fa fa-retweet"></i> <span>VALIDASI PEMBAYARAN</span>
            </a>
          </li>

          <li>
            <a href="pembayaran.php">
              <i class="fa fa-retweet"></i> <span>PEMBAYARAN</span>
            </a>
          </li>

          <li>
            <a href="bill.php">
              <i class="fa fa-retweet"></i> <span>BILL</span>
            </a>
          </li>

          <li class="header">CETAK</li>

          <li>
            <a href="laporan.php">
              <i class="fa fa-file"></i> <span>LAPORAN</span>
            </a>
          </li>

          <li>
            <a href="logout.php">
              <i class="fa fa-sign-out"></i> <span>LOGOUT</span>
            </a>
          </li>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>
