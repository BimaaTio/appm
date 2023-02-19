<!-- File Ini akan berisi tentang function yang akan sering digunakan -->
<?php
date_default_timezone_set("Asia/Jakarta");
//Base URL
define(
  'URL',
  'http://localhost/appm/'
);
//============================================
//Koneksi
$host   = 'localhost';
$name   = 'root';
$pass   = '';
$dbname = 'db_appm';
//Var conn untuk menyambungkan website ke database
$conn   = mysqli_connect($host, $name, $pass, $dbname);
// debugging jika koneksi errorr
if (mysqli_error($conn)) {
  die("Connection failed: " . mysqli_error($conn));
}
//===============================================
//Query ->  Fetch ke array associative
function query($query)
{
  global $conn;
  $result = mysqli_query($conn, $query);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}
//===============================================
//Num rows -> hitung data database 
function numRows($query)
{
  global $conn;
  $result = mysqli_query($conn, $query);
  $total = mysqli_num_rows($result);
  return $total;
}
//===============================================
//Rand Number (id)
function randNumb($lenght = 10)
{
  $num = '1234567890';
  $lenght = strlen($num);
  $random = '';
  for ($i = 1; $i < $lenght; $i++) {
    $random .= $num[rand(0, $lenght - 1)];
  }
  return $random;
}
//==============================================
//Register User 
function regUser($data)
{
  global $conn;

  $uid   = substr(randNumb(), 4);
  $nama  = ucwords(htmlspecialchars(stripslashes($data['nama'])));
  $uname = htmlspecialchars(stripslashes($data['uname']));
  $pass  = mysqli_real_escape_string($conn, $data['pass']);
  $pass2 = mysqli_real_escape_string($conn, $data['pass2']);
  $telp  = formatNomor($data['telp']);
  $level = $data['level'];
  $tgl   = date("d-m-Y H:i:s");

  // Pengecekan username sudah ada atau belum
  $cek   = query("SELECT * FROM tb_user WHERE uname = '$uname' ");
  if ($cek) {
    echo
    "
      <script>
      alert('Email Sudah ada!, Silahkan Gunakan Email lain')
      </script>
      ";
    return false;
  }
  // cek jika konfirmasi password tidak sama
  if ($pass != $pass2) {
    echo
    "
      <script>
      alert('Password Tidak Sesuai!, Silahkan cek Kembali Passwordnya!')
      </script>
      ";
    return false;
  }
  // Encrypt password yang akan dimasukan kedalam database
  $password = password_hash($pass, PASSWORD_BCRYPT);
  // query insert / memasukan data yang di input ke database
  mysqli_query($conn, "INSERT INTO tb_user VALUES($uid, '$nama', '$uname', '$password', '$telp', '$level', '$tgl')");
  return mysqli_affected_rows($conn);
}
//=======================================================
//Registrasi Akun Masyarakat
function regMas($data)
{
  global $conn;
  $idm = substr(randNumb(), 4);
  $nik = htmlspecialchars($data['nik']);
  $nama = ucwords(htmlspecialchars($data['nama']));
  $uname = htmlspecialchars($data['uname']);
  $pass  = mysqli_real_escape_string($conn, $data['pass']);
  $pass2 = mysqli_real_escape_string($conn, $data['pass2']);
  $telp  = formatNomor($data['telp']);
  // $tgl   = date("d-m-Y H:i:s");

  // Pengecekan username sudah ada atau belum
  $cek   = query("SELECT * FROM tb_masyarakat WHERE uname = '$uname' ");
  if ($cek) {
    echo
    "
      <script>
      alert('Username Sudah ada!, Silahkan Gunakan Username lain')
      </script>
      ";
    return false;
  }
  // cek jika konfirmasi password tidak sama
  if ($pass != $pass2) {
    echo
    "
      <script>
      alert('Password Tidak Sesuai!, Silahkan cek Kembali Passwordnya!')
      </script>
      ";
    return false;
  }
  // Encrypt password yang akan dimasukan kedalam database
  $password = password_hash($pass, PASSWORD_BCRYPT);
  // query insert / memasukan data yang di input ke database
  mysqli_query($conn, "INSERT INTO tb_masyarakat VALUES($idm,'$nik','$nama','$uname','$password','$telp', CURDATE())");
  return mysqli_affected_rows($conn);
}
//=======================================================

