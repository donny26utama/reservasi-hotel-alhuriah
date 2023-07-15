<?php
include 'header.php';

if(isset($_SESSION['booking_kamar_status'])){
    if($_SESSION['booking_kamar'] != $_GET['id']){
        unset($_SESSION['booking_kamar_status']);
        unset($_SESSION['booking_kamar']);
        unset($_SESSION['booking_dari']);
        unset($_SESSION['booking_sampai']);
        unset($_SESSION['booking_dewasa']);
    }
}
?>

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>transaksi</h4>
                    <div class="breadcrumb__links">
                        <a href="index.php">Home</a>
                        <a href="#">Booking</a>
                        <span>transaksi</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">

            <?php
            if(isset($_SESSION['booking_kamar_status'])){
                if($_SESSION['booking_kamar_status'] == "tersedia"){
                    echo "<div class='alert alert-success text-center'><b>Kamar tersedia.</b> silahkan klik \"CHECKOUT\" untuk melanjutkan booking</div>";
                }elseif($_SESSION['booking_kamar_status'] == "tidak-tersedia"){
                    echo "<div class='alert alert-danger text-center'><b>Kamar tidak tersedia.</b> Silahkan cari tanggal atau kamar lain.</div>";
                }
            }
            ?>

            <!-- <form action="#"> -->
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-6">

                        <h6 class="checkout__title">Detail Booking</h6>

                        <?php
                        $no=1;
                        $id_kamar = mysqli_escape_string($koneksi,$_GET['id']);
                        $data = mysqli_query($koneksi,"SELECT * FROM kamar where kamar_id='$id_kamar'");
                        /*$data = mysqli_query($koneksi,"SELECT * FROM kamar,booking_kamar,check_in,check_out,pilih,serah,terima where kamar.kamar_id=pilih.kamar_id=serah.kamar_id=terima.kamar_id and  booking_kamar.booking_id=pilih.booking_id and check_in.kd_check_in=terima.kd_check_in and check_out.kd_check_out=serah.kd_check_out ");*/
                        $k = mysqli_fetch_assoc($data);
                        ?>

                        <div class="row">

                            <div class="col-lg-2">
                                <?php if($k['kamar_foto1'] == ""){ ?>
                                    <img src="gambar/sistem/kamar.png" style="width: auto;height: auto">
                                <?php }else{ ?>
                                    <img src="gambar/kamar/<?php echo $k['kamar_foto1'] ?>" style="width: auto;height: auto">
                                <?php } ?>
                            </div>

                            <div class="col-lg-10">

                                <h5><?php echo $k['kamar_nama']; ?></h5>


                                <small class="text-muted">
                                    <?php echo $k['kamar_kategori']; ?>
                                    |
                                    Ranjang : <?php echo $k['kamar_ranjang']; ?>
                                    |
                                    Ukuran Kamar : <?php echo $k['kamar_ukuran']; ?> m2
                                    <br>
                                    Fasilitas : 
                                    <?php   
                                    $id_kamar = $k['kamar_id'];
                                    $fasilitas = mysqli_query($koneksi,"select * from fasilitas_kamar where kamar_id='$id_kamar'");
                                    while($f = mysqli_fetch_array($fasilitas)){
                                        if ($f['Shower']=="Y"):
                                            echo "Shower, ";
                                        endif;
                                        if ($f['Closet_Jongkok']=="Y"):
                                            echo "Closet Jongkok, ";
                                        endif;
                                        if ($f['Closet_Duduk']=="Y"):
                                            echo "Closet Duduk, ";
                                        endif;
                                        if ($f['TV']=="Y"):
                                            echo "TV, ";
                                        endif;
                                        if ($f['Wifi']=="Y"):
                                            echo "Wifi, ";
                                        endif;
                                        if ($f['Breakfast']=="Y"):
                                            echo "Breakfast, ";
                                        endif;
                                        if ($f['Lunch']=="Y"):
                                            echo "Lunch, ";
                                        endif;
                                        if ($f['Lemari']=="Y"):
                                            echo "Lemari, ";
                                        endif;
                                        if ($f['AC']=="Y"):
                                            echo "AC, ";
                                        endif;
                                    }
                                    ?>
                                    <br>
                                    Harga : <b><?php echo "Rp. ".number_format($k['kamar_harga']).",-"; ?></b> / mlm

                                </small>

                            </div>

                        </div>

                        <br>
                        <hr>


                        <form action="booking_act.php" method="post">
                            <input type="hidden" name="kamar" value="<?php echo $id_kamar ?>">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="checkout__input">
                                        <p>Tgl. Check-In<span>*</span></p>
                                        <input type="text" name="dari" class="datepicker" required="required" value="<?php if(isset($_SESSION['booking_dari'])){ echo date('d-m-Y', strtotime($_SESSION['booking_dari'])); } ?>">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="checkout__input">
                                        <p>Tgl. Check-Out<span>*</span></p>
                                        <input type="text" name="sampai" class="datepicker" required="required" value="<?php if(isset($_SESSION['booking_sampai'])){ echo date('d-m-Y', strtotime($_SESSION['booking_sampai'])); } ?>">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="checkout__input">
                                        <p>Jumlah Orang<span>*</span></p>
                                        <select name="dewasa" required="required">
                                            <option <?php if(isset($_SESSION['booking_dewasa'])){ if($_SESSION['booking_dewasa'] == "1"){ echo "selected='selected'"; } } ?> value="1">1</option>
                                            <option <?php if(isset($_SESSION['booking_dewasa'])){ if($_SESSION['booking_dewasa'] == "2"){ echo "selected='selected'"; } } ?> value="2">2</option>
                                            <option <?php if(isset($_SESSION['booking_dewasa'])){ if($_SESSION['booking_dewasa'] == "3"){ echo "selected='selected'"; } } ?> value="3">3</option>
                                            <option <?php if(isset($_SESSION['booking_dewasa'])){ if($_SESSION['booking_dewasa'] == "4"){ echo "selected='selected'"; } } ?> value="4">4</option>

                                        </select>
                                    </div>
                                </div>


                            </div>
                            <center><button class="site-btn">CEK KETERSEDIAAN KAMAR</button></center>
                        </form>

                        <br>
                        <br>

                        <center>
                            <?php 
                            if(isset($_SESSION['booking_kamar_status'])){
                                if($_SESSION['booking_kamar_status'] == "tersedia"){
                                    ?>
                                    <a href="checkout.php" class="site-btn bg-success">CHECK OUT &nbsp; <i class="fa fa-arrow-right"></i></a>
                                    <?php
                                }

                            }
                            ?>
                        </center>


                    </div>
                    
                </div>
                <!-- </form> -->
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->


    <?php include 'footer.php'; ?>
