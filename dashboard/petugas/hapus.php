<?php
require '../../config/functions.php';
// Hapus Pengaduan
if (isset($_GET['hp'])) {
  mysqli_query($conn, "DELETE FROM tb_pengaduan WHERE id_p = '" . $_GET['hp'] . "' ");
  echo
  "
  <script>
      document.location.href = 'index.php?hal=laporan&oke=1&msg=Berhasil Dihapus';
  </script>
  ";
}
// Hapus Tanggapan dan jika berhasil ubah status pengaduan menjadi pending lagi berdasarkan id yang didapatkan dari parameter $_GET['ht'] & $_GET['idp']
if (isset($_GET['ht']) && isset($_GET['idp'])) {
  $idp = $_GET['idp'];
  mysqli_query($conn, "DELETE FROM tb_tanggapan WHERE id_t = '" . $_GET['ht'] . "' ");
  mysqli_query($conn, "UPDATE tb_pengaduan SET status = 'p' WHERE id_p = $idp");
  echo "
  <script>
      document.location.href = 'index.php?hal=laporan&oke=1&msg=Berhasil Dihapus';
  </script>
  ";
}