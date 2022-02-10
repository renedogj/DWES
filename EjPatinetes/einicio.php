<?php
session_start();
include("funciones.php");
if(!isset($_SESSION['email'])){
	redirecionarALogin();
}
$con = crearConexion();

include_once "Clases/Cliente.php";
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

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Menú Usuario - OPERACIONES </div>
		<div class="card-body">

		<?php
		$cliente = Cliente::obtenerCliente($con,$_SESSION["email"]);

		echo "<B>Bienvenido/a:</B> $cliente->nombre $cliente->apellido <BR><BR>";
		echo "<B>Saldo Cuenta:</B> $cliente->saldo <BR><BR>";
		?>

		<!--Formulario con enlaces -->
		<ul>
			<li><a href="ealquilar.php">Alquilar Patin</a></li>
			<li><a href="econsultar.php">Consultar Alquileres</a></li>
			<li><a href="eaparcar.php">Aparcar Patin</a></li>  		 
		</ul>
		
       
		
		<BR>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
			<button type="submit">Cerrar sesion</button>
		</form>
	</div>  
	<?php
	if(formularioEnviado()){
		cerrarSesion();
	}
	?>
   </body>
   
</html>


