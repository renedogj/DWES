<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<style type="text/css">
		table{
			border: solid;
			border-collapse: collapse;
		}
		td{
			border: solid;
			width: 50px;
			height: 20px;
		}
	</style>
</head>
<body>
	<table>
	<?php
		$num = 6;
		for($i=0;$i<=10;$i++){
			echo "<tr><td>" . $num . " x " . $i . "</td><td>" . $num*$i . "</td>";
		}
	?>
	</table>
</body>
</html>