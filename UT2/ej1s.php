<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>EJ1-Conversion IP Decimal a Binario</title>
</head>
<body>
<?php
	$bin = "";
	$ip = "0.0.0.0";
	while(!empty($ip)){
		$posicion = stripos($ip,".");
		if ($posicion == null) {
			$posicion = strlen($ip);
			$substr = substr($ip,0,$posicion);
			$bin .= sprintf( "%08d", decbin($substr));
			$ip = str_replace($substr,"",$ip,1);
		}else{
			$substr = substr($ip,0,$posicion);
			$bin .= sprintf( "%08d", decbin($substr)) . ".";
			$substr = $substr . ".";
			$ip = str_replace($substr,"",$ip,1);
		}
		echo $posicion . "<br>";
		echo $substr . "<br>";
		echo $bin . "<br>";
		echo $ip . "<br><br><br>";
	}
	echo $bin;
	

	/*$posicion = stripos($ip,".");
	echo $posicion . "<br>";
	$substr = substr($ip,0,$posicion);
	echo $substr . "<br>";
	$bin += sprintf( "%08d", decbin($substr));
	echo $bin . "<br>";
	$substr = $substr . ".";
	$ip = str_replace($substr,"",$ip);
	echo $ip . "<br>";

	$posicion = stripos($ip,".");
	echo $posicion . "<br>";
	$substr = substr($ip,0,$posicion);
	echo $substr . "<br>";
	$bin += sprintf( "%08d", decbin($substr));
	echo $bin . "<br>";
	$substr = $substr . ".";
	$ip = str_replace($substr,"",$ip);
	echo $ip . "<br>";

	$posicion = stripos($ip,".");
	echo $posicion . "<br>";
	$substr = substr($ip,0,$posicion);
	echo $substr . "<br>";
	$bin = sprintf( "%08d", decbin($substr));
	echo $bin . "<br>";
	$substr = $substr . ".";
	$ip = str_replace($substr,"",$ip);
	echo $ip . "<br>";*/

?>
</body>
</html>