<?php 
	session_start();
	include_once "conexion/conexion.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Ario</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/estilos_admin.css">

	<!-- Estilos del data tables-->
	<link rel="stylesheet" type="text/css" href="datatables/datatables.min.css">
	<link rel="stylesheet" type="text/css" href="datatables/DataTables-1.10.21/css/dataTables.bootstrap.css">


	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script type="text/javascript" src="js/jquery-3.4.1.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
</head>
<body>
	<div class="d-flex" id="wrapper">
	<div class="bg-light border-right" id="sidebar-wrapper">
			<div class="sidebar-heading">MENU </div>
			<div class="sidebar-heading">  </div>
			<div class="list-group list-group-flush">
				<a href="principal.php" class="list-group-item list-group-item-action bg-light">Inicio</a>
				<a href="Inventario.php" class="list-group-item list-group-item-action bg-light">Inventario</a>
				<a href="Clientes.php" class="list-group-item list-group-item-action bg-light">Personas</a>
				<a href="Ventas.php" class="list-group-item list-group-item-action bg-light">Ventas</a>
				<a href="Facturacion.php" class="list-group-item list-group-item-action bg-light">Facturacion</a>
			</div>
		</div>
	  <!-- /#sidebar-wrapper -->

	  <!-- Page Content -->
		<div id="page-content-wrapper">
			<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
				<button class="btn btn-outline-secondary" id="menu-toggle"><i class="fa fa-bars"></i> Menu</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav ml-auto mt-2 mt-lg-0">
						<div class="dropdown dropleft">
							<a class="btn btn-outline-success   " id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['user_name']; ?></a>
							<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
								<center>
									<a  class="btn btn-outline-danger  " href="cerrar_sesion.php">Cerrar Sesion <i class="fas fa-power-off"></i></a>
								</center>
							</div>
						</div>
					</ul>
				</div>
			</nav>
			<br><br>
		<!-- /#page-content-wrapper -->

		<div class="col-auto p-5 text-center;">
			<img style="width:400px; opacity: 0.6;" class="mx-auto d-block" src="img/logo.png" alt="">
		</div>
	</div>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="datatables/datatables.min.js"></script>
	<script type="text/javascript" src="js/mijs.js"></script>
</body>
</html>