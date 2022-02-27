<?php
session_start();

include_once 'funciones.php';
include_once '../db/db.php';
include_once '../models/peliculas.php';
include_once '../views/funciones.php';

$con=conexion();

if(isset($_SESSION['customer']) && isset($_SESSION['carrito'])){
	$peliculas = obtenerPeliculasStock($con);
	$mensaje = "";
	if(isset($_POST["agregar"])){
		if(isset($_POST['peliculas'])){
			$pelicula = $_POST['peliculas'];
			if(isset($_SESSION['carrito'][$pelicula])){
				$_SESSION['carrito'][$pelicula]++;
			}else{
				$_SESSION['carrito'][$pelicula] = 1;
			}
			$mensaje = "Pelicula añadida al carrito";
		}
	}else if(isset($_POST["vaciar"])){
		$_SESSION['carrito'] = [];
		$mensaje = "Carrito vaciado";
	}else if(isset($_POST["alquilar"])){
		$peliculasCarrito = $_SESSION["carrito"];

		if(count($peliculasCarrito) > 0){
			if(posibilidadAlquiler($peliculas,$peliculasCarrito)){
				foreach($peliculasCarrito as $film_id=>$cantidad){
					for ($i=0; $i<$cantidad; $i++) {
						alquilarPelicula($con,$film_id,$_SESSION['customer']['customer_id']);
					}
					actualizarInventario($con,$film_id,$cantidad);
				}
				$_SESSION['carrito'] = [];
				$mensaje = "Alquiler realizado con exito <br> Carrito vaciado";
			}else{
				$mensaje = "Está intentando alquilar peliculas que ya no están en stock";
			}
		}else{
			$mensaje = "No se puede alquiar porque el carrito está vacio";
		}
	}else if(isset($_POST["volver"])){

		header('Location: ' . "alqwelcome.php");
		die();
	}
	include_once '../views/alquilerPeliculas.php';
}else{
	cerrarSesion();
}

function posibilidadAlquiler($peliculas,$peliculasCarrito){
	foreach($peliculas as $pelicula){
		if(isset($peliculasCarrito[$pelicula["film_id"]])){
			if($pelicula["quantity"] < $peliculasCarrito[$pelicula["film_id"]]){
				return false;
			}
		}
	}
	return true;
}
?>