<?php
// Latih 2 - DELETE (butuh lat_dbase.sql)
mysqli_report(MYSQLI_REPORT_OFF);

$con = mysqli_connect("localhost","root","");

if (!$con)
  {
  die('Could not connect: ' . mysqli_connect_error());
  }

mysqli_select_db($con,"lat_dbase");

mysqli_query($con,"DELETE FROM tbl_mhs WHERE LastName='Prabowo'") or die('Error: ' . mysqli_error($con));

echo "Delete berhasil, baris yang terhapus: " . mysqli_affected_rows($con);

mysqli_close($con);
?>
