<?php

require_once "../controllers/clientes.controlador.php";
require_once "../models/clientes.modelo.php";

class AjaxCliente{

	/*=============================================
	EDITAR CLIENTE
	=============================================*/	

	public $idCliente;

	public function ajaxEditarCliente(){

		$item = "id";
		$valor = $this->idCliente;

		$respuesta = ControladorClientes::ctrMostrarClientes($item, $valor);

		echo json_encode($respuesta);


	}


		/*=============================================
	VALIDAR NO REPETIR USUARIO
	=============================================*/	

	public $validarCliente;

	public function ajaxValidarCliente(){

	
			$item = "ndocumento";

		$valor = $this->validarCliente;

		$respuesta = ControladorCliente::ctrMostrarClientes($item, $valor);

		echo json_encode($respuesta);

	}

	public $validarClienteruc;
	public function ajaxValidarClienteruc(){

		$item = "ruc";
		
	
		$valor = $this->validarClienteruc;

		$respuesta = ControladorCliente::ctrMostrarClientes($item, $valor);

		echo json_encode($respuesta);

	}

}

/*=============================================
EDITAR CLIENTE
=============================================*/	

if(isset($_POST["idCliente"])){

	$cliente = new AjaxClientes();
	$cliente -> idCliente = $_POST["idCliente"];
	$cliente -> ajaxEditarCliente();

}

/*=============================================
VALIDAR NO REPETIR USUARIO
=============================================*/

if(isset( $_POST["validarCliente"])){

	$valUsuario = new AjaxCliente();
	$valUsuario -> validarCliente = $_POST["validarCliente"];
	$valUsuario -> ajaxValidarCliente();

}

if(isset( $_POST["validarClienteruc"])){

	$valUsuario = new AjaxCliente();
	$valUsuario -> validarClienteruc = $_POST["validarClienteruc"];
	$valUsuario -> ajaxValidarClienteruc();

}