//Format Number id (+62)
function formatNomor($nomorhp)
{
  //Terlebih dahulu kita trim dl
  $nomorhp = trim($nomorhp);
  //bersihkan dari karakter yang tidak perlu
  $nomorhp = strip_tags($nomorhp);
  // Berishkan dari spasi
  $nomorhp = str_replace(" ", "", $nomorhp);
  // bersihkan dari bentuk seperti  (022) 66677788
  $nomorhp = str_replace("(", "", $nomorhp);
  // bersihkan dari format yang ada titik seperti 0811.222.333.4
  $nomorhp = str_replace(".", "", $nomorhp);

  //cek apakah mengandung karakter + dan 0-9
  if (!preg_match('/[^+0-9]/', trim($nomorhp))) {
    // cek apakah no hp karakter 1-3 adalah +62
    if (substr(trim($nomorhp), 0, 3) == '+62') {
      $nomorhp = trim($nomorhp);
    }
    // cek apakah no hp karakter 1 adalah 0
    elseif (substr($nomorhp, 0, 1) == '0') {
      $nomorhp = '+62' . substr($nomorhp, 1);
    }
  }
  return $nomorhp;
}
//=======================================================
function lapor($data)
{
  global $conn;
  $idp = substr(randNumb(), 4);
  $idm = $data['idm'];
  $judul = ucwords(htmlspecialchars($data['judul']));
  $isi = ucwords($data['isi']);
  $foto = foto();
  if (!foto()) {
    return false;
  }
  $status = 'p';

  // query insert ke database
  mysqli_query($conn, "INSERT INTO tb_pengaduan VALUES($idp,$idm,CURDATE(),'$judul','$isi','$foto','$status')");
  return mysqli_affected_rows($conn);
}
//=======================================================
//Function Menanggapi laporan pengaduan
function tanggapi($data)
{
  global $conn;

  $idt = substr(randNumb(), 4);
  $idp = $data['idp'];
  $uid = $data['uid'];
  $isi = ucwords(stripslashes($data['tanggapan']));

  // query insert tanggapan
  $query = "INSERT INTO tb_tanggapan VALUES($idt,$idp, CURDATE(),'$isi',$uid)";
  mysqli_query($conn, $query);

  //JIka sudah insert ubah status tanggapan menjadi a
  mysqli_query($conn, "UPDATE tb_pengaduan SET status = 'a' WHERE id_p = $idp ");
  return mysqli_affected_rows($conn);
}
//========================================================
//Upload Foto
function foto()
{

  $namaFile = $_FILES['foto']['name'];
  $ukuranFile = $_FILES['foto']['size'];
  $error = $_FILES['foto']['error'];
  $tmpName = $_FILES['foto']['tmp_name'];
  //Cek gambar 

  if (
    $error === 4
  ) {
    echo "<script>
                alert('Pilih gambar terlebih dahulu')
              </script>";
    return false;
  }

  // file type
  $ekstensiGambarValid = ['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG'];
  $formatFile = explode('.', $namaFile);
  $formatFile = strtolower(end($formatFile));

  if (!in_array($formatFile, $ekstensiGambarValid)) {
    echo "<script>
                alert('Format File tidak sesuai')
              </script>";
    return false;
  }

  // cek size

  if ($ukuranFile > 3000000) {
    echo "<script>
                alert('File size Max 3MB')
              </script>";
    return false;
  }


  // lolos cek
  // generate nama gambar

  $namaBaru = 'laporan' . substr(randNumb(), 5);
  $namaBaru .= '.';
  $namaBaru .= $formatFile;


  move_uploaded_file($tmpName, '../../assets/img/foto/' . $namaBaru);

  return $namaBaru;
}
//========================================================
//Update Profile
function updateProfil($data)
{
  global $conn;

  $uid      = $data['uid'];
  $fullName = ucwords(htmlspecialchars($data['fn']));
  $username = ucwords(htmlspecialchars($data['uname']));
  $telp     = htmlspecialchars($data['telp']);

  $query    = "UPDATE tb_user SET 
                nama = '$fullName',
                uname = '$username',
                telp  = '$telp'            
                WHERE uid = $uid";

  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}
//======================================================
function logo()
{
  $namaFile = $_FILES['logo']['name'];
  $ukuranFile = $_FILES['logo']['size'];
  $error = $_FILES['logo']['error'];
  $tmpName = $_FILES['logo']['tmp_name'];
  //Cek gambar 

  if (
    $error === 4
  ) {
    echo "<script>
                alert('Pilih gambar terlebih dahulu')
              </script>";
    return false;
  }

  // file type
  $ekstensiGambarValid = ['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG'];
  $formatFile = explode('.', $namaFile);
  $formatFile = strtolower(end($formatFile));

  if (!in_array($formatFile, $ekstensiGambarValid)) {
    echo "<script>
                alert('Format File tidak sesuai')
              </script>";
    return false;
  }

  // cek size

  if ($ukuranFile > 3000000) {
    echo "<script>
                alert('File size Max 3MB')
              </script>";
    return false;
  }


  // lolos cek
  // generate nama gambar

  $namaBaru = 'logo' . substr(randNumb(), 5);
  $namaBaru .= '.';
  $namaBaru .= $formatFile;


  move_uploaded_file($tmpName, '../../assets/img/foto/' . $namaBaru);

  return $namaBaru;
}
//======================================================
//Update Tampilan WEB
function setting($data)
{
  global $conn;

  $namaWeb = ucwords(htmlspecialchars($data['web']));
  $logoLama    = $data['logoLama'];
  $slogan = ucwords(htmlspecialchars($data['slogan']));
  $singkatan = ucwords(htmlspecialchars(strtoupper($data['singkatan'])));
  $desk = ucfirst($data['desk']);
  // cek jika tidak ganti logo
  if ($_FILES['logo']['error'] === 4) {
    $logo = $logoLama;
  } else {
    $logo = logo();
    unlink("../../assets/img/foto/" . $logoLama);
  }

  $query = "UPDATE tb_setting SET nama_web = '$namaWeb', logo = '$logo', singkatan = '$singkatan', deskripsi = '$desk'";
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}
