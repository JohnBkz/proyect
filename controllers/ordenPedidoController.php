<?php

class controllerOrdenPedido
{

    /*=============================================
	MOSTRAR Ordencompra
	=============================================*/

    static public function mostrarOrdenPedidoCtr($item, $valor)
    {
        // $item = 'idpedido';
        $respuesta = ModeloOrdencompra::mostrarOrdenPedidoMdl($item, $valor);

        return $respuesta;
    }

    // MOSTRAR DETALLE PEDIDO
    static public function mostrarDetPedido($item, $valor)
    {
        // $item = 'idpedido';
        $respuesta = ModeloOrdencompra::mostrarDetPedidoMdl($item, $valor);

        return $respuesta;
    }
}
