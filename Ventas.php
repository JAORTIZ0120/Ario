<?php 
	session_start();
	require_once "conexion/conexion.php";
 ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Ario</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/estilos_admin.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script type="text/javascript" src="js/jquery-3.4.1.js"></script>
	


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
	     <br><br>
	      <section class="col-md-11 card mx-auto ">
	      	<br>
	      	<center>
	      		<h2>Ventas realizadas</h2>
	      	</center>
	      	<br>
	      	<!-- Button que activa el modal -->
	      	<!--<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_registar_venta">
	      	  Registrar Venta
	      	</button>-->
	      	<center>
	      		<table class="table table-bordered mx-auto">
	      		  <thead class="text-center">
	      		    <tr>
	      		      <th scope="col">NUMERO FACTURA</th>
	      		      <th scope="col">NOMBRE CLIENTE</th>
	      		      <th scope="col">CEDULA CLIENTE</th>
	      		      <th scope="col">DESCUENTO</th>
	      		      <th scope="col">TOTAL</th>
	      		      <th scope="col">FECHA</th>
	      		    </tr>
	      		  </thead>
	      		  <tbody class="text-center">
	      		  	<form>
	      		  	<?php 
	      		  		$consulta = $conexion->query("SELECT * FROM factura_venta LEFT JOIN personas ON factura_venta.ID_PERSONA = personas.ID_PERSONA");
	      		  		while ($registros =  $consulta->fetch_array()) {
	      		  			
	      		  		 ?>
	      		  		 <tr>
	      		  		 	<td><input  class=" text-center form-control" type="text" name="numfactura" value="<?php echo $registros['ID_FACTURA'] ?>" readonly></td>
	      		  		 	<td><?php echo $registros['NOMBRES'] ?></td>
	      		  		 	<td><?php echo $registros['DOC_PERSONA'] ?></td>
	      		  		 	<td><?php echo $registros['DESCUENTO'] ?></td>
	      		  		 	<td><?php echo $registros['VALOR_TOTAL'] ?></td>
	      		  		 	<td><?php echo $registros['FECHA'] ?></td>
	      		  		    <td><a class="btn btn-outline-success" href="Ventas.php?view=<?php echo $registros['ID_FACTURA']; ?>" id="prueba" ><i class="fas fa-search-plus"></i></a></td>     		    
	      		  		 </tr>
	      		  		<?php  
	      		  		}

	      		  	 ?>

	      		   </form>
	      		 
	      		  </tbody>
	      		</table>
	      	</center>
	      	<br>
	      </section>

	      <center>
	      	<br>
	      	<section class="col-md-10">
	      		<table class="table text-center ">
	      		  <thead class="thead-dark">
	      		    <tr>
	      		      <th scope="col">PRODUCTO</th>
	      		      <th scope="col">CANTIDAD</th>
	      		      <th scope="col">TOTAL PRODUCTO</th>
	      		    </tr>
	      		  </thead>
	      		  <tbody>
	      		  	<?php 
	      		  		if (!empty($_GET['view'])) {
	      		  			$num = $_GET['view'];

	      		  			$traer_descuento = $conexion->query("SELECT DESCUENTO FROM factura_venta WHERE ID_FACTURA='$num'");
	      		  			$descuento = mysqli_fetch_assoc($traer_descuento);
	      		  
	      		  			$consulta = $conexion->query("SELECT * FROM items_factura LEFT JOIN producto ON items_factura.ID_PROD = producto.ID_PROD WHERE ID_FACTURA='$num'");

	      		  			$valor_temp=0;
	      		  			$valor_total=0;
	      		  			while ($reg = $consulta->fetch_array()) {
	      		  			?>
	      		  				<tr>
	      		  				  <td scope="row"><?php echo $reg['NOMBRE_PROD']; ?></td>
	      		  				  <td><?php echo $reg['CANTIDAD']; ?></td>
	      		  				  <td><?php echo $reg['VALOR']; ?></td>
	      		  				</tr>
	      		  				<?php 
	      		  					$valor_temp = $reg['VALOR'];
	      		  					intval($valor_total);
	      		  					$valor_total = $valor_total+$valor_temp;
	      		  				 ?>

	      		  				
	      		  			<?php 	
	      		  			}
	      		  			 $valor_imprimir = $valor_total-$descuento['DESCUENTO'];
	      		  			?>
	      		  			<tr class="border border-danger">
	      		  					
	      		  				<td>TOTAL</td>
	      		  				<td>IVA 19%</td>
	      		  				<td><?php echo $valor_imprimir ?></td>
	      		  			</tr>
	      		  			<?php 
	      		  		}

	      		  	 ?>


	      		  </tbody>
	      		</table>
	      		
	      	</section>
	      </center>
	      <br><br>

	  <!-- /#page-content-wrapper -->
	</div>
	<!-- Modal -->
	<div class="modal fade" id="modal_detalles_factura" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        ...
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary">Understood</button>
	      </div>
	    </div>
	  </div>
	</div>


	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/mijs.js"></script>

</body>
</html>