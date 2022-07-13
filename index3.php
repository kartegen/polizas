<?php
session_start();

require 'database.php';

if (isset($_SESSION['user_id'])) {

    $records = $conn->prepare('SELECT * FROM users WHERE id = :id');

    $records->bindParam(':id', $_SESSION['user_id']);

    $records->execute();

    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {

        $user = $results;
    }
}

if (! empty($_POST['vin'])) {

    if (! empty($user)) {

        $idUser = $user['id'];

        $idAgencia = $user['idAgencia'];

        $estatusPoliza = "activo";

        $tipoAgencia = $user['idTipoAgencia'];
    }
    if ($tipoAgencia == 2) {

        $sql = "INSERT INTO polizas (marca, submarca, color, kms, cc, fechaFacturaPrimordial, placa, vin, cilindors, combustible, kmsMantenimiento, mesesMantenimiento, yearFabricacion, nombreCliente, fechaNacimiento, rfc, codigoPostal, localidad, municipio, estado, calle, colonia, numExt, telefono, folioContrato, fechaInicio, fechaFin, fechaVenta, emailCliente, fechaFinMarca, vendedor, idUser, valorVenta, curpCliente, estatusPoliza, hp, idAgencia, motor ) VALUES (:marca, :submarca, :color, :kms, :cc,:fechaFacturaPrimordial, :placa, :vin, :cilindors, :combustible, :kmsMantenimiento, :mesesMantenimiento, :yearFabricacion, :nombreCliente, :fechaNacimiento, :rfc, :codigoPostal, :localidad, :municipio, :estado, :calle, :colonia, :numExt, :telefono, :folioContrato, :fechaInicio, :fechaFin, :fechaVenta, :emailCliente, :fechaFinMarca, :vendedor, :idUser, :valorVenta, :curpCliente, :estatusPoliza, :hp, :idAgencia, :motor )";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':marca', $_POST['marca']);

        $stmt->bindParam(':submarca', $_POST['submarca']);

        $stmt->bindParam(':color', $_POST['color']);

        $stmt->bindParam(':kms', $_POST['kms']);

        $stmt->bindParam(':cc', $_POST['cc']);

        $stmt->bindParam(':fechaFacturaPrimordial', $_POST['fechaFacturaPrimordial']);

        $stmt->bindParam(':placa', $_POST['placa']);

        $stmt->bindParam(':vin', $_POST['vin']);

        $stmt->bindParam(':cilindors', $_POST['cilindors']);

        $stmt->bindParam(':combustible', $_POST['combustible']);

        $stmt->bindParam(':kmsMantenimiento', $_POST['kmsMantenimiento']);

        $stmt->bindParam(':mesesMantenimiento', $_POST['mesesMantenimiento']);

        $stmt->bindParam(':yearFabricacion', $_POST['yearFabricacion']);

        $stmt->bindParam(':nombreCliente', $_POST['nombreCliente']);

        $stmt->bindParam(':fechaNacimiento', $_POST['fechaNacimiento']);

        $stmt->bindParam(':rfc', $_POST['rfc']);

        $stmt->bindParam(':codigoPostal', $_POST['codigoPostal']);

        $stmt->bindParam(':localidad', $_POST['localidad']);

        $stmt->bindParam(':municipio', $_POST['municipio']);

        $stmt->bindParam(':estado', $_POST['estado']);

        $stmt->bindParam(':calle', $_POST['calle']);

        $stmt->bindParam(':colonia', $_POST['colonia']);

        $stmt->bindParam(':numExt', $_POST['numExt']);

        $stmt->bindParam(':telefono', $_POST['telefono']);

        $stmt->bindParam(':folioContrato', $_POST['folioContrato']);

        $stmt->bindParam(':fechaInicio', $_POST['fechaInicio']);

        $stmt->bindParam(':fechaFin', $_POST['fechaFin']);

        $stmt->bindParam(':fechaVenta', $_POST['fechaVenta']);

        $stmt->bindParam(':emailCliente', $_POST['emailCliente']);

        $stmt->bindParam(':fechaFinMarca', $_POST['fechaFinMarca']);

        $stmt->bindParam(':vendedor', $_POST['vendedor']);

        $stmt->bindParam(':idUser', $idUser);

        $stmt->bindParam(':valorVenta', $_POST['valorVenta']);

        $stmt->bindParam(':curpCliente', $_POST['curpCliente']);

        $stmt->bindParam(':estatusPoliza', $estatusPoliza);

        $stmt->bindParam(':motor', $_POST['motor']);

        $stmt->bindParam(':hp', $_POST['hp']);

        $stmt->bindParam(':idAgencia', $idAgencia);

        if ($stmt->execute()) {

            echo '<script language="javascript">alert("POLIZA GUARDADA");window.location.href="index.php"</script>';
        } else {

            echo '<script language="javascript">alert("Error de registro");window.location.href="index3.php"</script>';
        }
        ;
    } elseif ($tipoAgencia == 1) {
        
        $sql = "INSERT INTO polizasnuevas (marca, submarca, color, kms, cc, fechaFacturaPrimordial, placa, vin, cilindors, combustible, kmsMantenimiento, mesesMantenimiento, yearFabricacion, nombreCliente, fechaNacimiento, rfc, codigoPostal, localidad, municipio, estado, calle, colonia, numExt, telefono, folioContrato, fechaInicio, fechaFin, fechaVenta, emailCliente, fechaFinMarca, vendedor, idUser, valorVenta, curpCliente, estatusPoliza, hp, idAgencia, motor ) VALUES (:marca, :submarca, :color, :kms, :cc,:fechaFacturaPrimordial, :placa, :vin, :cilindors, :combustible, :kmsMantenimiento, :mesesMantenimiento, :yearFabricacion, :nombreCliente, :fechaNacimiento, :rfc, :codigoPostal, :localidad, :municipio, :estado, :calle, :colonia, :numExt, :telefono, :folioContrato, :fechaInicio, :fechaFin, :fechaVenta, :emailCliente, :fechaFinMarca, :vendedor, :idUser, :valorVenta, :curpCliente, :estatusPoliza, :hp, :idAgencia, :motor )";
        
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':marca', $_POST['marca']);
        
        $stmt->bindParam(':submarca', $_POST['submarca']);
        
        $stmt->bindParam(':color', $_POST['color']);
        
        $stmt->bindParam(':kms', $_POST['kms']);
        
        $stmt->bindParam(':cc', $_POST['cc']);
        
        $stmt->bindParam(':fechaFacturaPrimordial', $_POST['fechaFacturaPrimordial']);
        
        $stmt->bindParam(':placa', $_POST['placa']);
        
        $stmt->bindParam(':vin', $_POST['vin']);
        
        $stmt->bindParam(':cilindors', $_POST['cilindors']);
        
        $stmt->bindParam(':combustible', $_POST['combustible']);
        
        $stmt->bindParam(':kmsMantenimiento', $_POST['kmsMantenimiento']);
        
        $stmt->bindParam(':mesesMantenimiento', $_POST['mesesMantenimiento']);
        
        $stmt->bindParam(':yearFabricacion', $_POST['yearFabricacion']);
        
        $stmt->bindParam(':nombreCliente', $_POST['nombreCliente']);
        
        $stmt->bindParam(':fechaNacimiento', $_POST['fechaNacimiento']);
        
        $stmt->bindParam(':rfc', $_POST['rfc']);
        
        $stmt->bindParam(':codigoPostal', $_POST['codigoPostal']);
        
        $stmt->bindParam(':localidad', $_POST['localidad']);
        
        $stmt->bindParam(':municipio', $_POST['municipio']);
        
        $stmt->bindParam(':estado', $_POST['estado']);
        
        $stmt->bindParam(':calle', $_POST['calle']);
        
        $stmt->bindParam(':colonia', $_POST['colonia']);
        
        $stmt->bindParam(':numExt', $_POST['numExt']);
        
        $stmt->bindParam(':telefono', $_POST['telefono']);
        
        $stmt->bindParam(':folioContrato', $_POST['folioContrato']);
        
        $stmt->bindParam(':fechaInicio', $_POST['fechaInicio']);
        
        $stmt->bindParam(':fechaFin', $_POST['fechaFin']);
        
        $stmt->bindParam(':fechaVenta', $_POST['fechaVenta']);
        
        $stmt->bindParam(':emailCliente', $_POST['emailCliente']);
        
        $stmt->bindParam(':fechaFinMarca', $_POST['fechaFinMarca']);
        
        $stmt->bindParam(':vendedor', $_POST['vendedor']);
        
        $stmt->bindParam(':idUser', $idUser);
        
        $stmt->bindParam(':valorVenta', $_POST['valorVenta']);
        
        $stmt->bindParam(':curpCliente', $_POST['curpCliente']);
        
        $stmt->bindParam(':estatusPoliza', $estatusPoliza);
        
        $stmt->bindParam(':motor', $_POST['motor']);
        
        $stmt->bindParam(':hp', $_POST['hp']);
        
        $stmt->bindParam(':idAgencia', $idAgencia);
        
        if ($stmt->execute()) {
            
            echo '<script language="javascript">alert("POLIZA GUARDADA");window.location.href="index.php"</script>';
        } else {
            
            echo '<script language="javascript">alert("Error de registro");window.location.href="index3.php"</script>';
        }
        ;
        
        
    }else if ($tipoAgencia== 3) {
        $sql = "INSERT INTO polizasemext (marca, submarca, color, kms, cc, fechaFacturaPrimordial, placa, vin, cilindors, combustible, kmsMantenimiento, mesesMantenimiento, yearFabricacion, nombreCliente, fechaNacimiento, rfc, codigoPostal, localidad, municipio, estado, calle, colonia, numExt, telefono, folioContrato, fechaInicio, fechaFin, fechaVenta, emailCliente, fechaFinMarca, vendedor, idUser, valorVenta, curpCliente, estatusPoliza, hp, idAgencia, motor ) VALUES (:marca, :submarca, :color, :kms, :cc,:fechaFacturaPrimordial, :placa, :vin, :cilindors, :combustible, :kmsMantenimiento, :mesesMantenimiento, :yearFabricacion, :nombreCliente, :fechaNacimiento, :rfc, :codigoPostal, :localidad, :municipio, :estado, :calle, :colonia, :numExt, :telefono, :folioContrato, :fechaInicio, :fechaFin, :fechaVenta, :emailCliente, :fechaFinMarca, :vendedor, :idUser, :valorVenta, :curpCliente, :estatusPoliza, :hp, :idAgencia, :motor )";
        
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':marca', $_POST['marca']);
        
        $stmt->bindParam(':submarca', $_POST['submarca']);
        
        $stmt->bindParam(':color', $_POST['color']);
        
        $stmt->bindParam(':kms', $_POST['kms']);
        
        $stmt->bindParam(':cc', $_POST['cc']);
        
        $stmt->bindParam(':fechaFacturaPrimordial', $_POST['fechaFacturaPrimordial']);
        
        $stmt->bindParam(':placa', $_POST['placa']);
        
        $stmt->bindParam(':vin', $_POST['vin']);
        
        $stmt->bindParam(':cilindors', $_POST['cilindors']);
        
        $stmt->bindParam(':combustible', $_POST['combustible']);
        
        $stmt->bindParam(':kmsMantenimiento', $_POST['kmsMantenimiento']);
        
        $stmt->bindParam(':mesesMantenimiento', $_POST['mesesMantenimiento']);
        
        $stmt->bindParam(':yearFabricacion', $_POST['yearFabricacion']);
        
        $stmt->bindParam(':nombreCliente', $_POST['nombreCliente']);
        
        $stmt->bindParam(':fechaNacimiento', $_POST['fechaNacimiento']);
        
        $stmt->bindParam(':rfc', $_POST['rfc']);
        
        $stmt->bindParam(':codigoPostal', $_POST['codigoPostal']);
        
        $stmt->bindParam(':localidad', $_POST['localidad']);
        
        $stmt->bindParam(':municipio', $_POST['municipio']);
        
        $stmt->bindParam(':estado', $_POST['estado']);
        
        $stmt->bindParam(':calle', $_POST['calle']);
        
        $stmt->bindParam(':colonia', $_POST['colonia']);
        
        $stmt->bindParam(':numExt', $_POST['numExt']);
        
        $stmt->bindParam(':telefono', $_POST['telefono']);
        
        $stmt->bindParam(':folioContrato', $_POST['folioContrato']);
        
        $stmt->bindParam(':fechaInicio', $_POST['fechaInicio']);
        
        $stmt->bindParam(':fechaFin', $_POST['fechaFin']);
        
        $stmt->bindParam(':fechaVenta', $_POST['fechaVenta']);
        
        $stmt->bindParam(':emailCliente', $_POST['emailCliente']);
        
        $stmt->bindParam(':fechaFinMarca', $_POST['fechaFinMarca']);
        
        $stmt->bindParam(':vendedor', $_POST['vendedor']);
        
        $stmt->bindParam(':idUser', $idUser);
        
        $stmt->bindParam(':valorVenta', $_POST['valorVenta']);
        
        $stmt->bindParam(':curpCliente', $_POST['curpCliente']);
        
        $stmt->bindParam(':estatusPoliza', $estatusPoliza);
        
        $stmt->bindParam(':motor', $_POST['motor']);
        
        $stmt->bindParam(':hp', $_POST['hp']);
        
        $stmt->bindParam(':idAgencia', $idAgencia);
        
        if ($stmt->execute()) {
            
            echo '<script language="javascript">alert("POLIZA GUARDADA");window.location.href="index.php"</script>';
        } else {
            
            echo '<script language="javascript">alert("Error de registro");window.location.href="index3.php"</script>';
        }
        ;
    }
}

