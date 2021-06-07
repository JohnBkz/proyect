<?php

class comprasController{
    static public function mostrarCompras($item, $valor){
        $respuesta = ModeloCompras::mostrarCompras($item, $valor);
        return $respuesta;
    }

    // mostrar detalle compra
    static public function mostrarDetalleCompras($item, $valor){
        $respuesta = ModeloCompras::mostrarDetalleCompras($item, $valor);
        return $respuesta;
    }
}