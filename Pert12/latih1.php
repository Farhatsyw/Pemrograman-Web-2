<?php
// Latih 1 - UPDATE (butuh lat_dbase.sql)
mysqli_report(MYSQLI_REPORT_OFF);

$con = mysqli_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysqli_connect_error());
  }

mysqli_select_db($con,"lat_dbase");

mysqli_query($con,"UPDATE tbl_mhs SET Age = '36'
WHERE FirstName = 'Karina' AND LastName = 'Suwandi'") or die('Error: ' . mysqli_error($con));

echo "Update berhasil, baris yang berubah: " . mysqli_affected_rows($con);

mysqli_close($con);
?>
