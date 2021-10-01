<?php
	$datosGuardados = array(
		"Precio",
		"VariacionPorcentaje",
		"Variacion",
		"VolumenTitulos",
		"Volumen"
	);
	$nombreEmpresas = array(
		"Inditex",
		"Aena",
		"Acciona",
		"Repsol",
		"Acs",
		"BBVA",
		"CaixaBank",
		"Santander",
		"A",
		"B",
		"C",
		"D",
		"E",
		"F",
		"G",
		"H",
		"I",
		"J",
		"K",
		"L",
		"M",
		"N",
		"Ñ",
		"O",
		"P",
		"Q",
		"R",
		"S",
		"T",
		"U",
		"V",
		"W",
		"X",
		"Y",
		"Z"
	);
	$empresas = array();

	foreach($nombreEmpresas as $i){
		$valoresEmpresa = array(
			$datosGuardados[0]=>rand(0,100),
			$datosGuardados[1]=>rand(-1,1),
			$datosGuardados[2]=>rand(-100,100),
			$datosGuardados[3]=>rand(0,1000),
			$datosGuardados[4]=>rand()
		);
		$empresas[$i] = $valoresEmpresa;
	}

	echo "<table><tr>";
	foreach($datosGuardados as $i){
		echo "<th>" . $i . "</th>";
	}
	echo "</tr>";
	foreach($empresas as $i => $i_value){
		echo "<tr><th>" . $i . "</th>";
		foreach($empresas[$i] as $j => $j_value){
			echo "<td>" . $j_value . "</td>";
		}
		echo "</tr>";
	}
	echo "</table>";
?>