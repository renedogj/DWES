<?php
	$bin = "";
	$ip = "192.160.0.230";
	while(!empty($ip)){
		$posicion = stripos($ip,".");
		if ($posicion == null) {
			$posicion = strlen($ip);
			$substr = substr($ip,0,$posicion);
			$bin .= sprintf( "%08d", decbin($substr));
			$ip = str_replace($substr,"",$ip);
		}else{
			$substr = substr($ip,0,$posicion);
			$bin .= sprintf( "%08d", decbin($substr)) . ".";
            $ip = substr($ip,$posicion+1,strlen($ip));
		}
	}
	echo $bin;
?>