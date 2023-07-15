<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Kamar
      <small>Data Kamar</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Kamar</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-12">
        <div class="box">

          <div class="box-header">
            <h3 class="box-title">Kamar</h3>
            <a href="kamar_tambah.php" class="btn btn-default btn-sm pull-right"><i class="fa fa-plus"></i> &nbsp Tambah Kamar Baru</a>              
          </div>
          <div class="box-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr>
                    <th width="1%">NO</th>
                    <th>NAMA KAMAR</th>
                    <th width="10%">JENIS RANJANG</th>
                    <th>UKURAN</th>
                    <th>KATEGORI</th>
                    <th width="10%">HARGA</th>
                    <th width="1%">FOTO</th>
                    <th width="10%">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $no=1;
                  $data = mysqli_query($koneksi,"SELECT * FROM kamar");
                  while($d = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td>
                        <?php echo $d['kamar_nama']; ?>
                        <br>
                        <small class="text-muted">
                          <?php   
                          $id_kamar = $d['kamar_id'];
                          $fasilitas = mysqli_query($koneksi,"select * from fasilitas_kamar,kamar_fasilitas where fk_id=kf_fasilitas and kf_kamar='$id_kamar' order by fk_nama asc");
                          while($f = mysqli_fetch_array($fasilitas)){
                            echo $f['fk_nama'].", ";
                          }
                          ?>
                        </small>
                      </td>
                      <td class="text-center"><?php echo $d['kamar_ranjang']; ?></td>
                      <td><?php echo $d['kamar_ukuran']; ?> m2</td>
                      <td><?php echo $d['kamar_kategori']; ?></td>
                      <td><?php echo "Rp. ".number_format($d['kamar_harga']).",-"; ?></td>
                      <td>
                        <center>
                          <?php if($d['kamar_foto1'] == ""){ ?>
                            <img src="../gambar/sistem/kamar.png" style="width: 70px;height: auto">
                          <?php }else{ ?>
                            <img src="../gambar/kamar/<?php echo $d['kamar_foto1'] ?>" style="width: 70px;height: auto">
                          <?php } ?>
                        </center>
                      </td>
                      <td>                        
                        <a class="btn btn-warning btn-sm" href="kamar_edit.php?id=<?php echo $d['kamar_id'] ?>"><i class="fa fa-cog"></i></a>
                        <a class="btn btn-danger btn-sm" onclick=" return confirm('Yakin?')" href="kamar_hapus.php?id=<?php echo $d['kamar_id'] ?>"><i class="fa fa-trash"></i></a>
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