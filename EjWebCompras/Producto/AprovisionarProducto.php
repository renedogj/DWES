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
	include("../Almacen/Almacen.php");
	include("../funciones.php");
	$con = crearConexion();
	?>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<table>
			<tr>
				<th>Alta Producto</th>
			<tr>
			<tr>
				<td for="producto">Producto</td>
				<td><?php Producto::mostrarDesplegableProductos($con); ?></td>
			</tr>
			<tr>
				<td for="almacen">Almacen</td>
				<td><?php Almacen::mostrarDesplegableAlmacenes($con); ?></td>
			</tr>
			<tr>
				<td for="cantidad">Cantidad</td>
				<td><input type="number" name="cantidad" id="cantidad" /td>
			</tr>
			<tr>
				<td><input type="submit" value="Aprovisionar"></td>
			</tr>
		</table>
	</form>
	<?php
	if (formularioEnviado()){
		foreach($_POST as $id => $input){
			$$id = limpiar($input);
		}
		Producto::aprovisionar($con,$almacen,$producto,$cantidad);
	}
	$con = null;
	?>
</body>
</html>