<!DOCTYPE html>
<html>
<head>
	<title>CANCELAR POLIZA</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
	<div id="wrapper">
		<h3>Cancelar Poliza</h3>
		<p>Esta seguro que quiere Cancelar esta poliza permanentemente?</p>
		<form action="cancelaPoliza.php" method="post">
			<input class="btn-danger" type="submit" name="eliminar" value="Cancelar" />
			<input type="hidden" name="sw" value="1" />
			<?php if(isset($_GET['id'])): ?>
				<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
			<?php endif; ?>
		</form><br />
		<a class="btn" href="index.php"><< Volver</a>
	</div>
</body>
</html>
<?php 

//conexion a bbdd
$link = mysqli_connect('localhost', 'autowarr_userPol', 'Morganas4@', 'autowarr_polizas');

//si el formulario fue enviado
if(isset($_POST['sw']) == 1){

	//cadena con la consulta de eliminacion segun el id de usuario
	//$query = "DELETE FROM users WHERE id =".$_POST['id']; //No olvidar el WHERE en el DELETE!!
	$query ="UPDATE polizas SET estatusPoliza='cancelado' WHERE idPoliza=".$_POST['id'];
// 	$query = "UPDATE `polizas` SET `estatusPoliza`='cancelado' WHERE idPoliza=125

	if(mysqli_query($link, $query)){ //si la consulta devuelve un resultado
		header("Location: index.php"); //redirecciono a index.php
	}else{ //si hubo un error
		echo "Ocurrio un error al intentar cancelar la poliza"; //mensaje de error
	}
}

//cierro conexion a bbdd
mysqli_close($link);
?>