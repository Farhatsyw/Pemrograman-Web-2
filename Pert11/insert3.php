<?php
// Latihan insert3.php - memasukkan data dari form.php
// Memakai prepared statement agar aman dari SQL Injection
$con = mysqli_connect("localhost", "root", "");
if (!$con) {
    die('Could not connect: ' . mysqli_connect_error());
}
mysqli_select_db($con, "lat_dbase");

$stmt = mysqli_prepare($con, "INSERT INTO tbl_mhs (FirstName, LastName, Age) VALUES (?, ?, ?)");
mysqli_stmt_bind_param($stmt, "ssi", $_POST['firstname'], $_POST['lastname'], $_POST['age']);

if (!mysqli_stmt_execute($stmt)) {
    die('Error: ' . mysqli_error($con));
}
echo "1 record added";

mysqli_close($con);
?>
