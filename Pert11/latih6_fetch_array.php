<?php
// Latih 6. fetch_array - akses kolom lewat NAMA field
$link = mysqli_connect("localhost", "root", "");
mysqli_select_db($link, "lat_dbase");
$hasil = mysqli_query($link, "select * from tbl_mhs");
while ($data = mysqli_fetch_array($hasil)) {
    echo $data['FirstName'] . " " . $data['LastName'] . " " . $data['Age'] . "<br>";
}
?>
