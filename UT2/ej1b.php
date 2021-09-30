<?php
	function binario($valorDecimal) {
		$numbinario = 0;
		$aux;
		$i = 1;
		while ($valorDecimal != 0) {
			$aux = $valorDecimal % 2;
			$valorDecimal = (int)($valorDecimal / 2);
			$numbinario = $numbinario + $aux * $i;
			$i = $i * 10;
		}
		return $numbinario;
	}

	echo binario(12);
?>