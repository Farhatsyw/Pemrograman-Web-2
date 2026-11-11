<?php
// CONTOH ERROR: ada echo sebelum session_start()
// Hasil: Warning ... headers already sent
echo "Hallo...";
session_start();
?>
