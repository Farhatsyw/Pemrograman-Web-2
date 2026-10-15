<?php
// Latih 7. Menghitung jumlah record (mysql_num_rows)
$link = mysqli_connect("localhost", "root", "");
mysqli_select_db($link, "lat_dbase");
$hasil = mysqli_query($link, "select * from tbl_mhs");
$hit   = mysqli_num_rows($hasil);
echo "jumlah record $hit";
mysqli_close($link);
?>
