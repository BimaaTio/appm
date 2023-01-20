<?php
session_start();
require '../../config/functions.php';
if (!isset($_SESSION['logAdmin'])) {
  header("Location:../../login.php?bad=Silahkan Login Dahulu");
  exit;
}
$uid = $_SESSION['uid'];
$title = $_GET['hal'];
if(empty($title)){
  $title = 'Dashboard';
}
$data = query("SELECT * FROM tb_user WHERE uid = $uid")[0];
// Baris laporan dg status Pending
$rowLapP = numRows("SELECT * FROM tb_pengaduan WHERE status = 'p' ");
// Baris laporan dg status Accept
$rowLapA = numRows("SELECT * FROM tb_pengaduan WHERE status = 'a' ");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>APPM &mdash; <?= ucwords($title) ?></title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="../../assets/template/dist/assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../assets/template/dist/assets/modules/fontawesome/css/all.min.css">


  <!-- CSS Libraries -->
  <link rel="stylesheet" href="../../assets/template/dist/assets/modules/jqvmap/dist/jqvmap.min.css">
  <link rel="stylesheet" href="../../assets/template/dist/assets/modules/summernote/summernote-bs4.css">
  <link rel="stylesheet" href="../../assets/template/dist/assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css">
  <link rel="stylesheet"
    href="../../assets/template/dist/assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css">
  <link rel="stylesheet" href="../../assets/template/dist/assets/modules/datatables/datatables.min.css">
  <link rel="stylesheet"
    href="../../assets/template/dist/assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet"
    href="../../assets/template/dist/assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="../../assets/template/dist/assets/css/style.css">
  <link rel="stylesheet" href="../../assets/template/dist/assets/css/components.css">
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
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown"
              class="nav-link dropdown-toggle nav-link-lg nav-link-user">
              <img alt="image" src="../../assets/template/dist/assets/img/avatar/avatar-1.png"
                class="rounded-circle mr-1">
              <div class="d-sm-none d-lg-inline-block">Hi,<?= $data['nama'] ?></div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="features-profile.html" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
              </a>
              <div class="dropdown-divider"></div>
              <a href="logout.php" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="index.html">Pelaporan Pengaduan</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">APPM</a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="dropdown active">
              <a href="?hal=" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-folder"></i> <span>Data</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="?hal=laporan">Data Laporan</a></li>
                <li><a class="nav-link" href="?hal=masyarakat">Data Akun Masyarakat</a></li>
                <li><a class="nav-link" href="?hal=petugas">Data Akun Petugas</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-cog"></i> <span>Pengaturan</span></a>
              <ul class="dropdown-menu">
                <li><a href="?hal=profil">Pengaturan Akun</a></li>
                <li><a class="nav-link" href="?hal=setting">Pengaturan Website</a></li>
              </ul>
            </li>
            <!-- <li><a class="nav-link" href="credits.html"><i class="fas fa-pencil-ruler"></i> <span>Credits</span></a></li> -->
          </ul>
        </aside>
      </div>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <?php 
          include 'config.php';
          ?>
        </section>
      </div>
      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2023 <div class="bullet"></div> Develop by <a
            href="https://instagram.com/bimatio_">Bimatio_</a>
        </div>
        <div class="footer-right">
          <b>Powered by</b> <u>STISLA</u>
        </div>
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="../../assets/template/dist/assets/modules/jquery.min.js"></script>
  <script src="../../assets/template/dist/assets/modules/popper.js"></script>
  <script src="../../assets/template/dist/assets/modules/tooltip.js"></script>
  <script src="../../assets/template/dist/assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="../../assets/template/dist/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="../../assets/template/dist/assets/modules/moment.min.js"></script>
  <script src="assets/js/stisla.js"></script>

  <!-- JS Libraies -->
  <script src="../../assets/template/dist/assets/modules/jquery.sparkline.min.js"></script>
  <script src="../../assets/template/dist/assets/modules/chart.min.js"></script>
  <script src="../../assets/template/dist/assets/modules/owlcarousel2/dist/owl.carousel.min.js"></script>
  <script src="../../assets/template/dist/assets/modules/summernote/summernote-bs4.js"></script>
  <script src="../../assets/template/dist/assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>
  <script src="../../assets/template/dist/assets/modules/datatables/datatables.min.js"></script>
  <script src="../../assets/template/dist/assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js">
  </script>
  <script src="../../assets/template/dist/assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
  <script src="../../assets/template/dist/assets/modules/jquery-ui/jquery-ui.min.js"></script>

  <!-- Page Specific JS File -->
  <script src="../../assets/template/dist/assets/js/page/index.js"></script>

  <!-- Template JS File -->
  <script src="../../assets/template/dist/assets/js/scripts.js"></script>
  <script src="../../assets/template/dist/assets/js/custom.js"></script>
</body>

</html>