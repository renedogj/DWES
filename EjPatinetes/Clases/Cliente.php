<?php
class Cliente{
	public $dni;
	public $nombre;
	public $apellido;
	public $email;
	public $saldo;
	public $fecha_alta;
	public $fecha_baja;

	public function __construct($dni,$nombre,$apellido,$email,$saldo,$fecha_alta,$fecha_baja){
		$this->dni = $dni;
		$this->nombre = $nombre;
		$this->apellido = $apellido;
		$this->email = $email;
		$this->saldo = $saldo;
		$this->fecha_alta = $fecha_alta;
        $this->fecha_baja = $fecha_baja;
	}

	public static function comprobarCredenciales($con,$email,$dni){
		$sql = "SELECT nombre,apellido,email,saldo,fecha_alta,fecha_baja FROM eclientes where dni='$dni' and email='$email'";

		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		$arrayCliente = new RecursiveArrayIterator($stmt->fetchAll());

		if(count($arrayCliente) == 1){
			$aux = $arrayCliente[0];
			$cliente = new Cliente($dni,$aux['nombre'],$aux['apellido'],$email,$aux['saldo'],$aux['fecha_alta'],$aux['fecha_baja']);
			return $cliente;
		}else{
			return null;
		}
	}

    public static function obtenerCliente($con,$email){
		$sql = "SELECT * from eclientes where email='$email'";

		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

		$arrayClientes = new RecursiveArrayIterator($stmt->fetchAll());

		if(count($arrayClientes) == 1){
            $aux = $arrayClientes[0];
            return new Cliente($aux['dni'],$aux['nombre'],$aux['apellido'],$email,$aux['saldo'],$aux['fecha_alta'],$aux['fecha_baja']);
		}
		return null;
	}

    public function desplegablePatinetesAlquilados($con){
        $sql="SELECT matricula from ealquileres where dni='$this->dni' and fecha_devolucion is null";

		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

		$arrayPatinetes = new RecursiveArrayIterator($stmt->fetchAll());
        if(count($arrayPatinetes) >0){
            echo "<select name='patinetes' class='form-control'>";
            foreach($arrayPatinetes as $patinete) {
                echo "<option value='".$patinete["matricula"]."'>".$patinete["matricula"]."</option>";
            }
            echo "</select>";	
        }else{
            echo "No tienes patines alquilados";
        }
    }
}
?>