<?php
class Empleado{
	public $dni;
	public $nombre;
	public $apellidos;
	public $fecha_nac;
	public $salario;

	function __construct($dni,$nombre,$apellidos,$fecha_nac,$salario){
		$this->dni = limpiar($dni);
		$this->nombre = limpiar($nombre);
		$this->apellidos = limpiar($apellidos);
		$this->fecha_nac = limpiar($fecha_nac);
		$this->salario = limpiar($salario);
	}

	function darDeAlta($con){
		$sql = "INSERT into empleados (dni,nombre,apellidos,fecha_nac,salario)
			values ('$this->dni', '$this->nombre', '$this->apellidos', '$this->fecha_nac', '$this->salario')";

		try {
			$con->exec($sql);
			echo "Empleado creado correctamente";
		}catch(PDOException $e) {
			echo $sql . "<br>" . $e->getMessage();
		}
	}
}
?>