<?php
class Empleado{
	public $emp_no;
	public $birth_date;
	public $first_name;
	public $last_name;
	public $gender;
	public $hire_date;

	public function __construct($emp_no,$birth_date,$first_name,$last_name,$gender,$hire_date){
		$this->emp_no = $emp_no;
		$this->birth_date = $birth_date;
		$this->first_name = $first_name;
		$this->last_name = $last_name;
		$this->gender = $gender;
		$this->hire_date = $hire_date;
	}

	public function darDeAlta($con){
		try {
			$sql = "INSERT INTO employees (emp_no, birth_date, first_name, last_name, gender, hire_date) VALUES ('$this->emp_no','$this->birth_date','$this->first_name','$this->last_name','$this->gender','$this->hire_date')";
			return $con->exec($sql);
		} catch(PDOException $e) {
			return false;
		}
	}

	public static function validarEmpleado($con,$emp_no,$last_name){
		$sql = "SELECT emp_no FROM employees where emp_no='$emp_no' and last_name='$last_name'";

		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		$arrayEmpleado = new RecursiveArrayIterator($stmt->fetchAll());

		if(count($arrayEmpleado) == 1){
			return true;
		}else{
			return false;
		}
	}

	public static function obtenerEmpleado($con,$emp_no){
		$sql = "SELECT emp_no, birth_date, first_name, last_name, gender, hire_date FROM employees where emp_no='$emp_no'";

		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		$arrayEmpleado = new RecursiveArrayIterator($stmt->fetchAll());

		if(count($arrayEmpleado) == 1){
			$aux = $arrayEmpleado[0];
			$empleado = new Empleado($emp_no,$aux['birth_date'],$aux['first_name'],$aux['last_name'],$aux['gender'],$aux['hire_date']);
			return $empleado;
		}else{
			return false;
		}
	}

	public static function empleadoEsDeRecursosHumanos($con,$emp_no){
		$sql = "SELECT dept_no FROM dept_emp where emp_no='$emp_no' and to_date='9999-01-01'";
		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		$arrayResultado = $stmt->fetchAll();

		if(count($arrayResultado) > 0){
			return $arrayResultado[0]["dept_no"] == "d003";
		}else{
			return 0;
		}
	}
}
?>