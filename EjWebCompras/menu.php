<?php
session_start();
include("funciones.php");
if(!isset($_SESSION['nif'])){
	redirecionarALogin();
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Menu</title>
	<link rel="stylesheet" type="text/css" href="css/menu.css">
</head>
<body>
	<header>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
			<button type="submit">Cerrar sesion</button>
		</form>
	</header>
	<main>
		<ul>
			<li><a href="Producto/comprarProductos.php">Comprar producto</a></li>
			<li><a href="">Consula compras</a></li>
		</ul>
	</main>
	<?php
	if(formularioEnviado()){
		cerrarSesion();
	}
	?>
</body>
</html>