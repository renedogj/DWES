<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Alta Producto</title>
</head>
<body>
	<?php
	include("../Cliente/Cliente.php");
	include("../funciones.php");
	$con = crearConexion();
	?>
	<div class="divFormRegistrar">
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<h2>Registrar usuario</h2>
			<label>Nif</label>
			<br>
			<input type="text" name="nif" maxlength="9">
			<br><br>
			<label>Nombre</label>
			<br>
			<input type="text" name="nombre" maxlength="40">
			<br><br>
			<label>Apellido</label>
			<br>
			<input type="text" name="apellido" maxlength="40">
			<br><br>
			<label>Direción</label>
			<br>
			<input type="text" name="direccion" maxlength="40">
			<br><br>
			<label>Código postal</label>
			<br>
			<input type="number" name="cp" maxlength="5">
			<br><br>
			<label>Ciudad</label>
			<br>
			<input type="text" name="ciudad" maxlength="40">
			<br><br>
			<label>Contraseña</label>
			<br>
			<input type="password" name="password" maxlength="40">
			<br><br>
			<label>Repite la contraseña</label>
			<br>
			<input type="password" name="passwordconfirmar" maxlength="40">
			<br><br>
			<input type="submit" name="submit" value="Registrar">
		</form>
	</div>
	<?php
	if (formularioEnviado()){
		foreach($_POST as $id => $input){
			$$id = limpiar($input);
		}
		if(Cliente::esNifValido($nif)){
			if($password == $passwordconfirmar){
				$cliente = new Cliente($nif,$nombre,$apellido,$cp,$direccion,$ciudad);
				if($cliente->darDeAlta($con,$password)){
					echo "Te has dado de alta correctamente";
				}
			}else{
				echo "Las contraseñas no coinciden";
			}
		}else{
			echo "El nif introducido no es valido";
		}
	}
	$con = null;
	?>
</body>
</html>