<?php
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