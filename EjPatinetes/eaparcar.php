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
	}else if(isset($_POST["volver"])){
		header('Location: ' . "einicio.php");
		die();
	}else if(isset($_POST["devolver"])){
		$matricula = $_POST["patinetes"];
		$info = Patinete::obtenerFechaInfoAlquiler($con,$matricula,$cliente->dni);
		if($info!=null){
			$importe = $info["preciobase"] * $info["dif"];
			Patinete::devolverPatinete($con,$cliente->dni,$matricula,$info["fecha_alquiler"],$info["fin"],$importe);
			$cliente->saldo -= $importe;
		}else{
			echo "No tienes ese patinete alquilado";
		}
	}
	?>
    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Menú Usuario - APARCAR PATINETE </div>
		<div class="card-body">
	  
	   

	<!-- INICIO DEL FORMULARIO -->
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
	
		<?php
		echo "<B>Bienvenido/a:</B> $cliente->nombre $cliente->apellido <BR><BR>";
		echo "<B>Saldo Cuenta:</B> $cliente->saldo <BR><BR>";

		echo "<B>PATINETES ALQUILADOS: </B>";
		$cliente->desplegablePatinetesAlquilados($con);
		?>
		<BR><BR>
		<div>
			<input type="submit" value="Aparcar Patinete" name="devolver" class="btn btn-warning disabled">
			<input type="submit" value="Volver" name="volver" class="btn btn-warning disabled">
		</div>		
	</form>
</div>
	</div>
	<!-- FIN DEL FORMULARIO -->
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
		<button type="submit" name="cerrarSesion">Cerrar sesion</button>
	</form>
</div>
	
  </body>
   
</html>



