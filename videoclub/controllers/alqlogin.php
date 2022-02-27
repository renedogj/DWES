<?php
session_start();
include_once '../db/db.php';
include_once '../models/login.php';
include_once 'funciones.php';

$conn=conexion();
if(isset($_POST['submit'])){//Si no se ha pulsado el boton de login cierra sesión

	if(isset($_POST['usuario']) && isset($_POST['clave'])){//Si se han rellenado los campos del login
		
		$respuesta = getCustomerId($conn,$_POST['usuario'], $_POST['clave']);

		$result = $respuesta->setFetchMode(PDO::FETCH_ASSOC);
        $customer = new RecursiveArrayIterator($respuesta->fetchAll());

		if($respuesta->rowCount() > 0){
			$_SESSION['customer'] = $customer[0];
			$_SESSION['carrito'] = [];
			header("location:alqwelcome.php");
		}else{
			echo "No existe ningun email con esa contrase&ntilde;a.";
		}
	}else{
		if(!isset($_POST['usuario'])){
			echo "No se ha proporcionado un usuario!";
		}
		if(!isset($_POST['clave'])){
			echo "No se ha proporcionado una contrase&ntilde;a!";
		}
	}
}else{
	include_once '../views/login.php';
}
?>