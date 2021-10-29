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
	$linea = "";
	foreach($_POST as $value){
		$linea .= $value . "##";
	}
	$linea .= "\n";
	
	$file = fopen("alumnos2.txt","w");
	fwrite($file, $linea);
	fclose($file);
	?>
</body>
</html>