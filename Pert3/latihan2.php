<html>
<head>
<title>contoh Penggunaan IF</title>
</head>
<body>
<form method="get">
  Besar Pembelian :
  <input type="text" name="total_beli"><br><br>
  <input type="submit" value="Tentukan Diskon">
</form>
<?php
  if (isset($_GET['total_beli']) && $_GET['total_beli'] !== '')
  {
	$total_beli = intval($_GET['total_beli']);
	$diskon = 0;
	if ($total_beli >= 200000)
	  $diskon = 0.1;
	else if ($total_beli >= 100000)
	  $diskon = 0.05;
	else
	  $diskon = 0.01;
	$diskon = $diskon * intval($total_beli);
	printf("Diskon\t= %s <br>\n", $diskon);
	printf("Pembayaran = %s <br>\n", $total_beli - $diskon);
  }
?>
</body>
</html>
