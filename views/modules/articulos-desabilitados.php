<div class="content-wrapper">

    <section class="content-header">
        <h1>Articulos Deshabilitados</h1>
        <ol class="breadcrumb">
            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Articulos Deshabilitados</li>
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
                            <th style="width: 10px;">#</th>
                            <th>Descripción</th>
                            <th>Categoría</th>
                            <th>Cantidad</th>
                            <th>Precio Venta</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $item = null;
                        $valor = null;
                        $articulos = ControladorArticulos::ctrMostrarArticulo($item, $valor);


                        foreach ($articulos as $key => $value) {
                            if ($value["estado"] == 1) {
                                echo '<tr>    
                                <td>' .  $value["idarticulo"] . '</td>        
                                <td>' . $value["descripcion"] . '</td>
                                <td>' . $value["tipoArt"] . '</td>
                                <td>' . $value["cantidad"] . '</td>
                                <td>' . $value["precioventa"] . '</td>
                                <td>
                                    <div class="btn-group">
                                    <button class="btn btn-danger btnActivarArt" id="btnActivar" idArticulo="' . $value["idarticulo"] . '" estadoArticulo="1" >Habilitar</button>
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




<?php
$borrarArticulo = new ControladorArticulos();
$borrarArticulo->ctrBorrarArticulos();
?>