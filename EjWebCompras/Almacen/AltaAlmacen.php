<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<table>
			<tr>
				<th>Alta Almacen</th>
			<tr>
			<tr>
				<td for="nombre">Localidad almacen</td>
				<td><input type="text" name="localidad"></td>
			</tr>
			<tr>
				<td><input type="submit" value="Dar de alta"></td>
			</tr>
		</table>
	</form>
	<?php
	include("Almacen.php");
	include("../funciones.php");
	
	if (formularioEnviado()){
		$localidad = limpiar($_POST['localidad']);
		$con = crearConexion();
		$almacen = Almacen::newAlmacen($con,$localidad);
		$almacen->darDeAlta($con);
		echo "<br>" . $almacen;
		$con = null;
	}
	?>
</body>
</html>