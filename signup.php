<?php

require 'database.php';

$message = '';

if (!empty($_POST['email'])) {
    $sql = "INSERT INTO users (email, password, tipo, estatus, idAgencia, telefonoGerente, idTipoAgencia) VALUES (:email, :password, :tipo, :estatus, :idAgencia, :telefonoGerente, :idTipoAgencia )";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':tipo', $_POST['tipo']);
    $stmt->bindParam(':estatus', $_POST['estatus']);        $stmt->bindParam(':idAgencia', $_POST['idAgencia']);        $stmt->bindParam(':telefonoGerente', $_POST['telefonoGerente']);        $stmt->bindParam(':idTipoAgencia', $_POST['idTipoAgencia']);
    if ($stmt->execute()) {
        echo '<script language="javascript">alert("Registro exitoso");window.location.href="index.php"</script>';
    } else {
        echo '<script language="javascript">alert("Error de registro");window.location.href="signup.php"</script>';
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
				<p class="login-box-msg">Registro de usuario</p>

				<form action="signup.php" method="POST">
				<div class="input-group mb-3">
						<input type="text" name="estatus" required="required" class="form-control"
							placeholder="Nombre" onkeyup="javascript:this.value=this.value.toUpperCase();">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user"></span>
							</div>
						</div>
					</div>					<div class="input-group mb-3">						<input type="tel" name="telefonoGerente" required="required" class="form-control"							placeholder="Telefono" onkeyup="javascript:this.value=this.value.toUpperCase();">						<div class="input-group-append">							<div class="input-group-text">								<span class="fas fa-user"></span>							</div>						</div>					</div>
					<div class="input-group mb-3">
						<input type="email" name="email" required="required" class="form-control"
							placeholder="Email">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user"></span>
							</div>
						</div>
					</div>
					<div class="input-group mb-3">
						<input type="password" name="password" class="form-control"
							placeholder="Password" required="required">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-lock"></span>
							</div>
						</div>
					</div>					<div >												<p>													<select														class="custom-select rounded-0" id="idTipoAgencia"														name="idTipoAgencia">														<option value="0">Tipo agencia:</option>                			 	<?php    require ('init.php');    $query = $conn->prepare("SELECT * FROM tipoAgencias");    $query->execute();    $data = $query->fetchAll();    foreach ($data as $valores) :        echo '<option value="' . $valores["idTipoAgencia"] . '">' . $valores["tipoAgencia"] . '</option>';    endforeach    ;    ?>                    </select>												</p>											</div>
					<div >												<p>													<select														class="custom-select rounded-0" id="idAgencia"														name="idAgencia">														<option value="0">Seleccione una agencia:</option>                			 	<?php    require ('init.php');    $query = $conn->prepare("SELECT * FROM agencias");    $query->execute();    $data = $query->fetchAll();    foreach ($data as $valores) :        echo '<option value="' . $valores["idAgencia"] . '">' . $valores["nombreAgencia"] . '</option>';    endforeach    ;    ?>                    </select>												</p>											</div>
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-home"></span>
							</div>
						</div>
					</div>
					
<hr>
					<div class="row">

						<!-- /.col -->
						<div class="col-4">
							<button type="submit"value="submit" class="btn btn-primary btn-block">Registrar</button>
						</div>
						<!-- /.col -->
					</div>
				</form>



				<a href="login.html" class="text-center">I already have a membership</a>
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