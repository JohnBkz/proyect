<?php

class VehiculosAjax {

    // EDITAR VEHICULO
    public $idvehiculo;
    public function ajaxEditarVehiculo() {
        $valor = $this->idvehiculo;
        $respuesta = VehiculosController::getVehiculo($valor);
        echo json_encode($respuesta);
    }

}

// EDITAR VEHICULO
if (isset($_POST["idvehiculo"])) {
    #error_log('UsuarioAjax::->' . $_POST["idvehiculo"]);
    $editar = new VehiculosAjax();
    $editar->idvehiculo = $_POST["idvehiculo"];
    $editar->ajaxEditarVehiculo();
}