?><!DOCTYPE html><html><head><meta http-equiv=�Content-Type� content=�text/html; charset=utf-8? /><meta name="viewport" content="width=device-width, initial-scale=1"><title>autoWarranty</title><!-- Google Font: Source Sans Pro --><link rel="stylesheet"	href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"><!-- Font Awesome --><link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css"><!-- Ionicons --><link rel="stylesheet"	href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"><!-- Tempusdominus Bootstrap 4 --><link rel="stylesheet"	href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css"><!-- iCheck --><link rel="stylesheet"	href="plugins/icheck-bootstrap/icheck-bootstrap.min.css"><!-- JQVMap --><link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css"><!-- Theme style --><link rel="stylesheet" href="dist/css/adminlte.min.css"><!-- overlayScrollbars --><link rel="stylesheet"	href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css"><!-- Daterange picker --><link rel="stylesheet"	href="plugins/daterangepicker/daterangepicker.css"><!-- summernote --><link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css"><!-- <SWAL --><script	src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.js"></script><link rel="stylesheet"	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"><script	src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script><script	src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script><style>* {	box-sizing: border-box;}body {	background-color: #f1f1f1;}#regForm {	background-color: #ffffff;	margin: 100px auto;	padding: 5px;	width: 70%;	min-width: 300px;}h1 {	text-align: center;}input {	padding: 10px;	width: 100%;}/* Mark input boxes that gets an error on validation: */input.invalid {	background-color: #ffdddd;}/* Hide all steps by default: */.tab {	display: none;}button {	background-color: #04AA6D;	color: #ffffff;	border: none;	padding: 10px 20px;	cursor: pointer;}button:hover {	opacity: 0.8;}#prevBtn {	background-color: #bbbbbb;}/* Make circles that indicate the steps of the form: */.step {	height: 15px;	width: 15px;	margin: 0 2px;	background-color: #bbbbbb;	border: none;	border-radius: 50%;	display: inline-block;	opacity: 0.5;}.step.active {	opacity: 1;}/* Mark the steps that are finished and valid: */.step.finish {	background-color: #04AA6D;}</style></head><!-- SI EL USUARIO ESTA LOGUEADO -->
<?php if(!empty($user)): ?>

