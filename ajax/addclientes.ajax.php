<?php

require_once "../controllers/clientes.controlador.php";
require_once "../models/clientes.modelo.php";

if (isset($_POST["midocu"])) {
     
	if (true) {

		$tabla = "clientes";

		$datos = array(			
			"documento" => $_POST["tipodocu"],
			"ndocumento" => $_POST["midocu"],
			"razonsocial" => $_POST["minombre"],
			"direccion" => $_POST["midireccion"],
			"telefono" => "",
			"email" => ""
		);

		$respuest = ModeloCliente::mdlIngresarCliente($tabla, $datos);
		 echo json_encode($respuest);
		// $item = null;
		// $valor = null;

		// $respuest = ControladorClientes::ctrMostrarClientes($item, $valor);
		// echo json_encode($respuest);
	}
}
