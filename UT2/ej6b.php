<?php
	$num = "5";
	$factorial = 1;
	echo $num . "! = ";
	for($i=$num;$i>0;$i--){
		$factorial *= $i;
		if($i != 1){
			echo $i . "x";
		}else{
			echo $i . " = ";
		} 
	}
	echo $factorial;
?>