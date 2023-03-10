<?php
$setting = query("SELECT * FROM tb_setting")[0];
if (isset($_POST['set'])) {
  if (setting($_POST) > 0) {
    echo "<script>document.location.href='?hal=setting&info=1&msg=Berhasil Mengubah Data!'</script>";
  } else {
    echo "<script>document.location.href='?hal=setting&bad=0&msg=Gagal Mengubah Data!'</script>";
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
              Setting Web
            </h3>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col">
    <?php if (isset($_GET['info'])) : ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Siip!</strong> <?= $_GET['msg'] ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php endif; ?>
    <?php if (isset($_GET['bad'])) : ?>
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Oops!</strong> <?= $_GET['msg'] ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php endif; ?>
    <div class="card">
      <div class="card-header">
        <h5>Terakhir Update : <?= $w['updated_at'] ?></h5>
      </div>
      <div class="card-body">
        <form method="post" class="needs-validation justify-content-center" enctype="multipart/form-data" novalidate="">
          <div class="card-body">
            <div class="form-group row mb-4">
              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Website</label>
              <div class="col-sm-12 col-md-7">
                <input type="text" class="form-control" name="web" value="<?= $w['nama_web'] ?>" required>
              </div>
            </div>
            <div class="form-group row mb-4">
              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Singkatan</label>
              <div class="col-sm-12 col-md-7">
                <input type="text" class="form-control" name="singkatan" value="<?= $w['singkatan'] ?>" required>
              </div>
            </div>
            <div class="form-group row mb-4">
              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Slogan</label>
              <div class="col-sm-12 col-md-7">
                <input type="text" class="form-control" name="slogan" value="<?= $w['slogan'] ?>" required>
              </div>
            </div>
            <div class="form-group row mb-4">
              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Deskripsi</label>
              <div class="col-sm-12 col-md-7">
                <textarea class="summernote" style="display: none;" name="desk" required><?= $w['deskripsi'] ?></textarea>
              </div>
            </div>
            <input type="hidden" name="logoLama" value="<?= $w['logo'] ?>">
            <div class="form-group row mb-4">
              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Logo</label>
              <div class="col-sm-12 col-md-7">
                <div id="image-preview" class="image-preview">
                  <img src="../../assets/img/<?= $w['logo'] ?>" alt="test" class="image-preview">
                  <label for="image-upload" id="image-label">Pilih Foto</label>
                  <input type="file" id="image-upload" name="logo">
                </div>
              </div>
            </div>
            <div class="form-group row mb-4">
              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
              <div class="col-sm-12 col-md-7">
                <button class="btn btn-primary" type="submit" name="set">Submit</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>