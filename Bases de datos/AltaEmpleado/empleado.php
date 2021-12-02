<?php
class Empleado{
	public $dni;
	public $nombre;
	public $fechaNacimiento;
	public $departamento;

	function __construct($dni,$nombre,$fechaNacimiento,$departamento){
		$this->dni = limpiar($dni);
		$this->nombre = limpiar($nombre);
		$this->fechaNacimiento = limpiar($fechaNacimiento);
		$this->departamento = limpiar($departamento);
	}

	function darDeAlta($con){
		$sql = "INSERT into empleado (dni,nombre_e,fec_nac,nombre_d) values ('$this->dni', '$this->nombre', '$this->fechaNacimiento', '$this->departamento')";

		try {
			$con->exec($sql);
			echo "Empleado creado correctamente";
		}catch(PDOException $e) {
			echo $sql . "<br>" . $e->getMessage();
		}
	}
}
?>