<?php
class categoria {
	const porcentajesPremios = [0=>0,1=>0,2=>0,3=>5,4=>8,5=>15,6=>40,"c"=>30,"r"=>2];

	public $idCategoria;
	public $jugadores = array();
	public $texto;
	public $numJugadores;
	public $porcentajePremio;
	public $premio;
	public $premioJugador;

	function __construct($idCategoria,$texto,$porcentajePremio,$recaudacion){
		$this->idCategoria = $idCategoria;
		$this->texto = $texto;
		$this->porcentajePremio = $porcentajePremio;
		$this->setPremio($recaudacion);
	}

	//Setters
	function setJugadores($jugadores){
		$this->jugadores = $jugadores;
	}

	function setTexto($texto){
		$this->texto = $texto;
	}

	function setNumJugadores(){
		$this->numJugadores = count($this->jugadores);
	}

	function setPorcentajePremio($porcentajePremio){
		$this->porcentajePremio = $porcentajePremio;
	}

	function setPremio($recaudacion){
		$this->premio = ($recaudacion*$this->porcentajePremio)/100;
	}

	function setPremioJugador(){
		if($this->numJugadores != 0){
			$this->premioJugador = $this->premio/$this->numJugadores;
		}else{
			$this->premioJugador = 0;
		}
	}

	//Getters
	function getJugadores(){
		return $this->jugadores;
	}

	function getTexto(){
		return $this->texto;
	}

	function getNumJugadores(){
		return $this->numJugadores;
	}

	function getPorcentajePremio(){
		return $this->porcentajePremio;
	}

	function getPremio(){
		return $this->premio;
	}

	function getPremioJugador(){
		return $this->premioJugador;
	}

	//metodos
	//Metodo para añadir un jugador al array jugadores
	function addJugador($jugador){
		array_push($this->jugadores,$jugador);
	}

	//Metodo para mostrar el número de ganadores de cada categoria
	public static function mostrarNumGanadoresCategoria($categorias){
		echo "<ul>";
		foreach($categorias as $categoria){
			echo "<li>" . $categoria->texto . $categoria->numJugadores . "</li>";
		}
		echo "</ul>";
	}

	//Metodo para guardar los resultados del sorteo en un archivo con la fecha
	public static function guardarSorteo($categorias,$fecha){
		$arrayFecha = explode("-",$fecha);
		$pathSorteo = "sorteos/premiosorteo_".$arrayFecha[2].$arrayFecha[1].$arrayFecha[0].".txt";
		$file = fopen($pathSorteo,"w");
		foreach($categorias as $categoria){
			if($categoria->idCategoria == "c"){
				$linea = "C5+#premio a percibir cada acertante 5 aciertos + complementario: " . $categoria->premioJugador . "\n";	
			}else if($categoria->idCategoria == "r"){
				$linea = "CR # premio a percibir por cada acertante reintegro:" . $categoria->premioJugador . "\n";
			}else{
				$linea = "CR" . $categoria->idCategoria . " # premio a percibir cada acertante " . $categoria->idCategoria . " aciertos: " . $categoria->premioJugador . "\n";
			}
			fwrite($file, $linea);
		}
		fclose($file);
	}
}
?>