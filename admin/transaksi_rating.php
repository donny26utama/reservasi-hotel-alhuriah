<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Transaksi
      <small>Data Transaksi / Pesanan</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-12">
        <div class="box box-info">

          <div class="box-header">
            <h3 class="box-title">Rating Kamar</h3>
          </div>
          <div class="box-body">

            <a href="transaksi.php" class="btn btn-default btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
            <br>
            <br>
            <div class="row">

              <?php 
              $id_invoice = $_GET['id'];
              $invoice = mysqli_query($koneksi,"select * from invoice where invoice_id='$id_invoice' order by invoice_id desc");
              while($i = mysqli_fetch_array($invoice)){
                ?>

                <div class="col-lg-12">

                  <?php 
                  if(isset($_GET['alert'])){
                    if($_GET['alert'] == "sukses"){
                      ?>

                      <div class="alert alert-success"> RATING DAN REVIEW KAMU TELAH TERSIMPAN</div>

                      <?php
                    }elseif($_GET['alert'] == "hapus"){
                      ?>

                      <div class="alert alert-success"> RATING DAN REVIEW TELAH DIHAPUS</div>

                      <?php
                    }

                  } 

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
                  ?>

                  <form action="transaksi_rating_update.php" method="post" class="form-rating-ku">

                    <input type="hidden" name="invoice" value="<?php echo $i['invoice_id'] ?>">

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
                          $transaksi = mysqli_query($koneksi,"select * from invoice,kamar where invoice_kamar=kamar_id and invoice_id='$id_invoice'");
                          while($d=mysqli_fetch_array($transaksi)){

                            ?>
                            <tr>
                              <td>
                                <center>
                                  <?php if($d['kamar_foto1'] == ""){ ?>
                                    <img src="../gambar/sistem/kamar.png" style="width: 50px;height: auto">
                                  <?php }else{ ?>
                                    <img src="../gambar/kamar/<?php echo $d['kamar_foto1'] ?>" style="width: 50px;height: auto">
                                  <?php } ?>
                                </center>
                              </td>
                              <td>
                                <?php echo $d['kamar_nama']; ?>
                                <br>
                                <small><i><?php echo "Rp. ".number_format($d['invoice_total_bayar']).",-"; ?></i></small>
                              </td>
                              <td>

                                <input type="hidden" name="kamar[]" value="<?php echo $d['kamar_id'] ?>">
                                <input type="hidden" value="<?php echo rating($i['invoice_id'], $d['kamar_id']); ?>" name="rating[]" class="form_rating_<?php echo $d['kamar_id']; ?>">

                                <i id="1" ke="<?php echo $d['kamar_id']; ?>" class="rating_bintang rating_<?php echo $d['kamar_id']; ?>_1 fa fa-star" style="color: orange"></i>
                                <i id="2" ke="<?php echo $d['kamar_id']; ?>" class="rating_bintang rating_<?php echo $d['kamar_id']; ?>_2 fa <?php if(rating($i['invoice_id'], $d['kamar_id']) >= 2){ echo "fa-star"; }else{ echo "fa-star-o"; } ?>" style="color: orange"></i>
                                <i id="3" ke="<?php echo $d['kamar_id']; ?>" class="rating_bintang rating_<?php echo $d['kamar_id']; ?>_3 fa <?php if(rating($i['invoice_id'], $d['kamar_id']) >= 3){ echo "fa-star"; }else{ echo "fa-star-o"; } ?>" style="color: orange"></i>
                                <i id="4" ke="<?php echo $d['kamar_id']; ?>" class="rating_bintang rating_<?php echo $d['kamar_id']; ?>_4 fa <?php if(rating($i['invoice_id'], $d['kamar_id']) >= 4){ echo "fa-star"; }else{ echo "fa-star-o"; } ?>" style="color: orange"></i>
                                <i id="5" ke="<?php echo $d['kamar_id']; ?>" class="rating_bintang rating_<?php echo $d['kamar_id']; ?>_5 fa <?php if(rating($i['invoice_id'], $d['kamar_id']) >= 5){ echo "fa-star"; }else{ echo "fa-star-o"; } ?>" style="color: orange"></i>

                                <br>
                                <small><i>Klik jumlah bintang yang diinginkan</i></small>
                              </td>
                              <td>
                                <textarea required="required" name="review[]" class="form-control" placeholder="Isi review .." style="resize: none;height: 100px"><?php echo review($i['invoice_id'], $d['kamar_id']) ?></textarea>
                              </td>
                            </tr>
                            <?php 
                          }
                          ?>
                        </tbody>
                      </table>
                    </div>

                    <input type="submit" class="btn btn-primary" value="SIMPAN">

                    <a href="transaksi_rating_hapus.php?id=<?php echo $i['invoice_id'] ?>" class="btn btn-danger"><i class="fa fa-close"></i> HAPUS RATING & REVIEW</a>

                  </form>


                </div>  


                <?php 
              }
              ?>
            </div>

          </div>

        </div>
      </section>
    </div>
  </section>

</div>
<?php include 'footer.php'; ?>