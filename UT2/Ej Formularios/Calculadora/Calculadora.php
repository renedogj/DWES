<?php
	$num1 = $_POST['num1'];
	$num2 = $_POST['num2'];
	$operacion = $_POST['operacion'];

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

	echo "Resultado operación: " . $num1 . " " . $operacion . " " . $num2 . " = " . operar($operacion,$num1,$num2);
?>