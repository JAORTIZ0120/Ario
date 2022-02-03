<?php 
	session_start();
	include 'Conexion/conexion.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Ario</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/estilos_admin.css">
	<link rel="stylesheet" type="text/css" href="css/estilos_login.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script type="text/javascript" src="js/jquery-3.4.1.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
</head>
<body>
	<section class=" mx-auto col-md-4 login">
		<img class="logo" src="./img/logo.png">
		<form class="formulario_login" action="#" method="POST">
			<div class="form-group col-md-12">
				<label for="user">Usuario</label>
				<input type="text" name="user" class="form-control" id="user"  required>
			</div>
			<div class="form-group col-md-12">
				<label for="password">Contraseña</label>
				<input type="password" name="password" class="form-control" id="password" autocomplete="off" required>
			</div>
			<?php
			 	if (!empty($_POST['user']) and !empty($_POST['password'])) {
			 		$user = $_POST['user'];
			 		$password = $_POST['password'];

			 		$consulta = $conexion->query("SELECT * FROM usuario WHERE CORREO = '$user' AND PASSWORD = '$password' "); 

			 		if ($reg = $consulta->fetch_array()) {
			 			$_SESSION['user_name'] = $reg['CORREO'];
			 			$_SESSION['id'] = $reg['ID_USUARIO'];
						echo "	<center>
									<div class='spinner-grow text-primary' role='status'>
										<span class='sr-only'>Loading...</span>
									</div>
									<div class='spinner-grow text-secondary' role='status'>
										<span class='sr-only'>Loading...</span>
									</div>
									<div class='spinner-grow text-success' role='status'>
										<span class='sr-only'>Loading...</span>
									</div>
									<div class='spinner-grow text-danger' role='status'>
										<span class='sr-only'>Loading...</span>
									</div>
									<div class='spinner-grow text-warning' role='status'>
										<span class='sr-only'>Loading...</span>
									</div>
									<div class='spinner-grow text-info' role='status'>
										<span class='sr-only'>Loading...</span>
									</div>
									<div class='spinner-grow text-light' role='status'>
										<span class='sr-only'>Loading...</span>
									</div>
									<div class='spinner-grow text-dark' role='status'>
										<span class='sr-only'>Loading...</span>
									</div>
								</center>";
						echo '<meta http-equiv="refresh" content="2;url=principal.php">';
					}
			 	} 
			?>
			<button type="submit" class="btn botonlogin btn-success">Iniciar</button>
		</form>
	</section>
</body>
</html>