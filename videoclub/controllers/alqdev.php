<?php
session_start();

include_once 'funciones.php';
include_once '../db/db.php';
include_once '../models/peliculas.php';
include_once '../views/funciones.php';

$con=conexion();

if(isset($_SESSION['customer']) && isset($_SESSION['carrito'])){
	$peliculasAlquildas = obternerPeliculasAlquiladas($con,$_SESSION['customer']['customer_id']);

	if(isset($_POST["devolver"])){
		
	}else if(isset($_POST["volver"])){
		header('Location: ' . "alqwelcome.php");
		die();
	}
	include_once '../views/devolverPeliculas.php';
}else{
	cerrarSesion();
}
?>


