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

	public static function arrayProductos($arrayProductos){
		$productos = array();
		foreach($arrayProductos as $producto){
			$producto = new Producto($producto["id"],$producto["nombre"],$producto["precio"],$producto["id_categoria"]);
			array_push($productos, $producto);
		}
		return $productos;
	}

	public function darDeAlta($con){
		try {
			$sql = "INSERT INTO productos (id,nombre,precio,id_productogoria) VALUES ('$this->id','$this->nombre','$this->precio','$this->categoria')";

			if ($con->exec($sql)) {
				echo "Nuevo producto creado";
			}	
		} catch(PDOException $e) {
			echo $sql . "<br>" . $e->getMessage();
		}
	}

	public static function aprovisionar($con,$almacen,$producto,$cantidad){
		try {
			$sql = "INSERT INTO almacena (num_almacen,id_producto,cantidad) VALUES ('$almacen','$producto','$cantidad')";
			if ($con->exec($sql)) {
				echo $cantidad ." unidades del producto " . $producto . " se han añadido al alamacen " . $almacen;
			}
		} catch(PDOException $e) {
			if($e->getCode() == 23000){
				try {
					$sql = "UPDATE almacena set cantidad = cantidad + '$cantidad' where num_almacen = '$almacen' and id_producto = '$producto'";
					if ($con->exec($sql)) {
						echo $cantidad ." unidades del producto " . $producto . " se han añadido al alamacen " . $almacen;
					}
				} catch(PDOException $e) {
					echo $sql . "<br>" . $e->getMessage();
				}
			}
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

	public static function mostrarDesplegableProductos($con){
		$sql="SELECT id,nombre,precio,id_categoria from productos";

		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		echo "<select name='producto' id='producto' required>";
		$arrayProductos = new RecursiveArrayIterator($stmt->fetchAll());
		$productos = self::arrayProductos($arrayProductos);
		foreach($productos as $producto) {
			echo "<option value='$producto->id'>$producto->nombre</option>";
		}
		echo "</select>";	
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