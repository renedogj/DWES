<?php
function obtenerPeliculasStock($con){
	$sql = "SELECT film.film_id,title,quantity from film,inventory where film.film_id = inventory.film_id and quantity > 0";

	$stmt = $con->prepare($sql);
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	return new RecursiveArrayIterator($stmt->fetchAll());
}

function alquilarPelicula($con,$film_id,$customer_id){
	$fecha = date("Y-m-d h:m:s");
	try {
		$sql = "INSERT INTO rental (film_id,rental_date,customer_id) VALUES ('$film_id','$fecha','$customer_id')";

		$con->exec($sql);
	} catch(PDOException $e) {
		echo $sql . "<br>" . $e->getMessage();
	}
}

function actualizarInventario($con,$film_id,$cantidad){
	try{
		$sql = "UPDATE inventory set quantity=quantity-$cantidad where film_id='$film_id'";

	    $con->exec($sql);
	} catch(PDOException $e) {
		echo $sql . "<br>" . $e->getMessage();
	}
}

function obtenerThemes($con){
	$sql = "SELECT distinct(theme) FROM film";

	$stmt = $con->prepare($sql);
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	return new RecursiveArrayIterator($stmt->fetchAll());
}

function obtenerPeliculasAlquiladasTematica($con,$customer_id,$theme){
	$sql = "SELECT title,release_year,rental_date,return_date FROM film,rental where film.film_id=rental.film_id and customer_id='$customer_id' and theme='$theme'";

	$stmt = $con->prepare($sql);
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	return new RecursiveArrayIterator($stmt->fetchAll());
}

function obternerPeliculasAlquiladas($con,$customer_id){
	$sql = "SELECT film.film_id,title FROM film,rental where film.film_id=rental.film_id and customer_id='$customer_id' and return_date is null";

	$stmt = $con->prepare($sql);
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	return new RecursiveArrayIterator($stmt->fetchAll());
}
?>