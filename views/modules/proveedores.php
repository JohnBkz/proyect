<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>Prooveedores</h1>
        <ol class="breadcrumb">
            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Prooveedores</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box ml-4">
            <div class="box-header mb-3">
                <button class="btn btn-primary" data-toggle="modal" data-target="#agregarProveedor">
                    Agregar Proveedor
                </button>
            </div>
            <div class="box-body">
                <table id="example1" class="table table dt-responsive" width="100%">
                    <thead>
                        <tr>
                            <th style="width: 10px;">ID</th>
                            <th>Razón Social</th>
                            <th>Dominio Fiscal</th>
                            <th>Teléfono</th>
                            <th>E-mail</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $item = null;
                        $valor = null;
                        $proveedor = ProveedorController::MostrarPorveedores($item, $valor);

                        foreach ($proveedor as $key => $value) {
                            echo '<tr>
                                <td>' . $value["idproveedor"] . '</td>
                                <td>' . $value["razonsocial"] . '</td>
                                <td>' . $value["domfiscal"] . '</td>
                                <td>' . $value["telefono"] . '</td>
                                <td>' . $value["email"] . '</td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-warning editarProveedor" idproveedor="' . $value["idproveedor"] . '" data-toggle="modal" data-target="#EditarProveedor"><i class="fa fa-pencil text-white"></i></button>

                                        <button class="btn btn-danger eliminarProveedor" data-toggle="modal" idproveedor="' . $value["idproveedor"] . '" aria-hidden="true"><i class="fa fa-times"></i></button>
                                    </div>
                                </td>
                            </tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

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
                    <button type="submit" class="btn btn-primary">Guardar proveedor</button>
                </div>
                <?php
                $createProveedor = new ProveedorController();
                $createProveedor->createProveedor();
                ?>
            </form>
        </div>
    </div>
</div>

<!-- EDITAR PROVEEDOR -->
<div id="EditarProveedor" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data">

                <!--=====================================
                CABEZA DEL MODAL
                ======================================-->
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Editar proveedor</h4>
                </div>

                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->
                <div class="modal-body">
                    <div class="box-body">

                        <!-- CÓDIGO -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-code" aria-hidden="true"></i></span>
                                <input type="text" class="form-control input-lg" name="Eidproveedor" value="" id="Eidproveedor">
                            </div>
                        </div>

                        <!-- RAZÓN SOCIAL -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-users" aria-hidden="true"></i></span>
                                <input type="text" class="form-control input-lg" name="Erazonsocial" id="Erazonsocial">
                            </div>
                        </div>

                        <!-- DOMICILIO FISCAL -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                                <input type="text" class="form-control input-lg" name="Edomfiscal" id="Edomfiscal">
                            </div>
                        </div>

                        <!-- TELÉFONO -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>
                                <input type="tel" class="form-control input-lg" name="Etelefono" id="Etelefono">
                            </div>
                        </div>

                        <!-- EMAIL -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                                <input type="mail" class="form-control input-lg" name="Eemail" id="Eemail">
                            </div>
                        </div>

                    </div>
                </div>

                <!--=====================================
                PIE DEL MODAL
                ======================================-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Modificar proveedor</button>
                </div>
                <?php
                $editarProveedor = new ProveedorController();
                $editarProveedor->editarProveedor();
                ?>
            </form>
        </div>
    </div>
</div>

<?php
$borrarProveedor = new ProveedorController();
$borrarProveedor->deleteProveedor();
?>