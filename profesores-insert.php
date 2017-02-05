<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="includes/estilo.css" rel="stylesheet">
<title>Aplicacion WEB: Formacion</title>
</head>
<body>
<?php
	include('includes/header.php');
	include('includes/conexion.php');
	include('includes/login.php');
	include('includes/nav-admin.php');
	include('includes/aside.php');	
?>

<h1>Profesores</h1>
<h2>Nuevo Profesor</h2>

<?php
if($_POST){
	// Se reciben datos y guardan en variables
	$nombre = ucwords(strtolower($_POST['nombre']));
	$apellido = ucwords(strtolower($_POST['apellido']));
	$calle = ucfirst(strtolower($_POST['calle']));
	$cp = $_POST['cp'];
	$poblacion = ucwords(strtolower($_POST['poblacion']));
	$dia = $_POST['dia'];
	$mes = $_POST['mes'];
	$anio = $_POST['anio'];
	$nacimiento = sprintf('%04d-%02d-%02d', $anio, $mes, $dia);	
	$sexo = $_POST['sexo'];
	$sueldo = $_POST['sueldo'];
	// recepcion y nombre de foto
	if($_FILES['foto']['size'] == 0){
		$consulta = "INSERT INTO profesores (nombre, apellido, calle, cp, poblacion, nacimiento, sexo, sueldo) ";
		$consulta .= "VALUES ('$nombre', '$apellido', '$calle', '$cp', '$poblacion', '$nacimiento', '$sexo', '$sueldo' ) ";
	} else {
		$extension_archivo = substr($_FILES['foto']['name'], -4);
		$foto = "fotos/". $nombre . "-" . $apellido . $extension_archivo;
		$foto = strtolower($foto);    //convertir a minúsculas
		$foto = str_replace(' ', '-', $foto);  // quitar espacios
		move_uploaded_file($_FILES['foto']['tmp_name'], $foto );	
	
		$consulta = "INSERT INTO profesores (nombre, apellido, calle, cp, poblacion, nacimiento, sexo, sueldo, foto) ";
		$consulta .= "VALUES ('$nombre', '$apellido', '$calle', '$cp', '$poblacion', '$nacimiento', '$sexo', '$sueldo', '$foto' ) ";
	}
	
	if ($conexion->query($consulta)) {
		//mensaje de confirmacion
		echo "<p>El nuevo profesor se ha añadido correctamente</p>";
		echo "<p><a href='profesores-ver.php?id=$conexion->insert_id'>Ver $nombre $apellido </a></p>";
		
	} else {
		die('Error de consulta '. $conexion->errno .': ' . $conexion->error );
	}

} else {
?>
<p>Todos los datos son obligatorios</p>
<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" onsubmit="return confirm('¿Seguro que quiere añadir este profesor')">

<p>Nombre<br>
<input type="text" name="nombre" size="50" maxlength="50" required> </p>

<p>Apellidos<br>
<input type="text" name="apellido" size="50" maxlength="50" required> </p>

<p>Calle<br>
<input type="text" name="calle" size="50" maxlength="100" required> </p>

<p>Cod. Postal<br>
<input type="text" name="cp" size="5" maxlength="5" required> </p>

<p>Población<br>
<input type="text" name="poblacion" size="50" maxlength="50" required> </p>

<p>Nacimiento<br>
<input type="number" name="dia" value="1" min="1" max="31" required > 
<input type="number" name="mes" value="1" min="1" max="12" required > 
<input type="number" name="anio" value="1990"  required > 
</p>

<p>Sexo<br>
<label><input type="radio" name="sexo" value="mujer" checked> Mujer </label><br>
<label><input type="radio" name="sexo" value="hombre"> Hombre </label>
</p>

<p>Sueldo<br>
<input type="number" name="sueldo" value="1500" min="0" step="100" required > </p>

<p>Fotografía<br>
<input type="file" name="foto" accept="image/*" > </p>

<p><input type="submit" value="Añadir"></p>


</form>


<?php

}

$conexion->close();
include('includes/footer.php');
?>

</body>
</html>