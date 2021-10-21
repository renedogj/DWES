<?php
$num1 = $_POST['num1'];
$num2 = $_POST['num2'];
$operacion = $_POST['operacion'];

include("funciones.php");

echo "<h1>Calculadora</h1>";
echo "Resultado operación: " . $num1 . " " . $operacion . " " . $num2 . " = " . operar($operacion,$num1,$num2);
?>