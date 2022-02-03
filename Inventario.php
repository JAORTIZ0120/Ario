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
			<section class="col-md-12 card mx-auto ">
				<br>
				<div class="row">
					<div class="col-md-12">
						<center>
							<h2>Productos</h2>
						</center>
						<br>
						<!-- Button que activa el modal -->
						<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_registar_producto">
						  Registrar Producto
						</button><br><br>

						<div class="col-md-12 border border-ligth">
							<center>
								<h2>Editar Producto</h2>
							</center>
							<?php if(!empty($_GET['edit'])) : ?>
								<?php $producto = ($_GET['edit']); ?>

								<?php $consulta = $conexion->query("SELECT * FROM producto LEFT JOIN personas ON producto.ID_PROVEEDOR = personas.ID_PERSONA WHERE ID_PROD = '$producto'"); ?>

								<form action="controller/editarProducto.php" method="POST">
							
								<?php while($resultado = $consulta->fetch_array()): ?>
									<div class="container">
										<div class="row">
											<div class="form-group col">
												<label for="nombre_Prod">Nombre del producto</label>
												<input type="text" class="form-control" id="nombre_Prod" name="nombre_Prod" required value="<?php echo ($resultado['NOMBRE_PROD']); ?>">
												<input type="text" hidden="true" class="form-control" id="id_producto" name="id_producto" required value="<?php echo ($resultado['ID_PROD']); ?>">
											</div>
										
											<div class="form-group col">
												<label for="proveedor">Proveedor</label>
												<select class="form-control" name="proveedor" required>
													<option value="<?php echo $registros['ID_PERSONA']; ?>"> <?php echo ($resultado['NOMBRES']); ?> </option>
													<?php $datos = $conexion->query("SELECT * FROM personas WHERE TIPO = 'PROVEEDOR' ")or die($conexion->error);?>

													<?php while ($registros = $datos->fetch_array()):  ?>	
														<option value="<?php echo $registros['ID_PERSONA']; ?>"><?php echo $registros['NOMBRES']; ?></option>
													<?php endwhile ?>
												</select>
											</div>
										</div>
										<div class="row">
											<div class="form-group col">
												<label for="stock">Stock</label>
												<input type="text" class="form-control" id="stock" name="stock" required value="<?php echo ($resultado['STOCK']); ?>">
											</div>
											<div class="form-group col">
												<label for="stock_seguridad">Stock de seguridad</label>
												<input type="text" class="form-control" id="stock_seguridad" name="stock_seguridad" required value="<?php echo ($resultado['STOCK_SEGURIDAD']); ?>">
											</div>
											<div class="form-group col">
												<label for="valor_unitario">Valor unitario</label>
												<input type="text" class="form-control" id="valor_unitario" name="valor_unitario" required value="<?php echo ($resultado['VALOR_UNITARIO']); ?>">
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
							<table id="tabla_paginada" class="table table-bordered mx-auto">
								<thead>
									<tr>
										<th style="text-align: center; white-space: nowrap;" scope="col">Codigo</th>
										<th style="text-align: center; white-space: nowrap;" scope="col">Nombre</th>
										<th style="text-align: center; white-space: nowrap;" scope="col">Stock</th>
										<th style="text-align: center; white-space: nowrap;" scope="col">Stock. S</th>
										<th style="text-align: center; white-space: nowrap;" scope="col">Valor unitario</th>
										<th style="text-align: center; white-space: nowrap;" scope="col">Proveedor</th>
										<th style="text-align: center; white-space: nowrap;" scope="col">Opciones</th>
									</tr>
								</thead>
								<tbody>
									<?php $consulta = $conexion->query("SELECT * FROM producto LEFT JOIN personas ON producto.ID_PROVEEDOR = personas.ID_PERSONA"); ?>

									<?php while($resultado = $consulta->fetch_array()): ?>
										<tr>
											<td><?php echo ($resultado['ID_PROD']); ?></td>
											<td><?php echo ($resultado['NOMBRE_PROD']); ?></td>
											<td><?php echo ($resultado['STOCK']); ?></td>
											<td><?php echo ($resultado['STOCK_SEGURIDAD']); ?></td>
											<td><?php echo ($resultado['VALOR_UNITARIO']); ?></td>
											<td style="white-space: nowrap;"><?php echo ($resultado['NOMBRES']); ?></td>
											<td><a type="button" class="btn btn-primary" href="Inventario.php?edit=<?php echo $resultado['ID_PROD']; ?>"> <i class='fas fa-edit'></i></a></td>
										</tr>
									<?php endwhile; ?>
								</tbody>
							</table>
						</center>
					</div>
				</div>
				<br>
			</section>
	</div>
	<!-- Modal Registar producto -->
	<div class="modal fade" id="modal_registar_producto" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="staticBackdropLabel">Ingrese datos del producto</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="controller/crearProducto.php" method="POST">
						<div class="form-group">
							<label for="nombre_Prod">Nombre del producto</label>
							<input type="text" class="form-control" id="nombre_Prod" name="nombre_Prod" required>
						</div>
						<div class="form-group">
							<label for="stock">Stock</label>
							<input type="text" class="form-control" id="stock" name="stock" required >
						</div>
						<div class="form-group">
							<label for="stock_seguridad">Stock de seguridad</label>
							<input type="text" class="form-control" id="stock_seguridad" name="stock_seguridad" required>
						</div>
						<div class="form-group">
							<label for="valor_unitario">Valor unitario</label>
							<input type="text" class="form-control" id="valor_unitario" name="valor_unitario" required>
						</div>
						<div class="form-group">
							<label for="proveedor">Proveedor</label>
							<select class="form-control" name="proveedor" required>
								<option>------</option>
								<?php $datos = $conexion->query("SELECT * FROM personas WHERE TIPO = 'PROVEEDOR' ")or die($conexion->error);?>

								<?php while ($registros = $datos->fetch_array()):  ?>	
									<option value="<?php echo $registros['ID_PERSONA']; ?>"><?php echo $registros['NOMBRES']; ?></option>
								<?php endwhile ?>
							</select>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
							<button type="submit" class="btn btn-success">Guardar</button>
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