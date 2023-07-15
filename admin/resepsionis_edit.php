<?php 
include 'header.php';
?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Resepsionis
      <small>Edit Resepsionis</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Data Resepsionis</li>
      <li class="active">Edit</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-6">       
        <div class="box">

          <div class="box-header">
            <h3 class="box-title">Edit Resepsionis</h3>
            <a href="resepsionis.php" class="btn btn-default btn-sm pull-right"><i class="fa fa-reply"></i> &nbsp; Kembali</a> 
          </div>
          <div class="box-body">
            <form action="resepsionis_update.php" method="post" enctype="multipart/form-data">
              <?php 
              $id = $_GET['id'];              
              $data = mysqli_query($koneksi, "select * from resepsionis where resepsionis_id='$id'");
              while($d = mysqli_fetch_array($data)){
                ?>

                <div class="form-group">
                  <label>Nama</label>
                  <input type="text" class="form-control" name="nama" value="<?php echo $d['resepsionis_nama'] ?>" required="required">
                  <input type="hidden" class="form-control" name="id" value="<?php echo $d['resepsionis_id'] ?>" required="required">
                </div>

                <div class="form-group">
                  <label>Username</label>
                  <input type="text" class="form-control" name="username" value="<?php echo $d['resepsionis_username'] ?>" required="required">
                </div>

                <div class="form-group">
                  <label>Password</label>
                  <input type="password" class="form-control" name="password" min="5" placeholder="Kosong Jika tidak ingin di ganti">
                  <small class="text-muted">Kosongkan Jika tidak ingin di ganti</small>
                </div>

                <div class="form-group">
                  <label>Foto</label>
                  <input type="file" name="foto">
                  <small class="text-muted">Kosong Jika tidak ingin di ganti</small>
                </div>

                <br>

                <div class="form-group">
                  <input type="submit" class="btn btn-primary" value="Simpan">
                </div>
                <?php
              }

              ?>
              
            </form>
          </div>

        </div>
      </section>
    </div>
  </section>

</div>
<?php include 'footer.php'; ?>