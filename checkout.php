<?php include 'header.php'; ?>

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Check Out</h4>
                    <div class="breadcrumb__links">
                        <a href="index.php">Home</a>
                        <a href="#">Booking</a>
                        <span>Check Out</span>
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
        <?php
        if(isset($_GET['alert'])){
            if($_GET['alert'] == "login"){
                echo "<div class='alert alert-success'>Login berhasil, silahkan lanjutkan pemesanan</div><br>";
            }
        }
        ?>

        <div class="checkout__form">
            <form action="checkout_act.php" method="post">
                <div class="row">
                    <div class="col-lg-8 col-md-6">

                        <h6 class="checkout__title">Detail Booking</h6>

                        <?php
                        $no=1;
                        $id_kamar = $_SESSION['booking_kamar'];
                        $kamar = mysqli_query($koneksi,"SELECT * FROM kamar where  kamar_id='$id_kamar' ");
                        $k = mysqli_fetch_assoc($kamar)
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


                        <div class="row">
                            <div class="col-lg-4">
                                <div class="checkout__input">
                                    <p>Tgl. Check-In<span>*</span></p>
                                    <b><?php echo date('d-m-Y', strtotime($_SESSION['booking_dari'] ))?></b>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="checkout__input">
                                    <p>Tgl. Check-Out<span>*</span></p>
                                    <b><?php echo date('d-m-Y', strtotime($_SESSION['booking_sampai'] ))?></b>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="checkout__input">
                                    <p>Jumlah Orang<span>*</span></p>
                                    <b><?php echo $_SESSION['booking_dewasa']; ?></b>
                                </div>
                            </div>


                        </div>

                        <br>
                        <br>

                        <h6 class="checkout__title">Data Customer</h6>

                        <?php
                            $noktp =  $_SESSION['customer_id'];
                            $qcustomer = mysqli_query($koneksi,"select * from customer where no_ktp='$noktp'");
                            $dtcustomer = mysqli_fetch_object($qcustomer);

                        ?>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Nama Lengkap<span>*</span></p>
                                    <input readonly type="text" name="nama" placeholder="Masukkan nama lengkap .." required="required" value="<?php echo $dtcustomer->customer_nama; ?>">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>No. HP / Whatsapp<span>*</span></p>
                                    <input type="text" name="hp" placeholder="Masukkan nomor hp .." required="required" value="<?php echo $dtcustomer->customer_hp; ?>">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="checkout__input">
                                    <p>Keterangan Reservasi<span></span></p>
                                    <input type="text" name="keterangan_reservasi" placeholder="Masukkan Keterangan Reservasi .." >
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <p>Layanan Tambahan (Opsional)</p>

                                <?php
                                    $layanan = mysqli_query($koneksi,"select * from layanan_tambahan order by lt_nama asc");
                                    while($l = mysqli_fetch_array($layanan)):
                                ?>
                                    <label for="<?php echo $l['lt_harga']; ?>">
                                        <input class="layanan_tambahan" id="<?php echo $l['lt_harga']; ?>" type="checkbox" name="layanan_tambahan[]" value="<?php echo $l['lt_id'] ?>">
                                        <?php echo $l['lt_nama'] ?> &nbsp; - &nbsp; <small class="text-muted">(<?php echo "Rp. ".number_format($l['lt_harga'])." ,-" ?>)</small>
                                    </label><br>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    </div>
                <div class="col-lg-4 col-md-6">
                <div class="checkout__order">
                    <h4 class="order__title">Your order</h4>


                    <div class="row">

                        <div class="col-lg-4">
                            <?php if($k['kamar_foto1'] == ""){ ?>
                                <img src="gambar/sistem/kamar.png" style="width: auto;height: auto">
                            <?php }else{ ?>
                                <img src="gambar/kamar/<?php echo $k['kamar_foto1'] ?>" style="width: auto;height: auto">
                            <?php } ?>
                        </div>

                        <div class="col-lg-8">

                            <h5><?php echo $k['kamar_nama']; ?></h5>


                            <small class="text-muted">
                                Kategori : <?php echo $k['kamar_kategori']; ?>
                                |
                                Ranjang : <?php echo $k['kamar_ranjang']; ?>

                                <br>
                                <b><?php echo "Rp. ".number_format($k['kamar_harga']).",-"; ?></b> / mlm
                            </small>

                        </div>

                    </div>

                    <br>
                    <hr>

                    <div class="checkout__order__products">Keterangan <span>Total</span></div>
                    <ul class="checkout__total__products">
                        <li>Harga Kamar <span> <?php echo "Rp. ".number_format($k['kamar_harga']).",-"; ?></span></li>
                        <?php 
                        $tgl_dari = strtotime($_SESSION['booking_dari'] );
                        $tgl_sampai = strtotime($_SESSION['booking_sampai'] );
                        $jumlah_hari =  $tgl_sampai - $tgl_dari;
                        $hari = round($jumlah_hari / (60 * 60 * 24));
                        ?>
                        <li>Lama Menginap <span><?php echo $hari ?> malam</span></li>
                        <li>Layanan Tambahan <span id="total">Rp. 0 ,-</span></li>
                    </ul>
                    <ul class="checkout__total__all">
                        <li>Total Bayar<span class="total_bayar"><?php echo "Rp. ".number_format($k['kamar_harga'] * $hari).",-"; ?></span></li>
                    </ul>

                    <input type="hidden" name="dari" value="<?php echo $_SESSION['booking_dari']; ?>">
                    <input type="hidden" name="sampai" value="<?php echo $_SESSION['booking_sampai']; ?>">
                    <input type="hidden" id="harga_per_malam" value="<?php echo $k['kamar_harga'] * $hari; ?>">
                    <input type="hidden" name="harga" id="total_harga" value="<?php echo $k['kamar_harga']; ?>">
                    <input type="hidden" name="harga_per_malam" value="<?php echo $k['kamar_harga']; ?>">
                    <input type="hidden" name="customer" value="<?php echo $_SESSION['customer_id']; ?>">

                    <button type="submit" class="site-btn">SELESAI</button>
                </div>
            </div>
        </div>
    </form>
</div>
</div>
</section>
<!-- Checkout Section End -->


<?php include 'footer.php'; ?>