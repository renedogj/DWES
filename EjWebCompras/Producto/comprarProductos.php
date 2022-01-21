<?php
session_start();
include("../funciones.php");
if(!isset($_SESSION['nif'])){
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
	<meta http-equiv="refresh" content ="1000">
	<title>Comprar Productos</title>
	<link rel="stylesheet" type="text/css" href="../css/menu.css">
	<link rel="stylesheet" type="text/css" href="../css/comprarProductos.css">
</head>
<body>
	<header>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
			<button type="submit" name="cerrarSesion">Cerrar sesion</button>
		</form>
	</header>
	<main>
		<!--<form action="<?php //echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
		<div class="productos">
			
			<?php
			/*$productos = Producto::obtenerProductos($con);
			foreach($productos as $producto){
				$producto->obtenerStockTotal($con);
				if($producto->stockTotal > 0){
					echo '<div class="producto" id="'.$producto->id.'">';
					echo '<h2>'.$producto->nombre.'</h2>';
					echo '<p class="precio">'.$producto->precio.'€</p>';
					echo '<p class="stock"><b>'.$producto->stockTotal.'</b> en stock</p>';
					echo '<button type="submit" name="addCarrito" value="'.$producto->id.'">Añadir al carrito</button>';
					echo '</div>';
				}
			}*/
			?>
		</div>
		</form>-->
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
		<?php Producto::mostrarDesplegableProductos($con); ?>
		<input type="number" name="cantidad">
		<br><br>
		<button type="submit" name="addCarrito" value="566168">Añadir al carrito</button>
		</form>
	</main>
	<?php
	/*if(isset($_POST["addCarrito"])){
		echo $_POST['addCarrito'];
	}*/


	if(isset($_POST["cerrarSesion"])){
		cerrarSesion();
	}else if(isset($_POST["addCarrito"])){
		//echo $_POST['addCarrito'];
		if(isset($_POST["cantidad"]) && $_POST['cantidad'] > 0){
			$cantidad = $_POST["cantidad"];
			$idProducto = $_POST["producto"];

			/*$producto = Producto::obtenerProducto($con,$idProducto);

			if($cantidad < $producto->stokTotal){

			}*/

			if(isset($_SESSION['carrito'][$idProducto])){
				$_SESSION['carrito'][$idProducto] += $cantidad;
			}else{
				$_SESSION['carrito'][$idProducto] = (int)$cantidad;
			}
			//echo $cantidad .  " " .$idProducto;
		}
	}
	var_dump($_SESSION['carrito']);
	?>
</body>
</html>