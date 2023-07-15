<!DOCTYPE html>
<html>
<head>
  <title>Laporan Penjualan</title>
</head>
<body>

  <style type="text/css">

    @media print{@page {size: landscape}}
    
    body{
      font-family: sans-serif;
    }

    .table{
      width: 100%;
    }

    th,td{
    }
    .table,
    .table th,
    .table td {
      padding: 2px;
      border: 1px solid black;
      border-collapse: collapse;
      font-size: 10pt;
      text-align: center;
    }
  </style>

    
  <center>
    <h2>Laporan Transaksi Kamar</h2>
  </center>

  <?php 
  include '../koneksi.php';
  if(isset($_GET['tanggal_sampai']) && isset($_GET['tanggal_dari'])){
    $tgl_dari = $_GET['tanggal_dari'];
    $tgl_sampai = $_GET['tanggal_sampai'];
    ?>
    <br/>

    <table class="">
      <tr>
        <td width="20%">DARI TANGGAL</td>
        <td width="1%">:</td>
        <td><?php echo $tgl_dari; ?></td>
      </tr>
      <tr>
        <td>SAMPAI TANGGAL</td>
        <td>:</td>
        <td><?php echo $tgl_sampai; ?></td>
      </tr>
    </table>

    <br/>

    <table class="table table-bordered table-striped" id="table-datatable">
      <thead>
        <tr>
          <th width="1%">NO</th>
          <th>INVOICE</th>
          <th>TANGGAL BOOKING</th>
          <th>NAMA CUSTOMER</th>
          <th>KAMAR</th>
          <th>JUMLAH</th>
          <th>STATUS</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        $no=1;
        $tgl_end = date('Y-m-d', strtotime($tgl_sampai . ' +1 day'));
        $query_layanan = "
          SELECT
            SUM(harga)
          FROM ambil
          WHERE ambil.id_transaksi = ci.id_transaksi";
        $query = "
          SELECT
            ci.*,
            c.customer_nama,
            k.kamar_nama,
            p.harga * p.lama_inap AS biaya_kamar,
            ($query_layanan) AS biaya_layanan
          FROM check_in AS ci
          INNER JOIN customer AS c ON c.no_ktp = ci.no_ktp
          INNER JOIN punya AS p ON p.id_transaksi = ci.id_transaksi
          INNER JOIN kamar as k ON k.kamar_id = p.kamar_id
          WHERE
              ci.tgl_transaksi >= '$tgl_dari' AND
              ci.tgl_transaksi <  '$tgl_end'
        ";
        $data = mysqli_query($koneksi, $query);
        while($i = mysqli_fetch_array($data)){
          $total_bayar = $i['biaya_kamar'] + $i['biaya_layanan'];
          ?>
          <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $i['invoice_no'] ?></td>
            <td><?php echo date('d-m-Y', strtotime($i['tgl_transaksi'])); ?></td>
            <td><?php echo $i['customer_nama'] ?></td>
            <td><?php echo $i['kamar_nama'] ?></td>
            <td><?php echo "Rp. ".number_format($total_bayar)." ,-" ?></td>
            <td>
              <?php 
              if($i['invoice_status'] == 0){
                echo "Menunggu Pembayaran";
              }elseif($i['invoice_status'] == 1){
                echo "Menunggu Konfirmasi";
              }elseif($i['invoice_status'] == 2){
                echo "Ditolak";
              }elseif($i['invoice_status'] == 3){
                echo "Dikonfirmasi";
              }elseif($i['invoice_status'] == 4){
                echo "Selesai";
              }
              ?>
            </td>
          </tr>
          <?php 
        }
        ?>
      </tbody>
    </table>

    <?php 
  }else{
    ?>

    <div class="alert alert-info text-center">
      Silahkan Filter Laporan Terlebih Dulu.
    </div>

    <?php
  }
  ?>
</body>

<script>
  window.print();
</script>
</html>