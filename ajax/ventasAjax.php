<?php
require_once '../controllers/ventasController.php';
require_once '../models/ventasModel.php';

class AjaxVentas {

    public $idventa;

    public function detalleVenta() {
        $item = "idventa";
        $valor = $this->idventa;
        $respuesta = VentasController::mostrarDetalleVenta($item, $valor);
        echo json_encode($respuesta);
    }

}

if (isset($_POST['idventa'])) {
    $showDetalle = new AjaxVentas();
    $showDetalle->idventa = $_POST['idventa'];
    $showDetalle->detalleVenta();
    echo "sfsd";
}else{
    echo "no hay nada";
}