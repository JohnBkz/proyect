<?php
require_once "../controllers/ventas.controlador.php";
require_once "../models/ventas.modelo.php";
		if (isset($_POST["idvehiculo"])) {
			/*=============================================
			GUARDAR LA COMPRA
			=============================================*/
			$datosV = array(
				"idventa" => $_POST["idventa"],
				"rucempresa" => $_POST["rucempresa"],
				"idtrabajador" => $_POST["idtrabajador"],
				"idvehiculo" => $_POST["idvehiculo"],
                "idproducto" => $_POST["idproducto"],
                "cantidad" => $_POST["cantidad"],
				"total" => $_POST["total"]		
			);
			$respuesta = ModeloVentas::mdlIngresarVale($datosV);
            echo json_encode($respuesta);

	}
?>