<body class="hold-transition sidebar-mini layout-fixed">	<div class="wrapper">		<!-- Navbar -->		<nav			class="main-header navbar navbar-expand navbar-white navbar-light">			<!-- Left navbar links -->			<ul class="navbar-nav">				<li class="nav-item"><a class="nav-link" data-widget="pushmenu"					href="#" role="button"><i class="fas fa-bars"></i></a></li>				<li class="nav-item d-none d-sm-inline-block"><a href="index.php"					class="nav-link">Inicio</a></li>				<li class="nav-item d-none d-sm-inline-block"><a href="index3.php"					class="nav-link">Nueva poliza</a></li>			</ul>		</nav>		<!-- /.navbar -->		<!-- Main Sidebar Container -->		<aside class="main-sidebar sidebar-dark-primary elevation-4">			<!-- Brand Logo -->			<a href="index.php" class="brand-link"> <img src="dist/img/logo.png"				alt="autoWarranty" class="brand-image img-circle elevation-3"				style="opacity: .8"> <span class="brand-text font-weight-light">Polizas</span>			</a>			<!-- Sidebar -->			<div class="sidebar">				<!-- Sidebar user panel (optional) -->				<div class="user-panel mt-3 pb-3 mb-3 d-flex">					<div class="image">						<!--           <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> -->					</div>					<div class="info">						<a href="#" class="d-block">BIENVENIDO <?= $user['estatus'];?></a>					</div>				</div>				<!-- Sidebar Menu -->				<nav class="mt-2">					<ul class="nav nav-pills nav-sidebar flex-column"						data-widget="treeview" role="menu" data-accordion="false">						<li class="nav-item"><a href="#" class="nav-link"> <i								class="nav-icon fas fa-edit"></i>								<p>									POLIZAS <i class="fas fa-angle-left right"></i>								</p>						</a>							<ul class="nav nav-treeview">								<li class="nav-item"><a href="index.php" class="nav-link"> <i										class="far fa-circle nav-icon"></i>										<p>Inicio</p>								</a></li>							</ul></li>					</ul>					<li class="nav-header">Sesión</li>					<li class="nav-item"><a href="logout.php" class="nav-link"> <i							class="nav-icon far fa-circle text-danger"></i>							<p class="text">Cerrar sesion</p>					</a></li>				</nav>				<!-- /.sidebar-menu -->			</div>			<!-- /.sidebar -->		</aside>		<!-- Content Wrapper. Contains page content -->		<div class="content-wrapper">			<!-- Content Header (Page header) -->			<div class="content-header">				<div class="container-fluid">					<!-- /.col -->					<div class="col-sm-12">						<ol class="breadcrumb float-sm-right">							<li class="breadcrumb-item active">NUEVA POLIZA</li>							<li class="breadcrumb-item"><a href="index.php">INICIO</a></li>						</ol>					</div>				</div>				<!-- /.container-fluid -->			</div>			<!-- /.content-header -->			<!-- Main content -->			<section class="content">				<div class="container-fluid">					<div class="row">						<!-- left column -->						<div class="col-md-12">							<!-- general form elements -->							<div class="card card-success">								<div class="card-header">									<h1 class="card-title">Registro</h1>								</div>								<!-- /.card-header -->								<!-- form start -->								<form id="regForm" method="POST" action="/polizas/index3.php">									<div class="tab">										<h1>CLIENTE</h1>										<p>											<label for="user">Nombre</label> <input type="text"												name="nombreCliente" class="form-control pl-0"												placeholder="NOMBRE DEL CLIENTE"												onkeyup="javascript:this.value=this.value.toUpperCase();" />										</p>										<p>											<label for="user">Fecha de nacimiento</label> <input												type="date" name="fechaNacimiento" id="nacimiento"												name="nacimiento">										</p>										<div class="row">											<div class="col-sm-6">												<p>													<label for="user">RFC</label> <input type="text" name="rfc"														class="form-control pl-0" placeholder="RFC CON HOMOCLAVE"														onkeyup="javascript:this.value=this.value.toUpperCase();" />												</p>											</div>											<div class="col-sm-6">												<p>													<label for="user">CURP</label> <input type="text"														name="curpCliente" class="form-control pl-0"														placeholder="CURP"														onkeyup="javascript:this.value=this.value.toUpperCase();" />												</p>											</div>										</div>										<div class="row">											<div class="col-sm-6">												<p>													<label for="user">Codigo postal</label> <input														type="number" name="codigoPostal"														class="form-control pl-0" placeholder="Codigo postal"														onkeyup="javascript:this.value=this.value.toUpperCase();" />												</p>											</div>											<div class="col-sm-6">												<p>													<label for="user">Calle</label> <input type="text"														name="calle" class="form-control pl-0" placeholder="CALLE"														onkeyup="javascript:this.value=this.value.toUpperCase();" />												</p>											</div>										</div>										<div class="row">											<div class="col-sm-6">												<p>													<label for="user">Colonia</label> <input type="text"														name="colonia" class="form-control pl-0"														placeholder="COLONIA"														onkeyup="javascript:this.value=this.value.toUpperCase();" />												</p>											</div>											<div class="col-sm-6">												<p>													<label for="user">Localidad</label> <input type="text"														name="localidad" class="form-control pl-0"														placeholder="LOCALIDAD"														onkeyup="javascript:this.value=this.value.toUpperCase();" />												</p>											</div>										</div>										<div class="row">											<div class="col-sm-6">												<p>													<label for="user">Municipio</label> <input type="text"														name="municipio" class="form-control pl-0"														placeholder="MUNICIPIO"														onkeyup="javascript:this.value=this.value.toUpperCase();" />												</p>											</div>											<div class="col-sm-6">												<p>													<label for="user">Estado</label> <input type="text"														name="estado" class="form-control pl-0"														placeholder="ESTADO"														onkeyup="javascript:this.value=this.value.toUpperCase();" />												</p>											</div>										</div>										<div class="row">											<div class="col-sm-4">												<p>													<label for="user">Numero exterior/interior</label> <input														type="text" name="numExt" class="form-control pl-0"														placeholder="NUMERO"														onkeyup="javascript:this.value=this.value.toUpperCase();" />												</p>											</div>											<div class="col-sm-4">												<p>													<label for="user">Email</label> <input type="email"														name="emailCliente" class="form-control pl-0"														placeholder="EMAIL" />												</p>											</div>											<div class="col-sm-4">												<p>													<label for="user">Teléfono</label> <input type="text"														name="telefono" class="form-control pl-0"														placeholder="TELEFONO"														onkeyup="javascript:this.value=this.value.toUpperCase();" />												</p>											</div>										</div>									</div>									<div class="tab">										<h1>VEHICULO</h1>										<div class="row">											<div class="col-sm-4">												<p>													<label for="user">Marca</label> <input type="text"														name="marca" class="form-control pl-0" placeholder="MARCA"														onkeyup="javascript:this.value=this.value.toUpperCase();" />												</p>											</div>											<div class="col-sm-4">												<p>													<label for="user">SubMarca</label> <input type="text"														name="submarca" class="form-control pl-0"														placeholder="Submarca"														onkeyup="javascript:this.value=this.value.toUpperCase();" />												</p>											</div>											<div class="col-sm-4">												<p>													<label for="user">Color</label> <input type="text"														name="color" class="form-control pl-0" placeholder="Color"														onkeyup="javascript:this.value=this.value.toUpperCase();" />												</p>											</div>										</div>										<div class="row">											<div class="col-sm-3">												<p>													<label for="user">Kilometraje</label> <input type="text"														name="kms" class="form-control pl-0"														placeholder="Kilometraje"														onkeyup="javascript:this.value=this.value.toUpperCase();" />												</p>											</div>											<div class="col-sm-2">												<p>													<label for="user">HP</label> <input type="text" name="hp"														class="form-control pl-0" placeholder="HP"														onkeyup="javascript:this.value=this.value.toUpperCase();" />												</p>											</div>											<div class="col-sm-2">												<p>													<label for="user">C.C.</label> <input type="text" name="cc"														class="form-control pl-0" placeholder="CC"														onkeyup="javascript:this.value=this.value.toUpperCase();" />												</p>											</div>											<div class="col-sm-3">												<p>													<label for="user">Placa</label> <input type="text"														name="placa" class="form-control pl-0" placeholder="Placa"														onkeyup="javascript:this.value=this.value.toUpperCase();" />												</p>											</div>										</div>										<div class="row">											<div class="col-sm-3">												<p>													<label for="user">Fecha de factura original</label> <input														type="date" name="fechaFacturaPrimordial"														id="fechaFacturaPrimordial">												</p>											</div>											<div class="col-sm-3">												<p>													<label for="user">Cilindros</label> <input type="number"														name="cilindors" class="form-control pl-0"														placeholder="Cilindros"														onkeyup="javascript:this.value=this.value.toUpperCase();" />												</p>											</div>											<div class="col-sm-3">												<p>													<label for="user">Año de fabricacion</label> <<input														type="number" name="yearFabricacion"														class="form-control pl-0"														placeholder="Año de fabricación"														onkeyup="javascript:this.value=this.value.toUpperCase();" />												</p>											</div>											<div class="col-sm-3">												<p>													<label for="user">Motor</label> <input type="number"														name="motor" id="motor" class="form-control pl-0"														placeholder="Motor"														onkeyup="javascript:this.value=this.value.toUpperCase();" />												</p>											</div>										</div>										<p>											<label for="user">VIN</label> <input type="text" name="vin"												class="form-control pl-0" placeholder="VIN"												onkeyup="javascript:this.value=this.value.toUpperCase();" />										</p>										<div class="row">											<div class="col-sm-4">												<p>													<label for="user">Kilometros mantenimiento</label> <input														type="number" name="kmsMantenimiento" id="kmMto"														placeholder="kilometros mantenimiento"														onkeyup="javascript:this.value=this.value.toUpperCase();" />												</p>											</div>											<div class="col-sm-4">												<p>													<label for="user">Meses mantenimiento</label> <input														type="number" name="mesesMantenimiento"														class="form-control pl-0"														placeholder="Meses mantenimiento"														onkeyup="javascript:this.value=this.value.toUpperCase();" />												</p>											</div>											<div class="col-sm-4">												<p>													<label for="user">Valor de venta</label> <input														type="number" name="valorVenta" id="kmMto"														placeholder="Valor de venta"														onkeyup="javascript:this.value=this.value.toUpperCase();" />												</p>											</div>										</div>										<p>											<label for="user">Combustible</label> <select												class="custom-select" id="combustible" name="combustible">												<option selected="selected" value="GASOLINA">Gasolina</option>												<option value="DIESEL">Diesel</option>												<option value="ELECTRICO">Electrico</option>												<option value="HIBRIDO">Hibrido</option>											</select>										</p>									</div>									<div class="tab">										<h1>POLIZA</h1>										<div class="row">											<div class="col-sm-4">												<p>													<label for="user">Contrato</label><select														class="custom-select" id="folioContrato"														name="folioContrato">														<option value="Cobertura 18 meses" selected="selected">18															MESES</option>														<option value="Cobertura 15 meses">15 MESES</option>													</select>												</p>											</div>											<div class="col-sm-4">												<p>													<label for="user">Fecha de inicio de cobertura</label> <input														type="date" name="fechaInicio" id="fechaInicio">												</p>											</div>											<div class="col-sm-4">												<p>													<label for="user">Fecha de fin de cobertura</label> <input														type="date" id="fechaFin" name="fechaFin">												</p>											</div>										</div>										<div class="row">											<div class="col-sm-4">												<p>													<label for="user">Fecha de venta</label> <input type="date"														name="fechaVenta" id="fechaVenta">												</p>											</div>											<div class="col-sm-4">												<p>													<label for="user">Fecha de fin garantia de marca</label> <input														type="date" value="2021-10-22">												</p>											</div>											<div class="col-sm-4">												<p>													<label for="user">Vendedor</label> <input type="text"														name="vendedor" class="form-control pl-0"														placeholder="VENDEDOR"														onkeyup="javascript:this.value=this.value.toUpperCase();" />												</p>											</div>										</div>									</div>									<div style="overflow: auto;">										<div style="float: right;">											<button type="button" id="prevBtn" onclick="nextPrev(-1)">Atrás</button>											<button type="button" id="nextBtn" onclick="nextPrev(1)">Siguiente</button>										</div>									</div>									<!-- Circles which indicates the steps of the form: -->									<div style="text-align: center; margin-top: 40px;">										<span class="step"></span> <span class="step"></span> <span											class="step"></span>									</div>								</form>							</div>						</div>					</div>					<!-- /.row -->				</div>				<!-- /.container-fluid -->			</section>
		
       <?php else: ?>
