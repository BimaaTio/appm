<?php
$id = $_GET['idl'];
$data = query("SELECT * FROM tb_pengaduan WHERE id_p = $id")[0];

if (isset($_POST['submit'])) {
  if (editLap($_POST) > 0) {
    echo
    "
    <script>
        document.location.href = '?hal=laporan-saya&sip=berhasil&msg=Laporan Berhasil Di edit';
    </script>
    ";
  } else {
    echo
    "
    <script>
        document.location.href = '?hal=laporan-saya&bad=gagal&msg=Laporan Gagal Di edit';
    </script>
    ";
  }
}
?>

<div class="row">
  <div class="col">
    <div class="card card-statistic-2">
      <div class="card-wrap">
        <div class="card-header">
          <div class="card-body">
            <h3 class="mb-5">
              Edit Laporan
            </h3>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <?php if (isset($_GET['sip']) == 'berhasil' && isset($_GET['msg'])) : ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Siip!</strong> <?= $_GET['msg'] ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php endif; ?>
    <?php if (isset($_GET['bad']) == 'gagal' && isset($_GET['msg'])) : ?>
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Oops!</strong> <?= $_GET['msg'] ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php endif; ?>
    <h5 class="mb-2">Formulir Laporan Pengaduan</h5>
    <div class="card">
      <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
          <input type="hidden" name="idm" value="<?= $uid ?>">
          <input type="text" name="idp" value="<?= $data['id_p'] ?>" id="">
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Judul Laporan</label>
            <div class="col-sm-12 col-md-7">
              <input type="text" class="form-control" name="judul" required value="<?= $data['judul_pengaduan'] ?>">
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Isi Laporan</label>
            <div class="col-sm-12 col-md-7">
              <textarea class="summernote" style="display: none;" name="isi" required><?= $data['isi_laporan'] ?></textarea>
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Foto</label>
            <div class="col-sm-12 col-md-7">
              <div id="image-preview" class="image-preview">
                <img src="../../assets/img/foto/<?= $data['foto'] ?>" alt="" class="image-preview">
                <label for="image-upload" id="image-label">Pilih Foto</label>
                <input type="text" name="fotoLama" value="<?= $data['foto'] ?>" id="">
                <input type="file" id="image-upload" name="foto">
              </div>
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
            <div class="col-sm-12 col-md-7">
              <button class="btn btn-primary" type="submit" name="submit">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>