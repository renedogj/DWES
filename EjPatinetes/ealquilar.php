<?php
session_start();
include("funciones.php");
if(!isset($_SESSION['email'])){
	redirecionarALogin();
}
$con = crearConexion();

include_once "Clases/Cliente.php";
include_once "Clases/Patinete.php";
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Bienvenido a EPATIN</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
</head>
   
<body>
    <h1>Servicio de ALQUILER PATINETES ELÉCTRICOS</h1>

	<?php
	$cliente = Cliente::obtenerCliente($con,$_SESSION["email"]);
	if(isset($_POST["cerrarSesion"])){
		cerrarSesion();
	}else if(isset($_POST["agregar"])){

		$matriculaPatinete = $_POST["patinetes"];
		if(!isset($_SESSION['carrito'][$matriculaPatinete])){
			$_SESSION['carrito'][$matriculaPatinete] = $matriculaPatinete;
			echo "Patinete " . $matriculaPatinete . " añadido a la cesta";
		}
	}else if(isset($_POST["vaciar"])){
		$_SESSION['carrito'] = array();
		echo "Carrito vaciado";
	}else if(isset($_POST["alquilar"])){
		if($cliente->saldo >= 10){
			$fecha = date("Y-m-d h:m:s");
			foreach($_SESSION["carrito"] as $matricula){
				Patinete::alquilarPatinete($con,$cliente->dni,$matricula,$fecha);
			}
			if(count($_SESSION['carrito']) == 0){
				echo "Alquiler realizado con éxito<br>";
			}
			$_SESSION['carrito'] = array();
			echo "Carrito vaciado<br>";
		}
	}
	?>

    <div class="container">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
			<div class="card-header">Menú Usuario - ALQUILAR PATINETES</div>
			<div class="card-body">
			<!-- INICIO DEL FORMULARIO -->
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
			
				<?php
				
				$fecha = date("d/m/Y h:m");
				echo "<B>Bienvenido/a:</B> $cliente->nombre $cliente->apellido <BR><BR>";
				echo "<B>Saldo Cuenta:</B> $cliente->saldo <BR><BR>";
				echo "<B>PATINETES disponibles</B> $fecha <BR><BR>";

				Patinete::mostrarDesplegablePatinetesDisponibles($con);
				?>
					
				
				<BR> <BR><BR><BR><BR><BR>
				<div>
					<input type="submit" value="Agregar a Cesta" name="agregar" class="btn btn-warning disabled">
					<input type="submit" value="Realizar Alquiler" name="alquilar" class="btn btn-warning disabled">
					<input type="submit" value="Vaciar Cesta" name="vaciar" class="btn btn-warning disabled">
				</div>		
			</form>
			</div>
		</div>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
			<button type="submit" name="cerrarSesion">Cerrar sesion</button>
		</form>
	</div>
	<!-- FIN DEL FORMULARIO -->
  </body>
   
</html>

