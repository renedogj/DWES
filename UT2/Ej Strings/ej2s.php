<?php
	$ip = "192.162.206.231";
	$binario = "";
	$ipAux = $ip;
	while(!empty($ipAux)){
		$posicion = stripos($ipAux,".");
		if ($posicion == null) {
			$posicion = strlen($ipAux);
			$substr = substr($ipAux,0,$posicion);
			$binario .= str_pad(decbin($substr),8,"0",STR_PAD_LEFT);
			$ipAux = str_replace($substr,"",$ipAux);
		}else{
			$substr = substr($ipAux,0,$posicion);
			$binario .= str_pad(decbin($substr),8,"0",STR_PAD_LEFT) . ".";
			$ipAux = substr($ipAux,$posicion+1,strlen($ipAux));
			if($ipAux == "0"){
				$binario .= str_pad(0,8,"0",STR_PAD_LEFT);
			}
		}
	}
	echo "IP " . $ip . " en binario es " . $binario;
?>