<?php
if(isset($_POST["emp_no"]) && isset($_POST["last_name"])){
	$emp_no = $_POST["emp_no"];
	$last_name = $_POST["last_name"];

	include_once '../models/Empleado.php';
	include_once '../db/db.php';

	$empleadoValido = Empleado::validarEmpleado($con,$emp_no,$last_name);

	if($empleadoValido){
		$empleadoEsDeRRHH = Empleado::empleadoEsDeRecursosHumanos($con,$emp_no);

		if(!is_null($empleadoEsDeRRHH)){
			if($empleadoEsDeRRHH){
				include_once '../views/menu_RRHH.php';
			}else{
				include_once '../views/menu_No_RRHH.php';
			}
		}else{
			echo "Empleado no valido";
			include_once '../views/login.php';
		}
	}else{
		echo "Empleado no valido";
		include_once '../views/login.php';
	}
}else{
	include_once '../views/login.php';
}

?>