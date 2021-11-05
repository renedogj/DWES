<?php 
	$file = fopen("alumnos2.txt","r");
	echo "<table>";
	while($linea = fgets($file)){
		echo "<tr><td>" . str_replace("##","</td><td>",$linea) . "</td></tr>";
	}
	echo "</table>";
	fclose($file);
?>