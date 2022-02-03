<?php 
	session_start();
	
 ?>

<!DOCTYPE html>
<html>
<head lang="es">
	<title>Ferreteria Benito's</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/estilos_admin.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script type="text/javascript" src="js/jquery-3.4.1.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
</head>
<body>

	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  <a class="navbar-brand" href="#">Ferreteria</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarNav">
	    <ul class="navbar-nav">
	      <li class="nav-item active">
	        <a class="nav-link" href="principal.php">Incio</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="Clientes.php">Clientes</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="Proveedores.php">Proveedores</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="Ventas.php">Ventas</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="Inventario.php">Inventario</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="#"></a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="#"></a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="#"></a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="#"></a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="#"></a>
	      </li>
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

	<script type="text/javascript">
		$(document).ready(function() {

			Swal.fire(
			  'Parece que no tienes permisos para este modulo',
			  'Utiliza el menu de arriba para dirigirte a otro lugar',
			  'question'
			);
			
		});
	</script>

</body>
</html>