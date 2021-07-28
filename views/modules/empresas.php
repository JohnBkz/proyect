<div class="content-wrapper">

    <section class="content-header">
        <h1>
            Empresas
            <small>Administrar empresas</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Tablero</li>
        </ol>

    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box ml-4">
            <div class="box-header mb-3">
                <div class="row">
                    <div class="col-lg-4">
                        <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#agregarEmpresa">Agregar empresa</button> -->
                    </div>
                    <div class="col-lg-4">
                        <button class="btn btn-primary">
                            <a href="trabajadores" class="text-white" style="color: #fff;">
                                <i class="fa fa-users" aria-hidden="true"></i>
                                <span>Trabajadores</span>
                            </a>
                        </button>
                    </div>
                    <div class="col-lg-4">
                        <button class="btn btn-primary">
                            <a href="autos" class="text-white" style="color: #fff;">
                                <i class="fa fa-car" aria-hidden="true"></i>
                                <span>Vehículos</span>
                            </a>
                        </button>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <table id="User" class="table table dt-responsive empresas" width="100%">
                    <thead>
                        <tr>
                            <th style="width:10px;">#</th>
                            <th style="width:10px;">RUC</th>
                            <th>Nombre</th>
                            <th>Domicilio Fiscal</th>
                            <th>Monto</th>
                            <th>Monto restante</th>
                            <th>Monto faltante</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $item = null;
                        $valor = null;
                        $empresa = empresaController::mostrarEmpresa($item, $valor);

                        foreach ($empresa as $key => $value) {
                            echo '
                            <tr>
                            <td>' . ($key + 1) . '</td>
                                <td>' . $value["rucempresa"] . '</td>
                                <td>' . $value["nombre"] . '</td>
                                <td>' . $value["domiciliofiscal"] . '</td>
                                <td>' . $value["monto"] . '</td>
                                <td>' . $value["montorestante"] .
                                '</td><td>' . $value["montofaltante"] . '</td>
                            ';
                            echo '<td>
                                    <button class="btn btn-warning EditarEmpresa" data-toggle="modal" data-target="#EditarEmpresa" idempresa="' . $value["rucempresa"] . '"><i class="fa fa-pencil text-white"></i></button>

                                    <button class="btn btn-danger EliminarEmpresa" data-toggle="modal" aria-hidden="true" idempresa="' . $value["rucempresa"] .
                                '"   ><i class="fa fa-times"></i></button>

                                <button class="btn btn-success agregarTrabajador" data-toggle="modal" data-target="#agregarTrabajador" idempresa="' . $value["rucempresa"] . '"><i class="fa fa-user-plus" aria-hidden="true"></i></button>

                                <button class="btn btn-success detEmpresa"  idempresa="' . $value["rucempresa"] . '" nomEmpresa="' . $value["nombre"] . '"><i class="fa fa-eye" aria-hidden="true"></i></button>
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
MODAL AGREGAR EMPRESA
======================================-->
<div id="agregarEmpresa" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data">
                <!--== CABEZA DEL MODAL ==-->
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Agregar empresa</h4>
                </div>

                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->
                <div class="modal-body">
                    <div class="box-body">

                        <!-- ENTRADA PARA EL RUC -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-address-card"
                                        aria-hidden="true"></i></span>
                                <input type="text" class="form-control input-lg rucEmpresa" name="rucEmpresa"
                                    id="rucEmpresa" placeholder="Ingresar RUC" required>
                            </div>
                        </div>
                        <!-- ENTRADA PARA EL NOMBRE -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input type="text" class="form-control input-lg usuario" name="nombreEmpresa"
                                    placeholder="Ingresar nombre" id="nombreEmpresa" required>
                            </div>
                        </div>
                        <!-- ENTRADA PARA LA DOMICILIO FISCAL -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="text" class="form-control input-lg" name="domicilioF" id="domicilioF"
                                    placeholder="Ingresar domicilio F">
                            </div>
                        </div>
                        <!-- ENTRADA PARA EL MONTO -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="number" class="form-control input-lg" name="montoEmpresa" id="montoEmpresa"
                                    placeholder="000000" min="0" required>
                            </div>
                        </div>
                    </div>
                </div>

                <!--=====================================
                PIE DEL MODAL
                ======================================-->

                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Guardar empresa</button>
                </div>
                <?php
                $crearEmpresa = new empresaController();
                $crearEmpresa->crearEmpresa();
                ?>
            </form>
        </div>
    </div>
</div>

<!--=====================================
MODAL EDITAR EMPRESA
======================================-->
<div id="EditarEmpresa" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data">
                <!--=====================================
                CABEZA DEL MODAL
                ======================================-->
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Editar empresa</h4>
                </div>
                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->
                <div class="modal-body">
                    <div class="box-body">

                        <!-- ENTRADA PARA EL RUC -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-address-card"
                                        aria-hidden="true"></i></span>
                                <input type="text" class="form-control input-lg" name="rucEmpresaE" id="rucEmpresaE"
                                    placeholder="Ingresar RUC" required>
                            </div>
                        </div>
                        <!-- ENTRADA PARA EL NOMBRE -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input type="text" class="form-control input-lg usuario" name="nombreEmpresaE"
                                    placeholder="Ingresar nombre" id="nombreEmpresaE" required>
                            </div>
                        </div>
                        <!-- ENTRADA PARA LA DOMICILIO FISCAL -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="text" class="form-control input-lg" name="domicilioFE" id="domicilioFE"
                                    placeholder="Ingresar domicilio F">
                            </div>
                        </div>
                        <!-- ENTRADA PARA EL MONTO -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="number" class="form-control input-lg" name="montoEmpresaE"
                                    id="montoEmpresaE" placeholder="000000" min="0" required>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Modificar empresa</button>
                </div>
                <?php
                $editarEmpresa = new empresaController();
                $editarEmpresa->editarEmpresa();
                ?>
            </form>
        </div>
    </div>
</div>

<?php
$borrarEmpresa = new empresaController();
$borrarEmpresa->deleteEmpresa();
?>

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
                        <!-- DNI TRABAJADOR -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-id-card-o"
                                        aria-hidden="true"></i></span>
                                <input type="text" class="form-control input-lg dniTrabajador" name="dniTrabajador"
                                    id="dniTrabajador" placeholder="Ingresar DNI" require>
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
                        <!-- ENTRADA PARA EL AUTO -->
                        <!-- ENTRADA PARA LA PLACA -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-car" aria-hidden="true"></i></span>
                                <input type="text" class="form-control input-lg placaAuto" name="placa" id="placaTrab"
                                    placeholder="Ingresar placa" required>
                            </div>
                        </div>
                    </div>
                </div>

                <!--=====================================
                PIE DEL MODAL
                ======================================-->

                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left closeB" data-dismiss="modal">Salir</button>
                    <button type="button" class="btn btn-primary agregarTraba">Guardar trabajador</button>
                </div>
                <?php
                // $crearTrabajador = new trabajadorController();
                // $crearTrabajador->crearTrabajador();
                ?>
            </form>
        </div>
    </div>
</div>