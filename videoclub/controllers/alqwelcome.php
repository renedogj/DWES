<?php
session_start();

include_once 'funciones.php';

if(isset($_POST['cerrarSesion'])){
	cerrarSesion();
}else{
	if(isset($_SESSION['customer'])){
		include_once '../views/welcome.php';
	}else{
		cerrarSesion();
	}
}
?>