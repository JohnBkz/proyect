<?php
require_once"../controllers/compraController.php";
require_once"../models/compraModel.php";

class AjaxCompras{
    // MOSTRAR DETALLE COMPRA
    public $idcompra;
    public function detalleCompra(){
        $item = "idcompra";
        $valor = $this->idcompra;
        $respuesta = comprasController::mostrarDetalleCompras($item, $valor);
        echo json_encode($respuesta);
    }
}

// MOSTRAR DETALLE COMPRA
if(isset($_POST["idcompra"])){
    $dCompra = new AjaxCompras();
    $dCompra->idcompra = $_POST["idcompra"];
    $dCompra->detalleCompra();
}