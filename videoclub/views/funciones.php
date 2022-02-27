<?php
function mostrarDesplegablePeliculas($peliculas){
	$peliculasCarrito = $_SESSION["carrito"];

	echo "<select name='peliculas' class='form-control'>";
	foreach($peliculas as $pelicula){
		if(isset($peliculasCarrito[$pelicula["film_id"]])){
			if($pelicula["quantity"] > $peliculasCarrito[$pelicula["film_id"]]){
				echo "<option value='" .$pelicula['film_id'] ."'>". $pelicula['title'] . "</option>";
			}
		}else{
			echo "<option value='" .$pelicula['film_id'] ."'>". $pelicula['title'] . "</option>";
		}
	}
	echo "</select>";
}

function mostrarCarrito($peliculas){
	$peliculasCarrito = $_SESSION["carrito"];

	if(count($peliculasCarrito) > 0){
		echo "<table>
			<tr>
				<th>Film_id</th>
				<th>Tittle</th>
				<th>Quantity</th>
			</tr>";

		foreach($peliculas as $pelicula){
			if(isset($peliculasCarrito[$pelicula["film_id"]])){
				echo "<tr>
							<td>".$pelicula["film_id"]."</td>
							<td>".$pelicula["title"]."</td>
							<td>".$peliculasCarrito[$pelicula["film_id"]]."</td>
						</tr>";
			}
		}
		echo "</table>";
	}
}

function mostrarDesplegableThemes($themes){
	echo "<select name='theme' class='form-control'>";
	foreach($themes as $theme){
		echo "<option value='" .$theme['theme'] ."'>". $theme['theme'] . "</option>";
	}
	echo "</select>";
}

function mostrarPeliculasTematica($peliculasTematica){
	if(count($peliculasTematica) > 0){
		echo "<table>
			<tr>
				<th>Titulo</th>
				<th>Año de lanzamiento</th>
				<th>Fecha de Alquiler</th>
				<th>Fecha de devolucion</th>
			</tr>";

		foreach($peliculasTematica as $pelicula){
			echo "<tr>
						<td>".$pelicula["title"]."</td>
						<td>".$pelicula["release_year"]."</td>
						<td>".$pelicula["rental_date"]."</td>
						<td>".$pelicula["return_date"]."</td>
					</tr>";
		}
		echo "</table>";
	}
}

function mostrarDesplegablePeliculasAlquiladas($peliculasAlquildas){
	echo "<select name='rental' class='form-control'>";
	foreach($peliculasAlquildas as $pelicula){
		echo "<option value='" .$pelicula['film_id'] ."'>". $pelicula['title'] . "</option>";
	}
	echo "</select>";
}

?>