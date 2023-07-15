<?php include 'header.php'; ?>

<?php
  $filter = "";
  if (isset($_GET["id"])):
    #id transaksi dari halaman lihat tagihan
    $id_transaksi = $_GET["id"];
    $filter = " AND tagihan.id_transaksi='$id_transaksi' ";
  endif;
?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Transaksi
      <small>Lihat Tagihan</small>
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
            <h3 class="box-title">Transaksi Tagihan</h3>
          </div>
          <div class="box-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr>
                    <th width="1%">NO</th>
                    <th>BILL ID</th>
                    <th>TANGGAL TAGIHAN</th>
                    <th>BUKTI PEMBAYARAN</th>
                    <th>NOMOR KAMAR</th>
                    <th>TANGGAL TRANSAKSI</th>
                    <th>TANGGAL CHECK IN</th>
                    <th>NAMA CUSTOMER </th>
                    <th>NO HP</th>
                     <th>JUMLAH TAMU</th>
                     <th>KAMAR YANG DIPESAN</th>
                     <th>KETERANGAN RESERVASI</th>
                    <th>STATUS</th>
                    <th class="text-center" width="30%">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $no = 1;
                 $data = mysqli_query($koneksi,"SELECT * FROM customer, check_in, tagihan where tagihan.id_transaksi=check_in.id_transaksi AND check_in.no_ktp=customer.no_ktp $filter");
                  while($i = mysqli_fetch_array($data)){
                    $id_transaksi = $i['id_transaksi'];
                    ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $i['bill_id']; ?></td>
                      <td><?php echo $i['bill_tanggal']; ?></td>
                      <td>
                        <?php 
                          if ($i['file_bukti']<>""):
                            ?><img src="../pembayaran/<?= $i['file_bukti'] ?>" width="50px"><?php
                          else:
                            echo "belum ada";
                          endif;
                        ?>
                      </td>
                      <td><?php echo $i['nokamar']; ?></td>
                      <td><?php echo $i['tgl_transaksi']; ?></td>
                      <td><?php echo $i['tgl_check_in']; ?></td>
                      <td><?php echo $i['customer_nama'] ?></td>
                      <td><?php echo $i['customer_hp'] ?></td>
                      <td><?php echo $i['jumlahorang'] ?> orang</td>
                      <td>
                        <?php
                          $q = mysqli_query($koneksi,"SELECT * FROM punya, kamar where kamar.kamar_id=punya.kamar_id AND punya.id_transaksi='$id_transaksi'");
                          while ($dt=mysqli_fetch_object($q)):
                            echo  $dt->kamar_kategori . " " . $dt->kamar_nama . " " . $dt->kamar_ranjang . "<br>";
                            echo " (Rp." . number_format($dt->harga) . ",- / malam, selama " . $dt->lama_inap . " malam)";
                          endwhile;
                        ?>
                      </td>
                      <td><?php echo $i['keterangan_reservasi'] ?></td>
                       <td><?php echo $i['status'] ?></td>
                      
                      <td>

                        <a class='btn btn-sm btn-warning' href="inputtagihan.php?id=<?php echo $i['id_transaksi']; ?>">Validasi</a>
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