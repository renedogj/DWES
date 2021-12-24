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
				<th>Alta categoria</th>
			<tr>
			<tr>
				<td for="nombre">Nombre Categoria</td>
				<td><input type="text" name="nombre"></td>
			</tr>
			<tr>
				<td><input type="submit" value="Dar de alta"></td>
			</tr>
		</table>
	</form>
	<?php
	include("Categoria.php");
	include("../funciones.php");
	
	if (formularioEnviado()){
		$nombre = $_POST['nombre'];
		$con = crearConexion();
		$categoria = Categoria::newCategoria($con,$nombre);
		$categoria->darDeAlta($con);
		echo "<br>" . $categoria;
		$con = null;
	}
	?>
</body>
</html>