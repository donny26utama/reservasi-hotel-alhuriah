<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Fasilitas Hotel
      <small>Data Fasilitas Hotel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Fasilitas Hotel</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-12">
        <div class="box">

          <div class="box-header">
            <h3 class="box-title">Fasilitas Hotel</h3>
            <div class="btn-group pull-right">
              <a href="fasilitas_hotel_tambah.php" class="btn btn-default btn-sm"><i class="fa fa-plus"></i> &nbsp Tambah Fasilitas</a>              
            </div>
          </div>
          <div class="box-body">

            <div class="alert alert-success">
              Fasilitas ini akan muncul pada halaman depan website.
            </div>

            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr>
                    <th width="1%">NO</th>
                    <th>NAMA FASILITAS</th>
                    <th width="12%">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $no=1;
                  $data = mysqli_query($koneksi,"SELECT * FROM fasilitas_hotel");
                  while($d = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><i class="fa <?php echo $d['fh_icon']; ?>"></i> &nbsp; <?php echo $d['fh_nama']; ?></td>
                      <td>                      
                        <a class="btn btn-warning btn-sm" href="fasilitas_hotel_edit.php?id=<?php echo $d['fh_id'] ?>"><i class="fa fa-cog"></i></a>
                        <a class="btn btn-danger btn-sm" href="fasilitas_hotel_hapus_konfir.php?id=<?php echo $d['fh_id'] ?>"><i class="fa fa-trash"></i></a>
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