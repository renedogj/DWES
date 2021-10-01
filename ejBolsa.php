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
	/*$empresas = array (
		"Inditex" => array (
			$datosGuardados[0]=>31.800,
			$datosGuardados[1]=>-0.06,
			$datosGuardados[2]=>-0.02,
			$datosGuardados[3]=>482.599,
			$datosGuardados[4]=>15306460.74
		),
		"Aena" => array (
			$datosGuardados[0]=>31.800,
			$datosGuardados[1]=>-0.06,
			$datosGuardados[2]=>-0.02,
			$datosGuardados[3]=>482.599,
			$datosGuardados[4]=>15306460.74
		),
		"Acciona" => array (
			$datosGuardados[0]=>31.800,
			$datosGuardados[1]=>-0.06,
			$datosGuardados[2]=>-0.02,
			$datosGuardados[3]=>482.599,
			$datosGuardados[4]=>15306460.74
		),
		"Repsol" => array (
			$datosGuardados[0]=>31.800,
			$datosGuardados[1]=>-0.06,
			$datosGuardados[2]=>-0.02,
			$datosGuardados[3]=>482.599,
			$datosGuardados[4]=>15306460.74
		),
		"Acs" => array (
			$datosGuardados[0]=>31.800,
			$datosGuardados[1]=>-0.06,
			$datosGuardados[2]=>-0.02,
			$datosGuardados[3]=>482.599,
			$datosGuardados[4]=>15306460.74
		),
		"BBVA" => array (
			$datosGuardados[0]=>31.800,
			$datosGuardados[1]=>-0.06,
			$datosGuardados[2]=>-0.02,
			$datosGuardados[3]=>482.599,
			$datosGuardados[4]=>15306460.74
		),
		"CaixaBank" => array (
			$datosGuardados[0]=>31.800,
			$datosGuardados[1]=>-0.06,
			$datosGuardados[2]=>-0.02,
			$datosGuardados[3]=>482.599,
			$datosGuardados[4]=>15306460.74
		),
		"Santander" => array (
			$datosGuardados[0]=>31.800,
			$datosGuardados[1]=>-0.06,
			$datosGuardados[2]=>-0.02,
			$datosGuardados[3]=>482.599,
			$datosGuardados[4]=>15306460.74
		),
		"A" => array (
			$datosGuardados[0]=>31.800,
			$datosGuardados[1]=>-0.06,
			$datosGuardados[2]=>-0.02,
			$datosGuardados[3]=>482.599,
			$datosGuardados[4]=>15306460.74
		),
		"B" => array (
			$datosGuardados[0]=>31.800,
			$datosGuardados[1]=>-0.06,
			$datosGuardados[2]=>-0.02,
			$datosGuardados[3]=>482.599,
			$datosGuardados[4]=>15306460.74
		),
		"C" => array (
			$datosGuardados[0]=>31.800,
			$datosGuardados[1]=>-0.06,
			$datosGuardados[2]=>-0.02,
			$datosGuardados[3]=>482.599,
			$datosGuardados[4]=>15306460.74
		),
		"D" => array (
			$datosGuardados[0]=>31.800,
			$datosGuardados[1]=>-0.06,
			$datosGuardados[2]=>-0.02,
			$datosGuardados[3]=>482.599,
			$datosGuardados[4]=>15306460.74
		),
		"E" => array (
			$datosGuardados[0]=>31.800,
			$datosGuardados[1]=>-0.06,
			$datosGuardados[2]=>-0.02,
			$datosGuardados[3]=>482.599,
			$datosGuardados[4]=>15306460.74
		),
		"F" => array (
			$datosGuardados[0]=>31.800,
			$datosGuardados[1]=>-0.06,
			$datosGuardados[2]=>-0.02,
			$datosGuardados[3]=>482.599,
			$datosGuardados[4]=>15306460.74
		),
		"G" => array (
			$datosGuardados[0]=>31.800,
			$datosGuardados[1]=>-0.06,
			$datosGuardados[2]=>-0.02,
			$datosGuardados[3]=>482.599,
			$datosGuardados[4]=>15306460.74
		),
		"H" => array (
			$datosGuardados[0]=>31.800,
			$datosGuardados[1]=>-0.06,
			$datosGuardados[2]=>-0.02,
			$datosGuardados[3]=>482.599,
			$datosGuardados[4]=>15306460.74
		),
		"I" => array (
			$datosGuardados[0]=>31.800,
			$datosGuardados[1]=>-0.06,
			$datosGuardados[2]=>-0.02,
			$datosGuardados[3]=>482.599,
			$datosGuardados[4]=>15306460.74
		),
		"J" => array (
			$datosGuardados[0]=>31.800,
			$datosGuardados[1]=>-0.06,
			$datosGuardados[2]=>-0.02,
			$datosGuardados[3]=>482.599,
			$datosGuardados[4]=>15306460.74
		),
		"K" => array (
			$datosGuardados[0]=>31.800,
			$datosGuardados[1]=>-0.06,
			$datosGuardados[2]=>-0.02,
			$datosGuardados[3]=>482.599,
			$datosGuardados[4]=>15306460.74
		),
		"L" => array (
			$datosGuardados[0]=>31.800,
			$datosGuardados[1]=>-0.06,
			$datosGuardados[2]=>-0.02,
			$datosGuardados[3]=>482.599,
			$datosGuardados[4]=>15306460.74
		),
		"M" => array (
			$datosGuardados[0]=>31.800,
			$datosGuardados[1]=>-0.06,
			$datosGuardados[2]=>-0.02,
			$datosGuardados[3]=>482.599,
			$datosGuardados[4]=>15306460.74
		),
		"N" => array (
			$datosGuardados[0]=>31.800,
			$datosGuardados[1]=>-0.06,
			$datosGuardados[2]=>-0.02,
			$datosGuardados[3]=>482.599,
			$datosGuardados[4]=>15306460.74
		),
		"Ñ" => array (
			$datosGuardados[0]=>31.800,
			$datosGuardados[1]=>-0.06,
			$datosGuardados[2]=>-0.02,
			$datosGuardados[3]=>482.599,
			$datosGuardados[4]=>15306460.74
		),
		"O" => array (
			$datosGuardados[0]=>31.800,
			$datosGuardados[1]=>-0.06,
			$datosGuardados[2]=>-0.02,
			$datosGuardados[3]=>482.599,
			$datosGuardados[4]=>15306460.74
		),
		"P" => array (
			$datosGuardados[0]=>31.800,
			$datosGuardados[1]=>-0.06,
			$datosGuardados[2]=>-0.02,
			$datosGuardados[3]=>482.599,
			$datosGuardados[4]=>15306460.74
		),
		"Q" => array (
			$datosGuardados[0]=>31.800,
			$datosGuardados[1]=>-0.06,
			$datosGuardados[2]=>-0.02,
			$datosGuardados[3]=>482.599,
			$datosGuardados[4]=>15306460.74
		),
		"R" => array (
			$datosGuardados[0]=>31.800,
			$datosGuardados[1]=>-0.06,
			$datosGuardados[2]=>-0.02,
			$datosGuardados[3]=>482.599,
			$datosGuardados[4]=>15306460.74
		),
		"S" => array (
			$datosGuardados[0]=>31.800,
			$datosGuardados[1]=>-0.06,
			$datosGuardados[2]=>-0.02,
			$datosGuardados[3]=>482.599,
			$datosGuardados[4]=>15306460.74
		),
		"T" => array (
			$datosGuardados[0]=>31.800,
			$datosGuardados[1]=>-0.06,
			$datosGuardados[2]=>-0.02,
			$datosGuardados[3]=>482.599,
			$datosGuardados[4]=>15306460.74
		),
		"U" => array (
			$datosGuardados[0]=>31.800,
			$datosGuardados[1]=>-0.06,
			$datosGuardados[2]=>-0.02,
			$datosGuardados[3]=>482.599,
			$datosGuardados[4]=>15306460.74
		),
		"V" => array (
			$datosGuardados[0]=>31.800,
			$datosGuardados[1]=>-0.06,
			$datosGuardados[2]=>-0.02,
			$datosGuardados[3]=>482.599,
			$datosGuardados[4]=>15306460.74
		),
		"W" => array (
			$datosGuardados[0]=>31.800,
			$datosGuardados[1]=>-0.06,
			$datosGuardados[2]=>-0.02,
			$datosGuardados[3]=>482.599,
			$datosGuardados[4]=>15306460.74
		),
		"X" => array (
			$datosGuardados[0]=>31.800,
			$datosGuardados[1]=>-0.06,
			$datosGuardados[2]=>-0.02,
			$datosGuardados[3]=>482.599,
			$datosGuardados[4]=>15306460.74
		),
		"Y" => array (
			$datosGuardados[0]=>31.800,
			$datosGuardados[1]=>-0.06,
			$datosGuardados[2]=>-0.02,
			$datosGuardados[3]=>482.599,
			$datosGuardados[4]=>15306460.74
		),
		"Z" => array (
			$datosGuardados[0]=>31.800,
			$datosGuardados[1]=>-0.06,
			$datosGuardados[2]=>-0.02,
			$datosGuardados[3]=>482.599,
			$datosGuardados[4]=>15306460.74
		)
	);*/
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