<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Alta Producto</title>
	<style type="text/css">
		table{
			width: 50%;
			border: solid;
			border-collapse: collapse;
		}
		td,th{
			text-align: center;
			border: solid;
			height: 20px;
		}
	</style>
</head>
<body>
	<?php
	include("Producto.php");
	include("../Almacen/Almacen.php");
	include("../funciones.php");
	$con = crearConexion();
	?>
	<h3>Alta Producto</h3>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<label for="producto">Producto</label>
		<?php Producto::mostrarDesplegableProductos($con); ?>
		<br><br>
		<input type="submit" value="Mostrar stock">
		<br><br>
	</form>
	<?php
	if (formularioEnviado()){
		$id = $_POST["producto"];
		$producto = new Producto($id,null,null,null);
		$producto->mostrarStock($con);
	}
	$con = null;
	?>
</body>
</html>