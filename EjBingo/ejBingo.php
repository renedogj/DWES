<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Bingo</title>
	<link href="ejBingo.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<?php
	define("numeroMaximo", 60);
	define("numerosPorCarton", 15);
	define("numJugadores", 4);
	define("cartonPorJugador", 3);

	$jugadores = array();
	$tachados = array();
	$bingo = false;

	//Asignar a cada jugador sus tres cartones
	for($i = 0; $i < numJugadores; $i++){
		for($j = 0; $j < cartonPorJugador; $j++){
			$jugadores[$i][$j] = generarCarton();
		}
	}

	echo "<div class='bolas'>";
	//Bucle que mientras no haya bingo saque vola y compruebe los cartones
	while(!$bingo){
		sacarBola();
		$ganadores = comprobarCartones();
		if(count($ganadores) != 0){
			$bingo = true;
		}
	}
	echo "</div>";

	echo "<div class='divContenedor'>";
	for($i = 0; $i < numJugadores; $i++){
		mostrarCartonesJugador($i);
	}
	echo "</div>";

	echo "<br><b>Ganadores:</b><br>";
	for($i = 0; $i < count($ganadores); $i++){
		echo "<h3 class='carton'>Jugador: " . $ganadores[$i][0] . "</h3>";
		mostrarCarton($ganadores[$i][0],$ganadores[$i][1]);
	}	

	//Función para sacar bola y añadirla al array tachados
	function sacarBola(){
		global $tachados;
		do{
			$bola = rand(1,numeroMaximo);
		}while(in_array($bola, $tachados));
		echo "<img src='imagenesbolas/" . $bola . ".png'>";
		array_push($tachados, $bola);
	}

	//Función que compueba los cartones de cada jugador
	//Devuelve las posiciones del jugador-carton ganador o un array vacio
	function comprobarCartones(){
		global $jugadores,$tachados;
		$ganadores = array();
		for($i = 0; $i < numJugadores; $i++){
			for($j = 0; $j < cartonPorJugador; $j++){
				if(count(array_diff($jugadores[$i][$j],$tachados)) == 0){
					$ganador = array($i,$j);
					array_push($ganadores, $ganador);
				}
			}
		}
		return $ganadores;
	}

	//Función que genera un nuevo carton sin repetir ningún valor en él
	function generarCarton(){
		$carton = array();
		for($i = 0 ;$i < numerosPorCarton; $i++){
			do{
				$num = rand(1,numeroMaximo);
			}while(in_array($num, $carton));
			$carton[$i] = $num;
		}
		return $carton;
	}

	function mostrarCarton($jugador,$carton){
		global $jugadores,$tachados;
		echo "<p class='carton'>Cartón: " . $carton . "</p>";
		echo "<table><tr>";
		for($i = 0; $i < numerosPorCarton; $i++){
			if(in_array($jugadores[$jugador][$carton][$i],$tachados)){
				echo "<td><strike>" . $jugadores[$jugador][$carton][$i] . "</strike></td>";
			}else{
				echo "<td>" . $jugadores[$jugador][$carton][$i] . "</td>";
			}
		}
		echo "</tr></table>";
	}

	function mostrarCartonesJugador($jugador){
		echo "<div class='divJugador'>";
		echo "<h2 class='jugador'>Jugador: " . $jugador . "</h2>";
		for($i = 0; $i < cartonPorJugador; $i++){
			mostrarCarton($jugador,$i);
		}
		echo "</div>";		
	}
?>
</body>
</html>