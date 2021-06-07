<?php
require_once "../controllers/ventas.controlador.php";
require_once "../models/ventas.modelo.php";




		if (isset($_POST["comprobante"])) {

			/*=============================================
			ACTUALIZAR LAS COMPRAS DEL CLIENTE Y REDUCIR EL STOCK Y AUMENTAR LAS VENTAS DE LOS PRODUCTOS
			=============================================*/
            $tipocomp="Boleta";
			if ($_POST["producto"] == "" ||  $_POST["producto"] == "[]") {
				$respuesta = 0;
				echo json_encode($respuesta);
			}else{

			/*=============================================
			GUARDAR LA COMPRA
			=============================================*/

			$tabla = "ventas";

			$datos = array(
				"idusuario" => $_POST["idusuario"],
				"idcliente" => $_POST["idcliente"],
				"comprobante" => $_POST["comprobante"],
				"productos" => $_POST["producto"],
                "metpago" => $_POST["metpago"],
                "codetransaccion" => $_POST["codetransaccion"],
				"subtotal" => $_POST["subtotal"],
                "descuento" => $_POST["descuento"],
                "igv" => $_POST["igv"],
				"total" => $_POST["total"],
                "estado" => $_POST["estado"]
				
			);

			$respuesta = ModeloVentas::mdlIngresarVenta($tabla, $datos,$_POST["comprobante"]);
            echo json_encode($respuesta);
		}
	}
?>