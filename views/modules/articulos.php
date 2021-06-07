<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>Articulos Habilitados</h1>
        <ol class="breadcrumb">
            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Articulos Habilitados</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box ml-4">
            <div class="box-header mb-3">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarArticulo">
                    Agregar artículo
                </button>
            </div>
            <div class="box-body">
                <table id="example1" class="table table dt-responsive" width="100%">
                    <thead>
                        <tr>
                            <th style="width: 10px;">#</th>
                            <th>Descripción</th>
                            <th>Unidad</th>
                            <th>Categoría</th>
                            <th>Cantidad</th>
                            <th>Precio Venta</th>
                            <th>Valor Venta</th>
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
                                <td>' .  $value["idarticulo"]  . '</td>        
                                <td>' . $value["descripcion"] . '</td>
                                <td>' . $value["unidad"] . '</td>
                                <td>' . $value["tipoArt"] . '</td>
                                <td>' . $value["cantidad"] . '</td>
                                <td>' . $value["precioventa"] . '</td>
                                <td>' . $value["valorventa"] . '</td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-warning mr-1 EditarArticulo" idArticulo="' . $value["idarticulo"] . '" data-toggle="modal" data-target="#EditarArticulo"><i class="fa fa-pencil text-white"></i></button>

                                        <button class="btn btn-danger EliminarArticulo" id="eliminarArticulo" idArticulo="' . $value["idarticulo"] . '" estadoArticulo="' . $value["estado"] . '" ><i class="fa fa-times"></i></button>
                                    </div>
                                </td>
                            </tr> ';
                            }
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


<!-- AGREGAR ARTICULO -->
<div id="modalAgregarArticulo" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data">
                <!--=====================================
                CABEZA DEL MODAL
                ======================================-->
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Agregar articulo</h4>
                </div>
                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->
                <div class="modal-body">
                    <div class="box-body">

                        <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-th" aria-hidden="true"></i></span>
                                <select class="form-control input-lg" name="categoria">
                                    <option disabled selected>Seleccionar categoría</option>
                                    <?php
                                    $item = null;
                                    $valor = null;
                                    $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);
                                    foreach ($categorias as $key => $value) {
                                        echo '<option value="' . $value["idtipo"] . '">' . $value["descripcion"] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <!-- ENTRADA PARA ID -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-code" aria-hidden="true"></i></span>
                                <input type="text" class="form-control input-lg" name="idArticulo"
                                    placeholder="Ingresar código articulo" required>
                            </div>
                        </div>

                        <!-- ENTRADA PARA LA DESCRIPSION -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-product-hunt"
                                        aria-hidden="true"></i></span>
                                <input type="text" class="form-control input-lg" name="descripcion"
                                    placeholder="Ingresar descripsion" required>
                            </div>
                        </div>

                        <!-- ENTRADA PARA LA UNIDAD -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-underline"
                                        aria-hidden="true"></i></span>
                                <select class="form-control input-lg" name="unidad">
                                    <option selected disabled>Seleccionar Unidad</option>
                                    <option value="Uni">Unidad</option>
                                    <option value="Gal">Galones</option>
                                </select>
                            </div>
                        </div>

                        <!-- ENTRADA PARA CANTIDAD -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-check" aria-hidden="true"></i></span>
                                <input type="number" min="0" class="form-control input-lg" name="cantidad"
                                    placeholder="Ingresar cantidad">
                            </div>
                        </div>

                        <!-- ENTRADA PARA PRECIO VENTA -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-arrow-down"
                                        aria-hidden="true"></i></span>
                                <input type="number" min="0" class="form-control input-lg" name="pVenta"
                                    placeholder="Ingresar precio venta" required>
                            </div>
                        </div>

                    </div>
                </div>
                <!--=====================================
                PIE DEL MODAL
                ======================================-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Agregar articulo</button>
                </div>
                <?php
                $crearArticulo = new ControladorArticulos();
                $crearArticulo->ctrCrearArticulo();
                ?>
            </form>
        </div>
    </div>
</div>

<!-- EDITAR ARTICULO -->
<div id="EditarArticulo" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data">
                <!--=====================================
                CABEZA DEL MODAL
                ======================================-->
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Editar articulo</h4>
                </div>
                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->
                <div class="modal-body">
                    <div class="box-body">

                        <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-th" aria-hidden="true"></i></span>
                                <select class="form-control input-lg" name="categoria">
                                    <option id="idtipo" selected></option>
                                </select>
                            </div>
                        </div>

                        <!-- ENTRADA PARA ID -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-code" aria-hidden="true"></i></span>
                                <input type="text" class="form-control input-lg" name="EidArticulo" id="idArticulo">
                            </div>
                        </div>

                        <!-- ENTRADA PARA LA DESCRIPSION -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-product-hunt"
                                        aria-hidden="true"></i></span>
                                <input type="text" class="form-control input-lg" name="descripcion" id="descripcion">
                            </div>
                        </div>

                        <!-- ENTRADA PARA LA UNIDAD -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-underline"
                                        aria-hidden="true"></i></span>
                                <select class="form-control input-lg" name="Eunidad">
                                    <option value="" id="editarUnidad" selected disabled></option>
                                    <option value="Unidad">Unidad</option>
                                    <option value="Galones">Galones</option>
                                </select>
                            </div>
                        </div>

                        <!-- ENTRADA PARA CANTIDAD -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-check" aria-hidden="true"></i></span>
                                <input type="number" min="0" class="form-control input-lg" name="cantidad"
                                    id="cantidad">
                            </div>
                        </div>

                        <!-- ENTRADA PARA PRECIO VENTA -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-arrow-down"
                                        aria-hidden="true"></i></span>
                                <input type="number" min="0" class="form-control input-lg" name="pVenta" id="pVenta">
                            </div>
                        </div>

                    </div>
                </div>
                <!--=====================================
                PIE DEL MODAL
                ======================================-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Modificar articulo</button>
                </div>
                <?php
                    $editarArticulo = new ControladorArticulos();
                    $editarArticulo->ctrEditarticulo();
                ?>
            </form>
        </div>
    </div>
</div>

<?php
$borrarArticulo = new ControladorArticulos();
$borrarArticulo->ctrBorrarArticulos();
?>