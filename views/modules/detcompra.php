<div class="content-wrapper">

    <section class="content-header">
        <h1>Detalle compra <?php echo $_GET["idcompra"]; ?></h1>
        <ol class="breadcrumb">
            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="compras"> Compras</a></li>
            <li class="active">Detalle compra </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box ml-4">
            <div class="box-body">
                <table id="example1" class="table table dt-responsive" width="100%">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Proveedor</th>
                            <th>Fecha</th>
                            <th>Usuario</th>
                            <th>Observación</th>
                            <th>Productos</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                            <th>Detalle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($_GET["idcompra"])) {
                            error_log('e' . $_GET['idcompra']);
                            $item = "idcompra";
                            $valor = $_GET["idcompra"];
                            $detCompra = detCompraController::mostrarDetalleCompra($item, $valor);

                            foreach ($detCompra as $value) {
                                echo '
                                <tr>
                                    <td>' . $value["idcompra"] . '</td>
                                    <td>' . $value["proveedor"] . '</td>
                                    <td>' . $value["fecha"] . '</td>
                                    <td>' . $value["usuario"] . '</td>
                                    <td>' . $value["observacion"] . '</td>
                                    <td>' . $value["productos"] . '</td>
                                    <td>' . $value["cantidad"] . '</td>
                                    <td>' . $value["total"] . '</td>
                                    <td class="text-center">
                                        <button class="btn btn-success " idcompra="' . $value["idcompra"] . '" ><i class="fa fa-print" aria-hidden="true"></i></button>
                                    </td>
                                </tr>';
                            }
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