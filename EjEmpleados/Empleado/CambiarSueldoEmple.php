<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Modificar sueldo empleado</title>
</head>
<body>
	<?php
		include("../Departamento/Departamento.php");
		include("Empleado.php");
		include("../funciones.php");
		$con = crearConexion();
	?>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<table>
			<tr>
				<th>Modificar sueldo Empleado</th>
			<tr>
			<tr>
				<td>DNI Empleado</td>
				<td><input type="text" name="dni"></td>
			</tr>
			<tr>
				<td>Porcentaje cambio de salario</td>
				<td><input type="text" name="porcentaje">%</td>
			</tr>
		</table>
		<br>
		<input type="submit" value="Modificar sueldo">		
	</form>
	<?php
		if(formularioEnviado()){
			foreach($_POST as $id => $input){
				$$id = $input;
			}

			$empleado = Empleado::getEmpleado($con,$dni);
			$nuevoSueldo = $empleado->modificarSueldo($con,$porcentaje);
		}
		$con = null;
	?>
</body>
</html>