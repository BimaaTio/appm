<div class="row">
  <div class="col">
    <div class="card card-statistic-2">
      <div class="card-wrap">
        <div class="card-header">
          <div class="card-body">
            <h3 class="mb-5">
              <marquee behavior="" direction="">Selamat Datang <?= $data['nama'] ?> di Dashboard</marquee>
            </h3>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-4 col-md-4 col-sm-12">
    <div class="card card-statistic-2">
      <div class="card-icon shadow-info bg-info">
        <i class="fas fa-file"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Data Laporan (Diproses)</h4>
        </div>
        <div class="card-body">
          <?= $rowLapProses ?>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-md-4 col-sm-12">
    <div class="card card-statistic-2">
      <div class="card-icon shadow-success bg-success">
        <i class="fas fa-file"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Total Yang Sudah Selesai</h4>
        </div>
        <div class="card-body">
          <?= $rowLapSelesai ?>
        </div>
      </div>
    </div>
  </div>
</div>