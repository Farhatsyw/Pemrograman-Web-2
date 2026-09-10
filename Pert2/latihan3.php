<?php
// cek apakah form sudah disubmit
$hasil = null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nilai1 = $_POST["nilai1"];
    $nilai2 = $_POST["nilai2"];
    $operator = $_POST["operator"];

    switch ($operator) {
        case "+":
            $hasil = $nilai1 + $nilai2;
            break;
        case "-":
            $hasil = $nilai1 - $nilai2;
            break;
        case "*":
            $hasil = $nilai1 * $nilai2;
            break;
        case "/":
            // cegah pembagian dengan nol
            $hasil = ($nilai2 != 0) ? $nilai1 / $nilai2 : "Tidak bisa dibagi 0";
            break;
    }
}
?>
<html>
<head>
<title>Kalkulator Sederhana PHP</title>
</head>
<body>

<form method="POST" action="">
    <b>Nilai I</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Nilai II</b><br>
    <input type="text" name="nilai1" required>
    <select name="operator">
        <option value="+">+</option>
        <option value="-">-</option>
        <option value="*">*</option>
        <option value="/">/</option>
    </select>
    <input type="text" name="nilai2" required>
    <input type="submit" value="submit">
</form>

<?php if ($hasil !== null): ?>
    <p>Hasil = <?php echo $hasil; ?></p>
<?php endif; ?>

</body>
</html>
