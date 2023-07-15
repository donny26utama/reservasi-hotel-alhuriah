<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Fasilitas Kamar
      <small>Edit Fasilitas Kamar</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Fasilitas Kamar</li>
      <li class="active">Edit</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-6">   

        <div class="box">

          <div class="box-header">
            <h3 class="box-title">Edit Fasilitas Kamar</h3>
            <a href="fasilitas_kamar.php" class="btn btn-default btn-sm pull-right"><i class="fa fa-reply"></i> &nbsp Kembali</a> 
          </div>
          <div class="box-body">

           <?php 
           $id = $_GET['id'];              
           $qfk = mysqli_query($koneksi, "select * from fasilitas_kamar where id_fk='$id'");
           $dtfk = mysqli_fetch_object($qfk);
            ?>

            <form action="fasilitas_kamar_update.php" method="post">


              <div class="form-group">
                <input type="hidden" name="id" value="<?php echo $dtfk->id_fk ?>">
                <label>Pilih Kamar</label>
                
                <select readonly disabled class="form-control" name="kamar_id" required>
                  <option value="">--Pilih Kamar--</option>  
                  <?php
                    $q = mysqli_query($koneksi,"SELECT * FROM kamar where kamar_id='$dtfk->kamar_id'");
                    while($dt = mysqli_fetch_object($q)):
                      ?>
                        <option <?= ($dt->kamar_id==$dtfk->kamar_id) ? "selected" : "" ?> value="<?= $dt->kamar_id ?>"><?= $dt->kamar_nama ?> <?= $dt->kamar_ranjang ?> bed</option>
                      <?php
                    endwhile;
                  ?>
                </select>
              </div>



              <div class="form-group">
                <label>Shower</label>
                <select class="form-control" name="Shower" required>
                  <option <?= ($dtfk->Shower=="Y") ? "selected" : "" ?> value="Y">Ya</option>
                  <option <?= ($dtfk->Shower=="T") ? "selected" : "" ?> value="T">Tidak</option>
                </select>
              </div>

              <div class="form-group">
                <label>Closet Jongkok</label>
                <select class="form-control" name="Closet_Jongkok" required>
                  <option <?= ($dtfk->Closet_Jongkok=="Y") ? "selected" : "" ?> value="Y">Ya</option>
                  <option <?= ($dtfk->Closet_Jongkok=="T") ? "selected" : "" ?> value="T">Tidak</option>
                </select>
              </div>

              <div class="form-group">
                <label>Closet Duduk</label>
                <select class="form-control" name="Closet_Duduk" required>
                  <option <?= ($dtfk->Closet_Duduk=="Y") ? "selected" : "" ?> value="Y">Ya</option>
                  <option <?= ($dtfk->Closet_Duduk=="T") ? "selected" : "" ?> value="T">Tidak</option>
                </select>
              </div>

              

              <div class="form-group">
                <label>TV</label>
                <select class="form-control" name="TV" required>
                  <option <?= ($dtfk->TV=="Y") ? "selected" : "" ?> value="Y">Ya</option>
                  <option <?= ($dtfk->TV=="T") ? "selected" : "" ?> value="T">Tidak</option>
                </select>
              </div>

              <div class="form-group">
                <label>Wifi</label>
                <select class="form-control" name="Wifi" required>
                  <option <?= ($dtfk->Wifi=="Y") ? "selected" : "" ?> value="Y">Ya</option>
                  <option <?= ($dtfk->Wifi=="T") ? "selected" : "" ?> value="T">Tidak</option>
                </select>
              </div>

             

              <div class="form-group">
                <label>Breakfast</label>
                <select class="form-control" name="Breakfast" required>
                  <option <?= ($dtfk->Breakfast=="Y") ? "selected" : "" ?> value="Y">Ya</option>
                  <option <?= ($dtfk->Breakfast=="T") ? "selected" : "" ?> value="T">Tidak</option>
                </select>
              </div>

              <div class="form-group">
                <label>Lunch</label>
                <select class="form-control" name="Lunch" required>
                  <option <?= ($dtfk->Lunch=="Y") ? "selected" : "" ?> value="Y">Ya</option>
                  <option <?= ($dtfk->Lunch=="T") ? "selected" : "" ?> value="T">Tidak</option>
                </select>
              </div>

              

              <div class="form-group">
                <label>Lemari</label>
                <select class="form-control" name="Lemari" required>
                  <option <?= ($dtfk->Lemari=="Y") ? "selected" : "" ?> value="Y">Ya</option>
                  <option <?= ($dtfk->Lemari=="T") ? "selected" : "" ?> value="T">Tidak</option>
                </select>
              </div>

              <div class="form-group">
                <label>AC</label>
                <select class="form-control" name="AC" required>
                  <option <?= ($dtfk->AC=="Y") ? "selected" : "" ?> value="Y">Ya</option>
                  <option <?= ($dtfk->AC=="T") ? "selected" : "" ?> value="T">Tidak</option>
                </select>
              </div>

              

              <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Simpan">
              </div>

            </form>

        </div>
      </div>
    </section>
  </div>
</section>
</div>
<?php include 'footer.php'; ?>