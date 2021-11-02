<?php
$numJugadores = 0;

for ($i=1; $i <= 4 ; $i++) {
	$nombre = $_POST["nombre".$i];
	//Quitamos espacios a la derecha y a la izquierda del nombre
	$nombre = trim($nombre);
	//Si el nombre no es nulo y no está vacio lo añadimos al array nombres que 
	//nos servirá para crear el array jugadores.
	if($nombre != null && $nombre != ""){
		$nombres[$i] = $nombre;
		$numJugadores++;
	}
}

$numDados = $_POST['numdados'];

include("funcionesDados.php");

/**
 * Los jugadores se almacenan en un array asociativo cuya clave es el nombre del
 * jugador.Este array contiene otro array con solo dos valores el primero contiene 
 * otro array con los numeros sacados en los dados y el segundo valor contiene la 
 * puntuación. De este modo, con tan solo saber el nombre del jugador podemos sacar
 * toda la informmación necesaria;
 **/

if ($numJugadores >= 2 && $numJugadores <= 4 && $numDados >= 1 && $numDados <= 10) {
	//Por cada jugador asignamos lass tiradas de dadoos y calculamos su puntuación
	foreach($nombres as $jugador){
		$jugadores[$jugador][0] = tirarDadosJugador($numDados);
		$jugadores[$jugador][1] = calcularPuntuacion($jugadores,$jugador,$numDados);
	}
	//mostramos la tabla con las tiradas
	mostarTablaTiradas($jugadores);
	//mostramos la puntuación de los jugadores
	mostrarPuntuaciones($jugadores);
	//Contamos lo ganadores y los mostramos
	mostrarGanadores(contarGanadores($jugadores));
}else{
	echo "EL número de dados debe estar entre 1 y 10";
}
?>