</head>
<body>
	<h2>Historial departamento</h2>
	<?php
	include("Empleado.php");
	include("../funciones.php");
	$con = crearConexion();
	?>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<label>Departamento</label>
		<?php Empleado::mostrarDesplegableEmpleados($con); ?>
		<br><br>
		<input type="submit" value="Obtener empleados">
	</form>
	<?php
	if(formularioEnviado()){
		$empleado = $_POST['empleado'];
		Empleado::getHistorialDept($con);
	}
	$con = null;
	?>
</body>
</html>