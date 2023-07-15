<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Layanan Tambahan
      <small>Data Layanan Tambahan</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Layanan Tambahan</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-12">
        <div class="box">

          <div class="box-header">
            <h3 class="box-title">Layanan Tambahan</h3>
            <div class="btn-group pull-right">
              <a href="layanan_tambahan_tambah.php" class="btn btn-default btn-sm"><i class="fa fa-plus"></i> &nbsp Tambah Fasilitas</a>              
            </div>
          </div>
          <div class="box-body">

            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr>
                    <th width="1%">NO</th>
                    <th>NAMA FASILITAS</th>
                    <th>HARGA</th>
                    <th width="15%">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $no=1;
                  $data = mysqli_query($koneksi,"SELECT * FROM layanan_tambahan");
                  while($d = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><i class="fa <?php echo $d['lt_icon']; ?>"></i> &nbsp; <?php echo $d['lt_nama']; ?></td>
                      <td><?php echo "Rp.".number_format($d['lt_harga']).",-"; ?></td>
                      <td>                      
                        <a class="btn btn-warning btn-sm" href="layanan_tambahan_edit.php?id=<?php echo $d['lt_id'] ?>"><i class="fa fa-cog"></i></a>
                        <a class="btn btn-danger btn-sm" href="layanan_tambahan_hapus_konfir.php?id=<?php echo $d['lt_id'] ?>"><i class="fa fa-trash"></i></a>
                     </td>
                   </tr>
                   <?php 
                 }
                 ?>
               </tbody>
             </table>
           </div>

         </div>

       </div>
     </section>
   </div>
 </section>

</div>
<?php include 'footer.php'; ?>