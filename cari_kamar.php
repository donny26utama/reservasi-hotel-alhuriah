<?php include 'header.php'; ?>

<?php 
if(isset($_SESSION['booking_kamar_status'])){
    unset($_SESSION['booking_kamar_status']);
    unset($_SESSION['booking_kamar']);
    unset($_SESSION['booking_dari']);
    unset($_SESSION['booking_sampai']);
    unset($_SESSION['booking_dewasa']);
    unset($_SESSION['booking_anak']);
}
?>

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">


        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Cari kamar</h4>
                    <div class="breadcrumb__links">
                        <a href="index.php">Home</a>
                        <a href="kamar.php">Kamar</a>
                        <span>Cari Kamar</span>
                    </div>
                </div>
            </div>
        </div>

        <br>
        <center>
            <h3 class="font-weight-bold"><i class="fa fa-search"></i> Cari Kamar</h3>
        </center>
        <br>
        <br>


        <form action="cari_kamar.php" method="get">
            
            <div class="row">
                <div class="col-lg-4">
                    <div class="checkout__input">
                        <p>Tgl. Check-In<span>*</span></p>
                        <input type="text" class="datepicker" name="dari" id="tgl_dari" placeholder="Masukkan tanggal .." required="required" value="<?php if(isset($_GET['dari'])){ echo date('d-m-Y', strtotime($_GET['dari'])); } ?>">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="checkout__input">
                        <p>Tgl. Check-Out<span>*</span></p>
                        <input type="text" class="datepicker" name="sampai" id="tgl_sampai" placeholder="Masukkan tanggal .." required="required" value="<?php if(isset($_GET['sampai'])){ echo date('d-m-Y', strtotime($_GET['sampai'])); } ?>">
                    </div>
                </div>
                <div class="col-lg-1">
                    <div class="checkout__input">
                        <p>Dewasa<span>*</span></p>
                        <select name="dewasa" required="required">
                            <option <?php if(isset($_GET['dewasa'])){ if($_GET['dewasa'] == "1"){ echo "selected='selected'"; } } ?> value="1">1</option>
                            <option <?php if(isset($_GET['dewasa'])){ if($_GET['dewasa'] == "2"){ echo "selected='selected'"; } } ?> value="2">2</option>
                            <option <?php if(isset($_GET['dewasa'])){ if($_GET['dewasa'] == "3"){ echo "selected='selected'"; } } ?> value="3">3</option>
                            <option <?php if(isset($_GET['dewasa'])){ if($_GET['dewasa'] == "4"){ echo "selected='selected'"; } } ?> value="4">4</option>
                            <option <?php if(isset($_GET['dewasa'])){ if($_GET['dewasa'] == "5"){ echo "selected='selected'"; } } ?> value="5">5</option>
                            <option <?php if(isset($_GET['dewasa'])){ if($_GET['dewasa'] == "6"){ echo "selected='selected'"; } } ?> value="6">6</option>
                            <option <?php if(isset($_GET['dewasa'])){ if($_GET['dewasa'] == "7"){ echo "selected='selected'"; } } ?> value="7">7</option>
                            <option <?php if(isset($_GET['dewasa'])){ if($_GET['dewasa'] == "8"){ echo "selected='selected'"; } } ?> value="8">8</option>
                            <option <?php if(isset($_GET['dewasa'])){ if($_GET['dewasa'] == "9"){ echo "selected='selected'"; } } ?> value="9">9</option>
                            <option <?php if(isset($_GET['dewasa'])){ if($_GET['dewasa'] == "10"){ echo "selected='selected'"; } } ?> value="10">10</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-1">
                    <div class="checkout__input">
                        <p>Anak<span>*</span></p>
                        <select name="anak" required="required">
                            <option <?php if(isset($_GET['anak'])){ if($_GET['anak'] == "0"){ echo "selected='selected'"; } } ?> value="0">0</option>
                            <option <?php if(isset($_GET['anak'])){ if($_GET['anak'] == "1"){ echo "selected='selected'"; } } ?> value="1">1</option>
                            <option <?php if(isset($_GET['anak'])){ if($_GET['anak'] == "2"){ echo "selected='selected'"; } } ?> value="2">2</option>
                            <option <?php if(isset($_GET['anak'])){ if($_GET['anak'] == "3"){ echo "selected='selected'"; } } ?> value="3">3</option>
                            <option <?php if(isset($_GET['anak'])){ if($_GET['anak'] == "4"){ echo "selected='selected'"; } } ?> value="4">4</option>
                            <option <?php if(isset($_GET['anak'])){ if($_GET['anak'] == "5"){ echo "selected='selected'"; } } ?> value="5">5</option>
                            <option <?php if(isset($_GET['anak'])){ if($_GET['anak'] == "6"){ echo "selected='selected'"; } } ?> value="6">6</option>
                            <option <?php if(isset($_GET['anak'])){ if($_GET['anak'] == "7"){ echo "selected='selected'"; } } ?> value="7">7</option>
                            <option <?php if(isset($_GET['anak'])){ if($_GET['anak'] == "8"){ echo "selected='selected'"; } } ?> value="8">8</option>
                            <option <?php if(isset($_GET['anak'])){ if($_GET['anak'] == "9"){ echo "selected='selected'"; } } ?> value="9">9</option>
                            <option <?php if(isset($_GET['anak'])){ if($_GET['anak'] == "10"){ echo "selected='selected'"; } } ?> value="10">10</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-2">
                    <br>
                    <center><button class="site-btn mt-2">CARI KAMAR</button></center>
                </div>

            </div>
        </form>


        <br>

        <?php 
        if(isset($_GET['dari'])){
            $dari = mysqli_real_escape_string($koneksi,$_GET['dari']);
            $sampai = mysqli_real_escape_string($koneksi,$_GET['sampai']);

            $jumlah_tersedia = 0;

            if($dari == $sampai){
                echo "Tanggal salah";
            }else if($sampai <= $dari){
                echo "Tanggal salah";
            }else{

                echo "<br><br><center>";
                echo "<h4><b>HASIL PENCARIAN :</b> Kamar Yang Tersedia</h4> <br><br>";
                echo "</center>";

                $dari = date('Y-m-d', strtotime($dari));
                $sampai = date('Y-m-d', strtotime($sampai));
                
                $kamar = mysqli_query($koneksi,"select * from kamar, kategori where kategori_id=kamar_kategori order by kamar_harga asc");

                while($k = mysqli_fetch_array($kamar)){
                    $id_kamar = $k['kamar_id'];

                    $cek = mysqli_query($koneksi,"select * from invoice where invoice_kamar='$id_kamar' and (invoice_dari >= '$dari' and invoice_dari <= '$sampai' or invoice_sampai > '$dari' and invoice_sampai <= '$sampai') and (invoice_status='0' or invoice_status='1' or invoice_status='3')");
                    // $cek = mysqli_query($koneksi,"select * from invoice where invoice_kamar='$id_kamar' and (invoice_dari BETWEEN '$dari' and '$sampai' or invoice_sampai BETWEEN '$dari' and '$sampai') and (invoice_status='0' or invoice_status='1' or invoice_status='3')");
                    $c = mysqli_num_rows($cek);

                    // cek jika jumlah kamar lebih banyak dari yg sudah dibooking
                    if($k['kamar_jumlah'] > $c){
                        $sisa = $k['kamar_jumlah'] - $c;
                        $jumlah_tersedia += 1;
                        ?>

                        <div class="row justify-content-center">

                            <div class="col-lg-2">
                                <?php if($k['kamar_foto1'] == ""){ ?>
                                    <img src="gambar/sistem/kamar.png" style="width: auto;height: auto">
                                <?php }else{ ?>
                                    <img src="gambar/kamar/<?php echo $k['kamar_foto1'] ?>" style="width: auto;height: auto">
                                <?php } ?>
                            </div>

                            <div class="col-lg-6">

                                <h5><?php echo $k['kamar_nama']; ?></h5>


                                <small class="text-muted">
                                    <?php echo $k['kategori_nama']; ?>
                                    |
                                    Ranjang : <?php echo $k['kamar_ranjang']; ?>
                                    |
                                    Ukuran Kamar : <?php echo $k['kamar_ukuran']; ?> m2
                                    <br>
                                    Fasilitas : 
                                    <?php   
                                    $id_kamar = $k['kamar_id'];
                                    $fasilitas = mysqli_query($koneksi,"select * from fasilitas_kamar,kamar_fasilitas where fk_id=kf_fasilitas and kf_kamar='$id_kamar' order by fk_nama asc");
                                    while($f = mysqli_fetch_array($fasilitas)){
                                        echo $f['fk_nama'].", ";
                                    }
                                    ?>
                                    <br>
                                    Harga : <b><?php echo "Rp. ".number_format($k['kamar_harga']).",-"; ?></b> / mlm

                                </small>
                                
                                <br>
                                Tersisa <b><?php echo $sisa; ?> Kamar</b> 
                                <br>
                                <a class="site-btn py-2 px-2 mt-3" target="_blank" style="font-size: 8pt" href="kamar_detail.php?id=<?php echo $k['kamar_id']; ?>">LIHAT KAMAR</a>


                            </div>

                        </div> 

                        <hr>


                        <?php
                    }
                    
                    // echo $jumlah_tersedia;
                    



                }

                if($jumlah_tersedia == "0"){
                    echo "<div class='alert alert-danger text-center'><b>Kamar tidak tersedia.</b> Silahkan cari tanggal atau kamar lain.</div>";
                }
            }
        }
        ?>
        <br>

    </div>
</section>
<!-- Breadcrumb Section End -->


<?php include 'footer.php'; ?>