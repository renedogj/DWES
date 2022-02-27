<?php
function cerrarSesion(){
	session_unset();
	session_destroy();
	redirecionarALogin();
}

function redirecionarALogin(){
	header('Location: ' . "alqlogin.php");
	die();
}
?>