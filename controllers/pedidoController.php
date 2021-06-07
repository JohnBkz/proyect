<?php

class controllerPedido{

    static public function crearPedido(){
        if(isset($_POST['idUsuario'])) {
            $datos = [
                'idUser' => $_POST['idUsuario'],
                // 'codPedido' => $_POST['nuevoPedido'],
                'proveedor' => $_POST['proveedorPedido'],
                'impuesto' => $_POST['nuevoPrecioImpuesto'],
                'neto' => $_POST['nuevoPrecioNeto'],
                'total' => $_POST['nuevoTotalPedido'],
                'fechaE' => $_POST['nuevaFechaPedido']
            ];
            $inserVenta = modelPedido::insertPedidoModel($datos);
            $maxIdPedido = modelPedido::maxIdPedido($_POST['idUsuario']);
            $idProducto = count($_REQUEST["idproducto"]);
            $detalle = "";
            for ($i = 0; $i < $idProducto; $i++) {
                $detalle = $detalle . "('" . $maxIdPedido . "', '" . $_REQUEST['idproducto'][$i] . "', '" . $_REQUEST['cantidad'][$i] . "',  '" . $_REQUEST['unidad'][$i] . "', '" . $_REQUEST['precio'][$i] . "'),";                
            }
            $detalle = rtrim($detalle, ',');
            $resultDetalle = modelPedido::insertDetallePedido($detalle);
            if ($inserVenta == "ok" && $resultDetalle == "ok") {
                //error_log('UsuarioController::createUsuario()-> OK');
                echo '<script>
                    swal({
                        type: "success",
                        title: "¡El pedido ha sido guardado correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if(result.value){
                            window.location = "pedidos";
                        }
                    });
                </script>';
            }else{
                echo '<script>
                    swal({
                        type: "error",
                        title: "¡ni mergaaaaas!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if(result.value){
                            window.location = "pedidos";
                        }
                    });
                </script>';
            }
        }
    }

    static public function mostrarPedidos($item, $valor){
        $respuesta = modelPedido::mostrarPedidos($item, $valor);
        return $respuesta;
    }

}