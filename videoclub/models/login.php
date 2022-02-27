<?php
//Función: getCustomerId
//Parámetros entrada: $conexion: id conexión; $usuario email introducido por pantalla; $clave clave introducido por pantalla
//Parámetros salida: devuelve el identificador de la conexión
function getCustomerId($conexion,$usuario, $clave){
        try{
            $sql = $conexion->prepare("SELECT customer_id,first_name,last_name,email FROM customer WHERE email = '$usuario' AND 
										concat(last_name,first_name) = '$clave' AND active = 1");
            $sql->execute();
            return $sql;
        }catch(Exception $e){
            echo "<strong>ERROR: </strong>".$e->getMessage();
        }
        
    }

?>