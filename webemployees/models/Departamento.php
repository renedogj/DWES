<?php
class Departamentos{
	public $dept_no;
	public $dept_name;

	public function __construct($dept_no,$dept_name){
		$this->dept_no = $dept_no;
		$this->dept_name = $dept_name;
	}
}
?>