</head>
<body>
	<h2>Lista de empleados por departamento</h2>
	<?php
	include("Departamento.php");
	include("../Empleado/Empleado.php");
	include("../funciones.php");
	$con = crearConexion();
	?>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		
		<label>Departamento</label>
		<?php Departamento::mostrarDesplegableDepartamento($con); ?>
		<br><br>
		<input type="submit" value="Obtener empleados">
	</form>
	<?php
	if(formularioEnviado()){
		$cod_dept = $_POST['departamento'];
		echo "<h4>$cod_dept</h4>";
		Empleado::getEmpleadosDept($con,$cod_dept);
	}
	$con = null;
	?>
</body>
</html>