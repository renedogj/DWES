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
				<td><input type="text" name="departamento"></td>
			</tr>
			<tr>
				<td><input type="submit" value="Alta"></td>
			</tr>
		</table>
	</form>
	<?php
	include("funcionesAltaDepartamento.php");
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		$departamento = $_POST['departamento'];
		$con = crearConexion();
		altaDepartamento($con,$departamento);
		$con = null;
	}
	?>
</body>
</html>

