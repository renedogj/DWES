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
	<title>Comprar Productos</title>
	<link rel="stylesheet" type="text/css" href="../css/menu.css">
</head>
<body>
	<header>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
			<button type="submit">Cerrar sesion</button>
		</form>
	</header>
	<main>
		<div class="productos">
			<div class="producto">
				<h3>NombreProducto</h3>
				<p>12.5€</p>
				<p>20</p>
				<button>Añadir al carrito</button>
			</div>
			<?php
			$productos = Producto::obtenerProductos($con);
			foreach($productos as $producto){
				echo '<div class="producto">';
				$producto->obtenerStockTotal($con);
				echo $producto->stockTotal;
				echo '</div>';
			}
			?>
		</div>
	</main>
	<?php
	if(formularioEnviado()){
		cerrarSesion();
	}
	?>
</body>
</html>