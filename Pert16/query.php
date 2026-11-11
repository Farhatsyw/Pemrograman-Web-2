<?php
mysqli_report(MYSQLI_REPORT_OFF); // PHP 8.1+ melempar exception, dimatikan supaya "or die" bekerja

$con = mysqli_connect("localhost","root","","lat_dbase");
$query = ".....";
$hasil = mysqli_query($con,$query) or die(mysqli_error($con));
echo "Jumlah data: " . mysqli_num_rows($hasil);
mysqli_query($con,$query) or die(mysqli_error($con));
?>
