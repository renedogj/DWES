<?php
function crearConexion(){
	$servidor = "localhost";
	$usuario = "root";
	$password = "rootroot";
	$dataBase="comprasweb";

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

function redirecionarALogin(){
	header('Location: ' . "http://192.168.206.230/Desarrollo%20entorno%20servidor/EjWebCompras/login.php");
	die();
}

function cerrarSesion(){
	session_unset();
	session_destroy();
	redirecionarALogin();
}
?>