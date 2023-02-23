<div class="row">
  <div class="col">
    <div class="card card-statistic-2">
      <div class="card-wrap">
        <div class="card-header">
          <div class="card-body">
            <h3 class="mb-5">
              Laporan Pengaduan Masyarakat
            </h3>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12">
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
    <h5 class="mb-2">Laporan Pengaduan</h5>
    <div class="card">
      <div class="card-body">

        <div class="table-responsive">
          <table class="table table-bordered table-striped" id="table-1">
            <thead>
              <tr>
                <th class="text-center">
                  #
                </th>
                <th>Nama Pengadu</th>
                <th>Judul Masalah</th>
                <th>Isi yg diajukan</th>
                <th>Foto</th>
                <th>Tgl</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1;
              foreach ($dataLap as $dl) : ?>
                <tr class="" id="<?= $dl['id_p'] ?>">
                  <td>
                    <?= $i++ ?>
                  </td>
                  <td data-target="pengadu"><?= $dl['nama'] ?></td>
                  <td data-target="judul">
                    <?= $dl['judul_pengaduan'] ?>
                  </td>
                  <td>
                    <?= $dl['isi_laporan'] ?>
                  </td>
                  <td>
                    <img alt="<?= $dl['foto'] ?>" src="../../assets/img/foto/<?= $dl['foto'] ?>" width="150" data-toggle="tooltip" title="<?= $dl['judul_pengaduan'] ?>">
                  </td>
                  <td><?= $dl['tgl_pengaduan'] ?></td>
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
                  </td>
                  <td>
                    <?php if ($dl['status'] !== 'proses' && $dl['status'] !== 'selesai') : ?>
                      <a href="#" data-role="ta" data-id="<?= $dl['id_p'] ?>" class="btn btn-sm btn-info" data-toggle="modal" data-target="#tanggapi">Tanggapi</a>
                      <a href="hapus.php?hp=<?= $dl['id_p'] ?>" id="hapus" class="btn btn-sm btn-danger">Hapus</a>
                    <?php endif; ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>