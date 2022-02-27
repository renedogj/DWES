<?php
session_start();

include_once 'funciones.php';
include_once '../db/db.php';
include_once '../models/peliculas.php';
include_once '../views/funciones.php';

$con=conexion();

if(isset($_SESSION['customer']) && isset($_SESSION['carrito'])){
	$themes = obtenerThemes($con);
	$peliculasTematica = [];
	if(isset($_POST["mostrar"])){
		if(isset($_POST['theme'])){
			$theme = $_POST['theme'];
			$peliculasTematica = obtenerPeliculasAlquiladasTematica($con,$_SESSION['customer']['customer_id'],$theme);
		}
	}else if(isset($_POST["volver"])){
		header('Location: ' . "alqwelcome.php");
		die();
	}
	include_once '../views/consultarAlquileres.php';
}else{
	cerrarSesion();
}
?>