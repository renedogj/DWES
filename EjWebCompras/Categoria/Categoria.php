<?php
class Categoria{
	public $id;
	public $nombre;

	public function __construct($id,$nombre){
		$this->id = $id;
		$this->nombre = $nombre;
	}

	public static function newCategoria($con,$nombre){
		$cod = self::obtenerNuevoCod($con);
		return new Categoria($cod,$nombre);
	}


	public function darDeAlta($con){
		if($this->nombre != null && $this->nombre != "" && $this->id != "" && $this->id != null){
			try {
				$sql = "INSERT INTO categorias (id,nombre) VALUES ('$this->id','$this->nombre')";

				if ($con->exec($sql)) {
					echo "Nueva categoria creada";
				}	
			} catch(PDOException $e) {
				echo $sql . "<br>" . $e->getMessage();
			}
		}
	}

	public static function obtenerNuevoCod($con){
		$sql="SELECT max(id) as max from categorias";

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

	public function __toString(){
		return "id: " . $this->id . " nombre: " . $this->nombre;
	}
}
?>