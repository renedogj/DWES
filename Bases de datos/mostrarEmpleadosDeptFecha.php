<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Modificar sueldo empleado</title>
</head>
<body>
	<?php
	include("../funciones.php");
	$con = crearConexion();
	?>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">			
		<h2>Departamento de cada empleado en una fecha</h2>
		<label>Fecha</label>
		<input type="date" name="fecha">
		<br><br>
		<label>Hora</label>
		<input type="time" name="hora">
		<br><br>
		<input type="submit" value="Mostrar">		
	</form>
	<?php
	if(formularioEnviado()){
		foreach($_POST as $id => $input){
			$$id = $input;
		}
		$fechaCompleta = $fecha . " " . $hora;
		empleDeptFecha($con,$fechaCompleta);
	}
	$con = null;
	?>
</body>
</html>