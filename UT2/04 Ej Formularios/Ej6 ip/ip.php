<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ip</title>
</head>
<body>
	<h1>Ip</h1>
	<form>
		<?php
		$ip = $_POST['ip'];
		$binario = ipABin($ip);

		$htmlForm = <<< TEXTHTML
		<label for="ip">IP notacion decimal:</label>
		<input type="text" name="ip" value="${ip}">
		<br><br>
		<label for="binario">IP notacion binaria:</label>
		<input type="text" name="binario" value="${binario}">
		<br><br>
		TEXTHTML;

		echo $htmlForm;

		function ipABin($ip){
			$binIp = "";
			while(!empty($ip)){
				$posicion = stripos($ip,".");
				if ($posicion == null) {
					$posicion = strlen($ip);
					$substr = substr($ip,0,$posicion);
					$binIp .= sprintf( "%08d", decbin($substr));
					$ip = str_replace($substr,"",$ip);
				}else{
					$substr = substr($ip,0,$posicion);
					$binIp .= sprintf( "%08d", decbin($substr)) . ".";
					$ip = substr($ip,$posicion+1,strlen($ip));
				}
			}
			return $binIp;
		}
		?>
	</form>
</body>
</html>