<?php
require_once "../controllers/ventas.controlador.php";
require_once "../models/ventas.modelo.php";
		if (isset($_POST["idusuario"])) {

			$datos = array(
				"idusuario" => $_POST["idusuario"],
				"idarticulo" => $_POST["idarticulo"],
				"cantidad" => $_POST["cantidad"],
				"idventa" => $_POST["idventa"],	
			);

			if ($_POST["tipo"]==0){	
			$respuesta = ModeloVentas::mdlIngresarDetalleTemp($datos);
            echo json_encode($respuesta);
		}else if ($_POST["tipo"]==1){
			$respuesta = ModeloVentas::mdlAumenEliminarStock($datos);
            echo json_encode($respuesta);
		}else if ($_POST["tipo"]==2){
			$respuesta = ModeloVentas::mdlActualizarStock($datos);
            echo json_encode($respuesta);
		}else if ($_POST["tipo"]==3){
			$respuesta = ModeloVentas::mdlActualizaridventaDetalleTemp($datos);
            echo json_encode($respuesta);
		}
	}
?>