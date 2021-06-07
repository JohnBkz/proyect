<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Crear pedido
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Crear pedido</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-7 col-xs-6">
                <div class="box box-success">
                    <div class="box-header with-border"></div>
                    <form role="form" method="post" class="formularioPedido">
                        <div class="box-body">
                            <div class="box">
                                <!-- ENTRADA DEL USUARIO -->
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input type="text" class="form-control" id="nuevoUsuario" name="nuevoUsuario" value="<?php echo $_SESSION["nombre"]; ?>" readonly>
                                        <input type="hidden" name="idUsuario" value="<?php echo $_SESSION["id"]; ?>">
                                    </div>
                                </div>
                                <!-- ENTRADA DEL PROVEEDOR -->
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                        <select class="form-control input-lg" name="proveedorPedido" required>
                                            <option disabled selected>Seleccionar proveedor</option>
                                            <?php
                                            $item = null;
                                            $valor = null;
                                            $proveedor = ProveedorController::MostrarPorveedores($item, $valor);
                                            foreach ($proveedor as $key => $value) {
                                                echo '<option value="' . $value["idproveedor"] . '">' . $value["razonsocial"] . '</option>';
                                            }
                                            ?>
                                        </select>
                                        <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#agregarProveedor" data-dismiss="modal">Agregar
                                                proveedor</button></span>
                                    </div>
                                </div>

                                <!--=====================================
                                ENTRADA PARA AGREGAR PRODUCTO
                                ======================================-->

                                <div class="form-group row nuevoProducto">
                                    <table class="table tablaCompras center pt-5" style="width:100%;">
                                        <thead>
                                            <th>Eliminar</th>
                                            <th>Descripsión</th>
                                            <th style="text-align: right;">Cantidad</th>
                                            <th style="text-align: right;">Val Unitario</th>
                                            <th style="text-align: center;">Sub total</th>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>

                                <!--=====================================
                                BOTÓN PARA AGREGAR PRODUCTO
                                ======================================-->

                                <!-- <button type="button" class="btn btn-default hidden-lg btnAgregarPedido">Agregar producto</button> -->

                                <hr>

                                <div class="row">

                                    <!--=====================================
                                    ENTRADA IMPUESTOS Y TOTAL
                                    ======================================-->
                                    <div class="col-xs-10 col-12 pull-right">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Fecha Entrega</th>
                                                    <th>Total</th>
                                                    <!-- <th>Neto</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="width: 50%">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-calendar-o" aria-hidden="true"></i></span>
                                                            <input type="date" class="form-control" id="nuevaFechaPedido" name="nuevaFechaPedido" placeholder="0000-00-00">
                                                        </div>
                                                    </td>
                                                    <td style="width: 50%">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                                                            <input type="text" class="form-control" id="nuevoTotalPedido" name="nuevoTotalPedido" total="" placeholder="00000" readonly required>
                                                            <input type="hidden" name="nuevoPrecioImpuesto" id="nuevoPrecioImpuesto">
                                                            <input type="hidden" id="impuestoPedido" name="impuestoPedido" value="18">
                                                            <input type="hidden" name="nuevoPrecioNeto" id="nuevoPrecioNeto">
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary pull-right">Guardar pedido</button>
                        </div>
                        <?php
                        $crearPedido = new controllerPedido();
                        $crearPedido->crearPedido();
                        ?>
                    </form>
                </div>
            </div>

            <!-- TABLA DE PRODUCTOS -->
            <div class="col-lg-5  col-xs-6">
                <div class="box box-warning">
                    <div class="box-header with-border"></div>
                    <div class="box-body">
                        <table id="example1" class="table  table-bordered table-striped dt-responsive tablaPedidos">

                            <thead>
                                <tr>
                                    <th>Descripcion</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $item = null;
                                $valor = null;
                                $articulos = ControladorArticulos::ctrMostrarArticulo($item, $valor);
                                foreach ($articulos as $key => $value) {
                                    if ($value["estado"] == 0) {
                                        echo '<tr>         
                                        <td>' . $value["descripcion"] . '</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary agregarProductoPedido recuperarBoton" idArticulo="' . $value["idarticulo"] . '">Agregar</button>
                                            </div>
                                        </td>
                                    </tr> ';
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>



<!-- AGREGAR PROVEEDOR -->
<div id="agregarProveedor" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data">

                <!--=====================================
                CABEZA DEL MODAL
                ======================================-->
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Agregar proveedor</h4>
                </div>

                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->
                <div class="modal-body">
                    <div class="box-body">

                        <!-- CODIGO -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-code" aria-hidden="true"></i></span>
                                <input type="number" min="0" class="form-control input-lg ruc" name="idproveedor" id="idproveedor" placeholder="Ingresar RUC" required>
                            </div>
                        </div>

                        <!-- ENTRADA PARA LA RAZÓN SOCIAL -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-users" aria-hidden="true"></i></span>
                                <input type="text" class="form-control input-lg razonsocial" name="razonsocial" placeholder="Ingresar Razón Social" required>
                            </div>
                        </div>

                        <!-- ENTRADA PARA EL DOMICILIO FISCAL -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                                <input type="text" class="form-control input-lg" name="domfiscal" placeholder="Ingresar Domicilio Fiscal" required>
                            </div>
                        </div>

                        <!-- ENTRADA PARA EL TELEFONO -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>
                                <input type="tel" class="form-control input-lg" name="telefono" placeholder="Ingresar Teléfono" required>
                            </div>
                        </div>

                        <!-- ENTRADA PARA E-MAIL -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                                <input type="mail" class="form-control input-lg" name="email" placeholder="Ingresar E-mail" required>
                            </div>
                        </div>
                    </div>
                </div>

                <!--=====================================
                PIE DEL MODAL
                ======================================-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Guardar pedido</button>
                </div>
                <?php
                $createProveedor = new ProveedorController();
                $createProveedor->createProveedorPedido();
                ?>
            </form>
        </div>
    </div>
</div>