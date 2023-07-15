<?php include 'header.php'; ?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Pembayaran
      <small>Pembayaran</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-12">
        <div class="box box-default">

          <div class="box-header">
            <h3 class="box-title">Pembayaran</h3>
          </div>
          <div class="box-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr>
                    <th style="width: 1%">NO</th>
                    <th>KODE PEMBAYARAN</th>
                    <th>TANGGAL PEMBAYARAN</th>
                    <th class="text-center">BUKTI TRANSFER</th>
                    <th class="text-center">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $no = 1;
                    $data = mysqli_query($koneksi,"SELECT * FROM pembayaran,booking_kamar where pembayaran.booking_id=booking_kamar.booking_id");
                    while($i = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td>pembayaran-00<?php echo $i['pembayaran_id'] ?> </td>
                      <td><?php echo $i['tgl_pembayaran']; ?></td>
                      <td><?php echo $i['bukti_transfer'] ?></td>
                      <div class="modal fade" id="buktiPembayaran_<?php echo $i['pembayaran_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Bukti Pembayaran</h4>
                              </div>
                              <div class="modal-body">

                                <center>
                                  <?php 
                                  if($i['bukti_transfer'] == ""){
                                    echo "Bukti pembayaran belum diupload oleh pembeli/customer.";
                                  }else{
                                    ?>
                                    <img src="../gambar/bukti_pembayaran/<?php echo $i['bukti_transfer']; ?>" alt="" style="width: 100%">
                                    <?php
                                  }
                                  ?>
                                </center>
                     
                      <td class="text-center">    
                  

                        <a class='btn btn-sm btn-danger' onclick="return confirm('Yakin ingin hapus?')" href="pembayaran_hapus.php?id=<?php echo $i['pembayaran_id']; ?>"><i class="fa fa-trash"></i></a>
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