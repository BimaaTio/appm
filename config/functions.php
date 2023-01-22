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
$conn   = mysqli_connect($host,$name,$pass,$dbname);
// debugging jika koneksi errorr
if(mysqli_error($conn))
{
  die("Connection failed: " . mysqli_error($conn));
}
//===============================================
//Query ->  Fetch ke array associative
function query($query)
{
  global $conn;
  $result = mysqli_query($conn, $query);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)
  ) {
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
function regUser($data) {
  global $conn;

  $uid   = substr(randNumb(), 4);
  $nama  = ucwords(htmlspecialchars(stripslashes($data['nama'])));
  $uname = ucwords(htmlspecialchars(stripslashes($data['uname'])));
  $pass  = mysqli_real_escape_string($conn, $data['pass']);
  $pass2 = mysqli_real_escape_string($conn, $data['pass2']);
  $telp  = formatNomor($data['telp']);
  $level = $data['level'];
  $tgl   = date("d-m-Y H:i:s");
  
  // Pengecekan username sudah ada atau belum
  $cek   = query("SELECT * FROM tb_user WHERE uname = '$uname' ");
  if($cek){
    echo
      "
      <script>
      alert('Email Sudah ada!, Silahkan Gunakan Email lain')
      </script>
      ";
      return false;
  } 
  // cek jika konfirmasi password tidak sama
  if($pass != $pass2){
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
  mysqli_query($conn,"INSERT INTO tb_user VALUES($uid, '$nama', '$uname', '$password', '$telp', '$level', '$tgl')");
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
//Function Menanggapi laporan pengaduan
function tanggapi($data)
{
  global $conn;

  $idt = substr(randNumb(), 4);
  $idp = $data['idp'];
  $uid = $data['uid'];
  $tgl = date("d-m-Y H:i:s");
  $isi = ucwords(stripslashes($data['tanggapan']));

  // query insert tanggapan
  $query = "INSERT INTO tb_tanggapan VALUES($idt,$idp,'$tgl','$isi',$uid)";
  mysqli_query($conn, $query);

  //JIka sudah insert ubah status tanggapan menjadi a
  mysqli_query($conn, "UPDATE tb_pengaduan SET status = 'a' ");
  return mysqli_affected_rows($conn);
}