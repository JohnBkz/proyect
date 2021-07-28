<div class="content-wrapper">

    <section class="content-header">
        <h1>
            Autos
            <small>Administrar autos</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="empresas"><i class="fa fa-building-o"></i> Empresas</a></li>
            <li class="active">Autos</li>
        </ol>

    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box ml-4">
            <div class="box-header mb-3">
                <button class="btn btn-primary" data-toggle="modal" data-target="#agregarAuto">Agregar
                    auto</button>
            </div>
            <div class="box-body">
                <table id="User" class="table table dt-responsive" width="100%">
                    <thead>
                        <tr>
                            <th style="width:10px;">#</th>
                            <th>Placa</th>
                            <th>KM</th>
                            <th>Empresa</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $item = null;
                        $valor = null;
                        $auto = autosController::mostrarAuto($item, $valor);

                        foreach ($auto as $key => $value) {
                            echo '
                            <tr>
                                <td>' . ($key + 1) . '</td>
                                <td>' . $value["placa"] . '</td>
                                <td>' . $value["km"] . '</td>
                                <td>' . $value["empresa"] . '</td>                            
                            ';
                            echo '<td>
                                    <button class="btn btn-warning editarAuto" data-toggle="modal" data-target="#editarAuto" idvehiculo="' . $value["idvehiculo"] . '"><i class="fa fa-pencil text-white"></i></button>
                                    <button class="btn btn-danger eliminarAuto" data-toggle="modal" aria-hidden="true" idvehiculo="' . $value["idvehiculo"] . '"   ><i class="fa fa-times"></i></button>
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

<!--=====================================
MODAL AGREGAR AUTO
======================================-->
<div id="agregarAuto" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data">
                <!--== CABEZA DEL MODAL ==-->
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Agregar auto</h4>
                </div>

                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->
                <div class="modal-body">
                    <div class="box-body">

                        <!-- ENTRADA PARA LA PLACA -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-car" aria-hidden="true"></i></span>
                                <input type="text" class="form-control input-lg placaAuto" name="placa" id="placa"
                                    placeholder="Ingresar placa" required>
                            </div>
                        </div>
                        <!-- ENTRADA PARA EL KILOMETRAJE -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-tachometer"
                                        aria-hidden="true"></i></span>
                                <input type="text" class="form-control input-lg " name="kilometraje"
                                    placeholder="Ingresar kilometraje" id="kilometraje" required>
                            </div>
                        </div>
                        <!-- ENTRADA PARA LA EMPRESA-->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-building-o"></i></span>
                                <select class="form-control input-lg" name="empresaAuto">
                                    <option disabled selected>Seleccionar empresa</option>
                                    <?php
                                    $item = null;
                                    $valor = null;
                                    $empresa = empresaController::mostrarEmpresa($item, $valor);
                                    foreach ($empresa as $key => $value) {
                                        echo '<option value="' . $value["rucempresa"] . '">' . $value["nombre"] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!--=====================================
                PIE DEL MODAL
                ======================================-->

                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Guardar auto</button>
                </div>
                <?php
                $crearAuto = new autosController();
                $crearAuto->crearAuto();
                ?>
            </form>
        </div>
    </div>
</div>

<!--=====================================
MODAL EDITAR AUTO
======================================-->
<div id="editarAuto" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data">
                <!--== CABEZA DEL MODAL ==-->
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Editar auto</h4>
                </div>

                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->
                <div class="modal-body">
                    <div class="box-body">

                        <!-- ENTRADA PARA LA PLACA -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-car" aria-hidden="true"></i></span>
                                <input type="text" class="form-control input-lg placaAuto" name="placaE" id="placaE"
                                    required>
                            </div>
                        </div>
                        <!-- ENTRADA PARA EL KILOMETRAJE -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-tachometer"
                                        aria-hidden="true"></i></span>
                                <input type="text" class="form-control input-lg " name="kilometrajeE" id="kilometrajeE"
                                    required>
                            </div>
                        </div>
                        <!-- ENTRADA PARA LA EMPRESA-->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-building-o"></i></span>
                                <select class="form-control input-lg" name="empresaAutoE">
                                    <option disabled selected id="empresaAutoE"></option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!--=====================================
                PIE DEL MODAL
                ======================================-->

                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Editar auto</button>
                </div>
                <?php
                $editarAuto = new autosController();
                $editarAuto->editarAuto();
                ?>
            </form>
        </div>
    </div>
</div>

<?php
$borrarAuto = new autosController();
$borrarAuto->deleteAuto();
?>