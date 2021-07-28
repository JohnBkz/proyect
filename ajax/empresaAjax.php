<?php

require_once "../controllers/empresaController.php";
require_once "../models/empresaModel.php";

class ajaxEmpresas
{

    // VALIDAR NO REPETIR EMPRESA
    public $validarEmpresa;
    public function ajaxValidarEmpresa()
    {
        $item = "rucempresa";
        $valor = $this->validarEmpresa;
        $respuesta = empresaController::mostrarEmpresa($item, $valor);
        echo json_encode($respuesta);
    }

    public $rucEmpresa;
    public function ajaxEditarEmpresa()
    {
        $item = "rucempresa";
        $valor = $this->rucEmpresa;
        $respuesta = empresaController::mostrarEmpresa($item, $valor);
        echo json_encode($respuesta);
    }
}

// VALIDAR NO REPETIR EMPRESA
if (isset($_POST["validarEmpresa"])) {

    $valUsuario = new ajaxEmpresas();
    $valUsuario->validarEmpresa = $_POST["validarEmpresa"];
    $valUsuario->ajaxValidarEmpresa();
}
// EDITAR EMPRESA
if (isset($_POST["idempresa"])) {
    $editar = new ajaxEmpresas();
    $editar->rucEmpresa = $_POST["idempresa"];
    $editar->ajaxEditarEmpresa();
}