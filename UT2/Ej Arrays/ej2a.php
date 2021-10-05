<?php
	$array = array();
	$numImpar = 1;
	$impares = 0;
	$numImpares = 0;
	$pares = 0;
	$numPares = 0;

	for($i = 0;$i < 20; $i++){
		$array[$i] = $numImpar;
		$numImpar += 2;
		if($i%2 == 0){
			$pares += $array[$i];
			$numPares++;
		}else{
			$impares += $array[$i];
			$numImpares++;
		}
	}

	echo "<table>";
	for($i = 0;$i < 20; $i++){
		echo "<tr><td>" . $i . "</td><td>" . $array[$i] . "</td><td>" . ($i+$array[$i]) . "</td></tr>";
	}
	echo "</table>";

	echo "Pares: " . $pares/$numPares . "<br>";
	echo "Media impares: " . $impares/$numImpares;
?>