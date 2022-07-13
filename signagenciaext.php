<?php



require 'database.php';



$message = '';



if (!empty($_POST['nombreAgencia']) && !empty($_POST['telefonoAgencia'])) {
    
    $sql ="INSERT INTO `agenciasExt` (
`nombreAgencia`,
`telefonoAgencia`,
`localidadAgencia`,
`gerenteAgencia`,
`coloniaAgencia`,
`direccionAgencia`,
`calleAgencia`,
`extensionAgencia`,
`numExtAgencia`,
`emailAgencia`,
`estadoAgencia`,
`cpAgencia`,
`municipioAgencia`,
`rfcAgencia`,
`prefijoAgencia`,
`idEmpresa`)
VALUES (
:nombreAgencia,
:telefonoAgencia,
:localidadAgencia,
:gerenteAgencia,
:coloniaAgencia,
:direccionAgencia,
:calleAgencia,
:extensionAgencia,
:numExtAgencia,
:emailAgencia,
:estadoAgencia,
:cpAgencia,
:municipioAgencia,
:rfcAgencia,
:prefijoAgencia,
:idEmpresa )";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nombreAgencia', $_POST['nombreAgencia']);
    $stmt->bindParam(':telefonoAgencia', $_POST['telefonoAgencia']);
    $stmt->bindParam(':localidadAgencia', $_POST['localidadAgencia']);
    $stmt->bindParam(':gerenteAgencia', $_POST['gerenteAgencia']);
    $stmt->bindParam(':coloniaAgencia', $_POST['coloniaAgencia']);
    $stmt->bindParam(':direccionAgencia', $_POST['calleAgencia']);
    $stmt->bindParam(':extensionAgencia', $_POST['extensionAgencia']);
    $stmt->bindParam(':numExtAgencia', $_POST['numExtAgencia']);
    $stmt->bindParam(':emailAgencia', $_POST['emailAgencia']);
    $stmt->bindParam(':estadoAgencia', $_POST['estadoAgencia']);
    $stmt->bindParam(':cpAgencia', $_POST['cpAgencia']);
    $stmt->bindParam(':municipioAgencia', $_POST['municipioAgencia']);
    $stmt->bindParam(':rfcAgencia', $_POST['rfcAgencia']);
    $stmt->bindParam(':prefijoAgencia', $_POST['prefijoAgencia']);
    $stmt->bindParam(':idEmpresa', $_POST['idEmpresa']);
    
    if ($stmt->execute()) {
        
        echo '<script language="javascript">alert("Agencia registrada");window.location.href="admin.php"</script>';
        
    } else {
        
        echo '<script language="javascript">alert("Error de registro");window.location.href="signagencia.php"</script>';
        
    }
    
}

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>autoWarranty</title>



<!-- Google Font: Source Sans Pro -->

<link rel="stylesheet"

	href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

<!-- Font Awesome -->

<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">

<!-- Ionicons -->

<link rel="stylesheet"

	href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

<!-- Tempusdominus Bootstrap 4 -->

<link rel="stylesheet"

	href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

<!-- iCheck -->

<link rel="stylesheet"

	href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">

<!-- JQVMap -->

<link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">

<!-- Theme style -->

<link rel="stylesheet" href="dist/css/adminlte.min.css">

<!-- overlayScrollbars -->

<link rel="stylesheet"

	href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

<!-- Daterange picker -->

<link rel="stylesheet"

	href="plugins/daterangepicker/daterangepicker.css">

<!-- summernote -->

<link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">

<!-- <SWAL -->

<script

	src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.js"></script>

<link rel="stylesheet"

	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<script

	src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script

	src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>

