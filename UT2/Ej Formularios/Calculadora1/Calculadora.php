<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Calculadora</title>
</head>
<body>
	<h1>Calculadora</h1>
	<form method="post" action="Calculadora.php">
		<?php
		$num1 = $_POST['num1'];
		$num2 = $_POST['num2'];
		$operacion = $_POST['operacion'];

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

		function operar($operacion,$num1,$num2){
			switch ($operacion) {
				case '+':
				return sumar($num1,$num2);
				case '-':
				return restar($num1,$num2);
				case '*':
				return multiplicar($num1,$num2);
				case '/':
				return dividir($num1,$num2);
			}
		}

		function sumar($num1,$num2){
			return $num1 + $num2;
		}

		function restar($num1,$num2){
			return $num1 - $num2;
		}

		function multiplicar($num1,$num2){
			return $num1 * $num2;
		}

		function dividir($num1,$num2){
			return $num1 / $num2;
		}
		?>
	</form>
</body>
</html>