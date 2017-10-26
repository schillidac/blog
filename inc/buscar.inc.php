<section id="buscador">
	<form method="POST" action="busqueda.php">
			<input type="text" name="busqueda" placeholder="Buscar...">
		<label for="palabras">Todas las palabras</label>
			<input type="radio" name="palabras" value="0">
		<label for="palabras">Algunas palabras</label>
			<input type="radio" name="palabras" value="1" checked>
			<input type="hidden" name="verificador" value="1" checked>
			<input type="submit" name="enviar" value="Buscar">
	</form>
</section>