<?php
class apuesta {
	public $combinacion = array();
	public $complementario;
	public $reintegro;

	function __construct($combinacion,$complementario,$reintegro){
		$this->combinacion = $combinacion;
		$this->complementario = $complementario;
		$this->reintegro = $reintegro;
	}

	//Setters
	function setCombinacion($combinacion){
		$this->combinacion = $combinacion;
	}

	function setComplementario($complementario){
		$this->complementario = $complementario;
	}

	function setReintegro($reintegro){
		$this->reintegro = $reintegro;
	}

	//Getters
	function getCombinacion(){
		return $this->combinacion;
	}

	function getComplementario(){
		return $this->complementario;
	}

	function getReintegro(){
		return $this->reintegro;
	}

	//Metodos
	public static function generarApuestaGanadora(){
		$combinacionGanadora = array();
		for($i = 0 ;$i < 6; $i++){
			$combinacionGanadora[$i] = apuesta::obtenerNumValido($combinacionGanadora);
		}
		return new apuesta(
			$combinacionGanadora,
			apuesta::obtenerNumValido($combinacionGanadora),
			rand(1,9)
		);
	}

	//Metodo para obtener un nuevo aleatorio entre 1 y el 49 que no esté en el array
	public static function obtenerNumValido($array){
		do{
			$num = rand(1,49);
		}while(in_array($num, $array));
		return $num;
	}

	//Metodo para mostrar la combinación ganadora
	public function mostrarCombinacion(){
		echo "<table><tr>";
		foreach($this->combinacion as $num){
			echo "<td><img src=\"../r22_bolasprimitiva/" . $num . ".png\"></td>"; 
		}
		echo "</tr></table><br><br>";

		echo "Complementario: " . $this->complementario . "<br>";
		echo "Reintegro: " . $this->reintegro . "<br><br>";
	}
}
?>