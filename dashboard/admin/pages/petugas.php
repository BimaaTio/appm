<div class="row">
  <div class="col">
    <div class="card card-statistic-2">
      <div class="card-wrap">
        <div class="card-header">
          <div class="card-body">
            <h3 class="mb-5">
              Data Akun Petugas
            </h3>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <h5 class="mb-2">Kelola Data Akun Petugas</h5>
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
        <button class="btn btn-primary" data-toggle="modal" data-target="#petugas">Tambah Akun</button>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped" id="table-1">
            <thead>
              <th>#</th>
              <th>Nama</th>
              <th>Username</th>
              <th>Telp</th>
              <th>Level</th>
              <th>Tgl buat</th>
              <th></th>
            </thead>
            <tbody>
              <?php
              $user = query("SELECT * FROM tb_user");
              $i = 1;
              foreach ($user as $u) :
              ?>
                <tr>
                  <td><?= $i++ ?></td>
                  <td><?= $u['nama'] ?></td>
                  <td><?= $u['uname'] ?></td>
                  <td><?= $u['telp'] ?></td>
                  <td>
                    <?php if ($u['level'] == 'a') : ?>
                      <div class="badge badge-info shadow-info">Admin</div>
                    <?php endif;
                    if ($u['level'] == 'p') : ?>
                      <div class="badge badge-warning shadow-warning">Petugas</div>
                    <?php endif; ?>
                  </td>
                  <td><?= $u['created_at'] ?></td>
                  <td>
                    <a href="hapus.php?user=<?= $u['uid'] ?>" id="hapus" class="btn btn-sm btn-danger shadow-danger">Hapus</a>
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