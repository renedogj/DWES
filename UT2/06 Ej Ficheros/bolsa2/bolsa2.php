<?php
$nombreValor = $_POST['nombre'];
$pathIbex = "./../ibex35.txt";

if(file_exists($pathIbex)){
	$fileIbex = file($pathIbex);
	foreach($fileIbex as $indice => $linea){
		if($nombreValor == trim(substr($linea,0, 23))){
			echo $linea . "<br>";
		}
	}
}else{
	echo "No existe el archivo";
}
?>