<body class="hold-transition register-page">

	<div class="register-box">

		<div class="card card-outline card-primary">

			<div class="card-header text-center">

				<a href="index.php" class="h1"><b>Auto</b>Warranty</a>

			</div>

			<div class="card-body">

				<p class="login-box-msg">Registro de agencia SEMINUEVOS</p>



				<form action="signagenciaext.php" method="POST">
					<div class="input-group mb-3">

						<input type="text" name="nombreAgencia" required="required" class="form-control"

							placeholder="Nombre de la agencia" onkeyup="javascript:this.value=this.value.toUpperCase();">

						<div class="input-group-append">

							<div class="input-group-text">

								<span class="fas fa-user"></span>

							</div>

						</div>

					</div>
					
					<div class="input-group mb-3">
						<input type="text" name="rfcAgencia" required="required" class="form-control"

							placeholder="RFC" onkeyup="javascript:this.value=this.value.toUpperCase();">

						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user"></span>
							</div>
						</div>
					</div>
					
					<div class="input-group mb-3">
						<input type="text" name="telefonoAgencia" required="required" class="form-control"

							placeholder="telefono agencia" onkeyup="javascript:this.value=this.value.toUpperCase();">

						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user"></span>
							</div>
						</div>
					</div>
					
					<div class="input-group mb-3">
						<input type="text" name="extencionAgencia" required="required" class="form-control"

							placeholder="Extension" onkeyup="javascript:this.value=this.value.toUpperCase();">

						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user"></span>
							</div>
						</div>
					</div>				
					<div class="input-group mb-3">
						<input type="text" name="calleAgencia" required="required" class="form-control"

							placeholder="Calle" onkeyup="javascript:this.value=this.value.toUpperCase();">

						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user"></span>
							</div>
						</div>
					</div>
					
					<div class="input-group mb-3">
						<input type="text" name="numExtAgencia" required="required" class="form-control"

							placeholder="Numero exterior" onkeyup="javascript:this.value=this.value.toUpperCase();">

						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user"></span>
							</div>
						</div>
					</div>
					<div class="input-group mb-3">
						<input type="text" name="numIntAgencia" required="required" class="form-control"

							placeholder="Numero interior" onkeyup="javascript:this.value=this.value.toUpperCase();">

						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user"></span>
							</div>
						</div>
					</div>
					
					<div class="input-group mb-3">
						<input type="text" name="coloniaAgencia" required="required" class="form-control"

							placeholder="Colonia" onkeyup="javascript:this.value=this.value.toUpperCase();">

						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user"></span>
							</div>
						</div>
					</div>
					<div class="input-group mb-3">
						<input type="text" name="localidadAgencia" required="required" class="form-control"

							placeholder="Localidad" onkeyup="javascript:this.value=this.value.toUpperCase();">

						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user"></span>
							</div>
						</div>
					</div>
					<div class="input-group mb-3">
						<input type="text" name="municipioAgencia" required="required" class="form-control"

							placeholder="Municipio" onkeyup="javascript:this.value=this.value.toUpperCase();">

						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user"></span>
							</div>
						</div>
					</div>
					<div class="input-group mb-3">
						<input type="text" name="estadoAgencia" required="required" class="form-control"

							placeholder="Estado" onkeyup="javascript:this.value=this.value.toUpperCase();">

						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user"></span>
							</div>
						</div>
					</div>
					<div class="input-group mb-3">
						<input type="number" name="cpAgencia" required="required" class="form-control"

							placeholder="Codigo postal" onkeyup="javascript:this.value=this.value.toUpperCase();">

						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user"></span>
							</div>
						</div>
					</div>
					
					
					<div class="input-group mb-3">
						<input type="email" name="emailAgencia" required="required" class="form-control"

							placeholder="Correo electronico" onkeyup="javascript:this.value=this.value.toLowCase();">

						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user"></span>
							</div>
						</div>
					</div>
					<div class="input-group mb-3">
						<input type="text" name="prefijoAgencia" required="required" class="form-control"

							placeholder="Prefijo" onkeyup="javascript:this.value=this.value.toUpperCase();">

						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user"></span>
							</div>
						</div>
					</div>
					
					<div class="input-group mb-3">
												<p>
													 <select
														class="custom-select rounded-0" required="required" id="idEmpresa"
														name="idEmpresa">
														<option value="">Seleccione una empresa:</option>          
      			 	<?php

      			 	require ('init.php');
      			 	$query = $conn->prepare("SELECT * FROM empresas");
      			 	$query->execute();
      			 	$data = $query->fetchAll();
      			 	
      			 	foreach ($data as $valores) :
      			 	echo '<option value="' . $valores["idEmpresa"] . '">' . $valores["nombreEmpresa"] . '</option>';
      			 	endforeach
      			 	;
    ?>
                    </select>
												</p>
												<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user"></span>
							</div>
						</div>
											</div>
					
					
					
					
					<div class="input-group mb-3">
						<input type="text" name="gerenteAgencia" required="required" class="form-control"

							placeholder="Gerente" onkeyup="javascript:this.value=this.value.toUpperCase();">

						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user"></span>
							</div>
						</div>
					</div>
					
<hr>

					<div class="row">



						<!-- /.col -->

						<div class="col-12">

							<button type="submit"value="submit" class="btn btn-primary btn-block">Registrar agencia</button>
 
						</div>

						<!-- /.col -->

					</div>

				</form>


				<a href="admin.php" class="text-center">Cancelar</a>

			</div>

			<!-- /.form-box -->

		</div>

		<!-- /.card -->

	</div>

	<!-- /.register-box -->



	<!-- jQuery -->

	<script src="plugins/jquery/jquery.min.js"></script>

	<!-- Bootstrap 4 -->

	<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

	<!-- AdminLTE App -->

	<script src="dist/js/adminlte.min.js"></script>

</body>

</html>

</html>