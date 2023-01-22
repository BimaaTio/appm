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
        <form action="" method="post" class="form-inline">
          <input type="date" name="start" class="mr-2 form-control">
          <input type="date" name="end" class="ml-2 form-control">
          <button type="submit" name="filterLap" class="btn btn-info ml-3">Filter</button>
        </form>
      </div>
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
              if (isset($_POST['filterLap'])) {
                $start = $_POST['start'];
                $end   = $_POST['end'];
                $dataLap = query("SELECT * FROM tb_masyarakat,tb_pengaduan,tb_tanggapan WHERE tb_pengaduan.id_m = tb_masyarakat.id_m AND tb_pengaduan.id_p = tb_tanggapan.id_p AND tb_pengaduan.tgl_pengaduan BETWEEN '$start' AND DATE_ADD('$end', INTERVAL 1 DAY)");
              } else {
                $dataLap = query("SELECT * FROM tb_masyarakat,tb_pengaduan WHERE tb_pengaduan.id_m = tb_masyarakat.id_m");
              }
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
                    <?php if ($dl['status'] !== 'a') : ?>
                      <a href="#" data-role="ta" data-id="<?= $dl['id_p'] ?>" class="btn btn-sm btn-info" data-toggle="modal" data-target="#tanggapi">Tanggapi</a>

                      <a href="hapus.php?hp=<?= $dl['id_p'] ?>" id="hapus" class="btn btn-sm btn-danger">Hapus</a>
                  </td>
                <?php endif ?>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>



<!-- Table Laporan yanf sudah ditanggapi -->

<div class="row mt-5">
  <div class="col-12">
    <h5 class="mb-2">Laporan Yang Sudah Ditanggapi</h5>
    <div class="card">
      <div class="card-header">
        <form action="" method="post" class="form-inline">
          <input type="date" name="start" class="mr-2 form-control">
          <input type="date" name="end" class="ml-2 form-control">
          <button type="submit" name="filterTang" class="btn btn-info ml-3">Filter</button>
        </form>
      </div>
      <div class="card-body">
        <div class="table-responsive" id="buton">
          <table class="table table-bordered table-striped" id="table-2">
            <thead>
              <th>#</th>
              <th>Nama Petugas</th>
              <th>Judul Pengaduan</th>
              <th>Tgl Tanggapan</th>
              <th>Isi Tanggapan</th>
              <th></th>
            </thead>
            <tbody>
              <?php
              if (isset($_POST['filterTang'])) {
                $start = $_POST['start'];
                $end   = $_POST['end'];
                $tanggapan = query("SELECT * FROM tb_pengaduan,tb_tanggapan,tb_user WHERE tb_pengaduan.id_p = tb_tanggapan.id_p AND tb_tanggapan.uid = tb_user.uid AND tb_tanggapan.tgl_tanggapan BETWEEN '$start' AND DATE_ADD('$end', INTERVAL 1 DAY)");
              } else {
                $tanggapan = query("SELECT * FROM tb_pengaduan,tb_tanggapan,tb_user WHERE tb_pengaduan.id_p = tb_tanggapan.id_p AND tb_tanggapan.uid = tb_user.uid");
              }
              $n = 1;
              foreach ($tanggapan as $t) :
              ?>
                <tr <?= $t['id_t'] ?>>
                  <td><?= $n++ ?></td>
                  <td><?= $t['nama'] ?></td>
                  <td><?= $t['judul_pengaduan'] ?></td>
                  <td><?= $t['tgl_tanggapan'] ?></td>
                  <td><?= $t['isi_laporan'] ?></td>
                  <td>
                    <a href="hapus.php?ht=<?= $t['id_t'] ?>&idp=<?= $t['id_p'] ?>" id="hapus" class="btn btn-sm btn-danger">Hapus</a>
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