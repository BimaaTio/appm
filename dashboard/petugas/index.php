<?php
session_start();
require '../../config/functions.php';
if (!isset($_SESSION['logPetugas'])) {
  header("Location:../../login.php?bad=Silahkan Login Dahulu");
  exit;
}
$uid = $_SESSION['uid'];
$judul = $_GET['hal'];
$active = $_GET['hal'];
$t1 = '';
if (empty($judul)) {
  $judul = 'Dashboard';
}
// data user
$data = query("SELECT * FROM tb_user WHERE uid = $uid")[0];
// Data masyarakat
$dataMasyarakat = query("SELECT * FROM tb_masyarakat");
// Data Laporan Beserta nama pelapor tb_masyarakat & tb_pengaduan 
$dataLap = query("SELECT * FROM tb_masyarakat,tb_pengaduan WHERE tb_pengaduan.id_m = tb_masyarakat.id_m");
// Baris laporan dg status Pending
$rowLapP = numRows("SELECT * FROM tb_pengaduan WHERE status = 'p' ");
// Baris laporan dg status Accept
$rowLapA = numRows("SELECT * FROM tb_pengaduan WHERE status = 'a' ");
// Akun masyarakat yang terdaftar
$rowMas  = numRows("SELECT * FROM tb_masyarakat");
// Akun petugas Terdaftar
$rowPet  = numRows("SELECT * FROM tb_user WHERE level = 'p' ")
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>APPM &mdash; <?= ucwords($judul) ?></title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="../../assets/template/dist/assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../assets/template/dist/assets/modules/fontawesome/css/all.min.css">


  <!-- CSS Libraries -->
  <link rel="stylesheet" href="../../assets/template/dist/assets/modules/jqvmap/dist/jqvmap.min.css">
  <link rel="stylesheet" href="../../assets/template/dist/assets/modules/summernote/summernote-bs4.css">
  <link rel="stylesheet" href="../../assets/template/dist/assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="../../assets/template/dist/assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css">
  <link rel="stylesheet" href="../../assets/template/dist/assets/modules/datatables/datatables.min.css">
  <link rel="stylesheet" href="../../assets/template/dist/assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <!-- <link rel="stylesheet" href="../../assets/template/dist/assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css"> -->
  <link rel="stylesheet" href="../../assets/template/dist/assets/modules/prism/prism.css">

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
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
              <img alt="image" src="../../assets/template/dist/assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
              <div class="d-sm-none d-lg-inline-block">Hi,<?= $data['nama'] ?></div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <!-- <a href="features-profile.html" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
              </a> -->
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
            <?php if ($active == '') : ?>
              <li class="dropdown active">
                <a href="?hal=" class="nav-link active"><i class="fas fa-fire"></i><span>Dashboard</span></a>
              </li>
            <?php else : ?>
              <li class="dropdown">
                <a href="?hal=" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
              </li>
            <?php endif; ?>
            <?php if ($active == 'laporan') : ?>
              <li class="dropdown active">
                <a href="?hal=laporan" class="nav-link active"><i class="fas fa-file"></i><span>Laporan</span></a>
              </li>
            <?php else : ?>
              <li class="dropdown">
                <a href="?hal=laporan" class="nav-link"><i class="fas fa-file"></i><span>Laporan</span></a>
              </li>
            <?php endif; ?>
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
          Copyright &copy; 2023 <div class="bullet"></div> Develop by <a href="https://instagram.com/bimatio_">Bimatio_</a>
        </div>
        <div class="footer-right">
          <b>Powered by</b> <u>STISLA</u>
        </div>
      </footer>
    </div>
  </div>
  <!-- General JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.6.1.slim.min.js" integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script>
  <script src="../../assets/template/dist/assets/modules/jquery.min.js"></script>
  <script src="../../assets/template/dist/assets/modules/popper.js"></script>
  <script src="../../assets/template/dist/assets/modules/tooltip.js"></script>
  <script src="../../assets/template/dist/assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="../../assets/template/dist/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="../../assets/template/dist/assets/modules/moment.min.js"></script>
  <script src="../../assets/template/dist/assets/js/stisla.js"></script>

  <!-- JS Libraies -->
  <script src="../../assets/template/dist/assets/modules/jquery.sparkline.min.js"></script>
  <script src="../../assets/template/dist/assets/modules/chart.min.js"></script>
  <script src="../../assets/template/dist/assets/modules/owlcarousel2/dist/owl.carousel.min.js"></script>
  <script src="../../assets/template/dist/assets/modules/summernote/summernote-bs4.js"></script>
  <script src="../../assets/template/dist/assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>
  <script src="../../assets/template/dist/assets/modules/sweetalert/sweetalert.min.js"></script>
  <!-- <script src="../../assets/template/dist/assets/modules/datatables/datatables.min.js"></script>
  <script src="../../assets/template/dist/assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <script src="../../assets/template/dist/assets/modules/datatables/jszip/jszip.min.js"></script>
  <script src="../../assets/template/dist/assets/modules/datatables/pdfmake/pdfmake.min.js"></script>
  <script src="../../assets/template/dist/assets/modules/datatables/pdfmake/vfs_fonts.js"></script> -->

  <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.bootstrap4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.colVis.min.js"></script>
  <script src="../../assets/template/dist/assets/modules/jquery-ui/jquery-ui.min.js"></script>
  <script src="../../assets/template/dist/assets/modules/prism/prism.js"></script>
  <!-- Page Specific JS File -->
  <script src="../../assets/template/dist/assets/js/page/index.js"></script>
  <script src="../../assets/template/dist/assets/js/page/bootstrap-modal.js"></script>
  <script src="../../assets/template/dist/assets/js/page/modules-sweetalert.js"></script>
  <!-- Template JS File -->
  <script src="../../assets/template/dist/assets/js/scripts.js"></script>
  <script src="../../assets/template/dist/assets/js/custom.js"></script>
