<?php
if(camposObligatoriosRellenos()){
	echo "<table>";
	foreach($_POST as $campo => $valor){
		echo "<tr><th>". $campo . "</th><td> " . $valor . "</td></tr>";
	}
	echo "</table>";
}else{
	$htmlForm = '<form method="post" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '">';
	$htmlForm .= <<< TEXTHTML
	<label for="nombre">Nombre:</label>
	TEXTHTML;
	$htmlForm .= campoObligatorioRelleno("nombre");
	$htmlForm .= <<< TEXTHTML
	<label for="apellido1">Apellido1:</label>
	<input type="text" id="apellido1" name="apellido1" value="${_POST['apellido1']}"><br><br>
	<label for="apellido2">Apellido2</label>
	<input type="text" id="apellido2" name="apellido2" value="${_POST['apellido2']}"><br><br>
	<label for="email">Email:</label>
	TEXTHTML;
	$htmlForm .= campoObligatorioRelleno("email");
	$htmlForm .= <<< TEXTHTML
	<label for="sexo">Sexo:</label>
	<input type="radio" id="radioMujer" name="sexo" value="M" required>
	<label for="radioMujer">Mujer</label>
	<input type="radio" id="radioHombre" name="sexo" value="H" required>
	<label for="radioHombre">Hombre	</label>
	TEXTHTML;
	$htmlForm .= campoObligatorioRelleno("sexo");
	$htmlForm .= <<< TEXTHTML
	<input type="submit" value="Enviar">
	<input type="reset" value="Borrar">
	</form>
	TEXTHTML;

	echo $htmlForm;
}

function camposObligatoriosRellenos(){
	$camposObligatorios = ["nombre","email","sexo"];
	foreach($_POST as $campo => $valor){
		if(in_array($campo,$camposObligatorios) && $valor == ""){
			return false;
		}
	}
	return true;
}
function campoObligatorioRelleno($campo){
	$text = "";
	if($campo != "sexo"){
		$text .= '<input type="text" id="'.$campo.'" name="'.$campo.'">';
	}
	if($_POST[$campo] == ""){
		$text .= '<label> Campo Obligatorio</label>';
	}
	return $text . '<br><br>';
}
?>