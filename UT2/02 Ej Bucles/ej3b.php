<?php
	function decToHexa($numDecimal){
		$hexavalues = array('0','1','2','3','4','5','6','7','8','9','A','B','C','D','E','F');
		$numHexa = '';
		while($numDecimal != '0'){
			$numHexa = $hexavalues[bcmod($numDecimal,'16')] . $numHexa;
			$numDecimal = bcdiv($numDecimal,'16',0);
		}
		return $numHexa;
	}

	echo decToHexa(3554851612);
?>