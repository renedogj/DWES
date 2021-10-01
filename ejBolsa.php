<?php
	$Empresas = array (
		"Inditex" => array(
			"Precio"=>31.800,
			"VariacionPorcentaje"=>-0.06,
			"Variacion"=>-0.02,
			"VolumenTitulos"=>482.599,
			"Volumen"=>15306460.74
		)
	);

	foreach($Empresas as $i => $i_value){
		echo $i . "<br>";
		foreach($Empresas[$i] as $j => $j_value){
			echo $j . " => " . $j_value . "<br>";
		}
	}
?>