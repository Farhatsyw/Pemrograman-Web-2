<?php
// Form action untuk download-script-form-input-data.php
// Butuh: mahasiswa.sql (database db_mahasiswa) dan koneksi-tutor.php

//cek button (kalau file ini dibuka langsung tanpa lewat form, kembalikan ke form)
if (!isset($_POST['Submit']) || $_POST['Submit'] != "Submit") {
  header("Location: download-script-form-input-data.php");
  exit;
}

//validasi data kosong (jurusan masih "- Pilih Jurusan -" juga dianggap kosong)
if (empty($_POST['id_mahasiswa'])||empty($_POST['nama'])||empty($_POST['alamat'])||empty($_POST['telepon'])||$_POST['jurusan']=="-") {
?>
<script language="JavaScript">
alert('Data Harap Dilengkapi!');
document.location='download-script-form-input-data.php';
</script>
<?php
  exit;
}

include "koneksi-tutor.php";

//amankan input sebelum masuk query
$id_mahasiswa = mysqli_real_escape_string($Open, $_POST['id_mahasiswa']);
$nama         = mysqli_real_escape_string($Open, $_POST['nama']);
$jurusan      = mysqli_real_escape_string($Open, $_POST['jurusan']);
$alamat       = mysqli_real_escape_string($Open, $_POST['alamat']);
$telepon      = mysqli_real_escape_string($Open, $_POST['telepon']);

//cek NIM di database
$cek = mysqli_num_rows(mysqli_query($Open,"SELECT id_mahasiswa FROM mahasiswa WHERE id_mahasiswa='$id_mahasiswa'"));
if ($cek > 0) {
?>
<script language="JavaScript">
alert('NIM sudah dipakai!, silahkan ganti NIM yang lain');
document.location='download-script-form-input-data.php';
</script>
<?php
  mysqli_close($Open);
  exit;
}

//Masukan data ke Table
$input = "INSERT INTO mahasiswa (id_mahasiswa,nama,jurusan,alamat,telepon) VALUES ('$id_mahasiswa','$nama','$jurusan','$alamat','$telepon')";
$query_input = mysqli_query($Open,$input);
if ($query_input) {
  //Jika Sukses
?>
<script language="JavaScript">
alert('Input Data Mahasiswa Berhasil');
document.location='download-script-form-input-data.php';
</script>
<?php
}
else {
  //Jika Gagal
  echo "Input Data Mahasiswa Gagal!, Silahkan diulangi!";
}

//Tutup koneksi engine MySQL
mysqli_close($Open);
?>
