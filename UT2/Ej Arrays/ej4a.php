<?php
	$array = array();

	for($i = 0; $i < 20; $i++){
		$array[$i] = decbin($i);
	}

	$arrayInverso = array_reverse($array);
	print_r($arrayInverso);
?>