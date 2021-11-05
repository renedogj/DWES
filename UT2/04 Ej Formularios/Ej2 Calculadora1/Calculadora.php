<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Calculadora</title>
</head>
<body>
	<h1>Calculadora</h1>
	<form>
		<?php
		$num1 = $_POST['num1'];
		$num2 = $_POST['num2'];
		$operacion = $_POST['operacion'];

		include("funciones.php");

		$htmlForm = <<< TEXTHTML
		<label for="num1">Operando1:</label>
		<input type="number" name="num1" value="${num1}">
		<br><br>
		<label for="num2">Operando2:</label>
		<input type="number" name="num2" value="${num2}">
		<br><br>
		TEXTHTML;

		echo $htmlForm;

		echo "Resultado operación: " . $num1 . " " . $operacion . " " . $num2 . " = " . operar($operacion,$num1,$num2);
		?>
	</form>
</body>
</html>