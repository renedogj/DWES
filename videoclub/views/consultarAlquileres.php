<html>
   <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VIDEOCLUB - IES Leonardo Da Vinci - Alquiler Películas</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    </head>
   

   
   <body>
    <h1 class="text-center"> VIDEOCLUB IES LEONARDO DA VINCI</h1>

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Consulta Alquileres</div>
		<div class="card-body">
      
	   

	<!-- INICIO DEL FORMULARIO -->
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
	
		<B>Nombre Cliente:</B> <?php echo $_SESSION['customer']['first_name']; ?> <BR> 
		<B>Email Cliente:</B> <?php echo $_SESSION['customer']['email']; ?> <BR>
		<B>Número Socio:</B> <?php echo $_SESSION['customer']['customer_id']; ?> <BR><BR>
				 
		<label for="tematica" ><B> Seleccionar Temática:</B> </label>
		<?php mostrarDesplegableThemes($themes); ?>
		<BR>
		<BR>		
		<div>
			<input type="submit" value="Volver" name="volver" class="btn btn-warning disabled">
			<input type="submit" value="Mostar" name="mostrar" class="btn btn-warning disabled">
		</div>		
	</form>
	<!-- FIN DEL FORMULARIO -->
  </div>
</div>
	<?php mostrarPeliculasTematica($peliculasTematica); ?>


</body>
</html>