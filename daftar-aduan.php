<?php
session_start();
if (!isset($_SESSION['aduan'])) {
  header("Location:login.php?bad=Silahkan Login Dahulu");
  exit;
}
require 'config/functions.php';

// data website
$w = query("SELECT * FROM tb_setting")[0];

// Pagination
$jmlDataPerHal = 6;
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
  <link rel="shortcut icon" href="assets/img/foto/<?= $w['logo'] ?>" type="image/x-icon">
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
        <a class="navbar-brand" href="#">
          <img src="assets/img/foto/<?= $w['logo'] ?>" alt="Bootstrap" width="58" height="54" class="me-2">
          <?= $w['nama_web'] ?> </a>
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
              <a href="daftar-aduan.php" class="nav-link active">Daftar Aduan</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-fill"></i>
              </a>
              <ul class="dropdown-menu">
                <?php if (isset($_SESSION['logAdmin'])) : ?>
                  <li><a class='dropdown-item' href='dashboard/admin/?hal='>Dashboard</a></li>
                <?php endif; ?>
                <?php if (isset($_SESSION['logPetugas'])) : ?>
                  <li><a class='dropdown-item' href='dashboard/petugas/?hal='>Dashboard</a></li>
                <?php endif; ?>
                <?php if (isset($_SESSION['logMasyarakat'])) : ?>
                  <li><a class='dropdown-item' href='dashboard/masyarakat/?hal='>Dashboard</a></li>
                <?php endif; ?>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="dashboard/logout.php">Logout</a></li>
              </ul>
            </li>
          <?php else : ?>
            <li class="nav-item">
              <a href="login.php" class="nav-link">Login</a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Konten -->
  <div class="container">
    <h1 class="text-center mt-3 mb-3 fw-bold">Daftar Aduan</h1>
    <hr>

    <div class="row row-cols-1 row-cols-md-3 g-4 mt-4">
      <?php
      if (count($data) > 0) :
        foreach ($data as $d) :
      ?>

          <div class="col">
            <div class="card h-100">
              <img src="assets/img/foto/<?= $d['foto'] ?>" class="card-img-top" alt="<?= $d['foto'] ?>" />
              <div class="card-body">
                <h5 class="card-title"><?= $d['judul_pengaduan'] ?></h5>
                <p class="card-text">
                <ul class="list-unstyled mt-2">
                  <li>Isi : <?= $d['isi_laporan'] ?></li>
                  <li>Tanggapan : <?= $d['tanggapan'] ?></li>
                  <li>Yang Menanggapi : <?= $d['nama'] ?></li>
                </ul>
                </p>
              </div>
              <div class="card-footer">
                <small class="text-muted"><?= $d['tgl_tanggapan'] ?></small>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else : ?>
        Tidak Ada Data!!
      <?php endif; ?>

    </div>



    <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-center mt-5">
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
    <a href="#" onclick="history.back()" class="btn btn-primary my-3 m-auto">Kembali</a>
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
  </script>
</body>

</html>