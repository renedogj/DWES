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

function altaDepartamento($con,$departamento){
	$departamento = limpiar($departamento);
	if($departamento != null && $departamento != ""){
		try {
			$sql = "INSERT INTO departamento (nombre_d) VALUES ('$departamento')";

			if ($con->exec($sql)) {
				echo "Nuevo departamento creado";
			}		
		} catch(PDOException $e) {
			echo $sql . "<br>" . $e->getMessage();
		}
	}
}

function limpiar($string){
	return trim(addslashes($string));
}
?>