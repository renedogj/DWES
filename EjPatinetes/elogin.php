<?php
session_start();
$redireccion = "einicio.php";
if(isset($_SESSION['email'])){
	$email = $_SESSION['email'];
}else{
	$email = "";
}
include("funciones.php");
include("Clases/Cliente.php");
?>
<html>
   
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page - EPATIN</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
 </head>
      
<body>
    <h1>ALQUILER PATINETES ELÉCTRICOS</h1>
    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
            <div class="card-header">Login Usuario</div>
                <div class="card-body">
                    <form id="" name="" action="" method="post" class="card-body">
                        <div class="form-group">
                            Email <input type="text" name="email" placeholder="email" class="form-control">
                        </div>
                        <div class="form-group">
                            Clave <input type="password" name="password" placeholder="password" class="form-control">
                        </div>				
                        
                        <input type="submit" name="submit" value="Login" class="btn btn-warning disabled">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
	if(formularioEnviado()){
		$email = $_POST['email'];
		$password = $_POST['password'];
		$con = crearConexion();
		$cliente = Cliente::comprobarCredenciales($con,$email,$password);
		if($cliente != null){
			$_SESSION['email'] = $email;
			$_SESSION['carrito'] = array();
			header('Location: '.$redireccion);
			die();
		}else{
			echo "Credenciales incorrectas";
		}
		$con=null;
	}
	?>
</body>
</html>