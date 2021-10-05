<?php
	$array = array();

	for($i = 0; $i < 20; $i++){
		$array[$i] = decbin($i);
	}

	echo "<table>";
	echo "<tr><th>Indice</th><th>Binario</th><th>Octal</th></tr>";
	for($i = 0; $i < count($array); $i++){
		echo "<tr><td>" . $i . "</td><td>" . $array[$i] . "</td><td>" . decoct($i) . "</td></tr>";
	}
	echo "</table>";
?>