<?php
$pathIbex = "./../ibex35.txt";
for($i = 0; $i < 2; $i++){
	$nombresValoresBursatiles[$i] = $_POST['nombre'.$i];
}

if(file_exists($pathIbex)){
	$fileIbex = file($pathIbex);
	array_splice($fileIbex, 0, 1);
	foreach($fileIbex as $indice => $linea){
		$ibex[trim(substr($linea,0, 23))] = obtenerValorBursatil($linea);
	}
	foreach($nombresValoresBursatiles as $nombre){
		mostrarValor($ibex,$nombre);
	}
}else{
	echo "No existe el archivo";
}

function obtenerValorBursatil($strValor){
	$posiciones = [23,32,40,48,60,69,78,91,100,106];
	$countPosiciones = count($posiciones)-1;

	for ($i=0; $i < $countPosiciones; $i++) {
		$posicionFinal = $posiciones[$i+1]-$posiciones[$i];
		$valorBursatil[$i] = trim(substr($strValor,$posiciones[$i],$posicionFinal));
	}
	return $valorBursatil;
}

function mostrarValor($ibex,$nombre){
	echo "Nombre: " . $nombre . "<br>";
	echo "Cotización: " . $ibex[$nombre][0] . "<br>";
	echo "Máximo: " . $ibex[$nombre][4] . "<br>";
	echo "Mínimo: " . $ibex[$nombre][5] . "<br><br>";
}
?>