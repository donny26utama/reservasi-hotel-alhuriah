<?php
include 'header.php';

function rating($id_invoice,$id_kamar){
    global $koneksi;

    $rating = mysqli_query($koneksi,"select * from rating where rating_invoice='$id_invoice'");
    $r = mysqli_num_rows($rating);
    if($r > 0){
        $ra = mysqli_fetch_assoc($rating);
        return $ra['rating'];
    }else{
        return "1";
    }
}

function review($id_invoice,$id_kamar){
    global $koneksi;

    $review = mysqli_query($koneksi,"select * from rating where rating_invoice='$id_invoice'");
    $r = mysqli_num_rows($review);
    if($r > 0){
        $ra = mysqli_fetch_assoc($review);
        return $ra['rating_review'];
    }else{
        return "-";
    }
}

$id_invoice = $_GET['id'];
$query = "select * from check_in where id_transaksi='$id_invoice' order by id_transaksi desc";
$invoice = mysqli_query($koneksi, $query);
?>

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Dashboard Customer</h4>
                    <div class="breadcrumb__links">
                        <a href="index.php">Home</a>
                        <a href="#">Customer</a>
                        <span>Pesanan</span>
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
        <div class="row">
            <div id="aside" class="col-md-3">
                <?php include 'customer_sidebar.php'; ?>
            </div>
            <div id="main" class="col-md-9">
                <h4><b>RATING KAMAR</b></h4>
                <br>
                <small class="text-muted">Isi rating dan review kamar</small>
                <br>
                <br>
                <a href="customer_pesanan.php" class="btn btn-primary btn-sm">
                    <i class="fa fa-arrow-left"></i> KEMBALI
                </a>
                <br>
                <br>
                <div class="row">
                    <?php while($i = mysqli_fetch_array($invoice)): ?>
                        <div class="col-lg-12">
                            <?php
                                if(isset($_GET['alert'])){
                                    if($_GET['alert'] == "sukses"){
                            ?>
                                        <div class="alert alert-success"> RATING DAN REVIEW KAMU TELAH TERSIMPAN</div>
                            <?php
                                    }
                                }
                            ?>
                            <form action="customer_rating_aksi.php" method="post" class="form-rating-ku">
                                <input type="hidden" name="invoice" value="<?= $i['id_transaksi'] ?>">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th colspan="2">kamar</th>
                                                <th>RATING</th>
                                                <th>REVIEW PEMBELI</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $no = 1;
                                                $total = 0;
                                                $qtrx = "
                                                    select
                                                        check_in.*,
                                                        kamar.*
                                                    from check_in
                                                    inner join punya
                                                        on punya.id_transaksi = check_in.id_transaksi
                                                    inner join kamar
                                                        on kamar.kamar_id = punya.kamar_id
                                                    where check_in.id_transaksi='$id_invoice'";
                                                $transaksi = mysqli_query($koneksi, $qtrx);
                                                while($d=mysqli_fetch_array($transaksi)):
                                            ?>
                                                <tr>
                                                    <td>
                                                        <center>
                                                            <?php if($d['kamar_foto1'] == ""){ ?>
                                                                <img src="gambar/sistem/kamar.png" style="width: 50px;height: auto">
                                                            <?php }else{ ?>
                                                                <img src="gambar/kamar/<?= $d['kamar_foto1'] ?>" style="width: 50px;height: auto">
                                                            <?php } ?>
                                                        </center>
                                                    </td>
                                                    <td>
                                                        <?= $d['kamar_nama']; ?>
                                                        <br>
                                                        <small><i><?= "Rp. ".number_format($d['invoice_total']).",-"; ?></i></small>
                                                    </td>
                                                    <td>

                                                        <input type="hidden" name="kamar[]" value="<?= $d['kamar_id'] ?>">
                                                        <input type="hidden" value="<?= rating($i['id_transaksi'], $d['kamar_id']); ?>" name="rating[]" class="form_rating_<?= $d['kamar_id']; ?>">

                                                        <i id="1" ke="<?= $d['kamar_id']; ?>" class="rating_bintang rating_<?= $d['kamar_id']; ?>_1 fa fa-star" style="color: orange"></i>
                                                        <i id="2" ke="<?= $d['kamar_id']; ?>" class="rating_bintang rating_<?= $d['kamar_id']; ?>_2 fa <?php if(rating($i['id_transaksi'], $d['kamar_id']) >= 2){ echo "fa-star"; }else{ echo "fa-star-o"; } ?>" style="color: orange"></i>
                                                        <i id="3" ke="<?= $d['kamar_id']; ?>" class="rating_bintang rating_<?= $d['kamar_id']; ?>_3 fa <?php if(rating($i['id_transaksi'], $d['kamar_id']) >= 3){ echo "fa-star"; }else{ echo "fa-star-o"; } ?>" style="color: orange"></i>
                                                        <i id="4" ke="<?= $d['kamar_id']; ?>" class="rating_bintang rating_<?= $d['kamar_id']; ?>_4 fa <?php if(rating($i['id_transaksi'], $d['kamar_id']) >= 4){ echo "fa-star"; }else{ echo "fa-star-o"; } ?>" style="color: orange"></i>
                                                        <i id="5" ke="<?= $d['kamar_id']; ?>" class="rating_bintang rating_<?= $d['kamar_id']; ?>_5 fa <?php if(rating($i['id_transaksi'], $d['kamar_id']) >= 5){ echo "fa-star"; }else{ echo "fa-star-o"; } ?>" style="color: orange"></i>

                                                        <br>
                                                        <small><i>Klik jumlah bintang yang diinginkan</i></small>
                                                    </td>
                                                    <td>
                                                        <textarea required="required" name="review[]" class="form-control" placeholder="Isi review .." style="resize: none;height: 100px"><?= review($i['id_transaksi'], $d['kamar_id']) ?></textarea>
                                                    </td>
                                                </tr>
                                                <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <input type="submit" class="btn btn-primary" value="SIMPAN">
                            </form>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Checkout Section End -->

<?php include 'footer.php'; ?>
