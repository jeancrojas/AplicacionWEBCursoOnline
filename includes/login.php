<?php
session_start();

// comprobamos si ya tiene acceso permitido
if (empty($_SESSION['acceso'])  || $_SESSION['acceso'] == 'no' ){

	if (empty($_POST)){
?>
        <article>
        <H1>Login usuarios</H1>
        <form method="post" action="<?= $_SERVER['PHP_SELF'] ?>" autocomplete="off" >
        <p>Usuario: <input type="text" name="usuario" ></p>
        <p>Contraseña: <input type="password" name="clave" ></p>
        <p><input type="submit" value="Acceder"></p>
        </form>
        </article>
<?php
		exit();
	} else {
		// recibimos datos $_POST	
		$usuario= $_POST['usuario'];
		$clave= $_POST['clave'];
		
		// Consultar bbdd
		$consulta= "SELECT * FROM usuarios WHERE usuario='$usuario' && clave='$clave' ";
		
		$resultado = $conexion->query($consulta);
		
		// comprobar si hay algun resultado correcto
		if ($conexion->affected_rows == 1){
			$_SESSION['acceso']='si';	
		} else {
			$_SESSION['acceso']='no';
			echo"<script>window.location='{$_SERVER['PHP_SELF']}'</script>";
		}
	}
}

?>