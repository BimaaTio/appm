<?php
require 'config/functions.php';
if (isset($_POST['regis'])) {
  if (regMas($_POST) > 0) {
    header("Location:login.php?sip=Berhasil Membuat akun!");
  } else {
    header("Location:register.php?bad=Gagal Membuat");
  }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Register &mdash; Stisla</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/template/dist/assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/template/dist/assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="assets/template/dist/assets/modules/jquery-selectric/selectric.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/template/dist/assets/css/style.css">
  <link rel="stylesheet" href="assets/template/dist/assets/css/components.css">
  <!-- Start GA -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-94034622-3');
  </script>
  <!-- /END GA -->
</head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="login-brand">
              <img src="assets/img/logo.png" alt="logo" width="100">
            </div>

            <div class="card card-primary">
              <div class="card-header">
                <h4>Register</h4>
              </div>

              <div class="card-body">
                <form method="POST">
                  <div class="form-group">
                    <label for="nama">NIK</label>
                    <input id="nama" type="number" class="form-control" name="nik" maxlength="18">
                    <div class="invalid-feedback">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="nama">Nama Lengkap</label>
                    <input id="nama" type="text" class="form-control" name="nama" maxlength="18">
                    <div class="invalid-feedback">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="uname">Username</label>
                    <input id="uname" type="text" class="form-control" name="uname" maxlength="18">
                    <div class="invalid-feedback">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="telp">Telp</label>
                    <input id="telp" type="tel" class="form-control" name="telp" maxlength="14">
                    <div class="invalid-feedback">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="password" class="d-block">Password</label>
                      <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="pass" maxlength="16">
                      <div id="pwindicator" class="pwindicator">
                        <div class="bar"></div>
                        <div class="label"></div>
                      </div>
                    </div>
                    <div class="form-group col-6">
                      <label for="password2" class="d-block">Konfirmasi Password</label>
                      <input id="password2" type="password" class="form-control" name="pass2" maxlength="16">
                    </div>
                  </div>


                  <div class="form-group">
                    <button type="submit" name="regis" class="btn btn-primary btn-lg btn-block">
                      Register
                    </button>
                  </div>
                </form>
                <div class="mt-5 text-muted text-center">
                  Sudah Punya Akun? <a href="login.php">Login disini!</a>
                </div>
              </div>
            </div>
            <div class="simple-footer">
              Copyright &copy; Bimatio_ 2023
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="assets/template/dist/assets/modules/jquery.min.js"></script>
  <script src="assets/template/dist/assets/modules/popper.js"></script>
  <script src="assets/template/dist/assets/modules/tooltip.js"></script>
  <script src="assets/template/dist/assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/template/dist/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="assets/template/dist/assets/modules/moment.min.js"></script>
  <script src="assets/template/dist/assets/js/stisla.js"></script>

  <!-- JS Libraies -->
  <script src="assets/template/dist/assets/modules/jquery-pwstrength/jquery.pwstrength.min.js"></script>
  <script src="assets/template/dist/assets/modules/jquery-selectric/jquery.selectric.min.js"></script>

  <!-- Page Specific JS File -->
  <script src="assets/template/dist/assets/js/page/auth-register.js"></script>

  <!-- Template JS File -->
  <script src="assets/template/dist/assets/js/scripts.js"></script>
  <script src="assets/template/dist/assets/js/custom.js"></script>
</body>

</html>