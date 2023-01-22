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
    <h5 class="mb-2">Laporan Pengaduan</h5>
    <div class="card">
      <div class="card-header">
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped" id="table-1">
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
              $dataLap = query("SELECT * FROM tb_masyarakat,tb_pengaduan WHERE tb_pengaduan.id_m = tb_masyarakat.id_m");
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
                    <img alt="<?= $dl['foto'] ?>" src="../../assets/img/<?= $dl['foto'] ?>" class="img-thumbnail" width="150" data-toggle="tooltip" title="<?= $dl['judul_pengaduan'] ?>">
                  </td>
                  <td><?= $dl['tgl_pengaduan'] ?></td>
                  <td>
                    <?php if ($dl['status'] === 'p') : ?>
                      <div class="badge badge-warning shadow-warning">Pending</div>
                    <?php endif; ?>
                    <?php if ($dl['status'] === 'a') : ?>
                      <div class="badge badge-success shadow-success">Accept</div>
                    <?php endif; ?>
                  </td>
                  <td>
                    <a href="#" data-role="ta" data-id="<?= $dl['id_p'] ?>" class="btn btn-sm btn-info" data-toggle="modal" data-target="#tanggapi">Tanggapi</a>
                    <a href="#" class="btn btn-sm btn-danger">Hapus</a>
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