<?php
if (isset($_POST['profil'])) {
  if (updateProfil($_POST) > 0) {
    echo "<script>document.location.href='?hal=profil&info=1&msg=Berhasil Mengubah Data!'</script>";
  } else {
    echo "<script>document.location.href='?hal=profil&bad=0&msg=Gagal Mengubah Data!'</script>";;
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
              Edit Profile
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
      <form method="post" class="needs-validation justify-content-center" novalidate="">
        <div class="card-body">
          <input type="hidden" name="uid" value="<?= $uid ?>">
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Lengkap</label>
            <div class="col-sm-12 col-md-7">
              <input type="text" class="form-control" name="fn" placeholder="<?= $data['nama'] ?>" required>
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Username</label>
            <div class="col-sm-12 col-md-7">
              <input type="text" class="form-control" name="uname" placeholder="<?= $data['uname'] ?>" required>
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Telp</label>
            <div class="col-sm-12 col-md-7">
              <input type="tel" class="form-control" name="telp" placeholder="<?= $data['telp'] ?>" required>
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
            <div class="col-sm-12 col-md-7">
              <button class="btn btn-primary" type="submit" name="profil">Submit</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>