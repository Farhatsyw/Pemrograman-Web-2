<?php
// Tes koneksi.php + tampilkan isi tabel artikel (butuh artikel_db.sql)
include "koneksi.php";

$hasil = mysqli_query($connection,"SELECT * FROM artikel ORDER BY id_artikel") or die(mysqli_error($connection));
echo "Koneksi berhasil. Daftar artikel:<br>";
while ($data = mysqli_fetch_array($hasil))
{
  echo $data['id_artikel'] . ". " . $data['judul'] . " (" . $data['tanggal'] . ")<br>";
}
mysqli_close($connection);
?>
