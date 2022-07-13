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

    $idAgencia = $user['idAgencia'];    $tipoAgencia = $user['idTipoAgencia'];    $idUser= $user['id'];
}
?>

<html>
<head>
<meta http-equiv=�Content-Type� content=�text/html; charset=utf-8? /><meta name="viewport" content="width=device-width, initial-scale=1">
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
<!-- <SWAL --><!-- jQuery --><script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script><!-- Custom functions file --><script src="js/functions.js"></script><!-- Sweet Alert Script --><script src="js/sweetalert.min.js"></script><!-- Sweet Alert Styles --><link href="css/sweetalert.css" rel="stylesheet">
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

<body class="hold-transition sidebar-mini layout-fixed">
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
									<h3 class="card-title">Polizas existentes <?= $tipoAgencia;?></h3>
								</div>
								<!-- /.card-header -->
								<div class="card-body">
									<table class="table table-bordered table-hover">
										<thead>
											<tr>
												<th style="width: 10px">Poliza</th>
												<th style="width: 5px">Agencia</th>
												<th>Cliente</th>
												<th>VIN</th>
												<th>Contrato</th>
												<th>Agente</th>
												<th>Inicio</th>
												<th>Fin</th>
												<th>Estatus</th>
												<th style="width: 10px">Acción</th>
											</tr>
										</thead>
										<tbody>
                                            <?php

    if ($idAgencia == 0) {                        echo '<script>           function alerta(){                window.location.href = "/polizas/admin.php";           }           alerta();           </script>';
//         $data = mysqli_connect("localhost", "autowarr_userPol", "Morganas4@", "autowarr_polizas") or die('Error de conexion: ' . mysqli_error());
//         $busc = mysqli_query($data, "SELECT polizas.*, users.estatus, users.id, users.tipo, agencias.nombreAgencia,	agencias.prefijoAgencia FROM polizas LEFT JOIN users ON polizas.idUser = users.id LEFT JOIN agencias ON polizas.idAgencia = agencias.idAgencia ORDER BY polizas.idPoliza DESC");

//         while ($row = mysqli_fetch_array($busc)) {
//             if ($row[33] == "activo") {
                
//                 echo "<tr class='success'> <td>" . $row[43] . '' . $row[0] . "</td><td style='width: 5px'>" . $row[42] . "</td><td>" . $row[14] . "</td> <td>" . $row[8] . "</td> <td>" . $row[26] . "</td>  <td>" . $row[31] . "</td>  <td>" . $row[27] . "</td>  <td>" . $row[28] . "</td> <td>" . $row[33] . "</td> <td><a  href='update.php?id=" . $row["0"] . "' target='_self'><span class='right badge badge-danger'>Editar PÃ³liza</span></a><hr><a  href='cancelaPoliza.php?id=" . $row["0"] . "' target='_blank'><span class='right badge badge-danger'>Cancelar</span></a><hr><a  href='v1poliza.php?id=" . $row["0"] . "' target='_blank'><span class='right badge badge-danger'>Imprimir pÃ³liza</span></a></td>";
//             } else {

//                 echo "<tr class='success'> <td>" . $row[43] . '' . $row[0] . "</td><td style='width: 5px'>" . $row[42] . "</td><td>" . $row[14] . "</td> <td>" . $row[8] . "</td> <td>" . $row[26] . "</td>  <td>" . $row[31] . "</td>  <td>" . $row[27] . "</td>  <td>" . $row[28] . "</td> <td>" . $row[33] . "</td>  <td><a  href='v1poliza.php?id=" . $row["0"] . "' target='_blank'><span class='right badge badge-danger'>Imprimir pÃ³liza</span></a></td>";
//             }
//         }
//         ;
    } else {        if ($user['idTipoAgencia'] == 2) {            
        $data = mysqli_connect("localhost", "root", "", "autowarr_polizas") or die('Error de conexion: ' . mysqli_error());
        $busc = mysqli_query($data, 'SELECT	polizas.*, users.estatus,users.id,users.tipo,agencias.nombreAgencia, agencias.prefijoAgencia FROM polizas LEFT JOIN	users ON polizas.idUser = users.id	LEFT JOIN agencias	ON polizas.idAgencia = agencias.idAgencia WHERE	polizas.idUser = ' . $idUser . ' ORDER BY polizas.idPoliza DESC LIMIT 100');

        while ($row = mysqli_fetch_array($busc)) {
            echo "<tr class='success'> <td>" . $row[43] . '' . $row[0] . "</td><td style='width: 5px'>" . $row[42] . "</td><td>" . $row[14] . "</td> <td>" . $row[8] . "</td> <td>" . $row[26] . "</td>  <td>" . $row[31] . "</td>  <td>" . $row[27] . "</td>  <td>" . $row[28] . "</td> <td>" . $row[33] . "</td> <td><a  href='v1poliza.php?id=" . $row["0"] . "' target='_blank'><span class='right badge badge-danger'>Imprimir póliza</span></a></td>";
        }        ;        }else if($user['idTipoAgencia'] == 3){                        $dataNew = mysqli_connect("localhost", "root", "", "autowarr_polizas") or die('Error de conexion: ' . mysqli_error());                        $buscNew = mysqli_query($dataNew, 'SELECT	polizasemext.*, users.estatus, users.id,users.tipo,agencias.nombreAgencia, agencias.prefijoAgencia FROM polizasemext LEFT JOIN	users ON polizasemext.idUser = users.id	LEFT JOIN agencias	ON polizasemext.idAgencia = agencias.idAgencia WHERE	polizasemext.idUser = ' . $idUser .  ' ORDER BY polizasemext.idPoliza DESC LIMIT 100');                                                while ($rowNew = mysqli_fetch_array($buscNew)) {                                echo "<tr class='success'> <td>" . $rowNew[44] . '' . $rowNew[0] . "</td><td style='width: 5px'>" . $rowNew[43] . "</td><td>" . $rowNew[14] . "</td> <td>" . $rowNew[8] . "</td> <td>" . $rowNew[26] . "</td>  <td>" . $rowNew[31] . "</td>  <td>" . $rowNew[27] . "</td>  <td>" . $rowNew[28] . "</td> <td>" . $rowNew[33] . "</td> <td><a  href='v1poliza.php?id=" . $rowNew["0"] . "' target='_blank'><span class='right badge badge-danger'>Imprimir póliza</span></a></td>";                            }        }        ;                                
    }

    // ?>
										</tbody>
									</table>
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
    echo 
       '<script language="javascript">alert("Necesitas estar logueado, si no tienes usuario, contacta al administrador");window.location.href="/polizas/login.php"</script>';
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