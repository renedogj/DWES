<?php
$combinacionGanadora = array();

for($i = 0 ;$i < 6; $i++){
	$combinacionGanadora[$i] = obtenerNumValido($combinacionGanadora);
}
define("combinacionGanadora", $combinacionGanadora);
define("complementario", obtenerNumValido($combinacionGanadora));
define("reintegro", rand(1,9));

function obtenerDatosJugador($jugadorAux){
	for ($i=0; $i < 6; $i++) { 
		$arrayNumeros[$i] = $jugadorAux[$i+1]; 
	}
	$jugador["numeros"] = $arrayNumeros;
	$jugador["complementario"] = $jugadorAux[7];
	$jugador["reintegro"] = $jugadorAux[8];
	return $jugador;
}

function obtenerCategoriasJugador($jugador){
	$categoriasAciertos = array();
	$dif = count(array_diff($jugador["numeros"],combinacionGanadora));
	$numAciertos = 6 - $dif;
	
	if($numAciertos == 5 && $jugador["complementario"] == complementario){
		array_push($categoriasAciertos, "c");
	}else{
		array_push($categoriasAciertos, $numAciertos);
	}

	if($jugador["reintegro"] == reintegro){
		array_push($categoriasAciertos, "r");
	}
	return $categoriasAciertos;
}

function obtenerNumValido($array){
	do{
		$num = rand(1,49);
	}while(in_array($num, $array));
	return $num;
}

function mostrarCombinacionGanadora(){
	echo "<table><tr>";
	foreach(combinacionGanadora as $num){
		echo "<td><img src=\"r22_bolasprimitiva/" . $num . ".png\"></td>"; 
	}
	echo "</tr></table><br><br>";

	echo "Complementario: " . complementario . "<br>";
	echo "Reintegro: " . reintegro . "<br><br>";
}

function mostrarNumGanadoresCategoria($acertantes){
	echo "<ul>";
	foreach($acertantes as $categoria){
		echo "<li>" . $categoria["texto"] . $categoria["numJugadores"];
	}
}
?>