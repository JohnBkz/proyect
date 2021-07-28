<div class="content-wrapper">

    <section class="content-header">
        <h1>
            Trabajadores
            <small>Administrar trabajadores</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="empresas"><i class="fa fa-building-o"></i> Empresas</a></li>
            <li class="active">Trabajadores</li>
        </ol>

    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box ml-4">
            <div class="box-header mb-3">
                <button class="btn btn-primary" data-toggle="modal" data-target="#agregarTrabajador">Agregar
                    trabajador</button>
                <button class="btn btn-success"><i class="fa fa-cloud-upload" aria-hidden="true"></i> Importar</button>
            </div>
            <div class="box-body">
                <table id="User" class="table table dt-responsive" width="100%">
                    <thead>
                        <tr>
                            <th style="width:10px;">DNI</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Empresa</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <!-- <tbody> -->
                    <?php
                    $item = null;
                    $valor = null;
                    $trabajador = trabajadorController::mostrarTrabajador($item, $valor);
                    foreach ($trabajador as $key => $value) {
                        echo '
                        <tr>
                            <td>' . $value["dnitrabajador"] . '</td>
                            <td>' . $value["nombres"] . '</td>
                            <td>' . $value["apellidos"] . '</td>
                            <td>' . $value["empresa"] . '</td>                            
                        ';
                        echo '<td>
                                <button class="btn btn-warning EditarTrabajador" data-toggle="modal" data-target="#EditarTrabajador" idtrabajador="' . $value["dnitrabajador"] . '" idtraba="' . $value["idtrabajador"] . '"><i class="fa fa-pencil text-white"></i></button>
                                <button class="btn btn-danger EliminarTrabajador" data-toggle="modal" aria-hidden="true" idtrabajador="' . $value["idtrabajador"] . '"   ><i class="fa fa-times"></i></button>
                            </td>
                        </tr>';
                    }
                    ?>
                    <!-- </tbody> -->
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!--=====================================
MODAL AGREGAR TRABAJADOR
======================================-->
<div id="agregarTrabajador" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data">
                <!--== CABEZA DEL MODAL ==-->
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <button type="button" class="close closeB" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Agregar trabajador</h4>
                </div>

                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->
                <div class="modal-body">
                    <div class="box-body">
                        <input type="hidden" id="empresaHidden" name="empresaHidden">

                        <!-- ENTRADA PARA LA EMPRESA -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-building-o"
                                        aria-hidden="true"></i></span>
                                <select class="form-control input-lg" name="empresaT" id="selecA">
                                    <option disabled selected id="traAgre" value="0">Seleccionar empresa</option>
                                    <?php
                                    $item = null;
                                    $valor = null;
                                    $empresa = empresaController::mostrarEmpresa($item, $valor);
                                    foreach ($empresa as $key => $value) {
                                        echo '<option value="' . $value["rucempresa"] . '" id="agregarE"> ' . $value["nombre"] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <!-- DNI TRABAJADOR -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-id-card-o"
                                        aria-hidden="true"></i></span>
                                <input type="text" class="form-control input-lg dniTrabajador" name="dniTrabajador"
                                    id="dniTrabajadorC" placeholder="Ingresar DNI">
                            </div>
                        </div>
                        <!-- ENTRADA PARA EL NOMBRE -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input type="text" class="form-control input-lg usuario" name="nombreTra" id="nombreTra"
                                    placeholder="Ingresar nombre" required>
                            </div>
                        </div>
                        <!-- ENTRADA PARA APELLIDO -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                                <input type="text" class="form-control input-lg" name="apellidoTra" id="apellidoTra"
                                    placeholder="Ingresar apellido">
                            </div>
                        </div>
                    </div>
                </div>

                <!--=====================================
                PIE DEL MODAL
                ======================================-->

                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left closeB" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Guardar trabajador</button>
                </div>
                <?php
                $crearTrabajador = new trabajadorController();
                $crearTrabajador->crearTrabajador();
                ?>
            </form>
        </div>
    </div>
</div>

<!--=====================================
MODAL EDITAR TRABAJADOR
======================================-->
<div id="EditarTrabajador" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data">
                <!--=====================================
                CABEZA DEL MODAL
                ======================================-->
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Editar trabajador</h4>
                </div>
                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->
                <div class="modal-body">
                    <div class="box-body">

                        <!-- ENTRADA PARA LA EMPRESA -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-building-o"
                                        aria-hidden="true"></i></span>
                                <select class="form-control input-lg" name="empresaTE">
                                    <option disabled selected id="empresaTE"></option>
                                </select>
                            </div>
                        </div>
                        <!-- DNI TRABAJADOR -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-id-card-o"
                                        aria-hidden="true"></i></span>
                                <input type="text" class="form-control input-lg" name="dniTrabajadorE"
                                    id="dniTrabajadorE">
                            </div>
                        </div>
                        <!-- ID TRABAJADOR -->
                        <input type="hidden" name="idTrabajdorE" id="idTrabajdorE">
                        <!-- ENTRADA PARA EL NOMBRE -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input type="text" class="form-control input-lg usuario" name="nombreTraE"
                                    id="nombreTraE" required>
                            </div>
                        </div>
                        <!-- ENTRADA PARA APELLIDO -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                                <input type="text" class="form-control input-lg" name="apellidoTraE" id="apellidoTraE">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Modificar trabajador</button>
                </div>
                <?php
                $editarTrabajador = new trabajadorController();
                $editarTrabajador->editarTrabajador();
                ?>
            </form>
        </div>
    </div>
</div>

<?php
$borrarTrabajador = new trabajadorController();
$borrarTrabajador->deleteTrabajador();
?>