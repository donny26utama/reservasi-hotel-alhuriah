<?php
include 'koneksi.php';

session_start();

$file = basename($_SERVER['PHP_SELF']);

if (!isset($_SESSION['customer_status'])) {

    // halaman yg dilindungi jika customer belum login
    $lindungi = array('customer.php','customer_logout.php','customer_invoice.php','customer_invoice_cetak.php','customer_password.php','customer_pembayaran.php','customer_pesanan.php','customer_rating.php');

    // periksa halaman, jika belum login ke halaman di atas, maka alihkan halaman
    if (in_array($file, $lindungi)) { header("location:index.php"); }

    if ($file == "checkout.php") { header("location:masuk.php?alert=login-dulu"); }

} else {

    // halaman yg tidak boleh diakses jika customer sudah login
    $lindungi = array('masuk.php','daftar.php');

    // periksa halaman, jika sudah dan mengakses halaman di atas, maka alihkan halaman
    if (in_array($file, $lindungi)) { header("location:customer.php"); }

}

if($file == "checkout.php"){
    if (!isset($_SESSION['booking_kamar_status'])) { header("location:kamar.php"); }
}

function bintang($id_kamar) {
    global $koneksi;
}

function total_review($id_kamar) {
    global $koneksi;

    $pemberi = mysqli_query($koneksi, "select count(rating) as total_pemberi from rating, invoice where rating_invoice=invoice_id and invoice_kamar='$id_kamar'");
    $p = mysqli_fetch_assoc($pemberi);

    return $p['total_pemberi'];
}
?>
<!DOCTYPE html>
<html lang="id-ID">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Hotel Al-Huriah</title>

    <link rel="icon" href="gambar/sistem/logo5.png">

    <!-- Css Styles -->
    <link rel="stylesheet" href="frontend/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="frontend/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="frontend/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="frontend/css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="frontend/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="frontend/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="frontend/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="frontend/css/style.css" type="text/css">

    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__option">
        <?php
            if(isset($_SESSION['customer_status'])):
                $id_customer = $_SESSION['customer_id'];
                $customer = mysqli_query($koneksi,"select * from customer where customer_id='$id_customer'");
                $c = mysqli_fetch_assoc($customer);
        ?>
            <div class="offcanvas__top__hover">
                <span>
                    <i class="fa fa-user-o"></i>
                    <?php echo $c['customer_nama']; ?>
                    <i class="arrow_carrot-down"></i>
                </span>
                <ul style="width: 180px">
                    <li class="p-2">
                        <a class="text-white" href="customer.php">
                            <i class="fa fa-user-o"></i> &nbsp; Akun Saya
                        </a>
                    </li>
                    <li class="p-2">
                        <a class="text-white" href="customer_pesanan.php">
                            <i class="fa fa-list"></i> &nbsp; Pesanan Saya
                        </a>
                    </li>
                    <li class="p-2">
                        <a class="text-white" href="customer_password.php">
                            <i class="fa fa-lock"></i> &nbsp; Ganti Password
                        </a>
                    </li>
                    <li class="p-2">
                        <a class="text-white" href="customer_logout.php">
                            <i class="fa fa-sign-out"></i> &nbsp; Keluar
                        </a>
                    </li>
                </ul>
            </div>
        <?php else: ?>
            <div class="offcanvas__links">
                <a href="masuk.php">LOGIN</a>
                <a href="daftar.php">DAFTAR</a>
            </div>
        <?php endif; ?>
        </div>
        <div class="offcanvas__nav__option">
            <a href="#" class="search-switch"><img src="frontend/img/icon/search.png" alt=""></a>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__text">
            <!-- <p>Free shipping, 30-day return or refund guarantee.</p> -->
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-7">
                        <div class="header__top__left">
                            <p>
                                <span class="badge badge-danger">HOT!</span>
                                Nikmati waktu liburan dengan kamar & pelayanan terbaik.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-5">
                        <div class="header__top__right">
                        <?php
                            if(isset($_SESSION['customer_status'])):
                                $id_customer = $_SESSION['customer_id'];
                                $customer = mysqli_query($koneksi,"select * from customer where no_ktp='$id_customer'");
                                $c = mysqli_fetch_assoc($customer);
                        ?>
                            <div class="header__top__hover">
                                <span>
                                    <i class="fa fa-user-o"></i>
                                    <?php echo $c['customer_nama']; ?> <i class="arrow_carrot-down"></i>
                                </span>
                                <ul style="width: auto; right: 0;left: -100px;top: 40px">
                                    <li class="p-2">
                                        <a class="text-dark" href="customer.php">
                                            Akun Saya &nbsp; <i class="fa fa-user-o"></i>
                                        </a>
                                    </li>
                                    <li class="p-2">
                                        <a class="text-dark" href="customer_pesanan.php">
                                            Pesanan Saya &nbsp; <i class="fa fa-list"></i>
                                        </a>
                                    </li>
                                    <li class="p-2">
                                        <a class="text-dark" href="customer_password.php">
                                            Ganti Password &nbsp; <i class="fa fa-lock"></i>
                                        </a>
                                    </li>
                                    <li class="p-2">
                                        <a class="text-dark" href="customer_logout.php">
                                            Keluar &nbsp; <i class="fa fa-sign-out"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        <?php else: ?>
                            <div class="header__top__links">
                                <a href="masuk.php">LOGIN</a>
                                <a href="daftar.php">DAFTAR</a>
                            </div>
                        <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-2">
                    <div class="header__logo">
                        <a href="index.php">
                            <img src="gambar/sistem/logo1.png" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li class="active"><a href="index.php">Home</a></li>
                            <li><a href="kamar.php">Kamar</a>
                                <ul class="dropdown">
                                    <?php
                                        $data = mysqli_query($koneksi, "SELECT * FROM kamar");
                                        while($d = mysqli_fetch_array($data)):
                                    ?>
                                        <li>
                                            <a href="kamar_detail.php?id=<?php echo $d['kamar_id']; ?>">
                                                <?php echo $d['kamar_nama']; ?>
                                            </a>
                                        </li>
                                    <?php endwhile; ?>
                                    <li><a href="kamar.php">Semua Kamar</a></li>
                                </ul>
                            </li>
                            <li><a href="kontak.php">Kontak</a></li>
                            <?php if(!isset($_SESSION['customer_status'])): ?>
                                <!-- tambah kustom -->
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-2 col-md-2">
                    <div class="header__nav__option">
                        <a href="#" class="search-switch"><img src="frontend/img/icon/search.png" alt=""></a>
                    </div>
                </div>
            </div>
            <div class="canvas__open"><i class="fa fa-bars"></i></div>
        </div>
    </header>
    <!-- Header Section End -->
