<?php
// Membuat koneksi ke database artikel_db (materi: Menambah, mengedit dan menghapus artikel)
// Catatan: PHP 8.1+ secara default melempar exception saat query/koneksi error.
// Dimatikan supaya alurnya sama dengan slide (cek manual pakai if).
mysqli_report(MYSQLI_REPORT_OFF);

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "artikel_db";

//lakukan koneksi dengan mysql
$connection = mysqli_connect($dbhost,$dbuser,$dbpass);
if(!$connection)
{
  echo "Tidak dapat terhubung dengan database";
  exit;
}

//pilih database
$pilih_db = mysqli_select_db($connection,$dbname);
if(!$pilih_db)
{
  echo "Tidak dapat memilih database";
  exit;
}
?>
