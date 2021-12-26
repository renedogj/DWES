<?php
class Producto{
	public $id;
	public $nombre;
	public $precio;
	public $categoria;

	public function __construct($id,$nombre,$precio,$categoria){
		$this->id = $id;
		$this->nombre = $nombre;
		$this->precio = $precio;
		$this->categoria = $categoria;
	}

	public static function newProducto($con,$nombre,$precio,$categoria){
		$cod = self::obtenerNuevoId($con);
		return new Producto($cod,$nombre,$precio,$categoria);
	}


	public function darDeAlta($con){
		try {
			$sql = "INSERT INTO productos (id,nombre,precio,id_categoria) VALUES ('$this->id','$this->nombre','$this->precio','$this->categoria')";

			if ($con->exec($sql)) {
				echo "Nuevo producto creado";
			}	
		} catch(PDOException $e) {
			echo $sql . "<br>" . $e->getMessage();
		}
		
	}

	public static function obtenerNuevoId($con){
		$sql="SELECT max(id) as max from productos";

		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		$arrayResultado = $stmt->fetchAll();

		if(count($arrayResultado) == 1){
			$lastId = (Int) substr($arrayResultado[0]["max"],1,4);
			$lastId++;
			while(strlen($lastId) != 4){
				$lastId = "0" . $lastId;
			}
			return "P" . $lastId;
		}
	}

	public function __toString(){
		return "<br>Producto:" .
			"<br>id: " . $this->id .
			"<br> nombre: " . $this->nombre .
			"<br>precio: " . $this->precio .
			"<br>categoria: " . $this->categoria;
	}
}
?>