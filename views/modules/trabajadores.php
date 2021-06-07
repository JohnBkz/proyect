<div class="content-wrapper">

    <section class="content-header">
        <h1>
            Usuarios
            <small>Administrar usuarios</small>
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
                <button class="btn btn-primary" data-toggle="modal" data-target="#agregarUsuario">
                    Agregar usuario
                </button>
            </div>
            <div class="box-body">
                <table id="User" class="table table dt-responsive" width="100%">
                    <thead>
                        <tr>
                            <th style="width:10px;">DNI</th>
                            <th>Horario</th>
                            <th>Usuario</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Foto</th>
                            <th>Perfil</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $item = null;
                        $valor = null;
                        $usuarios = UsuarioController::MostrarUsuarios($item, $valor);

                        foreach ($usuarios as $key => $value) {
                            echo '
                            <tr>
                                <td>' . $value["idusuario"] . '</td>
                                <td>' . $value["nombrehorario"] . '</td>
                                <td>' . $value["user"] . '</td>
                                <td>' . $value["nombres"] . '</td>
                                <td>' . $value["apellidos"] . '</td>
                            ';

                            if ($value["foto"] != "") {
                                echo '<td><img src="' . $value["foto"] . '" class="img-thumbnail" width="40px"></td>';
                            } else {
                                echo '<td><img src="views/img/usuarios/default/anonymous.png" class="img-thumbnail" width="40px"></td>';
                            }
                            echo '
                                <td>' . $value["description"] . '</td>';
                            if ($value["estado"] == 0) {

                                echo '<td><button class="btn btn-success btn-xs btnActivar act"  idUsuario="' . $value["idusuario"] . '" estadoUsuario="1" data-toggle="tooltip" data-placement="top" title="click para activar">Activado</button></td>';
                                //     <button type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top">
                                //     Tooltip on top
                                //   </button>
                            } else {

                                echo '<td><button class="btn btn-danger btn-xs btnActivar desc" idUsuario="' . $value["idusuario"] . '" estadoUsuario="0" data-bs-toggle="tooltip" data-bs-placement="top" title="Click para desactivar">Desactivado</button></td>';
                            }

                            echo '<td>
                                    <button class="btn btn-warning EditarUsuario" data-toggle="modal" data-target="#EditarUsuario" idusuario="' . $value["idusuario"] . '"><i class="fa fa-pencil text-white"></i></button>

                                    <button class="btn btn-danger EliminarUsuario" data-toggle="modal" aria-hidden="true" idusuario="' . $value["idusuario"] . '"  fotoUsuario="' . $value["foto"] . '" usuario="' . $value["user"] . '" ><i class="fa fa-times"></i></button>
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
MODAL AGREGAR USUARIO
======================================-->
<div id="agregarUsuario" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data">
                <!--== CABEZA DEL MODAL ==-->
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Agregar usuario</h4>
                </div>

                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->
                <div class="modal-body">
                    <div class="box-body">

                        <!-- ENTRADA PARA EL DNI -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-address-card"
                                        aria-hidden="true"></i></span>
                                <input type="text" class="form-control input-lg dni" name="iduser" id="iduser"
                                    placeholder="Ingresar DNI" required>
                            </div>
                        </div>
                        <!-- ENTRADA PARA EL USUARIO -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input type="text" class="form-control input-lg usuario" name="usuario"
                                    placeholder="Ingresar usuario" id="nuevoUsuario" required>
                            </div>
                        </div>
                        <!-- ENTRADA PARA LA CONTRASEÑA -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" class="form-control input-lg" name="password"
                                    placeholder="Ingresar contraseña" required>
                            </div>
                        </div>
                        <!-- ENTRADA PARA EL NOMBRE -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control input-lg" name="nombres"
                                    placeholder="Ingresar nombre" required>
                            </div>
                        </div>
                        <!-- ENTRADA PARA EL APELLIDO -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                                <input type="text" class="form-control input-lg" name="apellidos"
                                    placeholder="Ingresar apellido" required>
                            </div>
                        </div>
                        <!-- ENTRADA PARA SELECCIONAR SU PERFIL -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                <select class="form-control input-lg" name="perfil">
                                    <option value="" selected disabled>Selecionar perfil</option>
                                    <?php
                                    $perfiles = UsuarioController::showPerfiles();
                                    foreach ($perfiles as $perfil) {
                                        echo '<option value="' . $perfil['idperfil'] . '">' . $perfil['description'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <!-- ENTRADA PARA SELECCIONAR SU HORARIO -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                <select class="form-control input-lg" name="horario">
                                    <option value="" selected disabled>Selecionar Horario</option>
                                    <option value="1">12 Horas</option>
                                    <option value="2">8 Horas</option>
                                    <option value="3">4 Horas</option>
                                </select>
                            </div>
                        </div>
                        <!-- ENTRADA PARA SUBIR FOTO -->
                        <div class="form-group">
                            <div class="panel">SUBIR FOTO</div>
                            <input type="file" class="foto" name="foto">
                            <img src="views/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar"
                                width="100px">
                        </div>
                    </div>
                </div>

                <!--=====================================
                PIE DEL MODAL
                ======================================-->

                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Guardar usuario</button>
                </div>

                <?php
                $crearUsuario = new UsuarioController();
                $crearUsuario->createUsuario();
                ?>
            </form>
        </div>
    </div>
</div>

<!--=====================================
MODAL EDITAR USUARIO
======================================-->
<div id="EditarUsuario" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data">
                <!--=====================================
                CABEZA DEL MODAL
                ======================================-->
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Editar usuario</h4>
                </div>
                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->
                <div class="modal-body">
                    <div class="box-body">

                        <!-- ENTRADA PARA EL DNI -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-address-card"
                                        aria-hidden="true"></i></span>
                                <input type="text" class="form-control input-lg iduser" name="Eiduser" id="Eiduser"
                                    readonly>
                            </div>
                        </div>
                        <!-- ENTRADA PARA EL USUARIO -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input type="text" class="form-control input-lg" name="Eusuario" id="Eusuario" readonly>
                            </div>
                        </div>
                        <!-- ENTRADA PARA LA CONTRASEÑA -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" class="form-control input-lg" name="Epassword" id="Epassword">
                                <input type="hidden" id="passwordActual" name="passwordActual">
                            </div>
                        </div>
                        <!-- ENTRADA PARA EL NOMBRE -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control input-lg" name="Enombres" id="Enombres">
                            </div>
                        </div>
                        <!-- ENTRADA PARA EL APELLIDO -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                                <input type="text" class="form-control input-lg" name="Eapellidos" id="Eapellidos">
                            </div>
                        </div>
                        <!-- ENTRADA PARA SELECCIONAR SU HORARIO -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                <select class="form-control input-lg" name="Ehorario">
                                    <option id="horario" class="horario" selected></option>
                                </select>
                            </div>
                        </div>
                        <!-- ENTRADA PARA SELECCIONAR SU PERFIL -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                <select class="form-control input-lg" name="Eperfil">
                                    <option id="perfil" class="perfil" selected></option>
                                </select>
                            </div>
                        </div>
                        <!-- ENTRADA PARA SUBIR FOTO -->
                        <div class="form-group">
                            <div class="panel">SUBIR FOTO</div>
                            <input type="file" id="Efoto" name="Efoto" calss="foto">
                            <input type="hidden" name="fotoActual" id="fotoActual">
                            <img src="views/img/usuarios/default/anonymous.png"
                                class="img-thumbnail previsualizar Eprevisualizar" width="100px">
                        </div>
                    </div>
                </div>
                <!-- footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Modificar usuario</button>
                </div>
                <?php
                $editarUsuario = new UsuarioController();
                $editarUsuario->editUsuario();
                ?>
            </form>
        </div>
    </div>
</div>

<?php
$borrarUsuario = new UsuarioController();
$borrarUsuario->deleteUsuario();
?>