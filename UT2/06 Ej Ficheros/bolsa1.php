<?php
$nombreFichero = "./ibex35.txt";
if(file_exists($nombreFichero)){
	$file = file($nombreFichero);
	foreach($file as $indice => $linea){
		echo $linea . "<br>";
	}
}else{
	echo "No existe el archivo";
}
?>