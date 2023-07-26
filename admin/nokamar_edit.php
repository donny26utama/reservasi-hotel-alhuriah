<?php
include 'header.php';
$id = $_GET['id'];
$data = mysqli_query($koneksi, "select * from nokamar where nokamar='$id'");
?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Nomor Kamar
      <small>Edit Nomor Kamar</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Nomor Kamar</li>
      <li class="active">Edit</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-6">

        <div class="box">

          <div class="box-header">
            <h3 class="box-title">Edit Nomor Kamar</h3>
            <a href="fasilitas_kamar.php" class="btn btn-default btn-sm pull-right">
              <i class="fa fa-reply"></i> &nbsp; Kembali
            </a>
          </div>
          <div class="box-body">
            <?php if(isset($_GET['alert']) && $_GET['alert'] == "duplicate"): ?>
              <div class="alert alert-danger">Nomor Kamar Sudah Terdaftar</div>
            <?php endif; ?>
            <form action="nokamar_update.php" method="post">
              <?php while($d = mysqli_fetch_array($data)): ?>
                <input type="hidden" name="id" value="<?php echo $d['nokamar']; ?>">
                <div class="form-group">
                  <label>Pilih Kamar</label>
                  <select class="form-control" name="kamar_id" required>
                    <option value="">--Pilih Kamar--</option>
                    <?php
                      $q = mysqli_query($koneksi,"SELECT * FROM kamar ");
                      while($dt = mysqli_fetch_object($q)):
                        $selected_kamar = $dt->kamar_id == $d['kamar_id'] ? 'selected' : '';
                    ?>
                        <option value="<?= $dt->kamar_id ?>" <?= $selected_kamar ?>>
                          <?= $dt->kamar_nama ?> <?= $dt->kamar_ranjang ?> bed
                        </option>
                    <?php endwhile; ?>
                  </select>
                </div>

                <div class="form-group">
                  <label>Lantai</label>
                  <select class="form-control" name="lantai" required>
                    <option selected value="">--Pilih Lantai--</option>
                    <?php
                      foreach (range(1, 3) as $lt):
                        $selected_lt = $lt == $d['lantai'] ? 'selected' : '';
                    ?>
                        <option value="<?= $lt ?>" <?= $selected_lt ?>><?= $lt ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>

                <div class="form-group">
                  <label>Nomor Kamar</label>
                  <input type="number" class="form-control" name="nokamar" value="<?= $d['nokamar'] ?>" required>
                </div>

                <div class="form-group">
                  <input type="submit" class="btn btn-primary" value="Simpan">
                </div>
              <?php endwhile; ?>
            </form>

          </div>
        </div>
      </section>
    </div>
  </section>
</div>
<?php include 'footer.php'; ?>