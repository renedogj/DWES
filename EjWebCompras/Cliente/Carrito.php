<?php
session_start();
include("../funciones.php");
if(!isset($_SESSION['nif'])){
	redirecionarALogin();
}
$con = crearConexion();
include("../Producto/Producto.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Carrito</title>
	<link rel="stylesheet" type="text/css" href="../css/comprarProductos.css">
</head>
<body>
	<?php
	if(isset($_POST["eliminarCarrito"])){
		$id = $_POST["eliminarCarrito"];
		unset($_SESSION["carrito"][$id]);
	}
	?>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
		<div class="productos">
			<?php
			$carrito = $_SESSION["carrito"];
			foreach($carrito as $id => $cantidad){
				$producto = Producto::obtenerProducto($con,$id);
				$producto->obtenerStockTotal($con);
				//if($producto->stockTotal > 0){
					echo '<div class="producto" id="'.$id.'">';
					echo '<h2>'.$producto->nombre.'</h2>';
					echo '<p class="precio">'.$producto->precio.'€</p>';
					echo '<p class="udsCarrito stock"><b>'.$cantidad.'</b> uds.</p>';
					echo '<button type="submit" name="eliminarCarrito" value="'.$id.'">Eliminar del carrito</button>';
					echo '</div>';
				//}
			}
			?>
		</div>

		<button id="bttnComprar">Comprar</button>
	</form>
</body>
</html>