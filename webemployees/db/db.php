<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "employees";

try {
	$con = new PDO("mysql:host=$servername;dbname=$database", $username, $password); 	 	 	 	 	 	
	$con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 
	return $con;
} catch (PDOException $ex) {
	echo $ex->getMessage(); 	 	 	 	 	 	
}
?>