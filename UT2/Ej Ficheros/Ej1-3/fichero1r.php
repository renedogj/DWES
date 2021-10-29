<?php 
	$file = fopen("alumnos1.txt","r");
	while($linea = fgets($file)){
		echo $linea . "<br>";
	}
	fclose($file);
?>