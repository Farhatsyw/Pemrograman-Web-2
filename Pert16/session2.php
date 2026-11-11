<?php
// CONTOH ERROR: ada kode HTML sebelum session_start()
// Hasil: Warning ... headers already sent
?>
<html>
<head>
    <title>....</title>
</head>
<?php
session_start();
?>
