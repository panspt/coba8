<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $title ?></title>
	<link rel="stylesheet" href="">
	<style>
		body {
			text-align: center;
		}
	</style>
</head>

<body>
	<h1 align="center"><?php echo $title ?></h1>
	<?php $kode = "1234567889347294734"; ?>
	<h3>Ini render QRcode</h3>
	<img src="<?php echo site_url('barcode/QRcode/' . $kode); ?>" alt="">
	<p>
	<h3>Ini render Barcode</h3>
	</p>



</body>

</html>