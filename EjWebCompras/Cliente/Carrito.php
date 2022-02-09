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
	if(isset($_POST["eliminarDeCarrito"])){
		$id = $_POST["eliminarDeCarrito"];
		//unset($_SESSION["Carrito.php"][$id]);
		$carrito = unserialize($_COOKIE["carrito"]);
		unset($carrito[$id]);
		setArrayCookie("carrito",$carrito);
	}
	?>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
		<div class="productos">
			<?php
			$carrito = unserialize($_COOKIE["carrito"]);
			foreach($carrito as $id => $cantidad){
				$producto = Producto::obtenerProducto($con,$id);
				$producto->obtenerStockTotal($con);
				echo '<div class="producto" id="'.$id.'">';
				echo '<h2>'.$producto->nombre.'</h2>';
				echo '<p class="precio">'.$producto->precio.'€</p>';
				echo '<p class="udsCarrito stock"><b>'.$cantidad.'</b> uds.</p>';
				echo '<button type="submit" name="eliminarDeCarrito" value="'.$id.'">Eliminar del carrito</button>';
				echo '</div>';
			}
			?>
		</div>
		<button id="bttnComprar">Comprar</button>
	</form>
</body>
</html>