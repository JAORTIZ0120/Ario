<?php 
	session_start();
	include_once "conexion/conexion.php";
 ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Ario</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/estilos_admin.css">
	<script src="https://kit.fontawesome.com/88e2f49abe.js" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>

	<div class="d-flex" id="wrapper">

	  <!-- Sidebar -->
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
	  	    	  <a  class="btn btn-outline-success   " id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['user_name']; ?></a>
	  	    	  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
	  	    	  	<center>
	  	    	  		<a  class="btn btn-outline-danger  " href="cerrar_sesion.php">Cerrar Sesion <i class="fas fa-power-off"></i></a>
	  	    	  	</center>
	  	    	  </div>
	  	    	</div>
	  	    </ul>
	  	  </div>
	  	</nav>  
	  	<br><br><br>
	  	<div class="col-md-11">
	  		
	  			<center>
	  				<section class="col-md-11">
	  					<form class="form-inline  my-2 my-lg-6" method="POST" action="#">
	  						<input class="form-control mr-sm-2 col-md-8" type="search" placeholder="CODIGO / NOMBRE DEL PRODUCTO" aria-label="Search" name="input_buscar">
	  						<button class="btn btn-outline-success my-2 my-sm-0" type="submit">BUSCAR</button>
	  					</form>
	  					<br>
	  					<table class="table">
							<thead class="thead-dark">
	  							<tr>
									<th scope="col">CODIGO</th>
									<th scope="col">PRODUCTO</th>
									<th scope="col">INVENTARIO</th>
									<th scope="col">VALOR/U</th>
									<th scope="col">CANTIDAD</th>
									<th scope="col">ACCIONES</th>
								</tr>
							</thead>
							<tbody class="text-center">
								<?php if(!empty($_POST['input_buscar'])) : ?>
									<?php 
										$traer_prod = $_POST['input_buscar'];
	  					  				$consulta = $conexion->query("SELECT * FROM producto WHERE ID_PROD = '$traer_prod' OR NOMBRE_PROD = '$traer_prod' ");
									?>
									<tr>
										<form action="controller/Enviar_temporal.php" method="POST">
											<?php while ($reg = $consulta->fetch_array()) :?>
												<?php$cod_prod_temp = $reg['ID_PROD'];
	  					  						$nombre_prod_temp = $reg['NOMBRE_PROD'];?>
												<th scope="row"><input class="form-control" type="text" name="cod_prod_enviar" id="cod_prod_enviar" value="<?php echo $reg['ID_PROD']; ?>" readonly></th>
												<td><input class="form-control" type="text" name="nombre_prod_input" id="nombre_prod_temp" value="<?php echo $reg['NOMBRE_PROD']; ?>" readonly></td>
												<td><input class="form-control" type="text" name="stock_prod" value="<?php echo $reg['STOCK']; ?>" readonly></td>
												<td>
													<input class="form-control" type="text" name="valor_unidad" value="<?php echo $reg['VALOR_UNITARIO']; ?>" readonly>
												</td>
												<td>
													<input class="form-control"  type="number" name="cantidad_comprar" id="cantidad_comprar">
												</td>
												<td> 	
													<button class="btn btn-outline-success" type="submit"><i class="fas fa-plus"></i></button>
												</td>
											<?php endwhile; ?>
										</form>
									</tr>
								<?php else: ?>
									<div class="alert alert-success">Selecciona producto y cantidad</div>
								<?php endif; ?>
	  					  </tbody>
	  					</table>
	  				</section>
	  			</center>


	  		
			<center>
				<section class="col-md-6 text-center ">
					<br><br>
					<div class="card col-md-11 ">
						<div class="card-header">
						<br>
						</div>
						<div class="card-body">
							<h5 class="card-title">TOTAL A PAGAR</h5>
							<?php
								$consulta = $conexion->query("SELECT VALOR FROM items_factura_temporal"); 
								$valor_temp = 0;
								$valor_total = 0;
								while ($operacion = $consulta->fetch_array()) {
									$valor_temp = $operacion['VALOR'];
									intval($valor_total);
									$valor_total = $valor_total+$valor_temp;
								}
							?>
							<h6><?php echo $valor_total; ?></h6>
							<br>
							<a href="#" class="btn btn-outline-success"  data-toggle="modal" data-target="#modal_facturar">REGISTRAR VENTA</a>
							<!--<a href="#" class="btn btn-outline-success" data-toggle="modal" data-target="#modal_facturar">T-CREDITO</a>
							<a href="#" class="btn btn-outline-success" data-toggle="modal" data-target="#modal_facturar">SEPARAR</a>-->
						</div>
						<div class="card-footer text-muted">
							<br>
						</div>
					</div>
				</section>
			</center>
			<br><br>
			<center>
				<section class="col-md-11">
					<table class="table text-center">
						<thead class="thead-dark">
							<tr>
								<th scope="col">CODIGO</th>
								<th scope="col">PRODUCTO</th>
								<th scope="col">CANTIDAD</th>
								<th scope="col">VALOR TOTAL</th>
								<th scope="col">ACCIONES</th>
							</tr>
						</thead>
						<tbody>
	  				  	<form>
	  				  	<?php $consulta = $conexion->query("SELECT * FROM items_factura_temporal LEFT JOIN producto ON items_factura_temporal.ID_PROD = producto.ID_PROD");?>
							<?php while ($registros = $consulta->fetch_array()) :?>
								<tr>
									<td><input class="form-control" type="text" name="" value="<?php echo $registros['ID_PROD'] ?>" readonly></td>
									<td><input class="form-control" type="text" name="" value="<?php echo $registros['NOMBRE_PROD'] ?>" readonly></td>
									<td><input class="form-control" type="text" name="" value="<?php echo $registros['CANTIDAD'] ?>" readonly></td>
									<td><input class="form-control" type="text" name="" value="<?php echo $registros['VALOR'] ?>" readonly></td>
									<td>
										<a href="Facturacion.php?del=<?php echo $registros['ID_PROD']; ?> " class="btn btn-outline-danger"><i class="fas fa-trash"></i></a>
									</td>
								</tr>
							<?php endwhile; ?>
	  				  	 </form>
	  				  	
	  				  </tbody>
	  				</table>
	  			</section>
	  			<?php 
	  				if (!empty($_GET['del'])) {
	  					$eliminar = $_GET['del'];
	  					$retornar_inventario = 0;
	  					if ($eliminar!="") {
	  						$rest = $conexion->query("SELECT CANTIDAD FROM items_factura_temporal WHERE ID_PROD = '$eliminar' ");// traer cantidad de la factura temporal
	  						$cantidad_prod_tempora = mysqli_fetch_assoc($rest);

	  						$stock_actual = $conexion->query("SELECT STOCK FROM producto WHERE ID_PROD = '$eliminar' ");// traer el stock de la tabla de inventario
	  						$cantidad_prod_inventario = mysqli_fetch_assoc($stock_actual);

	  						$retornar_inventario = $cantidad_prod_inventario['STOCK'] + $cantidad_prod_tempora['CANTIDAD'];// sumar al stock actual

	  						$conexion->query("UPDATE producto set STOCK = '$retornar_inventario' WHERE ID_PROD = '$eliminar'");

							$conexion->query("DELETE FROM items_factura_temporal WHERE ID_PROD = '$eliminar'");
	  						echo "<script>Swal.fire({
								icon: 'success',
	  							title: '',
	  							text: 'Eliminado con exito',
	  							footer: '<a href></a>'
	  						})</script>";

	  						$eliminar = "";
	  					}
	  				}
	  			 ?>
	  		</center>
	  	</div>
	  </div>
	  <!--Contenido pagina-->
	</div>

	<!-- Modal -->
	<div class="modal fade" id="modal_facturar" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="staticBackdropLabel">Facturar</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="Crear_factura.php" method="POST">
						<div class="form-group">
							<label for="cedula_cliente">Cedula Cliente</label>
							<select class="form-control" name="cedula_cliente" id="cedula_cliente" required>
								<option>------</option>
								<?php $datos = $conexion->query("SELECT ID_PERSONA, NOMBRES FROM personas WHERE TIPO = 'CLIENTE' ")or die($conexion->error);?>
									<?php while ($reg =  $datos->fetch_array()): ?>
										<option value="<?php echo $reg['ID_PERSONA']; ?>"><?php echo $reg['NOMBRES']; ?></option>
									<?php endwhile; ?>
							</select>
						</div>
						<div class="form-group">
							<?php $consulta = $conexion->query("SELECT VALOR FROM items_factura_temporal");  
								$valor_temp = 0;
								$valor_total = 0;
								while ($operacion = $consulta->fetch_array()) {
									$valor_temp = $operacion['VALOR'];
									intval($valor_total);
									$valor_total = $valor_total+$valor_temp;
								}
							?>
							<label for="total">Total</label>
							<input type="text" class="form-control" id="total" value="<?php echo $valor_total; ?>" name="valor_total">
						</div>
						<div class="form-group">
							<label for="descuento">Descuento</label>
							<input type="text" class="form-control" id="descuento" name="descuento">
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
							<button type="submit" class="btn btn-success">Facturar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="js/jquery-3.4.1.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/mijs.js"></script>

</body>
</html>