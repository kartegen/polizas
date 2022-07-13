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

    $idAgencia = $user['idAgencia'];
}

$idPoliza=$_REQUEST['id'];




include_once 'conexion.php';

//  if(count($_POST)>0) {
//         mysqli_query($conn, "UPDATE `polizas` SET `marca`='" . $_POST['marca'] . "',`subMarca`='" . $_POST['subMarca'] . "',`color`='" . $_POST['color'] . "',`kms`='" . $_POST['kms'] . "',`cc`='" . $_POST['cc'] . "',`fechaFacturaPrimordial`='" . $_POST['fechaFacturaPrimordial'] . "',`placa`='" . $_POST['placa'] . "',`vin`='" . $_POST['vin'] . "',`cilindors`='" . $_POST['cilindors'] . "',`combustible`='" . $_POST['combustible'] . "',`kmsMantenimiento`='" . $_POST['kmsMantenimiento'] . "',`mesesMantenimiento`='" . $_POST['mesesMantenimiento'] . "',`yearFabricacion`='" . $_POST['yearFabricacion'] . "',`nombreCliente`='" . $_POST['nombreCliente'] . "',`fechaNacimiento`='" . $_POST['fechaNacimiento'] . "',`rfc`='" . $_POST['rfc'] . "',`codigoPostal`='" . $_POST['codigoPostal'] ."',`localidad`='" . $_POST['localidad'] ."',`municipio`='" . $_POST['municipio'] ."',`estado`='" . $_POST['estado'] ."',`calle`='" . $_POST['calle'] ."',`colonia`='" . $_POST['colonia'] ."',`numExt`='" . $_POST['numExt'] ."',`emailCliente`='" . $_POST['emailCliente'] ."',`telefono`='" . $_POST['telefono'] ."',`folioContrato`='" . $_POST['folioContrato'] ."',`fechaInicio`='" . $_POST['fechaInicio'] ."',`fechaFin`='" . $_POST['fechaFin'] ."',`fechaVenta`='" . $_POST['fechaVenta'] ."',`fechaFinMarca`='" . $_POST['fechaFinMarca'] ."',`vendedor`='" . $_POST['vendedor'] . "',`curpCliente`='" . $_POST['curpCliente'] . "',`motor`='" . $_POST['motor'] . "',`hp`='" . $_POST['hp'] . "',`valorVenta`='" . $_POST['valorVenta'] . "' WHERE idPoliza = " . $idPoliza . "'");
//         //mysqli_query($conn, "UPDATE `polizas` set `idPoliza'" . $_POST['idPoliza'] . "',  `marca=`'" . $_POST['marca'] . "', `subMarca`='" . $_POST['subMarca'] . "', `color`='" . $_POST['color'] . "' ,`kms`='" . $_POST['kms'] . "' ,`cc`='" . $_POST['cc'] . "' ,`fechaFacturaPrimordial`='" . $_POST['fechaFacturaPrimordial'] . "' ,`placa`='" . $_POST['placa'] . "' ,`vin`='" . $_POST['vin'] . "' ,`cilindors`='" . $_POST['cilindors'] . "' ,`combustible`='" . $_POST['combustible'] . "' ,`kmsMantenimiento`='" . $_POST['kmsMantenimiento'] . "' ,`mesesMantenimiento=`='" . $_POST['mesesMantenimiento'] . "' ,`yearFabricacion`='" . $_POST['yearFabricacion'] . "' ,`nombreCliente`='" . $_POST['nombreCliente'] . "' ,`fechaNacimiento`='" . $_POST['fechaNacimiento'] . "' ,`rfc`='" . $_POST['rfc'] . "' ,`codigoPostal`='" . $_POST['codigoPostal'] ."' ,`localidad`='" . $_POST['localidad'] ."' ,`municipio`='" . $_POST['municipio'] ."' ,`estado`='" . $_POST['estado'] ."' ,`calle`='" . $_POST['calle'] ."' ,`numExt`='" . $_POST['numExt'] ."' ,`email`='" . $_POST['email'] ."' ,`telefono`='" . $_POST['telefono'] ."' ,`folioContrato`='" . $_POST['folioContrato'] ."' ,`fechaInicio`='" . $_POST['fechaInicio'] ."' ,`fechaFin`='" . $_POST['fechaFin'] ."' ,`fechaVenta`='" . $_POST['fechaVenta'] ."' ,`fechaFinMarca`='" . $_POST['fechaFinMarca'] ."' ,`vendedor`='" . $_POST['vendedor'] . "' WHERE idPoliza='" . $_POST['idPoliza'] . "'");
    
