<?php
// PHP 8.1+ default-nya melempar exception; dimatikan supaya error bisa dicek manual dengan if
mysqli_report(MYSQLI_REPORT_OFF);

$Open = mysqli_connect("localhost","root","");
if (!$Open) {
  die("Tidak dapat terhubung ke MySQL: " . mysqli_connect_error());
}
if (!mysqli_select_db($Open,"db_mahasiswa")) {
  die("Database db_mahasiswa tidak ditemukan. Import dulu mahasiswa.sql");
}
?>
