<?php
require '../../config/functions.php';
$idp = $_GET['idp'];

if (isset($_GET['hp'])) {
  mysqli_query($conn, "DELETE FROM tb_pengaduan WHERE id_p = '" . $_GET['hp'] . "' ");
  echo "
  <script>
      document.location.href = 'index.php?hal=laporan&oke=1&msg=Berhasil Dihapus';
  </script>
  ";
} else {
  echo "
  <script>
      document.location.href = 'index.php?hal=laporan&ops=0&msg=Gagal Dihapus';
  </script>
  ";
}

if (isset($_GET['ht']) && isset($_GET['idp'])) {
  mysqli_query($conn, "DELETE FROM tb_tanggapan WHERE id_t = '" . $_GET['ht'] . "' ");
  mysqli_query($conn, "UPDATE tb_pengaduan SET status = 'p' WHERE id_p = $idp");
  echo "
  <script>
      document.location.href = 'index.php?hal=laporan&oke=1&msg=Berhasil Dihapus';
  </script>
  ";
} else {

  echo "
  <script>
      document.location.href = 'index.php?hal=laporan&ops=0&msg=Gagal Dihapus';
  </script>
  ";
}
