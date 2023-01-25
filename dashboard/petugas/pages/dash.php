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
      <div class="card-icon shadow-warning bg-warning">
        <i class="fas fa-file"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Total Pengaduan (Pending)</h4>
        </div>
        <div class="card-body">
          <?= $rowLapP ?>
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
          <h4>Total Yang Sudah Ditanggapi</h4>
        </div>
        <div class="card-body">
          <?= $rowLapA ?>
        </div>
      </div>
    </div>
  </div>
</div>