<?php
// Menampilkan buku tamu, 5 record per halaman (paging)
include "koneksi.php";

$per_halaman = 5;
$halaman     = isset($_GET['hal']) ? (int)$_GET['hal'] : 1;
if ($halaman < 1) $halaman = 1;

// total data & total halaman  (mysql_num_rows)
$q_total       = mysqli_query($conn, "SELECT id FROM buku_tamu");
$total_data    = mysqli_num_rows($q_total);
$total_halaman = max(1, ceil($total_data / $per_halaman));
if ($halaman > $total_halaman) $halaman = $total_halaman;

$mulai = ($halaman - 1) * $per_halaman;
$hasil = mysqli_query($conn, "SELECT * FROM buku_tamu ORDER BY id DESC LIMIT $mulai, $per_halaman");
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Daftar Buku Tamu</title>
<style>
  body { font-family: Verdana, Arial, sans-serif; font-size: 13px; max-width: 620px; margin: 30px auto; }
  h2 { color: #4a7c2c; }
  .entri { border: 1px solid #b5d99c; border-radius: 4px; padding: 10px; margin-bottom: 10px; }
  .entri small { color: #777; }
  .paging a, .paging b { display: inline-block; padding: 3px 9px; margin-right: 3px; border: 1px solid #4a7c2c; text-decoration: none; }
  .paging b { background: #4a7c2c; color: #fff; }
</style>
</head>
<body>
<h2>Daftar Buku Tamu</h2>
<p>Total: <?php echo $total_data; ?> komentar | <a href="form.php">+ Isi buku tamu</a></p>

<?php
if ($total_data == 0) {
    echo "<p><i>Belum ada komentar.</i></p>";
}
while ($d = mysqli_fetch_array($hasil)) {
    echo "<div class='entri'>";
    echo "<b>" . htmlspecialchars($d['nama']) . "</b> ";
    echo "<small>(" . htmlspecialchars($d['email']) . ")";
    if ($d['website'] != "") echo " - " . htmlspecialchars($d['website']);
    echo " - " . $d['tanggal'] . "</small>";
    echo "<p>" . nl2br(htmlspecialchars($d['komentar'])) . "</p>";
    echo "</div>";
}
?>

<div class="paging">
<?php
if ($halaman > 1) echo "<a href='?hal=" . ($halaman - 1) . "'>&laquo; Prev</a>";
for ($i = 1; $i <= $total_halaman; $i++) {
    if ($i == $halaman) echo "<b>$i</b>";
    else echo "<a href='?hal=$i'>$i</a>";
}
if ($halaman < $total_halaman) echo "<a href='?hal=" . ($halaman + 1) . "'>Next &raquo;</a>";
?>
</div>
</body>
</html>
