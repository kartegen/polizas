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
define("NRO_REGISTROS", 15);

?>



<!DOCTYPE html>

<html>

<head>

<meta http-equiv=�Content-Type� content=�text/html; charset=utf-8? />
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>autoWarranty</title>
<script src="./js/xlsx.full.min.js"></script>
<script src="./js/FileSaver.min.js"></script>
<script src="./js/tableexport.min.js"></script>


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

								<li class="nav-item"><a href="index.php" class="nav-link"> <i
										class="far fa-circle nav-icon"></i>

										<p>Inicio</p>

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



					<!-- /.col -->

					<div class="col-sm-12">

						<ol class="breadcrumb float-sm-right">

							<li class="breadcrumb-item active">NUEVA POLIZA</li>

							<li class="breadcrumb-item"><a href="index.php">INICIO</a></li>

						</ol>

					</div>

				</div>

				<!-- /.container-fluid -->

			</div>


			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">.</h4>									
                    <?php

    function verfecha($vfecha)
    {
        $fch = explode("-", $vfecha);
        $tfecha = $fch[2] . "-" . $fch[1] . "-" . $fch[0];
        return $tfecha;
    }
    $serie = '';
    $mes = '';
    $search_keyword = '';
    
    
    if (! empty($_POST['search']['keyword'] )) {
        
        $mes =$_POST['search']['mes'];
        $search_keyword = $_POST['search']['keyword'];
        
    } elseif (! empty($_POST['search']['mes'])){
        $mes =$_POST['search']['mes'];
        
    }elseif (! empty($_POST['search']['serie'])) {
        
        $serie = $_POST['search']['serie'];
        
    }
    // $sql = 'SELECT * FROM empleados WHERE vin LIKE :keyword OR marca LIKE :keyword OR version LIKE :keyword ORDER BY idVehiculo DESC ';

    $sqlNuevas = 'SELECT
	*, 
	polizasemext.idPoliza, 
	agencias.nombreAgencia, 
	empresas.nombreEmpresa
FROM
	empresas
	LEFT JOIN
	agencias
	ON 
		empresas.idEmpresa = agencias.idEmpresa
	LEFT JOIN
	polizasemext
	ON 
		agencias.idAgencia = polizasemext.idAgencia