<!-- 	USUARIO NO LOGUEADO -->
logueado
<?php

    echo '<script>
       function alerta(){
           swal("SESION CERRADA", "En un momento te redireccionamos", "warning")
            window.location.href = "/polizas/login.php";
       }
       alerta();
       </script>';

    ?>
	
<?php endif?>
       


 <footer class="main-footer">				<strong>Derechos reservados &copy; 2021 <a href="#">LOBDRA</a>.				</strong>				<div class="float-right d-none d-sm-inline-block">					<b>Version</b> BETA				</div>			</footer>			<!-- Control Sidebar -->			<aside class="control-sidebar control-sidebar-dark">				<!-- Control sidebar content goes here -->			</aside>			<!-- /.control-sidebar -->		</div>		<!-- ./wrapper -->		<!-- jQuery -->		<script src="plugins/jquery/jquery.min.js"></script>		<!-- jQuery UI 1.11.4 -->		<script src="plugins/jquery-ui/jquery-ui.min.js"></script>		<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->		<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>		<!-- Bootstrap 4 -->		<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>		<!-- ChartJS -->		<script src="plugins/chart.js/Chart.min.js"></script>		<!-- Sparkline -->		<script src="plugins/sparklines/sparkline.js"></script>		<!-- JQVMap -->		<script src="plugins/jqvmap/jquery.vmap.min.js"></script>		<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>		<!-- jQuery Knob Chart -->		<script src="plugins/jquery-knob/jquery.knob.min.js"></script>		<!-- daterangepicker -->		<script src="plugins/moment/moment.min.js"></script>		<script src="plugins/daterangepicker/daterangepicker.js"></script>		<!-- Tempusdominus Bootstrap 4 -->		<script			src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>		<!-- Summernote -->		<script src="plugins/summernote/summernote-bs4.min.js"></script>		<!-- overlayScrollbars -->		<script			src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>		<!-- AdminLTE App -->		<script src="dist/js/adminlte.js"></script>		<!-- AdminLTE for demo purposes -->		<!-- AdminLTE dashboard demo (This is only for demo purposes) -->		<script src="dist/js/pages/dashboard.js"></script>		<script>
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Guardar";
  } else {
    document.getElementById("nextBtn").innerHTML = "Siguiente";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
   y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}
</script></body></html>