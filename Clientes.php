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
			<section class="col-md-12 card mx-auto ">
				<br>
				<div class="row">
					<div class="col-md-12">
						<center>
							<h2>Personas Registradas</h2>
						</center>
						<br>
					<!-- Button que activa el modal -->
						<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_registar_cliente">
						  Registrar Persona
						</button><br><br>
						<div class="col-md-12 border border-ligth">
							<center>
								<h2>Editar Persona</h2>
							</center>
							<?php if(!empty($_GET['edit'])) : ?>
								<?php $persona = ($_GET['edit']); ?>

								<?php $consulta = $conexion->query("SELECT * FROM personas WHERE ID_PERSONA= '$persona'"); ?>

								<form action="controller/editarPersona.php" method="POST">
							
								<?php while($resultado = $consulta->fetch_array()): ?>
									<div class="container">
										<div class="row">
											<div class="form-group col">
												<label for="documento">Documento</label>
												<input type="text" class="form-control" id="documento" name="documento" required readonly value="<?php echo ($resultado['DOC_PERSONA']); ?>">
												<input type="text" hidden="true" class="form-control" id="id_persona" name="id_persona" required value="<?php echo ($resultado['ID_PERSONA']); ?>">
											</div>

											<div class="form-group col">
												<label for="nombre_persona">Nombres</label>
												<input type="text" class="form-control" id="nombre_persona" name="nombre_persona" required value="<?php echo ($resultado['NOMBRES']); ?>">
											</div>

											<div class="form-group col">
												<label for="apellidos">Apellidos</label>
												<input type="text" class="form-control" id="apellidos" name="apellidos" value="<?php echo ($resultado['APELLIDOS']); ?>">
											</div>
										</div>
										<div class="row">
											<div class="form-group col">
												<label for="tipo">Tipo</label>
												<select class="form-control" name="tipo" required>
													<option value="<?php echo $resultado['TIPO']; ?>"> <?php echo ($resultado['TIPO']); ?> </option>
													<option value="PROVEEDOR">PROVEEDOR</option>
													<option value="EMPLEADO">EMPLEADO</option>
													<option value="ADMINISTRADOR">ADMINISTRADOR</option>
													<option value="CLIENTE">CLIENTE</option>
												</select>
											</div>
											<div class="form-group col">
												<label for="celular">Celular</label>
												<input type="text" class="form-control" id="celular" name="celular" required value="<?php echo ($resultado['CELULAR']); ?>">
											</div>
											<div class="form-group col">
												<label for="direccion">Dirección</label>
												<input type="text" class="form-control" id="direccion" name="direccion" required value="<?php echo ($resultado['DIRECCION']); ?>">
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="submit" class="btn btn-success">Guardar Cambios</button>
									</div>
								<?php endwhile; ?>
								</form>
							<?php endif; ?>
						</div>
						<br><br>
						<center>
							<table id="tabla_paginada" class="table table-bordered mx-auto"  >
								<thead>
									<tr>
										<th scope="col">Documento</th>
										<th scope="col">Nombres</th>
										<th scope="col">Apellidos</th>
										<th scope="col">Celular</th>
										<th scope="col">Direccion</th>
										<th scope="col">Tipo</th>
										<th scope="col">Opciones</th>
									</tr>
								</thead>
								<tbody>
									<?php $consulta = $conexion->query("SELECT * FROM personas"); ?>

									<?php while($resultado = $consulta->fetch_array()): ?>
										<tr>
											<td><?php echo ($resultado['DOC_PERSONA']); ?></td>
											<td><?php echo ($resultado['NOMBRES']); ?></td>
											<td><?php echo ($resultado['APELLIDOS']); ?></td>
											<td><?php echo ($resultado['CELULAR']); ?></td>
											<td><?php echo ($resultado['DIRECCION']); ?></td>
											<td style="white-space: nowrap;"><?php echo ($resultado['TIPO']); ?></td>
											<td><a type="button" class="btn btn-primary" href="Clientes.php?edit=<?php echo $resultado['ID_PERSONA']; ?>"> <i class='fas fa-edit'></i></a></td>
										</tr>
									<?php endwhile; ?>
								</tbody>
							</table>
						</center>
					</div>
				</div>
				<br>
			</section>	
		<!-- /#page-content-wrapper -->
	</div>
	<!-- Modal Registar producto -->
	<div class="modal fade" id="modal_registar_cliente" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="staticBackdropLabel">Registrar Cliente</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="controller/crearPersona.php" method="POST">
						<div class="form-group">
						  <label for="documento">Documento de identidad</label>
						  <input type="number" class="form-control" id="documento" name="documento" required>
						</div>
						<div class="form-group">
						  <label for="nombres">Nombres</label>
						  <input type="text" class="form-control" id="nombres" name="nombres" required>
						</div>
						<div class="form-group">
						  <label for="apellidos">Apellidos</label>
						  <input type="text" class="form-control" id="apellidos" name="apellidos" >
						</div>
						<div class="form-group">
						  <label for="telefono">Telefono</label>
						  <input type="number" class="form-control" id="telefono" name="telefono" required>
						</div>
						<div class="form-group">
						  <label for="direccion">Direccion</label>
						  <input type="text" class="form-control" id="direccion" name="direccion" required>
						</div>
						<div class="form-group">
							<label for="tipo">Tipo</label>
						  <select class="form-control" name="tipo" required>
						  	<option value="CLIENTE">CLIENTE</option>
						  	<option value="EMPLEADO">EMPLEADO</option>
						  	<option value="ADMINISTRADOR">ADMINISTRADOR</option>
							<option value="PROVEEDOR">PROVEEDOR</option>
						  </select>
						</div>
	    
						<div class="modal-footer">
						  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
						  <button type="submit" class="btn btn-success">Registrar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="datatables/datatables.min.js"></script>
	<script type="text/javascript" src="js/mijs.js"></script>
</body>
</html>