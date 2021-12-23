<?php
function crearConexion(){
	$servidor = "localhost";
	$usuario = "root";
	$password = "rootroot";
	$dataBase="empleados1n";

	try {
		$con = new PDO("mysql:host=$servidor;dbname=$dataBase", $usuario, $password);
		// set the PDO error mode to exception
		$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $con;
	} catch(PDOException $e) {
		echo "Connection failed: " . $e->getMessage();
	}
}

function formularioEnviado(){
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		foreach($_POST as $input){
			if($input == null){
				return false;
			}
		}
		return true;
	}
	return false;
}

function limpiar($string){
	return trim(addslashes($string));
}

function empleDeptFecha($con,$fecha){
	$sql = "select empleados.dni,nombre,apellidos,emple_depart.cod_dept,nombre_dpto from empleados,emple_depart,departamentos where empleados.dni = emple_depart.dni and emple_depart.cod_dept = departamentos.cod_dept and fecha_ini >= '$fecha' and (fecha_fin <= '$fecha' or fecha_fin is null);";

	$stmt = $con->prepare($sql);
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	if($result){
		$arrayRows = new RecursiveArrayIterator($stmt->fetchAll());
		if(count($arrayRows) > 0){
			echo "<table>";
			foreach($arrayRows as $row){
				echo "<td>";
				foreach($row as $i){
					echo "<td>$i</td>";
				}
				echo "</tr>";
			}
			echo "</table>";
		}else{
			echo "No hay ningún empleado en esa fecha";
		}
	}
}
?>