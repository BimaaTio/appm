<div class="row">
  <div class="col">
    <div class="card card-statistic-2">
      <div class="card-wrap">
        <div class="card-header">
          <div class="card-body">
            <h3 class="mb-5">
              Data Akun Masyarakat
            </h3>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <h5 class="mb-2">Kelola Data Akun Masyarakat</h5>
    <div class="card">
      <div class="card-header">
        <button class="btn btn-primary" data-toggle="modal" data-target="#masyarakat">Tambah Akun</button>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped" id="table-1">
            <thead>
              <th>#</th>
              <th>NIK</th>
              <th>Nama</th>
              <th>Username</th>
              <th>Telp</th>
              <th>Tgl buat</th>
              <th></th>
            </thead>
            <tbody>
              <?php $i = 1;
              foreach ($dataMasyarakat as $dm) : ?>
                <tr>
                  <td width="1%"><?= $i++ ?></td>
                  <td><?= $dm['nik'] ?></td>
                  <td><?= $dm['nama'] ?></td>
                  <td><?= $dm['uname'] ?></td>
                  <td><?= $dm['telp'] ?></td>
                  <td><?= $dm['created_at'] ?></td>
                  <td>
                    <a href="hapus.php?mas=<?= $dm['id_m'] ?>" id="hapus" class="btn btn-sm btn-danger shadow-danger">Hapus</a>
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