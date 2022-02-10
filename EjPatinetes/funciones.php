<?php
include_once 'econfig.php';

function crearConexion(){
	try {
        $con = new PDO("mysql:host=". DB_SERVER . ";dbname=" . DB_DATABASE,DB_USERNAME, DB_PASSWORD);
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
	header('Location: ' . "elogin.php");
	die();
}

function cerrarSesion(){
	session_unset();
	session_destroy();
	redirecionarALogin();
}
?>