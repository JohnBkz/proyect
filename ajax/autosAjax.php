<?php

require_once "../controllers/autoController.php";
require_once "../models/autoModel.php";

class ajaxAutos
{
    // VALIDAR NO REPETIR AUTO
    public $validarAuto;
    public function ajaxValidarAuto()
    {
        $item = "placa";
        $valor = $this->validarAuto;
        $respuesta = autosController::mostrarAuto($item, $valor);
        echo json_encode($respuesta);
    }

    public $rucempresa;
    public function ajaxListarAutos()
    {
        $tabla = "vehiculos";
        $valor = $this->rucempresa;
        $respuesta = modeloAuto::listarAutoModel($tabla, $valor);
        echo json_encode($respuesta);
    }


    // EDITAR AUTO
    public $idVehiculo;
    public function ajaxEditarVehiculo()
    {
        $item = "idvehiculo";
        $valor = $this->idVehiculo;
        $respuesta = autosController::mostrarAuto($item, $valor);
        echo json_encode($respuesta);
    }
}
if (isset($_POST["placaTra"])) {
    if (true) {
        $datos = array(
            "placa" => $_POST["placaTra"],
            "kilometraje" => $_POST["km"],
            "empresaAuto" => $_POST["empresaTra"]
        );
        $respuesta = modeloAuto::crearAutoModel($datos);
        echo json_encode($respuesta);
    }
}
// VALIDAR NO REPETIR AUTO
if (isset($_POST["validarAuto"])) {
    $valAuto = new ajaxAutos();
    $valAuto->validarAuto = $_POST["validarAuto"];
    $valAuto->ajaxValidarAuto();
}
// EDITAR EMPRESA
if (isset($_POST["idVehiculo"])) {
    $editar = new ajaxAutos();
    $editar->idVehiculo = $_POST["idVehiculo"];
    $editar->ajaxEditarVehiculo();
}

// Listar todos AUTOS POR RUC
if (isset($_POST["rucempresa"])) {
    $listar = new ajaxAutos();
    $listar->rucempresa = $_POST["rucempresa"];
    $listar->ajaxListarAutos();
}