<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Alta Producto</title>
</head>
<body>
	<?php
	include("Producto.php");
	include("../Categoria/Categoria.php");
	include("../funciones.php");
	$con = crearConexion();
	?>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<table>
			<tr>
				<th>Alta Producto</th>
			<tr>
			<tr>
				<td for="nombre">Nombre producto</td>
				<td><input type="text" name="nombre"></td>
			</tr>
			<tr>
				<td for="precio">Precio producto</td>
				<td><input type="text" name="precio"></td>
			</tr>
			<tr>
				<td for="nombre">Categoria producto</td>
				<td><?php Categoria::mostrarDesplegableCategorias($con); ?></td>
			</tr>
			<tr>
				<td><input type="submit" value="Dar de alta"></td>
			</tr>
		</table>
	</form>
	<?php
	if (formularioEnviado()){
		foreach($_POST as $id => $input){
			$$id = $input;
		}

		$producto = Producto::newProducto($con,$nombre,$precio,$categoria);
		$producto->darDeAlta($con);
		echo $producto;
	}
	$con = null;
	?>
</body>
</html>