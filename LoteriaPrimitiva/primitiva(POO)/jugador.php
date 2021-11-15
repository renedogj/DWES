<?php
class jugador {
	public $idJugador;
	public $apuesta;
	public $categorias = array();

	function __construct($arrayJugador,$apuestaGanadora){
		$this->idJugador = $arrayJugador[0];
		for ($i=0; $i < 6; $i++) { 
			$numeros[$i] = $arrayJugador[$i+1]; 
		}
		$this->apuesta = new apuesta($numeros,$arrayJugador[7],$arrayJugador[8]);
		$this->obtenerCategoriasJugador($apuestaGanadora);
	}	

	//Metodos
	//Metodo para obtener las categorias del jugadore
	function obtenerCategoriasJugador($apuestaGanadora){
		$apuesta = $this->apuesta;
		$categoriasAciertos = array();

		$dif = count(array_diff($apuesta->combinacion,$apuestaGanadora->combinacion));
		$numAciertos = 6 - $dif;
		
		if($numAciertos == 5 && $apuesta->complementario == $apuestaGanadora->complementario){
			array_push($categoriasAciertos, "c");
		}else{
			array_push($categoriasAciertos, $numAciertos);
		}

		if($apuesta->reintegro == $apuestaGanadora->reintegro){
			array_push($categoriasAciertos, "r");
		}
		$this->categorias = $categoriasAciertos;
	}
}
?>