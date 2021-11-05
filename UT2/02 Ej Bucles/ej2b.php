<?php
	$numero = "136";
	$base = "8";
	$resultado="";

	while ($numero>=$base){
		$resultado = $resultado . $numero % $base;
		$numero = $numero / $base;
	}
	$resultado = strrev($resultado .variant_int($numero));

	echo $numero . " en base " . $base . ": " . $resultado;
?>