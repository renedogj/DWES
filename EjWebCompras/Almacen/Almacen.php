<?php
class Almacen{
	public $num;
	public $localidad;

	public function __construct($num,$localidad){
		$this->num = $num;
		$this->localidad = $localidad;
	}

	public static function newAlmacen($con,$localidad){
		$num = self::obtenerNuevoNum($con);
		return new Almacen($num,$localidad);
	}

	public static function arrayAlmacenes($arrayAlmacenes){
		$almacenes = array();
		foreach($arrayAlmacenes as $cate){
			$almacen = new Almacen($cate["num"],$cate["localidad"]);
			array_push($almacenes, $almacen);
		}
		return $almacenes;
	}

	public function darDeAlta($con){
		if($this->localidad != null && $this->localidad != "" && $this->num != "" && $this->num != null){
			try {
				$sql = "INSERT INTO Almacenes (num,localidad) VALUES ('$this->num','$this->localidad')";

				if ($con->exec($sql)) {
					echo "Nueva almacen creada";
				}	
			} catch(PDOException $e) {
				echo $sql . "<br>" . $e->getMessage();
			}
		}
	}

	public static function obtenerNuevoNum($con){
		$sql="SELECT max(num) as max from Almacenes";

		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		$arrayResultado = $stmt->fetchAll();

		if(count($arrayResultado) == 1){
			return $arrayResultado[0]["max"]+10;
		}
	}
	
	public static function mostrarDesplegableAlmacenes($con){
		$sql="SELECT num,localidad from Almacenes";

		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		echo "<select name='almacen' id='almacen' required>";
		$arrayAlmacenes = new RecursiveArrayIterator($stmt->fetchAll());
		$almacenes = self::arrayAlmacenes($arrayAlmacenes);
		foreach($almacenes as $almacen) {
			echo "<option value='$almacen->num'>$almacen->localidad</option>";
		}
		echo "</select>";	
	}

	public function __toString(){
		return "num: " . $this->num . " localidad: " . $this->localidad;
	}
}
?>