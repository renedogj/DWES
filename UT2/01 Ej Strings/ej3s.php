<?php
	define("ip","192.160.0.230/16");
	$mascara = substr(ip,stripos(ip,"/")+1,strlen(ip));
	$binIp = "";
	$ipAux = ip;
	while(!empty($ipAux)){
		$posicion = stripos($ipAux,".");
		if ($posicion == null) {
			$posicion = strlen($ipAux);
			$substr = substr($ipAux,0,$posicion);
			$binIp .= sprintf( "%08d", decbin($substr));
			$ipAux = str_replace($substr,"",$ipAux);
		}else{
			$substr = substr($ipAux,0,$posicion);
			$binIp .= sprintf( "%08d", decbin($substr)) . ".";
			$ipAux = substr($ipAux,$posicion+1,strlen($ipAux));
		}
	}

	$binRed = substr($binIp,0,$mascara);
	$binBroadcast = $binRed;

	for($i = $mascara; $i < 32;$i++){
		if($i%8 == 0 && $i != 32){
			$binRed .= ".";
		}
		$binRed .= "0";
	}

	$red = "";
	$binRedAux = $binRed;
	for($i = 8;$i <= 32; $i+=8){
		$red .= bindec(substr($binRedAux,0,8));
		if($i < 32){
			$red .= ".";
		}
		$binRedAux = substr($binRedAux,$i+1,strlen($binRedAux));
	}

	for($i = $mascara; $i < 32;$i++){
		if($i%8 == 0 && $i != 32){
			$binBroadcast .= ".";
		}
		$binBroadcast .= "1";
	}

	$broadcast = "";
	$binBroadcastAux = $binBroadcast;
	for($i = 8;$i <= 32; $i+=8){
		$broadcast .= bindec(substr($binBroadcastAux,0,8));
		if($i < 32){
			$broadcast .= ".";
		}
		$binBroadcastAux = substr($binBroadcastAux,$i+1,strlen($binBroadcastAux));
	}



	echo "IP " . ip . " en binario es " . $binIp . "<br>";
	echo "Mascara: " . $mascara . "<br>";
	echo "Red: " . $red . "<br>";
	echo "Broadcast: " . $broadcast . "<br>";
?>