<?php
// CONTOH ERROR: include "header.php" berisi echo, dan dipanggil sebelum session_start()
// Hasil: Warning ... headers already sent
include "header.php";
session_start();
?>
