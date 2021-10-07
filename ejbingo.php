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

	//Bucle que mientras no haya bingo saque vola y compruebe los cartones
	while(!$bingo){
		sacarBola();
		$ganador = comprobarCartones();
		if(count($ganador) != 0){
			$bingo = true;
		}
	}

	echo "Jugadores: ";
	var_dump($jugadores);
	echo "<br>";
	echo "Tachados: ";
	var_dump($tachados);
	echo "Ganador: " . $ganador[0] . " " . $ganador[1];

	//Función para sacar bola y añadirla al array tachados
	function sacarBola(){
		global $tachados;
		do{
			$bola = rand(1,numeroMaximo);
		}while(in_array($bola, $tachados));
		array_push($tachados, $bola);
	}

	//Función que compueba los cartones de cada jugador
	//Devuelve las posiciones del jugador-carton ganador o un array vacio
	function comprobarCartones(){
		global $jugadores,$tachados;
		for($i = 0; $i < numJugadores; $i++){
			for($j = 0; $j < cartonPorJugador; $j++){
				if(count(array_diff($jugadores[$i][$j],$tachados)) == 0){
					return array($i,$j);
				}
			}
		}
		return array();
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
?>