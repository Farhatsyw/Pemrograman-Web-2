<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Buku Tamu</title>
<style>
  body { font-family: Verdana, Arial, sans-serif; font-size: 13px; max-width: 520px; margin: 30px auto; }
  h2 { color: #4a7c2c; }
  td { padding: 5px; vertical-align: top; }
  input[type=text], input[type=email], textarea { width: 330px; padding: 4px; }
</style>
</head>
<body>
<h2>Buku Tamu</h2>
<form action="simpan.php" method="post">
<table>
  <tr><td>Nama</td><td><input type="text" name="nama" maxlength="50" required></td></tr>
  <tr><td>Email</td><td><input type="email" name="email" maxlength="60" required></td></tr>
  <tr><td>Website</td><td><input type="text" name="website" maxlength="60"></td></tr>
  <tr><td>Komentar</td><td><textarea name="komentar" rows="5" required></textarea></td></tr>
  <tr><td></td><td><input type="submit" name="kirim" value="Kirim"> <input type="reset" value="Batal"></td></tr>
</table>
</form>
<p><a href="tampil.php">Lihat Buku Tamu</a></p>
</body>
</html>
