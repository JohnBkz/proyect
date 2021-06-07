<?php

class detCompraController{
    static public function mostrarDetalleCompra ($item , $valor){
        // $tabla = "compra";
        $respuesta = detCompraModel::mostrarDetalleCompraModel($item, $valor);
        return $respuesta;
    }
}