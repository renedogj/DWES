<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Calculadora</title>
</head>
<body>
	<h1>Calculadora</h1>
	<form>
		<?php
		$num = explode("/",$_POST['num']);
		$base = $_POST['base'];
		echo "Número " . $num[0] . " en base " . $num[1] . " = " . base_convert($num[0],$num[1],$base) . " en base " . $base;
		?>
	</form>
</body>
</html>