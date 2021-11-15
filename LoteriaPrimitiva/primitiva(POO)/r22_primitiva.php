<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title>Primitiva HTML</title>
</head>
<body>
	<img src="primitiva.jpg">
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
		<p>Fecha del sorteo <input type='date' name='fechasorteo' size=15></p>
			<p>Recaudación Sorteo <input type='text' name='recaudacion' size=10></p>
				<p>Pulsa para generar combinación ganadora: <input type="submit" value="Combinacion" name="combinacion"></p>
			</form>

			<?php
			if ($_SERVER["REQUEST_METHOD"] == "POST"){
				$fecha = $_POST['fechasorteo'];
				echo "LOTERIA PRIMITIVA DE ESPAÑA " . $fecha . "<br><br>";
				$recaudacion = $_POST['recaudacion'];
				echo "Recaudacion: " . $recaudacion . "<br><br>";
				
				include("jugador.php");
				include("categoria.php");
				include("apuesta.php");

				$apuestaGanadora = apuesta::generarApuestaGanadora();

				$pathPrimitiva = "r22_primitiva.txt";

				foreach(categoria::porcentajesPremios as $id => $porcentajePremio){
					if($id == "c"){
						$texto = "Acertantes 5 números + complementario: ";
					}else if($id == "r"){
						$texto = "Acertantes reintegro: ";
					}else{
						$texto = "Acertantes " . $id . " números: ";
					}
					$categoria = new categoria($id,$texto,$porcentajePremio,$recaudacion);
					$categorias[$id] = $categoria;
				}

				if(file_exists($pathPrimitiva)){
					$filePrimitiva = file($pathPrimitiva);
					array_splice($filePrimitiva, 0, 1);
					$numApuestas = count($filePrimitiva);
					foreach($filePrimitiva as $indice => $strJugador){
						if($strJugador != ""){
							$arrayJugador = explode("-",$strJugador);
							$jugador = new jugador($arrayJugador,$apuestaGanadora);

							foreach($jugador->categorias as $idCategoria){
								$categorias[$idCategoria]->addJugador($jugador);
							}
						}
					}
					foreach($categorias as $categoria){
						$categoria->setNumJugadores();
						$categoria->setPremioJugador();
					}
					$apuestaGanadora->mostrarCombinacion();
					categoria::mostrarNumGanadoresCategoria($categorias);
					categoria::guardarSorteo($categorias,$fecha);
				}else{
					echo "No existe el archivo";
				}
			}	
			?>
</body>
</html>