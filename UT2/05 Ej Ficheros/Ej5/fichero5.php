<?php
$nombreFichero = $_POST["path"];
$opcionSelecionada = $_POST["mostrar"];

if(file_exists($nombreFichero)){
	$file = file($nombreFichero);
	switch($opcionSelecionada){
		case 1:
		foreach($file as $indice => $linea){
			echo $linea . "<br>";
		}
		break;
		case 2:
		$linea = $_POST["linea"];
		if($linea > 0){
			echo $file[$linea-1];
		}
		break;
		case 3:
		$numLineas = $_POST["numLineas"];
		for($i = 0; $i < $numLineas; $i++){
			echo $file[$i]."<br>";
		}
		break;
		default:
		echo "Se debe selecionar una opcion a mostrar";
		break;
	}
}else{
	echo "No existe el archivo";
}
?>