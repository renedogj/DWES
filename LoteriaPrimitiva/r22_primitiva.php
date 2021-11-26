﻿<!DOCTYPE HTML>
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
				$fecha = $_POST['fechasorteo'];
				echo "LOTERIA PRIMITIVA DE ESPAÑA " . $fecha . "<br><br>";
				$recaudacion = $_POST['recaudacion'];
				echo "Recaudacion: " . $recaudacion . "<br><br>";
				include("funciones.php");

				$pathPrimitiva = "r22_primitiva.txt";
				$porcentajesPremios = array(0=>0,1=>0,2=>0,3=>5,4=>8,5=>15,6=>40,"c"=>30,"r"=>2);
				
				foreach($porcentajesPremios as $id => $porcentajePremio){
					if((String) $id == "c"){						$texto = "Acertantes 5 números + complementario: ";
					}else if((String) $id == "r"){
						$texto = "Acertantes reintegro: ";
					}else{
						$texto = "Acertantes " . $id . " números: ";
					}
					$acertantes[$id]["texto"] = $texto;
					$acertantes[$id]["porcentajePremio"] = $porcentajePremio;
				}

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
					foreach($acertantes as $id => $categoria){
						if(array_key_exists("jugadores",$categoria)){
							$acertantes[$id]["numJugadores"] = count($categoria["jugadores"]);
							$premio = ($recaudacion*$acertantes[$id]["porcentajePremio"])/100;
							$acertantes[$id]["premioJugador"] = $premio/$acertantes[$id]["numJugadores"];
						}else{
							$acertantes[$id]["numJugadores"] = 0;
							$acertantes[$id]["premioJugador"] = 0;
						}	
					}
					mostrarCombinacionGanadora();
					mostrarNumGanadoresCategoria($acertantes);
					guardarSorteo($acertantes,$fecha);
				}else{
					echo "No existe el archivo";
				}
			}	
			?>
</body>
</html>