<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title>Primitiva HTML</title>
</head>
<body>
	<img src="primitiva.jpg">
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
		<p>Fecha del sorteo <input type='date' name='fechasorteo' size=15><br>
			<p>Recaudación Sorteo <input type='text' name='recaudacion' size=10><br>
				<p>Pulsa para generar combinación ganadora: <input type="submit" value="Combinacion" name="combinacion"></p>
			</form>

			<?php
			if ($_SERVER["REQUEST_METHOD"] == "POST"){
				//if(isset($_POST['fechasorteo'])){
					$fechasorteo = $_POST['fechasorteo'];
				//}
				echo "LOTERIA PRIMITIVA DE ESPAÑA" . $fechasorteo . "<br><br>";
				//if(isset($_POST['recaudacion'])){
					$recaudacion = $_POST['recaudacion'];
					echo "Recaudacion: " . $recaudacion . "<br><br>";
				//}
				include("funciones.php");

				$pathPrimitiva = "r22_primitiva.txt";

				for ($i=0; $i <= 6; $i++) { 
					$acertantes[$i]["texto"] = "Acertantes " . $i . " números: ";
				}
				$acertantes["c"]["texto"] = "Acertantes 5 números + complementario: ";
				$acertantes["r"]["texto"] = "Acertantes reintegro: ";

				if(file_exists($pathPrimitiva)){
					$filePrimitiva = file($pathPrimitiva);
					array_splice($filePrimitiva, 0, 1);
					$numApuestas = count($filePrimitiva);
					foreach($filePrimitiva as $indice => $strJugador){
						if($strJugador != ""){
							$jugadorAux = explode("-",$strJugador);
							$idJugador = $jugadorAux[0];
							$jugador = obtenerDatosJugador($jugadorAux);

							$categoriasAciertos = obtenerCategoriasJugador($jugador);

							foreach($categoriasAciertos as $categoria){
								$acertantes[$categoria]["jugadores"][$idJugador] = $jugador;
							}
						}
					}
					foreach($acertantes as $indice => $categoria){
						if(array_key_exists("jugadores",$categoria)){
							$acertantes[$indice]["numJugadores"] = count($categoria["jugadores"]);
						}else{
							$acertantes[$indice]["numJugadores"] = 0;
						}	
					}
					mostrarCombinacionGanadora();
					mostrarNumGanadoresCategoria($acertantes);
				}else{
					echo "No existe el archivo";
				}
			}	
			?>
		</body>
		</html>