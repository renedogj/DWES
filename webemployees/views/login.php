<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="../css/login.css">
</head>
<body>
	<div class="contenedora">
		<div class="iniciosesion">
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="form-inicio-sesion">
				<h1>Iniciar Sesion</h1>
				<div class="div-contenedora-labelinput">
					<label for="emp_no">Numero de empleado:</label>
					<input type="text" name="emp_no" maxlength="45" size="30" value="">
				</div>
				<div class="div-contenedora-labelinput">
					<label for="last_name">Contraseña:</label>
					<input type="text" name="last_name" size="30" maxlength="25" required/>
				</div>
				<button class="boton-iniciarsesion" id="boton" type="submit">Iniciar Sesión</button>
			</form>
		</div>
	</div>
</body>
</html>