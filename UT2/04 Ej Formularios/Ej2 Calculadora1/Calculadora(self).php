<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Calculadora</title>
</head>
<body>
	<h1>Calculadora</h1>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<label for="num1">Operando1:</label>
		<input type="number" name="num1">
		<br><br>
		<label for="num2">Operando2:</label>
		<input type="number" name="num2">
		<br><br>
		<label for="operacion"> Seleciona operación: </label>
		<br>
		<input type="radio" name="operacion" value="+" checked>suma
		<br>
		<input type="radio" name="operacion" value="-">resta
		<br>
		<input type="radio" name="operacion" value="*">multiplicacion
		<br>
		<input type="radio" name="operacion" value="/">division
		<br><br>
		<input type="submit" name="Enviar">
		<input type="reset" name="Borrar">

		<?php
		include("funciones.php");

		if(isset($_POST['num1']) && isset($_POST['num2'])){
			$num1 = $_POST['num1'];
			$num2 = $_POST['num2'];
			$operacion = $_POST['operacion'];

			echo "<br><p>Resultado operación: " . $num1 . " " . $operacion . " " . $num2 . " = " . operar($operacion,$num1,$num2) . "</p>";
		}
		?>
	</form>
</body>
</html>