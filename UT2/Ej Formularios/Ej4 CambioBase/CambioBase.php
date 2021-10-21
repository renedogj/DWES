<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Cambio de base</title>
</head>
<body>
	<h1>Cambio de base</h1>
	<form>
		<?php
		$decimal = $_POST['decimal'];
		$base = $_POST['base'];

		$bases = ["2"=>"Binario","8"=>"Octal","16"=>"Hexadecimal"];

		$htmlForm = <<< TEXTHTML
		<label for="decimal">Número decimal:</label>
		<input type="number" name="decimal" value="${decimal}">
		<br><br>
		TEXTHTML;

		echo $htmlForm;
		mostrarTabla($decimal,$bases,$base);

		function mostrarTabla($decimal,$bases,$base){
			echo "<table>";
			if($base == "*"){
				foreach($bases as $numbase => $value){
					echo "<tr>
						<td>$value</td><td>" . base_convert($decimal[0],10,$numbase) . "</td>
					</tr>";
				}
			}else{
				echo "<tr>
				<td>" . $bases[$base] . "</td><td>" . base_convert($decimal[0],10,$base) . "</td>
				</tr>";
			}
			echo "</table>";
		}
		?>
	</form>
</body>
</html>