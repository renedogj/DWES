<?php
//session_start();
include("funciones.php");
/*if(!isset($_SESSION['nif'])){
	redirecionarALogin();
}*/
if(!isset($_COOKIE['nif'])){
	redirecionarALogin();
}
$con = crearConexion();
include("Producto.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Comprar Productos</title>
	<link rel="stylesheet" type="text/css" href="../css/menu.css">
	<link rel="stylesheet" type="text/css" href="../css/comprarProductos.css"></head>
<body>
	<header>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
			<button type="submit" name="cerrarSesion">Cerrar sesion</button>
		</form>
	</header>
	<main>
		<a href="../Cliente/Carrito.php">Ver carrito</a>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
			<?php Producto::mostrarDesplegableProductos($con); ?>
			<input type="number" name="cantidad">
			<br><br>
			<button type="submit" name="addCarrito">Añadir al carrito</button>
			<button type="submit" name="deleteCarrito">Vaciar carrito</button>
		</form>
	</main>
	<?php
	if(isset($_POST["cerrarSesion"])){
		cerrarSesion();
	}else if(isset($_POST["addCarrito"])){
			//echo $_POST['addCarrito'];
		if(isset($_POST["cantidad"]) && $_POST['cantidad'] > 0){
			$cantidad = $_POST["cantidad"];
			$idProducto = $_POST["producto"];

			/*if(isset($_SESSION['carrito'][$idProducto])){
				$_SESSION['carrito'][$idProducto] += $cantidad;
			}else{
				$_SESSION['carrito'][$idProducto] = (int)$cantidad;
			}*/

			$carrito = unserialize($_COOKIE["carrito"]);
			if(isset($carrito[$idProducto])){
				$carrito[$idProducto] += $cantidad;
			}else{
				$carrito[$idProducto] = (int)$cantidad;
			}
			setArrayCookie("carrito",$carrito);

			echo "Producto " . $idProducto . " añadido a la cesta";
		}
	}else if(isset($_POST["deleteCarrito"])){
		//unset($_SESSION['carrito']);
		borrarCookie("carrito");
		echo "Carrito vacio";
	}
	?>
</body>
</html>