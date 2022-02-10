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
     <title>Bienvenido a MovilMAD</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
  </head>
   
 <body>
    <h1>Servicio de ALQUILER PATINETES ELÉCTRICOS</h1> 

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Menú Usuario - CONSULTA ALQUILERES </div>
		<div class="card-body">
	  
	  	
	   

	<!-- INICIO DEL FORMULARIO -->
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
				
		<?php
		$cliente = Cliente::obtenerCliente($con,$_SESSION["email"]);
		echo "<B>Bienvenido/a:</B> $cliente->nombre $cliente->apellido <BR><BR>";
		echo "<B>Saldo Cuenta:</B> $cliente->saldo <BR><BR>";
		?>
		     
			 Fecha Desde: <input type='date' name='fechadesde' value='' size=10 placeholder="fechadesde" class="form-control">
			 Fecha Hasta: <input type='date' name='fechahasta' value='' size=10 placeholder="fechahasta" class="form-control"><br><br>
				
		<div>
			<input type="submit" value="Consultar" name="consultar" class="btn btn-warning disabled">
		
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
	<?php
	if(isset($_POST["cerrarSesion"])){
		cerrarSesion();
	}else if(isset($_POST["consultar"])){
		$arrayPatinetes = Patinete::obtenerPatinetesAlquilados($con,$cliente->dni,$_POST["fechadesde"],$_POST["fechahasta"]);
		Patinete::mostrarPatinetes($arrayPatinetes);
	}else if(isset($_POST["volver"])){
		header('Location: ' . "einicio.php");
		die();
	}
	?>
  </body>
   
</html>
