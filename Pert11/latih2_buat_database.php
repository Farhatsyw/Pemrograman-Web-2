<?php
// Latih 2. Membuat Database  (mysql_connect + mysql_query)
$link   = mysqli_connect("localhost", "root", "");
$dbname = "lat_dbase";
$cek    = mysqli_query($link, "CREATE DATABASE $dbname")
          or die("Couldn't Create Database: $dbname - " . mysqli_error($link));
if ($cek) {
    echo "Database $dbname berhasil dibuat";
}
?>
