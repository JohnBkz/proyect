<?php

class VentasController {
    
    static public function mostrarVentas($item, $valor) {
        $respuesta = VentasModel::mostrarVentas($item, $valor);
        return $respuesta;      
    }

    static public function mostrarDetalleVenta($item, $valor) {
        // if (isset($_POST['idventa'])) {
        //     $idventa = $_POST['idventa'];
        $tabla = "detalleventa";
        $respuesta = VentasModel::mostrarDetalleVenta($tabla, $item, $valor);
        return $respuesta;
        // }       
    }

    static public function addVenta() {
        if(isset($_POST['idUsuario'])) {
            if (isset($_POST['codetransaccion'])) {
                $codeTran = $_POST['codetransaccion'];
            } else {
                $codeTran = '';
            }

            $datos = array (
                'idusuario'         => $_POST["idUsuario"],
                'idcliente'         => $_POST["dniCliente"],
                'comprobante'       => $_POST['comprobante'],
                'metpago'           => $_POST['metodoPago'],
                'codetransaccion'   => $codeTran,
                'subtotal'          => $_POST['newSubtotVent'],
                'igv'               => $_POST['newImpuestVent'],
                'total'             => $_POST['newTotVent']
            );

            $resVenta = VentasModel::insertVenta($datos);

            if ($resVenta == 'ok') {
                $resMaxIdVenta = VentasModel::maxIdVenta($_POST["idUsuario"]);
                error_log($resMaxIdVenta);
                $idproduct = count($_REQUEST['idproducto']);
                $detalle = "";

                for ($i = 0; $i < $idproduct; $i++) {
                    #$total = $_REQUEST['precioventa'][$i] * $_REQUEST['amount'][$i];
                    $detalle = $detalle . "(" . $resMaxIdVenta . "," . $_REQUEST['idproducto'][$i] . "," . $_REQUEST['amount'][$i] . "," . $_REQUEST['precioventa'][$i] . "," . $_REQUEST['precioventa'][$i] * $_REQUEST['amount'][$i] . "),";
                }

                $detalle = rtrim($detalle, ',');
                $resDetalle = VentasModel::insertDetalleVenta($detalle);

            }

            if ($resVenta == 'ok' && $resDetalle == 'ok') {
                echo '<script>
                    swal({
                       type: "success",
                        title: "¡La venta se registro correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if(result.value){
                            window.location = "crearventa";
                        }
                    });
                </script>';
            } else {
                echo '<script>
					swal({
						type: "error",
						title: "¡Error al registrar la venta y/o detalle!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
					}).then(function(result){
						if(result.value){
							window.location = "crearventa";
						}
					});
                </script>';
            }
        }
    }

}