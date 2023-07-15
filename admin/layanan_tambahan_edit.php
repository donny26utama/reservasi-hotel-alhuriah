<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Layanan Tambahan
      <small>Edit Layanan Tambahan</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Layanan Tambahan</li>
      <li class="active">Edit</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-6">   

        <div class="box">

          <div class="box-header">
            <h3 class="box-title">Edit Layanan Tambahan</h3>
            <a href="layanan_tambahan.php" class="btn btn-default btn-sm pull-right"><i class="fa fa-reply"></i> &nbsp Kembali</a> 
          </div>
          <div class="box-body">

           <?php 
           $id = $_GET['id'];              
           $data = mysqli_query($koneksi, "select * from layanan_tambahan where lt_id='$id'");
           while($d = mysqli_fetch_array($data)){
            ?>

            <form action="layanan_tambahan_update.php" method="post">

              <div class="form-group">
                <label>Nama Layanan</label>
                <input type="hidden" name="id" value="<?php echo $d['lt_id'] ?>">
                <input type="text" class="form-control" name="nama" required="required" value="<?php echo $d['lt_nama'] ?>" placeholder="Masukkan Nama Fasilitas..">
              </div>

              <div class="form-group">
                <label>Harga</label>
                <input type="number" class="form-control" name="harga" required="required" value="<?php echo $d['lt_harga'] ?>" placeholder="Masukkan Nama Fasilitas..">
              </div>

              <br>

              <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Simpan">
              </div>

            </form>
            <?php 
          }
          ?>

        </div>
      </div>
    </section>
  </div>
</section>
</div>
<?php include 'footer.php'; ?>