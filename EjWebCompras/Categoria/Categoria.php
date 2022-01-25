<?php
class Categoria{
	public $id;
	public $nombre;

	public function __construct($id,$nombre){
		$this->id = $id;
		$this->nombre = $nombre;
	}

	public static function newCategoria($con,$nombre){
		$cod = self::obtenerNuevoId($con);
		return new Categoria($cod,$nombre);
	}

	public static function arrayCategorias($arrayCategorias){
		$Categorias = array();
		foreach($arrayCategorias as $cate){
			$categoria = new Categoria($cate["id_categoria"],$cate["nombre"]);
			array_push($Categorias, $categoria);
		}
		return $Categorias;
	}

	public function darDeAlta($con){
		if($this->nombre != null && $this->nombre != "" && $this->id != "" && $this->id != null){
			try {
				$sql = "INSERT INTO categoria (id_categoria,nombre) VALUES ('$this->id','$this->nombre')";

				if ($con->exec($sql)) {
					echo "Nueva categoria creada";
				}	
			} catch(PDOException $e) {
				echo $sql . "<br>" . $e->getMessage();
			}
		}
	}

	public static function obtenerNuevoId($con){
		$sql="SELECT max(id_categoria) as max from categoria";

		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		$arrayResultado = $stmt->fetchAll();

		if(count($arrayResultado) == 1){
			$lastId = (Int) substr($arrayResultado[0]["max"],1,3);
			$lastId++;
			while(strlen($lastId) != 3){
				$lastId = "0" . $lastId;
			}
			return "C" . $lastId;
		}
	}
	
	public static function mostrarDesplegableCategorias($con){
		$sql="SELECT id_categoria,nombre from categoria";

		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		echo "<select name='categoria' id='categoria' required>";
		$arrayCategorias = new RecursiveArrayIterator($stmt->fetchAll());
		$Categorias = self::arrayCategorias($arrayCategorias);
		foreach($Categorias as $categoria) {
			echo "<option value='$categoria->id'>$categoria->nombre</option>";
		}
		echo "</select>";	
	}

	public function __toString(){
		return "id: " . $this->id . " nombre: " . $this->nombre;
	}
}
?>