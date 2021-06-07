<div class="content-wrapper">

    <section class="content-header">
        <h1>Administrar compras</h1>
        <ol class="breadcrumb">
            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Administrar compras</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box ml-4">
            <div class="box-header with-border">
                <a href="crearcompra">
                    <button class="btn btn-primary">
                        Agregar compra
                    </button>
                </a>
            </div>
            <div class="box-body">
                <table id="example1" class="table table dt-responsive" width="100%">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Proveedor</th>
                            <th>Fecha</th>
                            <th>Usuario</th>
                            <th>Observación</th>
                            <th>Neto</th>
                            <th>IGV</th>
                            <th>Total</th>
                            <th>Detalle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $item = null;
                        $valor = null;
                        $compras = comprasController::mostrarCompras($item, $valor);

                        foreach ($compras as $value) {
                            echo '
                            <tr>
                                <td>' . $value["idcompra"] . '</td>
                                <td>' . $value["proveedor"] . '</td>
                                <td>' . $value["fecha"] . '</td>
                                <td>' . $value["usuario"] . '</td>
                                <td>' . $value["observacion"] . '</td>
                                <td>' . $value["neto"] . '</td>
                                <td>' . $value["impuesto"] . '</td>
                                <td>' . $value["total"] . '</td>
                                <td class="text-center">
                                    <button class="btn btn-success " idcompra="' . $value["idcompra"] . '" ><i class="fa fa-print" aria-hidden="true"></i></button>
                                    <button class="btn btn-success DetalleCompra"  idcompra="' . $value["idcompra"] . '" ><i class="fa fa-file-text-o" aria-hidden="true"></i></button>
                                    <button class="btn btn-danger btnEliminarCompra "><i class="fa fa-times"></i></button>
                                </td>
                            </tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- DETALLE COMPRA -->
<!-- <div id="showCompra" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background:#3c8dbc; color:white">
                <button type="button" class="close salir" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Detalle venta</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <table id="example1" class="table table dt-responsive" width="100%">
                        <thead>
                            <tr>
                                <th>Articulo</th>
                                <th>Cantidad</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody id="detalleCompra">

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-right salir" data-dismiss="modal">Salir</button>
            </div>
        </div>
    </div>
</div> -->