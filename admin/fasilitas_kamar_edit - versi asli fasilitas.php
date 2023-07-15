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
           $data = mysqli_query($koneksi, "select * from fasilitas_kamar where fk_id='$id'");
           while($d = mysqli_fetch_array($data)){
            ?>

            <form action="fasilitas_kamar_update.php" method="post">

              <div class="form-group">
                <label>Icon</label>
                <input type="hidden" name="id" value="<?php echo $d['fk_id'] ?>">
                <input type="text" class="form-control" name="icon" required="required" value="<?php echo $d['fk_icon'] ?>" placeholder="Masukkan nama icon..">
                <a href="icon.php" target="_blank">Lihat contoh icon di sini</a>
              </div>

              <div class="form-group">
                <label>Nama Fasilitas</label>
                <input type="text" class="form-control" name="nama" required="required" value="<?php echo $d['fk_nama'] ?>" placeholder="Masukkan Nama Fasilitas..">
              </div>

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