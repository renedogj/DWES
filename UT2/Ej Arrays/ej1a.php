<?php
	$impares = array();
	$numImpar = 1;
	for($i = 0;$i <= 20; $i++){
		$impares[$i] = $numImpar;
		$numImpar += 2;
	}
	echo "<table>";
	for($i = 0;$i <= 20; $i++){
		echo "<tr><td>" . $i . "</td><td>" . $impares[$i] . "</td><td>" . ($i+$impares[$i]) . "</td></tr>";
	}
	echo "</table>";

	//Solucion sin array (no valida)
	$numImpar = 1;
	echo "<br><table>";
	for($i = 0;$i <= 20; $i++){
		$impares[$i] = $numImpar;
		echo "<tr><td>" . $i . "</td><td>" . $numImpar . "</td><td>" . ($i+$numImpar) . "</td></tr>";
		$numImpar += 2;
	}
	echo "</table>";
?>