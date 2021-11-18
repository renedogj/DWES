<?php
/**
 *  Funcion para generar, mediante el array baraja
 *  y de forma aleatoria las cartas del jugador
 **/
function generarCartasJugador($numeroCartas){
	$cartas = array();
	$cartasBaraja = count(baraja);
	for($i = 0; $i < $numeroCartas; $i++){
		array_push($cartas,baraja[rand(0,$cartasBaraja-1)]);
	}
	return $cartas;
}

/**
 * Funcion que retorna los puntos del jugador cuyo array de cartas
 * se ha pasado por parametro
 * */
function calcularPuntos($cartas){
	$puntuacion = 0;
	foreach($cartas as $carta){
		$carta = $carta[0];
		if($carta == "A"){
			$puntuacion++;
		}else if($carta == "J" || $carta == "Q" || $carta == "K"){
			$puntuacion += 10;
		}else{
			$puntuacion += $carta;
		}
	}
	return $puntuacion;
}

/**
 * Funcion con la que se averigua cuales de los jugadores son ganadores
 * y se devuelve un array con el nombre de los mismos y su puntuación
 * */
function calcularGanadores($jugadores){
	$ganadores = array();
	$banca = array_shift($jugadores);

	if($banca[puntuacion] > 21){
		foreach($jugadores as $nombre => $jugador){
			if($jugador[puntuacion] <= 21){
				$ganadores[$nombre] = $jugador[puntuacion];
			}
		}
	}else{
		//Calculamos la máxima puntucación
		$maxPuntuacion = $banca[puntuacion];
		foreach($jugadores as $jugador){
			if($jugador[puntuacion] <= 21){
				if($jugador[puntuacion] > $maxPuntuacion){
					$maxPuntuacion = $jugador[puntuacion];
				}
			}
		}
		
		if($banca[puntuacion] == $maxPuntuacion){
			$ganadores[banca] = $banca[puntuacion];
			foreach($jugadores as $nombre => $jugador){
				if($jugador[puntuacion] == $maxPuntuacion){
					$ganadores[$nombre] = $jugador[puntuacion];
				}
			}
		}else{
			foreach($jugadores as $nombre => $jugador){
				if($jugador[puntuacion] > $banca[puntuacion] && $jugador[puntuacion] <= 21){
					$ganadores[$nombre] = $jugador[puntuacion];
				}
			}
		}
	}
	arsort($ganadores);
	return $ganadores;
}

/**
 * Función que con la que se calcula el premio por ganador
 * */
function calcularPremio($ganadores,$cantidadApostada){
	$numGanadores = count($ganadores);
	$importeGanado = 0;
	if($numGanadores > 0){
		if(array_key_exists(banca,$ganadores)){
			if($numGanadores > 1){
				if($ganadores[banca] == 21){
					$cantidadApostada /= 2;
				}
				$importeGanado = $cantidadApostada/$numGanadores;
			}
		}else{
			$importeGanado = $cantidadApostada/$numGanadores;
		}
	}
	return $importeGanado;
}

/**
 * Funcion para mostrar por pantalla un tabla con el nombre de los 
 * jugadores y una imagen de cada una de las cartas que tiene
 * */
function mostrarJugada($jugadores){
	echo "<table>";
	foreach($jugadores as $nombre => $jugador){
		echo "<tr><td>" . $nombre . "</td>";
		foreach($jugador[cartas] as $carta){
			echo "<td><img src=\"images/".$carta.".png\"></td>";
		}
		echo "</tr>";
	}
	echo "</table>";
}

/**
 * Funcion que, con la fecha y la hora del sistema genera un fichero
 * en el que se almacenarán los ganadores con su puntiaccion y el importe
 * ganado redondeado a dos decimales.
 * Además, esta función a la par que guarda los ganadores en el fichero
 * mostrará por pantalla la información de los mismos
 * */
function generarFicheroMostrarGanadores($ganadores,$importeGanado){
	$importeGanado = round($importeGanado,2);
	$pathPremios = "premios/premios_" . date("dmYhis") . ".txt";
	$file = fopen($pathPremios,"w");
	//Se comprueba si la banca es el unico ganador
	if(array_key_exists(banca,$ganadores) && count($ganadores) == 1){
		$linea = banca . "#" . $ganadores[banca] . "#" . $importeGanado . "\n";
		echo "La Banca gana!!!";
		fwrite($file, $linea);
	}else{
		foreach($ganadores as $nombre => $puntuacion){
			$linea = $nombre . "#" . $puntuacion . "#" . $importeGanado . "\n";
			echo $nombre . " tiene " . $puntuacion . " puntos y gana " . $importeGanado . "<br>";
			fwrite($file, $linea);
		}
	}
	fclose($file);
}
?>