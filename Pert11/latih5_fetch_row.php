<?php
// Latih 5. Menampilkan Data - fetch_row (akses kolom lewat nomor index)
// mysql_db_query() sudah tidak ada; diganti mysqli_select_db + mysqli_query
$link = mysqli_connect("localhost", "root", "", "lat_dbase");
$hasil = mysqli_query($link, "select * from tbl_mhs");
while ($data = mysqli_fetch_row($hasil)) {
    echo "$data[0] $data[1] $data[2]<br>";
}
?>
