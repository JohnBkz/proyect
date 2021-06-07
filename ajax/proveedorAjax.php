<?php
require_once "../controllers/proveedorController.php";
require_once "../models/proveedorModel.php";

class AjaxProveedor {
    // EDITAR CLIENTES
    public $idproveedor;
    public function ajaxEditarProveedor() {
        $item = "idproveedor";
        $valor = $this->idproveedor;
        $respuesta = ProveedorController::MostrarPorveedores($item, $valor);
        echo json_encode($respuesta);
    }

    // NO REPETIR RAZON SOCIAL
    public $validarRS;
    public function ajaxValidarRS() {
        $item = "razonsocial";
        $valor = $this->validarRS;
        $respuesta = ProveedorController::MostrarPorveedores($item, $valor);
        echo json_encode($respuesta);
    }

    // NO REPETIR RAZON RUC
    public $validarRUC;
    public function ajaxValidarRUC() {
        $item = "idproveedor";
        $valor = $this->validarRUC;
        $respuesta = ProveedorController::MostrarPorveedores($item, $valor);
        echo json_encode($respuesta);
    }
}


// EDITAR USUARIO
if (isset($_POST["idProveedor"])) {
    $editar = new AjaxProveedor();
    $editar->idproveedor = $_POST["idProveedor"];
    $editar->ajaxEditarProveedor();
}

// NO REPEITR RAZON SOCIAL
if (isset($_POST["validarRS"])) {
    $valRS = new AjaxProveedor();
    $valRS->validarRS = $_POST["validarRS"];
    $valRS->ajaxValidarRS();
}

// NO REPEITR RAZON RUC
if (isset($_POST["validarRUC"])) {
    $valRS = new AjaxProveedor();
    $valRS->validarRUC = $_POST["validarRUC"];
    $valRS->ajaxValidarRUC();
}