<div class="row">
  <div class="col">
    <div class="card card-statistic-2">
      <div class="card-wrap">
        <div class="card-header">
          <div class="card-body">
            <h3 class="mb-5">
              Data Laporan Saya
            </h3>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <h5 class="mb-2">Laporan Saya</h5>
    <?php if (isset($_GET['sip']) == 'berhasil' && isset($_GET['msg'])) : ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Siip!</strong> <?= $_GET['msg'] ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php endif; ?>
    <?php if (isset($_GET['bad']) == 'gagal' && isset($_GET['msg'])) : ?>
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Oops!</strong> <?= $_GET['msg'] ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php endif; ?>
    <div class="card">
      <div class="card-header">
        <a href="?hal=formulir" class="btn btn-success shadow-success">Buat Laporan</a>
      </div>
      <div class="card-body">
        <table class="table table-bordered table-reponsive table-stripped" id="table-1">
          <thead class="text-center">
            <tr>
              <th width="1%">NO</th>
              <th>JUDUL LAPORAN</th>
              <th>ISI LAPORAN</th>
              <th>FOTO</th>
              <th>STATUS</th>
              <th>AKSI</th>
            </tr>
          </thead>
          <tbody class="text-center">
            <?php $no = 1;
            foreach ($dataLap as $dl) : ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= $dl['judul_pengaduan'] ?></td>
                <td><?= $dl['isi_laporan'] ?></td>
                <td>
                  <img alt="<?= $dl['foto'] ?>" src="../../assets/img/foto/<?= $dl['foto'] ?>" width="150" data-toggle="tooltip" title="<?= $dl['judul_pengaduan'] ?>">
                </td>
                <td>
                  <?php if ($dl['status'] === 'tunggu') : ?>
                    <span class="dropdown">
                      <btn class="dropdown-toggle badge badge-warning shadow-warning">Menunggu</btn>
                    </span>
                  <?php endif; ?>
                  <?php if ($dl['status'] === 'proses') : ?>
                    <div class="badge badge-info shadow-info">Diproses</div>
                  <?php endif; ?>
                  <?php if ($dl['status'] === 'selesai') : ?>
                    <div class="badge badge-success shadow-success">Selesai</div>
                  <?php endif; ?>
                  <?php if ($dl['status'] === 'ditolak') : ?>
                    <div class="badge badge-danger shadow-danger">Ditolak</div>
                  <?php endif; ?>
                </td>
                <td></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>