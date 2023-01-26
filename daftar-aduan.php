<?php
session_start();
if (!isset($_SESSION['aduan'])) {
  header("Location:login.php?bad=Silahkan Login Dahulu");
  exit;
}
require 'config/functions.php';


// Pagination
$jmlDataPerHal = 4;
$jmlData = count(query("SELECT * FROM tb_pengaduan,tb_tanggapan,tb_user WHERE tb_pengaduan.id_p = tb_tanggapan.id_p AND tb_tanggapan.uid = tb_user.uid"));
$jmlHal  = ceil($jmlData / $jmlDataPerHal);
$halAktif = (isset($_GET['halaman'])) ? $_GET['halaman'] : 1;
$awalData = ($jmlDataPerHal * $halAktif) - $jmlDataPerHal;

$data = query("SELECT * FROM tb_pengaduan,tb_tanggapan,tb_user WHERE tb_pengaduan.id_p = tb_tanggapan.id_p AND tb_tanggapan.uid = tb_user.uid LIMIT $awalData,$jmlDataPerHal");
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>APPM &mdash; Daftar-aduan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css" integrity="sha512-YFENbnqHbCRmJt5d+9lHimyEMt8LKSNTMLSaHjvsclnZGICeY/0KYEeiHwD1Ux4Tcao0h60tdcMv+0GljvWyHg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    * {
      font-family: 'Poppins', sans-serif;
    }

    body {
      overflow-x: hidden;
    }
  </style>
</head>

<body>
  <!-- Navbars -->
  <nav class="navbar navbar-expand-lg navbar-dark" style="background-color:#6777ef;">
    <div class="container">
      <div class="d-flex flex-grow-1">
        <span class="w-100 d-lg-none d-block">
          <!-- hidden spacer to center brand on mobile --></span>
        <a class="navbar-brand" href="#"> Aplikasi Pengaduan Pelaporan Masyarakat </a>
        <div class="w-100 text-right">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#myNavbar7">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
      </div>
      <div class="collapse navbar-collapse flex-grow-1 text-right" id="myNavbar7">
        <ul class="navbar-nav ms-auto flex-nowrap">
          <li class="nav-item">
            <a href="index.php" class="nav-link">Home</a>
          </li>
          <?php if (isset($_SESSION['aduan'])) : ?>
            <li class="nav-item">
              <a href="#" class="nav-link">Daftar Aduan</a>
            </li>
          <?php endif; ?>
          <li class="nav-item">
            <a href="dashboard/masyarakat/logout.php" class="nav-link">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- /Navbar -->
  <!-- Konten -->
  <div class="container">
    <h1 class="text-center mt-3 mb-3 fw-bold">Daftar Aduan</h1>
    <hr>

    <div class="row">
      <?php
      if (count($data) > 0) :
        foreach ($data as $d) :
      ?>
          <div class="col-md-4 mb-2 mt-2">
            <div class="card">

              <div class="card-header"><?= $d['judul_pengaduan'] ?></div>
              <div class="card-body">
                <img src="assets/img/foto/<?= $d['foto'] ?>" class="img-thumbnail" alt="">
                <ul class="list-unstyled mt-2">
                  <li>Isi : <?= $d['isi_laporan'] ?></li>
                  <li>Tanggapan : <?= $d['tanggapan'] ?></li>
                  <li>Yang Menanggapi : <?= $d['nama'] ?></li>
                </ul>
              </div>
              <div class="card-footer">
                <p class="muted">Tgl : <?= $d['tgl_tanggapan'] ?></p>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else : ?>
        Tidak Ada Data!!
      <?php endif; ?>
    </div>

    <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-center">
        <?php if ($halAktif > 1) : ?>
          <li class="page-item">
            <a class="page-link" href="?halaman=<?= $halAktif - 1 ?>" tabindex="-1" aria-disabled="true">Previous</a>
          </li>
        <?php endif; ?>
        <?php for ($i = 1; $i <= $jmlHal; $i++) : ?>
          <?php if ($i == $halAktif) : ?>
            <li class="page-item active"><a class="page-link" href="?halaman=<?= $i ?>"><?= $i ?></a></li>
          <?php else : ?>
            <li class="page-item"><a class="page-link " href="?halaman=<?= $i ?>"><?= $i ?></a></li>
          <?php endif; ?>
        <?php endfor; ?>
        <?php if ($halAktif < $jmlHal) : ?>
          <li class="page-item">
            <a class="page-link" href="?halaman=<?= $halAktif + 1 ?> ">Next</a>
          </li>
        <?php endif; ?>
      </ul>
    </nav>
  </div>
  <!-- /Konten -->
  <!-- Footer -->
  <div class="container">
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
      <div class="col-md-4 d-flex align-items-center">
        <a href="https://instagram.com/bimatio_" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
          <span class="mb-3 mb-md-0 text-muted">Copyright 2023 &copy; Bimatio_</span>
        </a>
      </div>

      <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
        <li class="ms-3"><a class="text-muted" href="https://instagram.com/bimatio_"><i class="bi bi-instagram" width="24" height="24"></i></a></li>
        <li class="ms-3"><a class="text-muted" href="https://wa.me/6288802791267"><i class="bi bi-whatsapp" width="24" height="24"></i></a></li>
        <li class="ms-3"><a class="text-muted" href="#"><i class="bi bi-facebook" width="24" height="24"></i></a></li>
      </ul>
    </footer>
  </div>
</body>

</html>