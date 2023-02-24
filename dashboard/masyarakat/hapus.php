<?php
require '../../config/functions.php';
// Hapus Pengaduan
if (isset($_GET['hp'])) {
  $id = $_GET['hp'];
  $foto = query("SELECT foto FROM tb_pengaduan WHERE id_p = $id ")[0];
  if (numRows("SELECT foto FROM tb_pengaduan WHERE id_p = $id") > 0) {
    if (file_exists("../../assets/img/foto/" . $foto['foto'])) {
      unlink("../../assets/img/foto/" . $foto['foto']);
    }
  }

  mysqli_query($conn, "DELETE FROM tb_pengaduan WHERE id_p = '" . $_GET['hp'] . "' ");
  echo
  "
  <script>
  document.location.href = 'index.php?hal=laporan-saya&sip=1&msg=Berhasil Dihapus'; 
  </script>
  ";
}
