<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>Clientes</h1>
        <ol class="breadcrumb">
            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Clientes</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box ml-4">
            <div class="box-header mb-3">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCliente">Agregar
                    cliente</button>
            </div>
            <div class="box-body">
                <table id="example1" class="table table dt-responsive" width="100%">
                    <thead>
                        <tr>
                            <th style="width: 10px;">#</th>
                            <th>RUC / Nombre</th>
                            <th>Razon social</th>
                            <th>Dirección</th>
                            <th>Teléfono</th>
                            <th>email</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $item = null;
                        $valor = null;

                        $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);

                        foreach ($clientes as $key => $value) {
                            echo '<tr>    
                                <td>' . ($key + 1) . '</td>        
                                <td>' . $value["idcliente"] . '</td>
                                <td>' . $value["razonsocial"] . '</td>
                                <td>' . $value["direccion"] . '</td>
                                <td>' . $value["telefono"] . '</td>
                                <td>' . $value["email"] . '</td>
                                <td>
                                    <button class="btn btn-warning text-white editarCliente" data-toggle="modal" data-target="#modalEditarCliente" idCliente="' . $value["idcliente"] . '"><i class="fa fa-pencil"></i></button>

                                    <button class="btn btn-danger eliminarCliente" data-toggle="modal"  idCliente="' . $value["idcliente"] . '"><i class="fa fa-times" aria-hidden="true"></i></button>
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


<!-- AGREGAR CLIENTE -->
<div id="modalAgregarCliente" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data">

                <!--=====================================
                CABEZA DEL MODAL
                ======================================-->
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Agregar cliente</h4>
                </div>

                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->
                <div class="modal-body">
                    <div class="box-body">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="radios" id="radioDNI" value="dni"
                                checked>
                            <label class="form-check-label" for="radioDNI">DNI</label>
                            <input class="form-check-input" type="radio" name="radios" id="radioRUC" value="ruc">
                            <label class="form-check-label" for="radioRUC">RUC</label>
                        </div>

                        <!-- ENTRADA PARA EL ruc -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1"><i
                                        class="fa fa-address-card"></i></span>
                                <input type="text" class="form-control input-lg " name="ruc"
                                    placeholder="Ingresar DNI/RUC" id="dni" required>
                            </div>
                        </div>

                        <!-- ENTRADA PARA Razon Social -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1"><i
                                        class="fa fa-address-card"></i></span>
                                <input type="text" class="form-control input-lg" name="razonS"
                                    placeholder="Ingresar razon social" required id="razonS" readonly>
                            </div>
                        </div>

                        <!-- ENTRADA PARA DIRECION -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1"><i class="fa fa-map-marker"
                                        aria-hidden="true"></i></span>
                                <input type="text" class="form-control input-lg" name="direccion"
                                    placeholder="Ingresar dirección" required>
                            </div>
                        </div>

                        <!-- ENTRADA PARA EL TELEFONO -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1"><i class="fa fa-phone"
                                        aria-hidden="true"></i></span>
                                <input type="tel" class="form-control input-lg" name="telefono"
                                    placeholder="Ingresar teléfono" required>
                            </div>
                        </div>

                        <!-- ENTRADA PARA EL EMAIL -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1"><i class="fa fa-envelope-o"
                                        aria-hidden="true"></i></span>
                                <input type="tel" class="form-control input-lg" name="email"
                                    placeholder="Ingresar correo">
                            </div>
                        </div>
                    </div>
                </div>

                <!--=====================================
                PIE DEL MODAL
                ======================================-->

                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Guardar cliente</button>
                </div>

                <?php
                $crearUsuario = new ControladorClientes();
                $crearUsuario->ctrCrearCliente();
                ?>

            </form>
        </div>
    </div>
</div>

<!-- EDITAR CLIENTE -->
<div id="modalEditarCliente" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data">
                <!--=====================================
                CABEZA DEL MODAL
                ======================================-->
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Editar cliente</h4>
                </div>
                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->
                <div class="modal-body">
                    <div class="box-body">

                        <!-- ENTRADA PARA EL ruc -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1"><i class="fa fa-address-card"
                                        aria-hidden="true"></i></span>
                                <input type="text" class="form-control input-lg " name="Eidcliente" value=""
                                    id="Eidcliente">
                            </div>
                        </div>

                        <!-- ENTRADA PARA Razon Social -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1"><i class="fa fa-users"
                                        aria-hidden="true"></i></span>
                                <input type="text" class="form-control input-lg" name="ErazonS" id="ErazonS">
                            </div>
                        </div>

                        <!-- ENTRADA PARA DIRECION -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1"><i class="fa fa-map-marker"
                                        aria-hidden="true"></i></span>
                                <input type="text" class="form-control input-lg" name="Edireccion" id="Edireccion">
                            </div>
                        </div>

                        <!-- ENTRADA PARA EL TELEFONO -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1"><i class="fa fa-phone"
                                        aria-hidden="true"></i></span>
                                <input type="tel" class="form-control input-lg" name="Etelefono" id="Etelefono">
                            </div>
                        </div>

                        <!-- ENTRADA PARA EL EMAIL -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1"><i class="fa fa-envelope-o"
                                        aria-hidden="true"></i></span>
                                <input type="tel" class="form-control input-lg" name="Eemail" id="Eemail">
                            </div>
                        </div>
                    </div>
                </div>
                <!--=====================================
                PIE DEL MODAL
                ======================================-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Modificar cliente</button>
                </div>
                <?php
                $editarUsuario = new ControladorClientes();
                $editarUsuario->ctrEditarCliente();
                ?>
            </form>
        </div>
    </div>
</div>

<?php
$borrarUsuario = new ControladorClientes();
$borrarUsuario->ctrBorrarCliente();
?>