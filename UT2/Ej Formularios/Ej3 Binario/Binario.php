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
		$decimal = $_POST['decimal'];
		$binario = decbin($decimal);

		$htmlForm = <<< TEXTHTML
		<label for="decimal">Operando1:</label>
		<input type="number" name="decimal" value="${decimal}">
		<br><br>
		<label for="binario">Operando2:</label>
		<input type="number" name="binario" value="${binario}">
		<br><br>
		TEXTHTML;

		echo $htmlForm;
		?>
	</form>
</body>
</html>