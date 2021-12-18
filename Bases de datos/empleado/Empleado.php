<?php
class Empleado{
	public $dni;
	public $nombre;
	public $apellidos;
	public $fecha_nac;
	public $salario;
	public $cod_dept;

	function __construct($dni,$nombre,$apellidos,$fecha_nac,$salario){
		$this->dni = limpiar($dni);
		$this->nombre = limpiar($nombre);
		$this->apellidos = limpiar($apellidos);
		$this->fecha_nac = limpiar($fecha_nac);
		$this->salario = limpiar($salario);
	}

	public static function convertirAEmpleado($arrayEmple){
		$aux = $arrayEmple[0];
		return new Empleado($aux["dni"],$aux["nombre"],$aux["apellidos"],$aux["fecha_nac"],$aux["salario"]);
	}

	function darDeAlta($con,$cod_dept){
		$sql = "INSERT into empleados (dni,nombre,apellidos,fecha_nac,salario)
		values ('$this->dni', '$this->nombre', '$this->apellidos', '$this->fecha_nac', '$this->salario');";
		$fecha = date("Y-m-d H:i:s");
		$sql .= "INSERT into emple_depart (dni,cod_dpto,fecha_ini) VALUES ('$this->dni', '$cod_dept', '$fecha')";
		$this->cod_dept = $cod_dept;
		try {
			$con->exec($sql);
			echo "Empleado creado correctamente";
		}catch(PDOException $e) {
			echo $sql . "<br>" . $e->getMessage();
		}
	}

	function cambiarDepartamento($con,$newDepartamento){
		$fecha = date("Y-m-d H:i:s");
		$sql = "UPDATE emple_depart set fecha_fin = '$fecha' where dni = '$this->dni' and cod_dpto = '$this->cod_dept' and fecha_fin is null;";

		$sql .= "INSERT into emple_depart (dni,cod_dpto,fecha_ini) VALUES ('$this->dni', '$newDepartamento', '$fecha')";
		try {
			$con->exec($sql);
			$this->cod_dept = $newDepartamento;
			echo "Empleado cambiado de departamento correctamente";
		}catch(PDOException $e) {
			echo $sql . "<br>" . $e->getMessage();
		}
	}

	public static function getEmpleado($con,$dni){
		$sql="SELECT * from empleados where dni = '$dni'";

		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

		$arrayEmple = $stmt->fetchAll();
		if(count($arrayEmple) == 1){
			$empleado = self::convertirAEmpleado($arrayEmple);
			$sql = "SELECT cod_dpto from emple_depart where dni = '$dni' and fecha_fin is null";

			$stmt = $con->prepare($sql);
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			$arrayCod = $stmt->fetchAll();
			
			$empleado->cod_dept = $arrayCod[0]["cod_dpto"];
			return $empleado;
		}
	}
}
?>