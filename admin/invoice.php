<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
     INVOICE
      <small>Data INVOICE</small>
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
            <h3 class="box-title">Transaksi / Booking</h3>
          </div>
          <div class="box-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr>
                    <th width="1%">NO</th>
                    <th>NO INVOICE</th>
                    <th>TANGGAL INVOICE</th>
                    <th>NAMA PEMESAN </th>
                    <th>JENIS KAMAR </th>
                    <th>KETERANGAN </th>
                    <th class="text-center">STATUS</th>
                    <th class="text-center">UPDATE STATUS</th>
                    <th class="text-center" width="30%">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $no = 1;
                 $data = mysqli_query($koneksi,"SELECT * FROM invoice,pembayaran,customer,kamar,transaksi_inap,mempunyai where invoice.no_invoice=pembayaran.no_invoice and  customer.no_ktp=transaksi_inap.no_ktp and transaksi");
                  while($i = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td>INVOICE_00<?php echo $i['no_invoice']; ?></td>
                      <td><?php echo $i['tgl_invoice']; ?></td>
                      <td><?php echo $i['customer_nama'] ?></td>
                      <td><?php echo $i['kamar_nama'] ?></td>
                      <td><?php echo $i['keterangan'] ?></td>
                      <td class="text-center">
                        <?php 
                        if($i['status'] == 0){
                          echo "<span class='label label-warning'>Menunggu Pembayaran</span>";
                        }elseif($i['status'] == 1){
                          echo "<span class='label label-default'>Menunggu Konfirmasi</span>";
                        }elseif($i['status'] == 2){
                          echo "<span class='label label-danger'>Ditolak</span>";
                        }elseif($i['status'] == 3){
                          echo "<span class='label label-primary'>Dikonfirmasi</span>";
                        }elseif($i['status'] == 4){
                          echo "<span class='label label-success'>Selesai</span>";
                        }
                        ?>
                      </td>
                      <td class="text-center">
                        <form action="transaksi_status.php" method="post">
                          <input type="hidden" value="<?php echo $i['booking_id'] ?>" name="invoice">
                          <select name="status" id="" class="form-control" onchange="form.submit()">
                            <option <?php if($i['status'] == "0"){echo "selected='selected'";} ?> value="0">Menunggu Pembayaran</option>
                            <option <?php if($i['status'] == "1"){echo "selected='selected'";} ?> value="1">Menunggu Konfirmasi</option>
                            <option <?php if($i['status'] == "2"){echo "selected='selected'";} ?> value="2">Ditolak</option>
                            <option <?php if($i['status'] == "3"){echo "selected='selected'";} ?> value="3">Dikonfirmasi</option>
                            <option <?php if($i['status'] == "4"){echo "selected='selected'";} ?> value="4">Selesai</option>
                          </select>
                        </form>
                      </td>
                      <td class="text-center">    


                        <div class="modal fade" id="buktiPembayaran_<?php echo $i['invoice_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Bukti Pembayaran</h4>
                              </div>
                              <div class="modal-body">

                                <center>
                                  <?php 
                                  if($i['invoice_bukti'] == ""){
                                    echo "Bukti pembayaran belum diupload oleh pembeli/customer.";
                                  }else{
                                    ?>
                                    <img src="../gambar/bukti_pembayaran/<?php echo $i['invoice_bukti']; ?>" alt="" style="width: 100%">
                                    <?php
                                  }
                                  ?>
                                </center>


                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                        </div>

                        <a class='btn btn-sm btn-danger' onclick="return confirm('Yakin ingin hapus?')" href="transaksi_hapus.php?id=<?php echo $i['invoice_id']; ?>"><i class="fa fa-trash"></i></a>
                        
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