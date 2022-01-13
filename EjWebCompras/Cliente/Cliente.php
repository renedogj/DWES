<?php
class Cliente{
	public $nif;
	public $nombre;
	public $apellido;
	public $cp;
	public $direccion;
	public $ciudad;

	public function __construct($nif,$nombre,$apellido,$cp,$direccion,$ciudad){
		$this->nif = $nif;
		$this->nombre = $nombre;
		$this->apellido = $apellido;
		$this->cp = $cp;
		$this->direccion = $direccion;
		$this->ciudad = $ciudad;
	}

	public function darDeAlta($con,$password){
		$password = md5($password);
		try {
			$sql = "INSERT INTO clientes (nif,nombre,apellido,cp,direccion,ciudad,password) VALUES ('$this->nif','$this->nombre','$this->apellido','$this->cp','$this->direccion','$this->ciudad','$password')";
			return $con->exec($sql);
		} catch(PDOException $e) {
			$mensaje = "Error: ";
			if ($e->getCode() == 23000) {
				$mensaje .= "NIF de cliente duplicado";
			} else {
				$mensaje .= $e->getMessage();
			}
			echo $mensaje;
			return false;
		}
	}

	public static function esNifValido($nif){
		$nif_codes = "TRWAGMYFPDXBNJZSQVHLCKE";

		if($nif != "" && $nif != null){
			if (preg_match ('/^[0-9]{8}[A-Z]{1}$/', $nif)) {
				$num = substr($nif, 0, 8);

				return ($nif[8] == $nif_codes[$num % 23]);
			}
		}
		return false;
	}
}
?>