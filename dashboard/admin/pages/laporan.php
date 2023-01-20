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
        <!-- form filter data berdasarkan range tanggal  -->
        <form action="index.php" method="get">
          <div class="row g-3 align-items-center">
            <div class="col-auto">
              <label class="col-form-label">Periode</label>
            </div>
            <div class="col-auto">
              <input type="date" class="form-control" name="dari" required>
            </div>
            <div class="col-auto">
              -
            </div>
            <div class="col-auto">
              <input type="date" class="form-control" name="ke" required>
            </div>
            <div class="col-auto">
              <button class="btn btn-primary" type="submit">Cari</button>
            </div>
          </div>
        </form>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped" id="table-1">
            <thead>
              <tr>
                <th class="text-center">
                  #
                </th>
                <th>Nama Pengaju</th>
                <th>Judul Masalah</th>
                <th>Isi yg diajukan</th>
                <th>Foto</th>
                <th>Tgl</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              //Filter by range tanggal
              if(isset($_GET['dari']) && isset($_GET['ke'])){
                //Tampilkan hasil data dari range tgl yg di input
                $dataLap = query("SELECT * FROM tb_pengaduan WHERE tgl_pengaduan BETWEEN '".$_GET['dari']."' and '".$_GET['ke']."'");
              } else {
                $dataLap = query("SELECT tb_masyarakat.nama,tb_pengaduan.judul_pengaduan,tb_pengaduan.isi_laporan,tb_pengaduan.foto,tb_pengaduan.tgl_pengaduan,tb_pengaduan.status FROM tb_masyarakat,tb_pengaduan WHERE tb_masyarakat.id_m = tb_pengaduan.id_m");
              }
              $i = 1;
              ?>
              <?php foreach($dataLap as $dl) :?>
              <tr class="align-middle">
                <td>
                  <?= $i++ ?>
                </td>
                <td><?= $dl['nama'] ?></td>
                <td>
                  <?= $dl['judul_pengaduan'] ?>
                </td>
                <td>
                  <?= $dl['isi_laporan'] ?>
                </td>
                <td>
                  <img alt="image" src="../../assets/template/dist/assets/img/avatar/avatar-5.png" class="img-thumbnail"
                    width="150" data-toggle="tooltip" title="Wildan Ahdian">
                </td>
                <td><?= $dl['tgl_pengaduan'] ?></td>
                <td>
                  <div class="badge badge-warning shadow-warning">Pending</div>
                </td>
                <td>
                  <a href="#" class="btn btn-sm btn-info">Tanggapi</a>
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