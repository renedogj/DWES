<?php
class Departamento{
	public $cod;
	public $nombre;

	function __construct($cod,$nombre){
		$this->cod = $cod;
		$this->nombre = $nombre;
	}

	public static function arrayDeptos($arrayDeptos){
		$departamentos = array();
		foreach($arrayDeptos as $dpto){
			$departamento = new Departamento($dpto["cod_dept"],$dpto["nombre_dpto"]);
			array_push($departamentos, $departamento);
		}
		return $departamentos;
	}

	public static function newDepartamento($con,$nombre){
		$cod = self::obtenerNuevoCod($con);
		return new Departamento($cod,$nombre);
	}

	public function darDeAlta($con){
		if($this->nombre != null && $this->nombre != "" && $this->cod != "" && $this->cod != null){
			try {
				$sql = "INSERT INTO departamentos (cod_dept,nombre_dpto) VALUES ('$this->cod','$this->nombre')";

				if ($con->exec($sql)) {
					echo "Nuevo departamento creado";
				}		
			} catch(PDOException $e) {
				echo $sql . "<br>" . $e->getMessage();
			}
		}
	}
	
	public static function obtenerNuevoCod($con){
		$sql="SELECT max(cod_dept) from departamentos";

		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		$arrayResultado = $stmt->fetchAll();

		if(count($arrayResultado) == 1){
			$lastId = (Int) substr($arrayResultado[0]["max(cod_dept)"],1,3);
			$lastId++;
			while(strlen($lastId) != 3){
				$lastId = "0" . $lastId;
			}
			return "D" . $lastId;
		}
	}

	public static function mostrarDesplegableDepartamento($con){
		$sql="SELECT cod_dept,nombre_dpto from departamentos";

		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		echo "<select name='departamento' id='departamento' required>";
		$arrayDeptos = new RecursiveArrayIterator($stmt->fetchAll());
		$departamentos = self::arrayDeptos($arrayDeptos);
		foreach($departamentos as $dpto) {
			echo "<option value='$dpto->cod'>$dpto->nombre</option>";
		}
		echo "</select>";	
	}
}
?>