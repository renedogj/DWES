<?php
class Empleado{
	public $dni;
	public $nombre;
	public $apellidos;
	public $fecha_nac;
	public $salario;
	public $departamento;

	function __construct($dni,$nombre,$apellidos,$fecha_nac,$salario){
		$this->dni = limpiar($dni);
		$this->nombre = limpiar($nombre);
		$this->apellidos = limpiar($apellidos);
		$this->fecha_nac = limpiar($fecha_nac);
		$this->salario = limpiar($salario);
		//$this->departamento = $departamento;
	}

	function darDeAlta($con,$cod_dept){
		$sql = "INSERT into empleados (dni,nombre,apellidos,fecha_nac,salario)
			values ('$this->dni', '$this->nombre', '$this->apellidos', '$this->fecha_nac', '$this->salario');";
		$fecha = date("Y-m-d H:i:s");
		$sql2 = "INSERT into emple_depart (dni,cod_dpto,fecha_ini) VALUES ('$this->dni', '$cod_dept', '$fecha')";
		try {
			$con->exec($sql);
			$con->exec($sql2);
			echo "Empleado creado correctamente";
		}catch(PDOException $e) {
			echo $sql . "<br>" . $e->getMessage();
		}
	}
}
?>