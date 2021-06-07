<?php
require_once "../controllers/clienteController.php";
require_once "../models/clienteModel.php";

class AjaxClientes {
    // EDITAR CLIENTES
    public $idCliente;
    public function ajaxEditarCliente() {
        $item = "idcliente";
        $valor = $this->idCliente;
        $respuesta = ControladorClientes::ctrMostrarClientes($item, $valor);
        echo json_encode($respuesta);
    }

    // NO REPETIR CLIENTE
      public $validarCliente;
     public function ajaxValidarCliente() {
        $item = "clientes";
        $valor = $this->validarCliente;
        $respuesta = ControladorClientes::ctrMostrarClientes($item, $valor);
        echo json_encode($respuesta);
    }
}
// EDITAR CLIENTES
if (isset($_POST["idCliente"])) {
    $editar = new AjaxClientes();
    $editar->idCliente = $_POST["idCliente"];
    $editar->ajaxEditarCliente();
}

// NO REPEITR CLIENTE
if (isset($_POST["validarCliente"])) {
    $valCliente = new AjaxClientes();
    $valCliente->validarCliente = $_POST["validarCliente"];
    $valCliente->ajaxValidarCliente();
}