<html>
   
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VIDEOCLUB - IES Leonardo Da Vinci</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
    <h1 class="text-center"> VIDEOCLUB IES LEONARDO DA VINCI</h1>

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Login Usuario</div>
		<div class="card-body">
		
		<form id="form" name="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="card-body">
			<div class="form-group">
				Usuario <input type="text" name="usuario" placeholder="usuario" class="form-control">
	        </div>
			<div class="form-group">
				Clave <input type="password" name="clave" placeholder="usuario" class="form-control">
	        </div>				
	        
			<input type="submit" name="submit" value="Login" class="btn btn-warning disabled">
        </form>
		
	    </div>
    </div>
    </div>
    </div>
</body>
</html>