</body>

</html>



<!-- Semua Modal Popup ada disini -->

<!-- Modal Tanggapi -->
<div class="modal fade" tabindex="-1" role="dialog" id="tanggapi">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tanggapi Masalah</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post" class="justify-content-center">
          <input name="idp" type="hidden" id="id_p">
          <input name="uid" type="hidden" value="<?= $uid ?>">
          <div class="form-group row mb-4">
            <label class="col-form-label col-2">Judul</label>
            <div class="col-10">
              <input id="judulLap" type="text" class="form-control" readonly>
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label col-2">Nama Pengadu</label>
            <div class="col-10">
              <input id="pengadu" type="text" class="form-control" readonly>
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label col-2">Tanggapan</label>
            <div class="col-10">
              <textarea class="summernote" name="tanggapan" cols="65" rows="15"></textarea>

            </div>
          </div>
      </div>
      <div class="modal-footer bg-whitesmoke br">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="submit" class="btn btn-primary">Tanggapi</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal Tambah Akun Petugas -->
<div class="modal fade" tabindex="-1" role="dialog" id="petugas">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Buat Akun Petugas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post" class="justify-content-center">
          <div class="form-group">
            <label for="nama">Nama Lengkap</label>
            <input id="nama" type="text" class="form-control" name="nama">
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
            <div class="form-group col-6">
              <label>Level</label>
              <select class="form-control selectric" name="level">
                <option value="a">Admin</option>
                <option value="p">Petugas</option>
              </select>
            </div>
          </div>
      </div>
      <div class="modal-footer bg-whitesmoke br">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="regis" class="btn btn-primary">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Tambah Akun Masyarakat -->
<div class="modal fade" tabindex="-1" role="dialog" id="masyarakat">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Buat Akun Masyarakat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post" class="justify-content-center">
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
      </div>
      <div class="modal-footer bg-whitesmoke br">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="regMas" class="btn btn-primary">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- proses penambahan data -->
<?php
// data tanggapan
if (isset($_POST['submit']))
  if (tanggapi($_POST) > 0) {
    echo
    "
      <script>document.location.href='?hal=laporan&sip=berhasil&msg=Berhasil Menanggapi'</script>
      ";
  } else {
    echo
    "
      <script>document.location.href='?hal=laporan&bad=gagal&msg=Gagal Menanggapi'</script>
      ";
  }
?>