<?php
// Menyimpan isian buku tamu ke database
include "koneksi.php";

if (!isset($_POST['kirim'])) {
    header("Location: form.php");
    exit;
}

$nama     = trim($_POST['nama']);
$email    = trim($_POST['email']);
$website  = trim($_POST['website']);
$komentar = trim($_POST['komentar']);

if ($nama == "" || $email == "" || $komentar == "") {
    echo "<script>alert('Nama, email, dan komentar wajib diisi!'); history.back();</script>";
    exit;
}

$stmt = mysqli_prepare($conn, "INSERT INTO buku_tamu (nama, email, website, komentar) VALUES (?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, "ssss", $nama, $email, $website, $komentar);

if (mysqli_stmt_execute($stmt)) {
    echo "<script>alert('Terima kasih, komentar Anda tersimpan.'); document.location='tampil.php';</script>";
} else {
    echo "Gagal menyimpan: " . mysqli_error($conn);
}
mysqli_close($conn);
?>
