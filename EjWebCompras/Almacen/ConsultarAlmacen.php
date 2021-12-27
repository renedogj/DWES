<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Stock Producto</title>
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
	include("Almacen.php");
	include("../funciones.php");
	$con = crearConexion();
	?>
	<h3>Consultar productos de un almacen</h3>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<label for="producto">Almacen</label>
		<?php Almacen::mostrarDesplegableAlmacenes($con); ?>
		<br><br>
		<input type="submit" value="Mostrar productos">
		<br><br>
	</form>
	<?php
	if (formularioEnviado()){
		$num = $_POST["almacen"];
		$almacen = new Almacen($num,null);
		$almacen->mostrarProductos($con);
	}
	$con = null;
	?>
</body>
</html>