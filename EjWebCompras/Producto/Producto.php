<?php
class Producto{
	public $id;
	public $nombre;
	public $precio;
	public $categoria;
	public $stockTotal;

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
			$producto = new Producto($producto["id_producto"],$producto["nombre"],$producto["precio"],$producto["id_categoria"]);
			array_push($productos, $producto);
		}
		return $productos;
	}

	public function darDeAlta($con){
		try {
			$sql = "INSERT INTO producto (id_producto,nombre,precio,id_categoria) VALUES ('$this->id','$this->nombre','$this->precio','$this->categoria')";

			if ($con->exec($sql)) {
				echo "Nuevo producto creado";
			}	
		} catch(PDOException $e) {
			echo $sql . "<br>" . $e->getMessage();
		}
	}

	public static function obtenerProducto($con,$id){
		$sql = "SELECT * from producto where id_producto='$id'";

		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

		$arrayProductos = new RecursiveArrayIterator($stmt->fetchAll());
		$productos = self::arrayProductos($arrayProductos);

		if(count($productos) == 1){
			$productos[0]->obtenerStockTotal($con);
			return $productos[0];
		}
		return null;
	}

	public function mostrarStock($con){
		$sql = "SELECT num_almacen,cantidad from almacena where id_producto='$this->id'";

		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		$arrayStock = new RecursiveArrayIterator($stmt->fetchAll());
		$cantidadTotal = 0;
		echo "<table>";
		echo "<tr>
				<th>Producto</th>
				<th>Almacen</th>
				<th>Cantidad</th>
			</tr>";
		foreach($arrayStock as $stock) {
			$cantidadTotal += $stock["cantidad"];
			echo "<tr>
					<td>" . $this->id . "</td>
					<td>" . $stock["num_almacen"] . "</td>
					<td>" . $stock["cantidad"] . "</td>
				</tr>";
		}
		echo "<tr>
				<td colspan ='2'>Cantidad total</td>
				<td>" . $cantidadTotal . "</td>
			</tr>";
		echo "</table>";
	}

	public function obtenerStockTotal($con){
		$sql = "SELECT sum(cantidad) from almacena where id_producto= '$this->id'";

		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		$arrayStock = new RecursiveArrayIterator($stmt->fetchAll());

		$this->stockTotal = $arrayStock[0]["sum(cantidad)"];
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
		$sql="SELECT max(id_producto) as max from producto";

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

	public static function obtenerProductos($con){
		$sql = "SELECT * from producto";

		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

		$arrayProductos = new RecursiveArrayIterator($stmt->fetchAll());
		$productos = self::arrayProductos($arrayProductos);

		return $productos;
	}

	public static function mostrarDesplegableProductos($con){
		$sql="SELECT * from producto";
		
		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

		$arrayProductos = new RecursiveArrayIterator($stmt->fetchAll());
		var_dump($arrayProductos);
		$productos = self::arrayProductos($arrayProductos);
		var_dump($productos);

		echo "<select name='producto' id='producto' required>";
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