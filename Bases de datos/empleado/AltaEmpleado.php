<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Alta empleado</title>
</head>
<body>
	<?php
		include("../departamento/Departamento.php");
		include("Empleado.php");
		include("../funciones.php");
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
				<td>Apellido</td>
				<td><input type="text" name="apellido"></td>
			</tr>
			<tr>
				<td>Fecha de Nacimiento</td>
				<td><input type="date" name="fecha_nac"></td>
			</tr>
			<tr>
				<td>Salario</td>
				<td><input type="text" name="salario"></td>
			</tr>
			<tr>
				<td>Departamento</td>
				<td><?php Departamento::mostrarDesplegableDepartamento($con); ?></td>
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

			$empleado = new Empleado($dni,$nombre,$apellido,$fecha_nac,$salario);
			$empleado->darDeAlta($con,$departamento);
			$con = null;
		}
	?>
</body>
</html>