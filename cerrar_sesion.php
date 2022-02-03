<?php 
	 session_start();
	 unset($_SESSION['user_name']) ;
	 unset($_SESSION['id']);
	 unset($_SESSION['tipo_iniciado']);
	 session_destroy();
	 header('Location:index.php');
	
 ?>