<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Alta empleado</title>
</head>
<body>
	<?php
		include("funciones.php");
		include("empleado.php");
		$con = crearConexion();
	?>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<table>
			<tr>
				<th>Alta Empleado</th>
			<tr>
			<tr>
				<td>DNI</td>
				<td><input type="text" name="dni"></td>
			</tr>
			<tr>
				<td>Nombre</td>
				<td><input type="text" name="nombre"></td>
			</tr>
			<tr>
				<td>Fecha de Nacimiento</td>
				<td><input type="text" name="fechaNacimiento"></td>
			</tr>
			<tr>
				<td>Departamento</td>
				<td><?php mostrarDesplegableCategorias($con); ?></td>
			</tr>
		</table>
		<br>
		<input type="submit" value="Crear nuevo empleado">		
	</form>
	<?php

		if(formularioEnviado()){
			foreach($_POST as $id => $input){
				$$id = $input;
			}
			$empleado = new Empleado($dni,$nombre,$fechaNacimiento,$departamento);
			$empleado->darDeAlta($con);
			$con = null;
		}
	?>
</body>
</html>