<?php
class Patinete{
	public $matricula;
	public $bateria;
	public $preciobase;
	public $disponible;

	public function __construct($matricula,$bateria,$preciobase,$disponible){
		$this->matricula = $matricula;
		$this->bateria = $bateria;
		$this->preciobase = $preciobase;
		$this->disponible = $disponible;
	}

	public static function arrayPatinetes($arrayPatinetes){
		$patinetes = array();
		foreach($arrayPatinetes as $patinete){
			$patinete = new Patinete($patinete["matricula"],$patinete["bateria"],$patinete["preciobase"],$patinete["disponible"]);
			array_push($patinetes, $patinete);
		}
		return $patinetes;
	}

	public static function obtenerFechaInfoAlquiler($con,$matricula,$dni){
		$sql = "SELECT fecha_alquiler,NOW() as fin, TIMESTAMPDIFF(MINUTE,fecha_alquiler,NOW()) as dif,preciobase
        from ealquileres,epatines
        where ealquileres.matricula=epatines.matricula and
        ealquileres.matricula='$matricula' and dni='$dni' and fecha_devolucion is null";

		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

		$arrayPatinetes = new RecursiveArrayIterator($stmt->fetchAll());
        //var_dump($arrayPatinetes[0]);
		if(count($arrayPatinetes) == 1){
			return $arrayPatinetes[0];
		}
		return null;
	}

	public static function obtenerPatinetesAlquilados($con,$dni,$fechaInicio,$fechaFin){
		$sql = "SELECT epatines.matricula,bateria,preciototal,fecha_alquiler,fecha_devolucion
        from epatines,ealquileres
        where epatines.matricula = ealquileres.matricula and
        dni='$dni' and fecha_alquiler>='$fechaInicio' and fecha_devolucion<='$fechaFin'
        order by epatines.matricula,fecha_alquiler";

		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

		$arrayPatinetes = new RecursiveArrayIterator($stmt->fetchAll());

		return $arrayPatinetes;
	}

	public static function mostrarDesplegablePatinetesDisponibles($con){
		$sql="SELECT * from epatines where disponible='S'";
		
		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

		$arrayPatinetes = new RecursiveArrayIterator($stmt->fetchAll());
		$patinetes = self::arrayPatinetes($arrayPatinetes);

        $patinetesCarrito = $_SESSION["carrito"];

		echo "<select name='patinetes' class='form-control'>";
		foreach($patinetes as $patinete) {
            if(!isset($patinetesCarrito[$patinete->matricula])){
                echo "<option value='$patinete->matricula'>$patinete->matricula</option>";
            }
		}
		echo "</select>";	
	}

    public static function alquilarPatinete($con,$dni,$matricula,$fecha){
        try {
			$sql = "INSERT INTO ealquileres (dni,matricula,fecha_alquiler) VALUES ('$dni','$matricula','$fecha')";

			if ($con->exec($sql)) {
                unset($_SESSION["carrito"]["matricula"]);
				echo "Patinete con " . $matricula . " alquilado con éxito<br>";
			}	
		} catch(PDOException $e) {
			echo $sql . "<br>" . $e->getMessage();
		}
    }
    
    public static function devolverPatinete($con,$dni,$matricula,$fechaInicio,$fechaFin,$importe){
        try {
            $sql = "UPDATE ealquileres set fecha_devolucion='$fechaFin', preciototal='$importe'
            where matricula='$matricula' and dni='$dni' and fecha_alquiler='$fechaInicio'";

            if ($con->exec($sql)) {
                echo "Patinete con " . $matricula . " devuelto con éxito<br>";

                $sql = "UPDATE eclientes set saldo=saldo-$importe where dni='$dni'";

                $con->exec($sql);
            }
        } catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }

    public static function mostrarPatinetes($arrayPatinetes){
        echo "<table>
            <tr>
                <th>Matricula</th>
                <th>Bateria</th>
                <th>Precio Total</th>
                <th>Fecha de Alquiler</th>
                <th>fecha de Devolucion</th>
            </tr>";
        foreach($arrayPatinetes as $patinete){
            echo "<tr>
                    <td>" . $patinete["matricula"] . "</td>
                    <td>" . $patinete["bateria"] . "</td>
                    <td>" . $patinete["preciototal"] . "</td>
                    <td>" . $patinete["fecha_alquiler"] . "</td>
                    <td>" . $patinete["fecha_devolucion"] . "</td>
                </tr>";
        }
        echo "</table>";
    }
}
?>