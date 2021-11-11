<?php
$nombreOrigen = $_POST["pathOrigen"];
$nombreDestino = $_POST["pathDestino"];
$opcionSelecionada = $_POST["operaciones"];

switch($opcionSelecionada){
	case 1:
		if(file_exists($nombreDestino)){
			echo "El archivo de destino ya existe";
		}else{
			copy($nombreOrigen, $nombreDestino);
			echo "Fichero copiado con exito";
		}
	break;
	case 2:
		rename($nombreOrigen, $nombreDestino);
		echo "Fichero renombrado con éxito";
	break;
	case 3:
		unlink($nombreOrigen);
		echo "Fichero eliminado con exito";
	break;
	default:
		echo "Se debe selecionar una opcion";
	break;
}
?>