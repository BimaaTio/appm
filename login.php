<?php
session_start();
require 'config/functions.php';
if (isset($_POST['masuk'])) {
  $uname = $_POST['uname'];
  $pass  = $_POST['pass'];
  // cek apakah username yang di input ada / tidak
  $cek   = mysqli_query($conn, "SELECT * FROM tb_user WHERE uname = '$uname' ");
  // Cek masyarakat
  $cekMas = mysqli_query($conn, "SELECT * FROM tb_masyarakat WHERE uname = '$uname'");
  // Jika username ada jalankan script login untuk user
  if (mysqli_num_rows($cek) === 1) {
    $row = mysqli_fetch_assoc($cek);
    // Cek level jika A (Admin)
    if ($row['level'] === 'a') {
      // melakukan password_verify
      if (password_verify($pass, $row['password'])) {
        // Set Session
        $_SESSION['logAdmin'] = true;
        $_SESSION['aduan'] = true;
        $_SESSION['uid'] = $row['uid'];
      }
      // Cek jika button ingat saya diklik set cookie
      if (isset($_POST['remember'])) {
        setcookie('id', $row['uid'], time() + 2500);
        setcookie('keyA', hash('sha256', $row['uid']), time() + 2500);
      }
      header("Location:dashboard/admin/?hal=");
      exit;
      // Cek level jika p (Petugas)
    }
    if ($row['level'] === 'p') {
      // melakukan password_verify
      if (password_verify($pass, $row['password'])) {
        // Set Session
        $_SESSION['logPetugas'] = true;
        $_SESSION['aduan'] = true;
        $_SESSION['uid'] = $row['uid'];
      }
      // Cek jika button ingat saya diklik set cookie
      if (isset($_POST['remember'])) {
        setcookie('id', $row['uid'], time() + 2500);
        setcookie('keyR', hash('sha256', $row['uid']), time() + 2500);
      }
      header("Location:dashboard/petugas/?hal=");
      exit;
    }
  }
  // Login Masyarakat
  if (mysqli_num_rows($cekMas) === 1) {
    $row = mysqli_fetch_assoc($cekMas);
    if (password_verify($pass, $row['password'])) {
      // jika password sudah benar set session berikut
      $_SESSION['logMasyarakat'] = true;
      $_SESSION['aduan'] = true;
      $_SESSION['uid'] = $row['id_m'];
    }
    // Cek jika button ingat saya diklik set cookie
    if (isset($_POST['remember'])) {
      setcookie('id', $row['id_m'], time() + 2500);
      setcookie('keyR', hash('sha256', $row['id_m']), time() + 2500);
    }
    header("Location:dashboard/masyarakat/?hal=");
    exit;
  }
  $error = true;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Login &mdash; APPM</title>

  <link rel="shortcut icon" href="assets/img/logo.png" type="image/x-icon">
  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?= constant("URL") ?>assets/template/dist/assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= constant("URL") ?>assets/template/dist/assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="<?= constant("URL") ?>assets/template/dist/assets/modules/bootstrap-social/bootstrap-social.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?= constant("URL") ?>assets/template/dist/assets/css/style.css">
  <link rel="stylesheet" href="<?= constant("URL") ?>assets/template/dist/assets/css/components.css">
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
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <a href="index.php">
                <img src="assets/img/logo.png" alt="logo" width="100">
              </a>
            </div>
            <?php if (isset($error)) : ?>
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Oops!</strong> Username / Password salah!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <?php endif; ?>
            <?php if (isset($_GET['sip'])) : ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Hey!</strong> <?= $_GET['sip'] ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <?php endif; ?>
            <?php if (isset($_GET['info'])) : ?>
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Hey!</strong> <?= $_GET['info'] ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <?php endif; ?>
            <?php if (isset($_GET['bad'])) : ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Oops!</strong> <?= $_GET['bad'] ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <?php endif; ?>
            <div class="card card-primary">
              <div class="card-header">
                <h4>Login</h4>
              </div>

              <div class="card-body">
                <form method="POST" action="#" class="needs-validation" novalidate="">
                  <div class="form-group">
                    <label for="uname">Username</label>
                    <input id="uname" type="text" class="form-control" name="uname" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      Silahkan Masukan Username Anda!
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                      <label for="password" class="control-label">Password</label>
                    </div>
                    <input id="password" type="password" class="form-control" name="pass" tabindex="2" required>
                    <div class="invalid-feedback">
                      Silahkan Masukan Password Anda
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                      <label class="custom-control-label" for="remember-me">Remember Me</label>
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" name="masuk" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Login
                    </button>
                  </div>
                </form>
              </div>
            </div>
            <div class="mt-5 text-muted text-center">
              Tidak Punya Akun? <a href="register.php">Buat Disini!</a>
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
  <script src="<?= constant("URL") ?>assets/template/dist/assets/modules/jquery.min.js"></script>
  <script src="<?= constant("URL") ?>assets/template/dist/assets/modules/popper.js"></script>
  <script src="<?= constant("URL") ?>assets/template/dist/assets/modules/tooltip.js"></script>
  <script src="<?= constant("URL") ?>assets/template/dist/assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?= constant("URL") ?>assets/template/dist/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="<?= constant("URL") ?>assets/template/dist/assets/modules/moment.min.js"></script>
  <script src="<?= constant("URL") ?>assets/template/dist/assets/js/stisla.js"></script>

  <!-- JS Libraies -->

  <!-- Page Specific JS File -->

  <!-- Template JS File -->
  <script src="assets/template/dist/assets/js/scripts.js"></script>
  <script src="assets/template/dist/assets/js/custom.js"></script>
</body>

</html>