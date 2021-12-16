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
				<th>Alta departamento</th>
			<tr>
			<tr>
				<td for="nombre">Nombre departamento</td>
				<td><input type="text" name="nombre"></td>
			</tr>
			<tr>
				<td><input type="submit" value="Alta"></td>
			</tr>
		</table>
	</form>
	<?php
	include("../funciones.php");
	include("../departamento.php");
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		$nombre = $_POST['nombre'];
		$con = crearConexion();
		$departamento = departamento::newDepartamento($con,$nombre);
		$departamento->darDeAlta($con);
		$con = null;
	}
	?>
</body>
</html>

