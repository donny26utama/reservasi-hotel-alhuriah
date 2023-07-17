<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Nomor Kamar
      <small>Data Nomor Kamar</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Nomor Kamar</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-12">
        <div class="box">

          <div class="box-header">
            <h3 class="box-title">Nomor Kamar</h3>
            <div class="btn-group pull-right">
              <a href="nokamar_tambah.php" class="btn btn-default btn-sm"><i class="fa fa-plus"></i> &nbsp; Tambah Nomor Kamar</a>              
            </div>
          </div>
          <div class="box-body">

            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr>
                    <th width="1%">#</th>
                    <th>Nomor Kamar</th>
                    <th>Nama Kamar</th>
                    <th>Lantai</th>
                    <th>Status</th>
                    <th width="12%">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $no=1;
                  $data = mysqli_query($koneksi,"SELECT * FROM nokamar, kamar where nokamar.kamar_id=kamar.kamar_id");
                  while($d = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $d['nokamar']; ?></td>
                      <td><?php echo $d['kamar_nama']; ?> <?php echo $d['kamar_ranjang']; ?> bed</td>
                      <td><?php echo $d['lantai']; ?></td>
                      <td>
                        <?php if ($d['kosong'] === 'Y'): ?>
                          <span class="badge bg-green">Kosong</span>
                        <?php else: ?>
                          <span class="badge bg-blue">Digunakan</span>
                        <?php endif; ?>
                      </td>
                      <td>
      
                              <a class="btn btn-warning btn-sm" href="nokamar_edit.php?id=<?php echo $d['nokamar'] ?>"><i class="fa fa-cog"></i></a>
                              <a class="btn btn-danger btn-sm" href="nokamar_hapus_konfir.php?id=<?php echo $d['nokamar'] ?>"><i class="fa fa-trash"></i></a>
                
                        
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