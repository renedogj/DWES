<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<label for="nombre">Nombre: </label>
		<input id="nombre" type="text" name="nombre">
		<br><br>
		<label for="apellido1">Apellido1: </label>
		<input id="apellido1" type="text" name="apellido1">
		<br><br>
		<label for="apellido2">Apellido2: </label>
		<input id="apellido2" type="text" name="apellido2">
		<br><br>
		<label for="fecha">Fecha de nacimiento: </label>
		<input id="fecha" type="date" name="fecha">
		<br><br>
		<label for="localidad">localidad: </label>
		<input id="localidad" type="text" name="localidad">
		<br><br>
		<input type="submit" value="Enviar">
		<input type="reset" value="Borrar">
	</form>
	<?php
		if ($_SERVER["REQUEST_METHOD"] == "POST"){
		foreach($_POST as $name => $value){
			$$name = $value;
		}

		$nombre = str_pad($nombre,40);
		$apellido1 = str_pad($apellido1,40);
		$apellido2 = str_pad($apellido2,40);
		$fecha = str_pad($fecha,10);
		$localidad = str_pad($localidad,27);

		$linea = $nombre . $apellido1 . $apellido2 . $fecha . $localidad;
		$file = fopen("alumnos1.txt","a");
		fwrite($file, $linea);
		fclose($file);
	}
	?>
</body>
</html>