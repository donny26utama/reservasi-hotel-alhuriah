<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Fasilitas Kamar
      <small>Data Fasilitas Kamar</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Fasilitas Kamar</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-12">
        <div class="box">

          <div class="box-header">
            <h3 class="box-title">Fasilitas Kamar</h3>
            <div class="btn-group pull-right">
              <a href="fasilitas_kamar_tambah.php" class="btn btn-default btn-sm"><i class="fa fa-plus"></i> &nbsp Tambah Fasilitas</a>              
            </div>
          </div>
          <div class="box-body">

            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr>
                    <th width="1%">NO</th>
                    <th>Id Kamar</th>
                    <th>Nama Kamar</th>
                    <th>Fasilitas</th>
                    <th width="12%">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $no=1;
                  $data = mysqli_query($koneksi,"SELECT * FROM kamar");
                  while($d = mysqli_fetch_array($data)){
                    $idkamarnya = $d['kamar_id'];
                    ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $d['kamar_id']; ?></td>
                      <td><?php echo $d['kamar_nama']; ?> <?php echo $d['kamar_ranjang']; ?> bed</td>
                      <td>
                        <?php
                          $q = mysqli_query($koneksi,"SELECT * FROM fasilitas_kamar WHERE kamar_id='$idkamarnya' ");
                          if (mysqli_num_rows($q)>0):
                            $dt = mysqli_fetch_object($q);
                            echo ($dt->Shower=="Y") ? "Shower, " : "";
                            echo ($dt->Closet_Jongkok=="Y") ? "Closet Jongkok, " : "";
                            echo ($dt->Closet_Duduk=="Y") ? "Closet Duduk, " : "";
                            echo ($dt->TV=="Y") ? "TV, " : "";
                            echo ($dt->Wifi=="Y") ? "Wifi, " : "";
                            echo ($dt->Breakfast=="Y") ? "Breakfast, " : "";
                            echo ($dt->Lunch=="Y") ? "Lunch, " : "";
                            echo ($dt->Lemari=="Y") ? "Lemari, " : "";
                            echo ($dt->AC=="Y") ? "AC, " : "";
                          endif;
                          
                        ?>
                      </td>
                      <td>
                        <?php if (mysqli_num_rows($q)>0): ?>
                              <a class="btn btn-warning btn-sm" href="fasilitas_kamar_edit.php?id=<?php echo $dt->id_fk ?>"><i class="fa fa-cog"></i></a>
                              <a class="btn btn-danger btn-sm" href="fasilitas_kamar_hapus_konfir.php?id=<?php echo $dt->id_fk ?>"><i class="fa fa-trash"></i></a>
                        <?php endif; ?>                      
                        
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