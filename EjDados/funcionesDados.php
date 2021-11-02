<?php
/**
 * Función que genera, por cada numero de dados un numero aleatorio y lo almacena
 * en un array que luego retornará
 **/
function tirarDadosJugador($numDados){
	for ($i = 0; $i < $numDados; $i++) {
		$tiradas[$i] = rand(1,6);
	}
	return $tiradas;
}

/**
 * Función que  calcula la puntucación del jugador pasado por parametro.
 * Para ello con la funcion array_unique se crea un array auxiliar del array de 
 * tiradas que no contiene valores repetidos pues si el numero de valores de este 
 * array tiradasaux es = a 1 significa que todas las tiradas tenían el mismo numero
 * y se le asigna al jugador una puntuación de 100. En caso contrario se suman los
 * dados para obtener la puntuación.
 **/
function calcularPuntuacion($jugadores,$jugador,$numDados){
	$tiradasAux =  array_unique($jugadores[$jugador][0]);
	if($numDados >= 2 && count($tiradasAux) == 1){
		$puntuacion = 100;
	}else{
		$puntuacion = 0;
		foreach($jugadores[$jugador][0] as $dado){
			$puntuacion += $dado;
		}
	}
	return $puntuacion;
}

/**
 * Función que retorna un array con los nombres de los jugadores.
 * Para ellos almacena todas las puntucaciones de los jugadores en un array y 
 * calcula el valor máximo. Después introduce en el array ganadores el nombre
 * de todos los jugadores con esa puntuación.
 **/
function contarGanadores($jugadores){
	$puntuaciones = array();
	$ganadores = array();
	foreach($jugadores as $jugador => $values){
		array_push($puntuaciones,$values[1]);
	}

	$puntuacionMaxima =  max($puntuaciones);

	foreach($jugadores as $jugador => $values){
		if($puntuacionMaxima == $values[1]){
			array_push($ganadores,$jugador);
		}
	}
	return $ganadores;
}

/**
 * Función que muestra la tabla con el nombre y la tirada de cada uno de los
 * jugadores. Para ello, por cada jugador llama a la funcion mostrarTiradaJugador
 **/
function mostarTablaTiradas($jugadores){
	echo "<table>";
	foreach($jugadores as $jugador => $values){
		mostrarTiradaJugador($jugadores,$jugador);
	}
	echo "</table>";
}

/**
 * Funcion que muestra la fila de la tabla de cada jugador.
 * En esta fila se muestra el nombre del jugador y las imagenes de dados con el
 * numero sacado en cada una de la tiradas.
 **/
function mostrarTiradaJugador($jugadores,$jugador){
	echo "<tr><td>" . $jugador . "</td><td>";
	foreach($jugadores[$jugador][0] as $dado){
		echo "<img src=\"images/".$dado.".png\">";
	}
	echo "</td></tr>";
}

/**
 * Función que muestra la puntuaciones de cada jugador.
 **/
function mostrarPuntuaciones($jugadores){
	foreach($jugadores as $jugador => $values){
		echo $jugador . " = " . $values[1] . "<br>";
	}
}

/**
 * Función que muestra el nombre de cada uno de los ganadores y el numero 
 * total de ganadores.
 **/
function mostrarGanadores($ganadores){
	foreach($ganadores as $ganador){
		echo "GANADOR: " . $ganador . "<br>";
	}
	echo "NUMERO DE GANADORES: " . count($ganadores);
}
?>