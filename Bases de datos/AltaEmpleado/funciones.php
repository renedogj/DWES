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

function mostrarDesplegableCategorias($con){
	$sql="SELECT nombre_d from departamento";

	$stmt = $con->prepare($sql);
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	echo "<select name='departamento' id='departamento' required>";
	foreach($stmt->fetchAll() as $row) {
		$departamento = $row['nombre_d'];
		echo "<option value='$departamento'>$departamento</option>";
	}
	echo "</select>";	
}
?>