<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Hapus Layanan Tambahan
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-6">    

        <br>

        <div class="box">

          <div class="box-header">
            <h3 class="box-title">Yakin Ingin Menghapus Layanan Tambahan ?</h3>
          </div>
          <div class="box-body">
            <br>
            <p>Dengan menghapus, layanan yang terhubung ke data lain juga akan ikut dihapus.</p>
            <br/>
            <br/>
            <a href="layanan_tambahan.php" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i> &nbsp Kembali</a> 
            <?php 
            $idd = $_GET['id'];
            ?>
            <a href="layanan_tambahan_hapus.php?id=<?php echo $idd; ?>" class="btn btn-success btn-sm pull-right"><i class="fa fa-check"></i> &nbsp Hapus</a> 
          </div>

        </div>
      </section>
    </div>
  </section>

</div>
<?php include 'footer.php'; ?>