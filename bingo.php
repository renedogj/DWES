<?php
	$numerMaximo = 60;
	$numerosPorCarton = 15;
	$numJugadores = 4;
	$cartonPorJugador = 3;

	$jugadores = array();
	$carton = array();
	$tachados = array();
	$aciertos = 0;

	for($i = 0 ;$i <= $numerosPorCarton; $i++){
		do{
			$num = rand(1,$numerMaximo);
		}while(in_array($num, $carton));
		$carton[$i] = $num;
	}

	while($aciertos < $numerosPorCarton){
		do{
			$bola = rand(1,$numerMaximo);
		}while(in_array($bola, $tachados));
		array_push($tachados, $bola);

		if(in_array($bola,$carton)){
			$aciertos++;
		}
	}

	print_r($carton);
	echo "<br>";
	print_r($aciertos);
	echo "<br>";
	print_r($tachados);
?>