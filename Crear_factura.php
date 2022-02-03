<?php 
	session_start();
	include_once "conexion/conexion.php";
	date_default_timezone_set('UTC');
	$cedula_cliente="";
	$valor_provisional="";// SE USARA EN CASO SE REALICE UN DESCUENTO 
	$descuento = 0;

	if (!empty($_POST['cedula_cliente']) && $_POST['cedula_cliente']!= "------") {

		$cedula_cliente= $_POST['cedula_cliente'];
		$valor_provisional=$_POST['valor_total'];
		$descuento = $_POST['descuento'];
		$valor_final = $valor_provisional-$descuento;
		$fecha = date('m/d/Y g:ia');

		//CREAR REGISTRO DE LA FACTURA
		 //-------------------------------------------------------------------------------------------------------------------------------------
		 //NUMERO DE FACTURAS

		 $consulta = $conexion->query("SELECT COUNT(*) total FROM factura_venta")or die($conexion->error);// TOMO NUMERO DE FACTURAS EN BASE DE DATOS PARA CREAR EL CONCECUTIVO.
		 $cantidad_facturas = mysqli_fetch_assoc($consulta);
		 $numero_factura = $cantidad_facturas['total']+1;


		 //TRAER DATOS DEL CLIENTE
		 $datos_cliente = $conexion->query("SELECT ID_PERSONA, NOMBRES FROM personas WHERE ID_PERSONA ='$cedula_cliente'");
		 $datos_cliente_factura = mysqli_fetch_assoc($datos_cliente);
		 $documento = $datos_cliente_factura['ID_PERSONA'];
		 $nombre = $datos_cliente_factura['NOMBRES'];
		 


		$id_vendedor = $_SESSION['id'];


		 //-----------------------------------------------------------------------------------------------------------------------------------------------
		 $conexion->query("INSERT INTO factura_venta(ID_FACTURA, ID_PERSONA, DESCUENTO, VALOR_TOTAL) VALUES('$numero_factura', '$documento', '$descuento','$valor_final')");

		//INSERTAR A ITEMS FACTURA
		$conexion->query("INSERT INTO items_factura(ID_FACTURA, ID_PROD, CANTIDAD, VALOR)SELECT * FROM items_factura_temporal");
		//LIMPIAR TABLA TEMPORAL
		 $conexion->query("DELETE  FROM items_factura_temporal");

		 header('Location:Facturacion.php');
	}

 ?>