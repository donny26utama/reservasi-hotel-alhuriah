<?php
session_start();
include '../koneksi.php';

function tglIndo($date) {
    list($tahun, $bln, $tgl) = explode('-', $date);

    switch ($bln) {
        default:
        case '01':
            $bulan = 'Januari';
            break;
        case '02':
            $bulan = 'Februari';
            break;
        case '03':
            $bulan = 'Maret';
            break;
        case '04':
            $bulan = 'April';
            break;
        case '05':
            $bulan = 'Mei';
            break;
        case '06':
            $bulan = 'Juni';
            break;
        case '07':
            $bulan = 'Juli';
            break;
        case '08':
            $bulan = 'Agustus';
            break;
        case '09':
            $bulan = 'September';
            break;
        case '10':
            $bulan = 'Oktober';
            break;
        case '11':
            $bulan = 'November';
            break;
        case '12':
            $bulan = 'Desember';
            break;
    }

    return sprintf('%s %s %s', $tgl, $bulan, $tahun);
}

$id_invoice = mysqli_real_escape_string($koneksi, $_GET['id']);
$query = "
    select
        check_in.*,
        customer.customer_nama,
        customer.customer_hp,
        punya.kamar_id,
        punya.lama_inap,
        punya.nokamar,
        admin.admin_nama
    from check_in
    inner join customer on customer.no_ktp = check_in.no_ktp
    inner join punya on punya.id_transaksi = check_in.id_transaksi
    inner join admin on admin.admin_username = check_in.admin_username
    where check_in.id_transaksi='$id_invoice'
    order by check_in.id_transaksi desc";
$invoice = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html lang="id-ID">
<head>
    <title></title>
    <style>
        body{
            font-family: sans-serif;
        }

        .table{
            border-collapse: collapse;
            width: 100%;
        }
        .table th,
        .table td{
            padding: 5px 10px;
            border: 1px solid black;
        }
        .table.no-border th,
        .table.no-border td{
            border: none;
        }
    </style>
</head>
<body>
    <center>
        <h2>AL-HURIAH HOTEL</h2>
    </center>
    <div>
        <?php
            while($i = mysqli_fetch_array($invoice)):
                $id_kamar = $i['kamar_id'];
                $tgl_indo = tglIndo($i['tgl_transaksi']);
                $query_kamar = "
                    SELECT *
                    FROM kamar
                    WHERE kamar_id='$id_kamar'
                    ORDER BY kamar_id desc";
                $kamar = mysqli_query($koneksi, $query_kamar);
                $k = mysqli_fetch_assoc($kamar);
        ?>
            <div>
                <h4><?= $i['invoice_no'] ?></h4>
                <br/>
                <table class="table table-bordered">
                    <tr>
                        <td style="width: 20%">Nama</td>
                        <td><?= $i['customer_nama']; ?></td>
                    </tr>
                    <tr>
                        <td>HP</td>
                        <td><?= $i['customer_hp']; ?></td>
                    </tr>
                    <tr>
                        <td>Kamar</td>
                        <td>
                            <b><?= $k['kamar_nama']; ?></b>
                            (No. Kamar: <?= $i['nokamar'] ?>)
                        </td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>
                            <?php
                            if($i['invoice_status'] == 0){
                                echo "<span class='label label-warning'>Menunggu Pembayaran</span>";
                            }elseif($i['invoice_status'] == 1){
                                echo "<span class='label label-default'>Menunggu Konfirmasi</span>";
                            }elseif($i['invoice_status'] == 2){
                                echo "<span class='label label-danger'>Ditolak</span>";
                            }elseif($i['invoice_status'] == 3){
                                echo "<span class='label label-primary'>Dikonfirmasi</span>";
                            }elseif($i['invoice_status'] == 4){
                                echo "<span class='label label-success'>Selesai</span>";
                            }
                            ?>
                        </td>
                    </tr>
                </table>
                <br/>
                <br>
                Detail :
                <br>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>Harga Kamar</td>
                            <td class="text-center"><?= "Rp. ".number_format($k['kamar_harga'])." ,-"; ?></td>
                        </tr>
                        <tr>
                            <td>
                                Lama Menginap :
                                <small class="text-muted">
                                    <?php
                                        $durasi = sprintf('%s +%s days', $i['tgl_check_in'], $i['lama_inap']);
                                        $check_in = date('d/m/Y', strtotime($i['tgl_check_in']));
                                        $check_out = date('d/m/Y', strtotime($durasi));
                                    ?>
                                    ( <?php echo $check_in, ' - ', $check_out; ?> )
                                </small>
                            </td>
                            <td class="text-center">
                                <?= $i['lama_inap'] ?> Hari
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Layanan Tambahan :
                                <br>
                                <?php
                                    $harga_layanan = 0;
                                    $id_invoice = $i['id_transaksi'];
                                    $query_layanan_tambahan = "
                                        select *
                                        from ambil
                                        inner join layanan_tambahan
                                            on layanan_tambahan.lt_id = ambil.lt_id
                                        where ambil.id_transaksi='$id_invoice'
                                    ";
                                    $template = '<small class="text-muted">- %s (Rp. %s ,-)</small>';
                                    $layanan = mysqli_query($koneksi, $query_layanan_tambahan);
                                    while($l = mysqli_fetch_array($layanan)):
                                        $harga_layanan += $l['lt_harga'];
                                        $lt_harga = number_format($l['lt_harga']);
                                ?>
                                    &nbsp; &nbsp; &nbsp;<?php echo sprintf($template, $l['lt_nama'], $lt_harga) ?><br>
                                <?php endwhile; ?>
                            </td>
                            <td class="text-center"><?= "Rp. ".number_format($harga_layanan)." ,-"; ?></td>
                        </tr>
                        <tr>
                            <td>Total Bayar</td>
                            <td class="text-center bg-primary text-white font-weight-bold">
                                <?= "Rp. ".number_format($i['invoice_total'])." ,-"; ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="table-responsive" style="margin-top: 50px;">
                <table class="table no-border">
                    <tbody>
                        <tr>
                            <td style="width: 65%"></td>
                            <td style="width: 35%; text-align: center">
                                Pangkalpinang, <?= $tgl_indo ?><br>
                                Admin Al-Huriah Hotel<br><br><br><br><br>
                                <b>( <?= $i['admin_nama'] ?> )</b>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <?php endwhile; ?>
    </div>

    <script>
        window.print();
    </script>
</body>
</html>
