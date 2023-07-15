<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Resepsionis
      <small>Data Resepsionis</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Data Resepsionis</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-12">
        <div class="box">

          <div class="box-header">
            <h3 class="box-title">Resepsionis</h3>
            <a href="resepsionis_tambah.php" class="btn btn-default btn-sm pull-right"><i class="fa fa-plus"></i> &nbsp Tambah Resepsionis Baru</a>              
          </div>
          <div class="box-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr>
                    <th width="1%">NO</th>
                    <th>NAMA</th>
                    <th>USERNAME</th>
                    <th width="15%">FOTO</th>
                    <th width="10%">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $no=1;
                  $data = mysqli_query($koneksi,"SELECT * FROM resepsionis");
                  while($d = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $d['resepsionis_nama']; ?></td>
                      <td><?php echo $d['resepsionis_username']; ?></td>
                      <td>
                        <center>
                          <?php if($d['resepsionis_foto'] == ""){ ?>
                            <img src="../gambar/sistem/user.png" style="width: 40px;height: auto">
                          <?php }else{ ?>
                            <img src="../gambar/resepsionis/<?php echo $d['resepsionis_foto'] ?>" style="width: 40px;height: auto">
                          <?php } ?>
                        </center>
                      </td>
                      <td>                        
                        <a class="btn btn-warning btn-sm" href="resepsionis_edit.php?id=<?php echo $d['resepsionis_id'] ?>"><i class="fa fa-cog"></i></a>
                        <a class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin hapus?')" href="resepsionis_hapus.php?id=<?php echo $d['resepsionis_id'] ?>"><i class="fa fa-trash"></i></a>

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