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

	public static function arrayEmple($arrayEmple,$cod_dept){
		$empleados = array();
		foreach($arrayEmple as $emple){
			$empleado = new Empleado($emple["dni"],$emple["nombre"],$emple["apellidos"],$emple["fecha_nac"],$emple["salario"]);
			$empleado->cod_dept = $cod_dept;
			array_push($empleados, $empleado);
		}
		return $empleados;
	}

	public static function convertirAEmpleado($arrayEmple){
		$aux = $arrayEmple[0];
		return new Empleado($aux["dni"],$aux["nombre"],$aux["apellidos"],$aux["fecha_nac"],$aux["salario"]);
	}

	function darDeAlta($con,$cod_dept){
		$sql = "INSERT into empleados (dni,nombre,apellidos,fecha_nac,salario)
		values ('$this->dni', '$this->nombre', '$this->apellidos', '$this->fecha_nac', '$this->salario');";
		$fecha = date("Y-m-d H:i:s");
		$sql .= "INSERT into emple_depart (dni,cod_dept,fecha_ini) VALUES ('$this->dni', '$cod_dept', '$fecha')";
		$this->cod_dept = $cod_dept;
		try {
			$con->exec($sql);
			echo "Empleado creado correctamente";
		}catch(PDOException $e) {
			echo $sql . "<br>" . $e->getMessage();
		}
	}

	function actualizarEmple($con){
		$sql = "UPDATE empleados set nombre='$this->nombre', apellidos='$this->apellidos', fecha_nac='$this->fecha_nac', salario='$this->salario' where dni = '$this->dni'";
		try {
			$result = $con->exec($sql);
		}catch(PDOException $e) {
			echo $sql . "<br>" . $e->getMessage();
			return -1;
		}
	}

	function cambiarDepartamento($con,$newDepartamento){
		$fecha = date("Y-m-d H:i:s");
		$sql = "UPDATE emple_depart set fecha_fin = '$fecha' where dni = '$this->dni' and cod_dept = '$this->cod_dept' and fecha_fin is null;";

		$sql .= "INSERT into emple_depart (dni,cod_dept,fecha_ini) VALUES ('$this->dni', '$newDepartamento', '$fecha')";
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
			$sql = "SELECT cod_dept from emple_depart where dni = '$dni' and fecha_fin is null";

			$stmt = $con->prepare($sql);
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			$arrayCod = $stmt->fetchAll();
			
			$empleado->cod_dept = $arrayCod[0]["cod_dept"];
			return $empleado;
		}
	}

	public static function getEmpleadosDept($con,$cod_dept){
		$sql = "SELECT empleados.dni as dni, nombre, apellidos, fecha_nac, salario from empleados,emple_depart where empleados.dni = emple_depart.dni and cod_dept = '$cod_dept' and fecha_fin is null group by empleados.dni";

		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

		$arrayEmple = new RecursiveArrayIterator($stmt->fetchAll());
		$empleados = self::arrayEmple($arrayEmple,$cod_dept);
		if(count($empleados) > 0 ){
			self::mostrarEmpleados($empleados);
		}else{
			echo "No hay empleados del departamento $cod_dept";
		}
	}

	public static function getHistorialDept($con){
		$sql = "SELECT cod_dept,fecha_ini,fecha_fin from emple_depart where dni = '54537052G' order by fecha_ini desc;";

		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

		$arrayDeptos = new RecursiveArrayIterator($stmt->fetchAll());
		echo "<table>";
		foreach($arrayDeptos as $depto){
			echo "<td>";
			foreach($depto as $i){
				echo "<td>$i</td>";
			}
			echo "</tr>";
		}
		echo "</table>";
	}

	public static function mostrarDesplegableEmpleados($con){
		$sql="SELECT dni, nombre, apellidos from empleados";

		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		
		$arrayEmple = new RecursiveArrayIterator($stmt->fetchAll());
		echo "<select name='empleado' id='empleado' required>";
		foreach($arrayEmple as $empleado){
			foreach($empleado as $a => $i){
				$$a = $i;
			}
			echo "<option value='$dni'>$nombre $apellidos</option>";
		}
		echo "</select>";
	}

	function modificarSueldo($con,$porcentaje){
		$this->salario += ($this->salario*$porcentaje)/100;
		self::actualizarEmple($con);
	}

	public static function mostrarEmpleados($arrayEmple){
		echo "<table>";
		echo "<tr>
				<th>DNI</th>
				<th>Nombre</th>
				<th>Apellidos</th>
				<th>Fecha de nacimiento</th>
				<th>Salario</th>
			</tr>";
		foreach($arrayEmple as $empleado){
			echo "<tr>
				<td>$empleado->dni</td>
				<td>$empleado->nombre</td>
				<td>$empleado->apellidos</td>
				<td>$empleado->fecha_nac</td>
				<td>$empleado->salario</td>
			</tr>";
		}
		echo "</table>";
	}
}
?>