WHERE
    polizasemext.idPoliza LIKE :serie AND
	empresas.nombreEmpresa LIKE :keyword AND
	DATE_FORMAT(fechaVenta,"%m") like :mes ORDER BY
	polizasemext.idPoliza DESC';

    /* Pagination Code starts */
    $per_page_html = '';
    $page = 1;
    $start = 0;
    if (! empty($_POST["page"])) {
        $page = $_POST["page"];
        $start = ($page - 1) * NRO_REGISTROS;
    }
    $limit = " limit " . $start . "," . NRO_REGISTROS;
    $pagination_statement = $conn->prepare($sqlNuevas);
    $pagination_statement->bindValue(':serie', '%' . $serie . '%', PDO::PARAM_STR);
    $pagination_statement->bindValue(':mes', '%' . $mes . '%', PDO::PARAM_STR);
    $pagination_statement->bindValue(':keyword', '%' . $search_keyword . '%', PDO::PARAM_STR);
    
    
    $pagination_statement->execute();

    $row_count = $pagination_statement->rowCount();
    if (! empty($row_count)) {
        $per_page_html .= "<div class='dataTables_paginate paging_simple_numbers'>";
        $page_count = ceil($row_count / NRO_REGISTROS);
        if ($page_count > 1) {
            for ($i = 1; $i <= $page_count; $i ++) {
                if ($i == $page) {
                    $per_page_html .= '<input type="submit" name="page" value="' . $i . '" class="btn-page current" />';
                } else {
                    $per_page_html .= '<input type="submit" name="page" value="' . $i . '" class="btn-page" />';
                }
            }
        }
        $per_page_html .= "</div>";
    }

    $query = $sqlNuevas . $limit;
    $pdo_statement = $conn->prepare($query);
    $pdo_statement->bindValue(':serie', '%' . $serie . '%', PDO::PARAM_STR);
    $pdo_statement->bindValue(':mes', '%' . $mes . '%', PDO::PARAM_STR);
    $pdo_statement->bindValue(':keyword', '%' . $search_keyword . '%', PDO::PARAM_STR);
   
    
    $pdo_statement->execute();
    $resultados = $pdo_statement->fetchAll();
    ?>
                    
                    <form name='frmSearch' action='' method='post'>
										<div style='text-align: right; margin: 20px 0px;'>


											<div class="row">
											<div class="col-lg-2">
													<div class="input-group">
														<input type="text" class="form-control" placeholder="No. Poliza"
															name='search[serie]' value="<?php echo $serie; ?>" id='serie'
															maxlength='25'>
														                           
													</div>
												</div>
												<div class="col-lg-5">
													<div class="input-group">
														<input type="text" class="form-control" placeholder="MES"
															name='search[mes]' value="<?php echo $mes; ?>" id='mes'
															maxlength='25'>
														<!--                               <span class="input-group-btn"> -->
														<!--                                 <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button> -->
														<!--                               </span> -->
													</div>
												</div>
												<div class="col-lg-5">
													<div class="input-group">
														<input type="text" class="form-control"
															placeholder="EMPRESA" name='search[keyword]'
															value="<?php echo $search_keyword; ?>" id='keyword'
															maxlength='25'>
														<!--                               <span class="input-group-btn"> -->
														<!--                                 <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button> -->
														<!--                               </span> -->
													</div>
												</div>
												<!-- /.col-lg-6 -->
											</div>
											<!-- /.row -->
										</div>

										<button type="button" id="btnExportar"
											class="btn btn-block btn-success">Exportar a excel</button>
										<div class="table-responsive">
											<table id="tabla" class="table table-bordered table-hover">
												<thead>
													<tr>
														<th>Poliza</th>
														<th>Empresa</th>
														<th>Agencia</th>
														<th>Beneficiario</th>
														<th>Vin</th>
														<th>Submarca</th>
														<th>Agente</th>
														<th>Fecha Venta</th>
														<th>Inicio</th>
														<th>Fin</th>
														<th>Estatus</th>
														<th>Aciones</th>

													</tr>
												</thead>
												<tbody id='table-body'>
                        	<?php
    if (! empty($resultados)) {
        foreach ($resultados as $row) {
            ?>
                        	  <tr class='table-row'>
														<td><?php echo $row['idPoliza']; ?></td>
														<td><?php echo $row['nombreEmpresa']; ?></td>
														<td><?php echo $row['nombreAgencia']; ?></td>
														<td><?php echo $row['nombreCliente']; ?></td>
														<td><?php echo $row['vin']; ?></td>
														<td><?php echo $row['subMarca']; ?></td>
														<td><?php echo $row['vendedor']; ?></td>
														<td><?php echo $row['fechaVenta']; ?></td>
														<td><?php echo $row['fechaInicio']; ?></td>
														<td><?php echo $row['fechaFin']; ?></td>
														<td><?php echo $row['estatusPoliza']; ?></td>
														<!-- 														Crear tres nuevas paginas para nuevos con un if aqui redireccionando -->


														<td style='width: 300px'><a
															href='v1poliza.php?id=<?php echo $row['idPoliza']; ?>'
															target='_blank'><button type="button"
																	class="btn btn-warning">
																	<i class="fas fa-print"></i>Imprimir
																</button></a> <a
															href='update.php?id=<?php echo $row['idPoliza']; ?>'
															target='_blank'><button type="button"
																	class="btn btn-primary float-center">
																	<i class="fas fa-edit"></i> Editar
																</button></a> <a
															href='cancelaPoliza.php?id=<?php echo $row['idPoliza']; ?>'
															target='_blank'><button type="button"
																	class="btn btn-danger float-right">
																	<i class="fas fa-exclamation-triangle"></i> Cancelar
																</button></a></td>

													</tr>





													<!-- 													AQUI DEBE TERMINAR EL IF -->
                            <?php
        }
    }
    ?>
                          </tbody>
											</table>											
                      <?php echo $per_page_html; ?>
                    </div>

										<script src="./js/script.js"></script>
									</form>
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
