<?php
	function añadirCeros(string $substr){
		while(strlen($substr) < 8){
			$substr = "0" . $substr;
		}
		return $substr;
	}

	$ip = "192.160.0.230";
	$binario = "";
	$ipAux = $ip;
	while(!empty($ipAux)){
		$posicion = stripos($ipAux,".");
		if ($posicion == null) {
			$posicion = strlen($ipAux);
			$substr = substr($ipAux,0,$posicion);
			$binario .= añadirCeros(decbin($substr));
			$ipAux = str_replace($substr,"",$ipAux);
		}else{
			$substr = substr($ipAux,0,$posicion);
			$binario .= añadirCeros(decbin($substr)) . ".";
			$ipAux = substr($ipAux,$posicion+1,strlen($ipAux));
		}
	}
	echo "IP " . $ip . " en binario es " . $binario;
?>