<?php
	define("numeroMaximo", 60);
	define("numerosPorCarton", 15);
	define("numJugadores", 4);
	define("cartonPorJugador", 3);

	$jugadores = array();
	$tachados = array();
	$bingo = false;
	$aciertos = 0;

	for($i = 0; $i < numJugadores; $i++){
		for($j = 0; $j < cartonPorJugador; $j++){
			$jugadores[$i][$j] = generarCarton();
		}
	}

	while(!$bingo){
		sacarBola();

		$ganador = comprobarCarton();
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

	function sacarBola(){
		global $tachados;
		do{
			$bola = rand(1,numeroMaximo);
		}while(in_array($bola, $tachados));
		array_push($tachados, $bola);
	}

	function comprobarCarton(){
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