// //     mysqli_query($conn, "UPDATE `polizas` SET `nombreCliente`='". $_POST['nombreCliente']  . "' WHERE idPoliza = " . $idPoliza . "'");
//      $message = "POLIZA ACTUALIZADA!";
//  }
 $result = mysqli_query($conn,"SELECT polizas.*,agencias.*,users.* FROM polizas LEFT JOIN agencias ON polizas.idAgencia = agencias.idAgencia LEFT JOIN users ON polizas.idUser = users.id WHERE polizas.idPoliza = '$idPoliza' ");
 $row= mysqli_fetch_array($result);

 require_once 'Conex.php';
 if(isset($_POST['btn_save_updates']))
 {
     $nombreCliente = $_POST['nombreCliente'];// user name
     $marca = $_POST['marca'];
     $subMarca = $_POST['subMarca'];
     $vin = $_POST['vin'];
     $color = $_POST['color'];
     $kms = $_POST['kms'];
     $cc = $_POST['cc'];
     $fechaFacturaPrimordial = $_POST['fechaFacturaPrimordial'];
     $placa = $_POST['placa'];
     $cilindors = $_POST['cilindors'];
     $combustible = $_POST['combustible'];
     $kmsMantenimiento = $_POST['kmsMantenimiento'];
     $mesesMantenimiento = $_POST['mesesMantenimiento'];
     $yearFabricacion = $_POST['yearFabricacion'];
     $fechaNacimiento = $_POST['fechaNacimiento'];
     $rfc = $_POST['rfc'];
     $codigoPostal = $_POST['codigoPostal'];
     $localidad = $_POST['localidad'];
     $municipio = $_POST['municipio'];
     $estado = $_POST['estado'];
     $calle = $_POST['calle'];
     $colonia = $_POST['colonia'];
     $numExt = $_POST['numExt'];
     $emailCliente = $_POST['emailCliente'];
     $telefono = $_POST['telefono'];
     $folioContrato = $_POST['folioContrato'];
     $fechaInicio = $_POST['fechaInicio'];
     $fechaFin = $_POST['fechaFin'];
     $fechaVenta = $_POST['fechaVenta'];
     $fechaFinMarca = $_POST['fechaFinMarca'];
     $vendedor = $_POST['vendedor'];
     $curpCliente = $_POST['curpCliente'];
     $motor = $_POST['motor'];
     $hp = $_POST['hp'];
     $valorVenta = $_POST['valorVenta'];
     
     
     // if no error occured, continue ....
     if(!isset($errMSG))
     {
         $stmt = $DB_con->prepare('UPDATE polizas
									 SET nombreCliente=:nombreCliente,marca=:marca,vin=:vin,subMarca=:subMarca,
color=:color,
kms=:kms,
cc=:cc,
fechaFacturaPrimordial=:fechaFacturaPrimordial,
placa=:placa,
vin=:vin,
cilindors=:cilindors,
combustible=:combustible,
kmsMantenimiento=:kmsMantenimiento,
mesesMantenimiento=:mesesMantenimiento,
yearFabricacion=:yearFabricacion,
nombreCliente=:nombreCliente,
fechaNacimiento=:fechaNacimiento,
rfc=:rfc,
codigoPostal=:codigoPostal,
localidad=:localidad,
municipio=:municipio,
estado=:estado,
calle=:calle,
colonia=:colonia,
numExt=:numExt,
emailCliente=:emailCliente,
telefono=:telefono,
folioContrato=:folioContrato,
fechaInicio=:fechaInicio,
fechaFin=:fechaFin,
fechaVenta=:fechaVenta,
fechaFinMarca=:fechaFinMarca,
vendedor=:vendedor,
curpCliente=:curpCliente,
motor=:motor,
hp=:hp,
valorVenta=:valorVenta
                                        
								   WHERE idPoliza=:idPoliza');
         
         $stmt->bindParam(':nombreCliente',$nombreCliente);
         $stmt->bindParam(':marca',$marca);
         $stmt->bindParam(':vin',$vin);
         $stmt->bindParam(':subMarca',$subMarca);
         
         $stmt->bindParam(':color',$color);
         $stmt->bindParam(':kms',$kms);
         $stmt->bindParam(':cc',$cc);
         $stmt->bindParam(':fechaFacturaPrimordial',$fechaFacturaPrimordial);
         $stmt->bindParam(':placa',$placa);
         $stmt->bindParam(':cilindors',$cilindors);
         $stmt->bindParam(':combustible',$combustible);
         $stmt->bindParam(':kmsMantenimiento',$kmsMantenimiento);
         $stmt->bindParam(':mesesMantenimiento',$mesesMantenimiento);
         $stmt->bindParam(':yearFabricacion',$yearFabricacion);
         $stmt->bindParam(':fechaNacimiento',$fechaNacimiento);
         $stmt->bindParam(':rfc',$rfc);
         $stmt->bindParam(':codigoPostal',$codigoPostal);
         $stmt->bindParam(':localidad',$localidad);
         $stmt->bindParam(':municipio',$municipio);
         $stmt->bindParam(':estado',$estado);
         $stmt->bindParam(':calle',$calle);
         $stmt->bindParam(':colonia',$colonia);
         $stmt->bindParam(':numExt',$numExt);
         $stmt->bindParam(':emailCliente',$emailCliente);
         $stmt->bindParam(':telefono',$telefono);
         $stmt->bindParam(':folioContrato',$folioContrato);
         $stmt->bindParam(':fechaInicio',$fechaInicio);
         $stmt->bindParam(':fechaFin',$fechaFin);
         $stmt->bindParam(':fechaVenta',$fechaVenta);
         $stmt->bindParam(':fechaFinMarca',$fechaFinMarca);
         $stmt->bindParam(':vendedor',$vendedor);
         $stmt->bindParam(':curpCliente',$curpCliente);
         $stmt->bindParam(':motor',$motor);
         $stmt->bindParam(':hp',$hp);
         $stmt->bindParam(':valorVenta',$valorVenta);
         
         $stmt->bindParam(':idPoliza',$idPoliza);
         
         if($stmt->execute()){
             ?>
<script>
			alert('Polza actualizada correctamente ...');
			window.location.href='index.php';
			</script>
<?php
		}
		else{
			$errMSG = "Los datos no fueron actualizados !";
		}		
	}						
}
 
 
 
?>


<html>
<head><meta charset="windows-1252">

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
<!-- Favicon-->
<link rel="shortcut icon" href="img/favicon.ico">
</head>
<!-- SI EL USUARIO ESTA LOGUEADO -->
<?php if(!empty($user)): ?>

<body class="hold-transition sidebar-mini layout-fixed">´


	<div class="wrapper">



		<!-- Navbar -->
		<nav
			class="main-header navbar navbar-expand navbar-white navbar-light">
			<!-- Left navbar links -->
			<ul class="navbar-nav">
				<li class="nav-item"><a class="nav-link" data-widget="pushmenu"
					href="#" role="button"><i class="fas fa-bars"></i></a></li>
				<li class="nav-item d-none d-sm-inline-block"><a href="index.php"
					class="nav-link">Inicio</a></li>
				<li class="nav-item d-none d-sm-inline-block"><a href="index3.php"
					class="nav-link">Nueva poliza</a></li>
			</ul>
		</nav>
		<!-- /.navbar -->

		<!-- Main Sidebar Container -->
		<aside class="main-sidebar sidebar-dark-primary elevation-4">
			<!-- Brand Logo -->
			<a href="index.php" class="brand-link"> <img src="dist/img/logo.png"
				alt="autoWarranty" class="brand-image img-circle elevation-3"
				style="opacity: .8"> <span class="brand-text font-weight-light">Polizas</span>
			</a>

			<!-- Sidebar -->
			<div class="sidebar">
				<!-- Sidebar user panel (optional) -->
				<div class="user-panel mt-3 pb-3 mb-3 d-flex">
					<div class="image">
						<!--           <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> -->
					</div>
					<div class="info">
						<a href="#" class="d-block">BIENVENIDO <?= $user['estatus'];?></a>
					</div>
				</div>
				<!-- Sidebar Menu -->
				<nav class="mt-2">
					<ul class="nav nav-pills nav-sidebar flex-column"
						data-widget="treeview" role="menu" data-accordion="false">

						<li class="nav-item"><a href="#" class="nav-link"> <i
								class="nav-icon fas fa-edit"></i>
								<p>
									POLIZAS <i class="fas fa-angle-left right"></i>
								</p>
						</a>
							<ul class="nav nav-treeview">
								<li class="nav-item"><a href="index3.php" class="nav-link"> <i
										class="far fa-circle nav-icon"></i>
										<p>Nueva Poliza</p>
								</a></li>
							</ul></li>
					</ul>
					<li class="nav-header">Sesión</li>
					<li class="nav-item"><a href="logout.php" class="nav-link"> <i
							class="nav-icon far fa-circle text-danger"></i>
							<p class="text">Cerrar sesion</p>
					</a></li>
				</nav>
				<!-- /.sidebar-menu -->
			</div>
			<!-- /.sidebar -->
		</aside>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<div class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1 class="m-0">INICIO</h1>
						</div>
						<!-- /.col -->
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item active">Inicio</li>
								<!-- 								<li class="breadcrumb-item"><a href="index.php">Inicio</a></li> -->
							</ol>
						</div>
						<!-- /.col -->
					</div>
					<!-- /.row -->
				</div>
				<!-- /.container-fluid -->
			</div>
			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h3 class="card-title">Editar polizas</h3>
								</div>
								<!-- /.card-header -->
								<div class="card-body">
								<div id="wrapper">
								<form method="post" enctype="multipart/form-data" class="form-horizontal">
                                    <?php
                                	if(isset($errMSG)){
                                		?>
                                    <div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; <?php echo $errMSG; ?> </div>
                                    <?php
                                	}
	                                  ?>
									<div class="form">
										<h1>CLIENTE</h1>
										<p>
											<label for="user">Nombre</label> <input type="text" class="form-control pl-0" name="nombreCliente"  value="<?php echo $row['nombreCliente']; ?>"onkeyup="javascript:this.value=this.value.toUpperCase();" >
										</p>
										<p>
											<label for="user">Fecha de nacimiento</label> <input type="date" class="form-control pl-0" name="fechaNacimiento"  value="<?php echo $row['fechaNacimiento']; ?>"onkeyup="javascript:this.value=this.value.toUpperCase();" >
										</p>
										<div class="row">
											<div class="col-sm-6">
												<p>
													<label for="user">RFC</label> <input type="text" class="form-control pl-0" name="rfc"  value="<?php echo $row['rfc']; ?>"onkeyup="javascript:this.value=this.value.toUpperCase();" >
												</p>
											</div>
											<div class="col-sm-6">
												<p>
													<label for="user">CURP</label> <input type="text" class="form-control pl-0" name="curpCliente"  value="<?php echo $row['curpCliente']; ?>"onkeyup="javascript:this.value=this.value.toUpperCase();" >
												</p>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-6">
												<p>
													<label for="user">Codigo postal</label> <input type="text" class="form-control pl-0" name="codigoPostal"  value="<?php echo $row['codigoPostal']; ?>"onkeyup="javascript:this.value=this.value.toUpperCase();" >
												</p>
											</div>
											<div class="col-sm-6">
												<p>
													<label for="user">Calle</label> <input type="text" class="form-control pl-0" name="calle"  value="<?php echo $row['calle']; ?>"onkeyup="javascript:this.value=this.value.toUpperCase();" >
												</p>
											</div>
										</div>
										
										
										<div class="row">
											<div class="col-sm-6">
												<p>
													<label for="user">Colonia</label> <input type="text" class="form-control pl-0" name="colonia"  value="<?php echo $row['colonia']; ?>"onkeyup="javascript:this.value=this.value.toUpperCase();" >
												</p>
											</div>
											<div class="col-sm-6">
												<p>
													<label for="user">Localidad</label> <input type="text" class="form-control pl-0" name="localidad"  value="<?php echo $row['localidad']; ?>"onkeyup="javascript:this.value=this.value.toUpperCase();" >
												</p>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-6">
												<p>
													<label for="user">Municipio</label> <input type="text" class="form-control pl-0" name="municipio"  value="<?php echo $row['municipio']; ?>"onkeyup="javascript:this.value=this.value.toUpperCase();" >
												</p>
											</div>
											<div class="col-sm-6">
												<p>
													<label for="user">Estado</label> <input type="text" class="form-control pl-0" name="estado"  value="<?php echo $row['estado']; ?>"onkeyup="javascript:this.value=this.value.toUpperCase();" >
												</p>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-4">
												<p>
													<label for="user">Numero exterior/interior</label><input type="text" class="form-control pl-0" name="numExt"  value="<?php echo $row['numExt']; ?>"onkeyup="javascript:this.value=this.value.toUpperCase();" >
												</p>
											</div>
											<div class="col-sm-4">
												<p>
													<label for="user">Email</label> <input type="text" class="form-control pl-0" name="emailCliente"  value="<?php echo $row['emailCliente']; ?>"onkeyup="javascript:this.value=this.value.toUpperCase();" >
												</p>
											</div>
											<div class="col-sm-4">
												<p>
													<label for="user">Telefono</label> <input type="text" class="form-control pl-0" name="telefono"  value="<?php echo $row['telefono']; ?>"onkeyup="javascript:this.value=this.value.toUpperCase();" >
												</p>
											</div>
										</div>

									</div>
									<div class="tab">
										<h1>VEHICULO</h1>
										<div class="row">
											<div class="col-sm-4">
												<p>
													<label for="user">Marca</label> <input type="text" class="form-control pl-0" name="marca"  value="<?php echo $row['marca']; ?>"onkeyup="javascript:this.value=this.value.toUpperCase();" >
												</p>
											</div>
											<div class="col-sm-4">
												<p>
													<label for="user">SubMarca</label> <input type="text" class="form-control pl-0" name="subMarca"  value="<?php echo $row['subMarca']; ?>"onkeyup="javascript:this.value=this.value.toUpperCase();" >
												</p>
											</div>
											<div class="col-sm-4">
												<p>
													<label for="user">Color</label><input type="text" class="form-control pl-0" name="color"  value="<?php echo $row['color']; ?>"onkeyup="javascript:this.value=this.value.toUpperCase();" >
												</p>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-3">
												<p>
													<label for="user">Kilometraje</label><input type="text" class="form-control pl-0" name="kms"  value="<?php echo $row['kms']; ?>"onkeyup="javascript:this.value=this.value.toUpperCase();" >
												</p>
											</div>
											<div class="col-sm-2">
												<p>
													<label for="user">HP</label> <input type="text" class="form-control pl-0" name="hp"  value="<?php echo $row['hp']; ?>"onkeyup="javascript:this.value=this.value.toUpperCase();" >
												</p>
											</div>
											<div class="col-sm-2">
												<p>
													<label for="user">C.C.</label> <input type="text" class="form-control pl-0" name="cc"  value="<?php echo $row['cc']; ?>"onkeyup="javascript:this.value=this.value.toUpperCase();" >
												</p>
											</div>
											<div class="col-sm-3">
												<p>
													<label for="user">Placa</label> <input type="text" class="form-control pl-0" name="placa"  value="<?php echo $row['placa']; ?>"onkeyup="javascript:this.value=this.value.toUpperCase();" >
												</p>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-3">
												<p>
													<label for="user">Fecha de factura original</label> <<input type="text" class="form-control pl-0" name="fechaFacturaPrimordial"  value="<?php echo $row['fechaFacturaPrimordial']; ?>"onkeyup="javascript:this.value=this.value.toUpperCase();" >
												</p>
											</div>
											<div class="col-sm-3">
												<p>
													<label for="user">Cilindros</label> <input type="text" class="form-control pl-0" name="cilindors"  value="<?php echo $row['cilindors']; ?>"onkeyup="javascript:this.value=this.value.toUpperCase();" >
												</p>
											</div>
											<div class="col-sm-3">
												<p>
													<label for="user">Año de fabricacion</label> <input type="text" class="form-control pl-0" name="yearFabricacion"  value="<?php echo $row['yearFabricacion']; ?>"onkeyup="javascript:this.value=this.value.toUpperCase();" >
												</p>

											</div>
											<div class="col-sm-3">
												<p>
											<label for="user">Motor</label> 
												<input type="text" class="form-control pl-0" name="motor"  value="<?php echo $row['motor']; ?>"onkeyup="javascript:this.value=this.value.toUpperCase();" >
												
											</p></div>
										</div>

										<p>
											<label for="user">VIN</label> <input type="text" class="form-control pl-0" name="vin"  value="<?php echo $row['vin']; ?>"onkeyup="javascript:this.value=this.value.toUpperCase();" >
										</p>

										<div class="row">
											<div class="col-sm-4">
												<p>
													<label for="user">Kilometros mantenimiento</label> <input type="text" class="form-control pl-0" name="kmsMantenimiento"  value="<?php echo $row['kmsMantenimiento']; ?>"onkeyup="javascript:this.value=this.value.toUpperCase();" >
												</p>
											</div>
											<div class="col-sm-4">
												<p>
													<label for="user">Meses mantenimiento</label> <input type="text" class="form-control pl-0" name="mesesMantenimiento"  value="<?php echo $row['mesesMantenimiento']; ?>"onkeyup="javascript:this.value=this.value.toUpperCase();" >
												</p>
											</div>
											<div class="col-sm-4">
												<p>
													<label for="user">Valor de venta</label> <input type="text" class="form-control pl-0" name="valorVenta"  value="<?php echo $row['valorVenta']; ?>"onkeyup="javascript:this.value=this.value.toUpperCase();" >
												</p>
											</div>
										</div>
										<p>
											<label for="user">Combustible</label> <select
												class="custom-select" id="combustible" name="combustible">
												<option selected="selected" value="GASOLINA">Gasolina</option>
												<option value="DIESEL">Diesel</option>
												<option value="ELECTRICO">Electrico</option>
												<option value="HIBRIDO">Hibrido</option>
											</select>
										</p>
									</div>
									<div class="tab">
										<h1>POLIZA</h1>
										<div class="row">
											<div class="col-sm-4">
												<p>
													<label for="user">Contrato</label><select
												class="custom-select" id="folioContrato" name="folioContrato">
												<option value="Cobertura 18 meses"selected="selected">18 MESES</option>
												
											</select>
												</p>
											</div>
											<div class="col-sm-4">
												<p>
													<label for="user">Fecha de inicio de cobertura</label> <input type="date" class="form-control pl-0" name="fechaInicio"  value="<?php echo $row['fechaInicio']; ?>"onkeyup="javascript:this.value=this.value.toUpperCase();" >
												</p>
											</div>
											<div class="col-sm-4">
												<p>
													<label for="user">Fecha de fin de cobertura</label> <input type="text" class="form-control pl-0" name="fechaFin"  value="<?php echo $row['fechaFin']; ?>"onkeyup="javascript:this.value=this.value.toUpperCase();" >
												</p>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-4">
												<p>
													<label for="user">Fecha de venta</label> <input type="text" class="form-control pl-0" name="fechaVenta"  value="<?php echo $row['fechaVenta']; ?>"onkeyup="javascript:this.value=this.value.toUpperCase();" >
												</p>
											</div>
											<div class="col-sm-4">
												<p>
													<label for="user">Fecha de fin garantia de marca</label> <input type="date" class="form-control pl-0" name="fechaFinMarca"  value="<?php echo $row['fechaFinMarca']; ?>"onkeyup="javascript:this.value=this.value.toUpperCase();" >
												</p>
											</div>
											<div class="col-sm-4">
												<p>
													<label for="user">Vendedor</label> <input type="text" class="form-control pl-0" name="vendedor"  value="<?php echo $row['vendedor']; ?>"onkeyup="javascript:this.value=this.value.toUpperCase();" >
												</p>
											</div>
										</div>
										
										<h1>Agencia</h1>
										<hr>
										<div class="row">
											<div class="col-sm-4">
												<p>
													<label for="user">ID USER</label> <input type="text" class="form-control pl-0" name="idUser" disabled value="<?php echo $row['idUser']; ?>"onkeyup="javascript:this.value=this.value.toUpperCase();" >
												</p>
											</div>
											<div class="col-sm-4">
												<p>
													<label for="user">ID AGENCIA</label> <input type="text" class="form-control pl-0" name="idAgencia" disabled value="<?php echo $row['idAgencia']; ?>"onkeyup="javascript:this.value=this.value.toUpperCase();" >
												</p>
											</div>
											<div class="col-sm-4">
												<p>
													<label for="user">Estatus Poliza</label> <input type="text" class="form-control pl-0" name="estatusPoliza" disabled value="<?php echo $row['estatusPoliza']; ?>"onkeyup="javascript:this.value=this.value.toUpperCase();" >
												</p>
											</div>
											<input type="hidden" name="idPoliza" class="txtField" value="<?php echo $row['idPoliza']; ?>">
										</div>
										<hr>										
									</div>
									<button type="submit" name="btn_save_updates" class="btn btn-default"> <span class="glyphicon glyphicon-save"></span> Actualizar </button>
          <a class="btn btn-default" href="index.php"> <span class="glyphicon glyphicon-backward"></span> cancelar </a>
									
								</form>
	</div>
								
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		
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
       
</div>

		<footer class="main-footer">
			<strong>Derechos reservados &copy; 2021 <a href="#">LOBDRA</a>.
			</strong>

			<div class="float-right d-none d-sm-inline-block">
				<b>Version</b> BETA
			</div>
		</footer>

		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
			<!-- Control sidebar content goes here -->
		</aside>
		<!-- /.control-sidebar -->
	</div>
	<!-- ./wrapper -->

	<!-- jQuery -->
	<script src="plugins/jquery/jquery.min.js"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
	<!-- Bootstrap 4 -->
	<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- ChartJS -->
	<script src="plugins/chart.js/Chart.min.js"></script>
	<!-- Sparkline -->
	<script src="plugins/sparklines/sparkline.js"></script>
	<!-- JQVMap -->
	<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
	<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
	<!-- jQuery Knob Chart -->
	<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
	<!-- daterangepicker -->
	<script src="plugins/moment/moment.min.js"></script>
	<script src="plugins/daterangepicker/daterangepicker.js"></script>
	<!-- Tempusdominus Bootstrap 4 -->
	<script
		src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
	<!-- Summernote -->
	<script src="plugins/summernote/summernote-bs4.min.js"></script>
	<!-- overlayScrollbars -->
	<script
		src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
	<!-- AdminLTE App -->
	<script src="dist/js/adminlte.js"></script>
	<!-- AdminLTE for demo purposes -->
	<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
	<script src="dist/js/pages/dashboard.js"></script>
</body>
</html>