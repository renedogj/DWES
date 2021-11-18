<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Black Jack</title>
	<style type="text/css">
		table{
			border: solid;
			border-collapse: collapse;
		}
		td{
			border: solid;
			border-collapse: collapse;
			width: 100px;
		}
		img{
			width: 100px;
		}
	</style>
</head>
<body>
	<?php
	//Array con todas las cartas
	$baraja=array("AC","2C","3C","4C","5C","6C","7C","JC","QC","KC",
		"AD","2D","3D","4D","5D","6D","7D","JD","QD","KD",
		"AP","2P","3P","4P","5P","6P","7P","JP","QP","KP",
		"AT","2T","3T","4T","5T","6T","7T","JT","QT","KT");
	//Constantes para facilitar la programacion y evitar errores
	define("baraja",$baraja);
	define("banca","banca");
	define("cartas","cartas");
	define("puntuacion","puntuacion");

	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		//Asignamos los valores del formulario a variables
		$numeroCartas = $_POST["numcartas"];
		$cantidadApostada = $_POST["apuesta"];
		for ($i=1; $i <= 4 ; $i++) {
			$nombre = $_POST["nombre".$i];
			//Quitamos espacios a la derecha y a la izquierda del nombre
			$nombre = trim($nombre);
			//Si el nombre no es nulo y no está vacio lo añadimos al array nombres que 
			//nos servirá para crear el array jugadores.
			if($nombre != null && $nombre != ""){
				$nombreJugadores[$i] = $nombre;
			}
		}
		//añadimos a la banca al array de nombredeJugadores
		array_unshift($nombreJugadores,banca);
		//Incluimos el archivo funciones.php con las funciones a usar
		include("funciones.php");	

		//Comprobamos que el numero de cartas está entre 2 y 6 
		if($numeroCartas >= 2 && $numeroCartas <= 6){
			//Por cada jugador generamos sus cartas, calculamos su puntucion
			//y guardamos estos datos en el array jugadores
			foreach ($nombreJugadores as $nombre) {
				$jugadores[$nombre][cartas] = generarCartasJugador($numeroCartas);
				$jugadores[$nombre][puntuacion] = calcularPuntos($jugadores[$nombre][cartas]);
			}

			//mostramos la jugada
			mostrarJugada($jugadores);
			echo "<br>";
			//calculamos y guardamos los ganadores
			$ganadores = calcularGanadores($jugadores);
			//calculamos el importe de cada ganador
			$importeGanado = calcularPremio($ganadores,$cantidadApostada);
			//Generamos el fichero con los gandores y mostramos la informacion de estos por pantalla
			generarFicheroMostrarGanadores($ganadores,$importeGanado);
		}
	}
	?>
</body>
</html>