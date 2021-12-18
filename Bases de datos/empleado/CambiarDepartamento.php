<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
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
				<th>Actualizar departamento</th>
			<tr>
			<tr>
				<td>Dni usuario</td>
				<td><input type="text" name="dni"></td>
			</tr>
			<tr>
				<td>Departamento</td>
				<td><?php Departamento::mostrarDesplegableDepartamento($con); ?></td>
			</tr>
			<tr>
				<td><input type="submit" value="Actualizar departamento"></td>
			</tr>
		</table>
	</form>
	<?php
	if(formularioEnviado()){
		foreach($_POST as $id => $input){
			$$id = $input;
		}
		$empleado = Empleado::getEmpleado($con,$dni);
		if($departamento != $empleado->cod_dept){
			$empleado->cambiarDepartamento($con,$departamento);
		}else{
			echo "El empleado ya está en ese departamento";
		}
	}
	$con = null;
	?>
</body>
</html>