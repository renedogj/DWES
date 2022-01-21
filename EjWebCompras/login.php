<?php
session_start();
$redireccion = "menu.php";
if(isset($_SESSION['nif'])){
	header('Location: '.$redireccion);
	die();
}
include("Cliente/Cliente.php");
include("funciones.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
	<div class="contenedora">
		<div class="iniciosesion">
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="form-inicio-sesion">
				<h1>Iniciar Sesion</h1>
				<div class="div-contenedora-labelinput">
					<label for="nif">Nif de usuario:</label>
					<input type="text" name="nif" maxlength="45" size="30">
				</div>
				<div class="div-contenedora-labelinput">
					<label for="password">Contraseña:</label>
					<input name="password" type="password" size="30" maxlength="25" required placeholder=" Contraseña"/>
				</div>
				<button class="boton-iniciarsesion" id="boton" type="submit">Iniciar Sesión</button>
			</form>
		</div>
	</div>
	<?php
	if(formularioEnviado()){
		$nif = $_POST['nif'];
		$password = $_POST['password'];
		$con = crearConexion();
		$cliente = Cliente::comprobarCredenciales($con,$nif,$password);
		if($cliente != null){
			$_SESSION['nif'] = $nif;
			$_SESSION['carrito'] = array();
			header('Location: '.$redireccion);
			die();
		}else{
			echo "Credenciales incorrectas";
		}
		$con=null;
	}
	?>
</body>
</html>