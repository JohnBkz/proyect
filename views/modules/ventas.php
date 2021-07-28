<div class="content-wrapper">

    <section class="content-header">
        <h1>Administrar ventas</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Administrar ventas</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <a href="crear-venta">
                    <button class="btn btn-primary">
                        Realizar Venta
                    </button>
                </a>
            </div>
            <div class="box-body">
                <table id="example1" class="table table dt-responsive" width="100%">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Comprobante</th>
                            <th>Usuario</th>
                            <th>Cliente</th>
                            <th>Fecha E</th>
                            <th>Fecha C</th>
                            <th>Método Pago</th>
                            <th>Total</th>
                            <th>Detalle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $item = null;
                        $valor = null;
                        $ventas = VentasController::mostrarVentas($item, $valor);

                        foreach ($ventas as $value) {
                            echo '
                            <tr>';
                            $valorVenta= $value["codecomprobante"];

                            for ($i=0; $i <= strlen($valorVenta); $i++) { 
                                if (is_numeric($valorVenta[$i]))
                               {
                                  $valor = $i;
                                  break;
                               }
                            }
                             
                            
                            $nroDocum = substr($valorVenta,$valor);

                            if ($nroDocum < 10) {
                                $nroDocum = "000" . $nroDocum;
                              } else if ($nroDocum < 100) {
                                $nroDocum = "00" . $nroDocum;
                              } else if ($nroDocum < 1000) {
                                $nroDocum = "0" . $nroDocum;
                               } else {
                                $nroDocum = $nroDocum;
                              }


                            echo '  <td>' .  $nroDocum . '</td>
                            <td>' . $value["comprobante"] . '</td>';

                            $itemUsuario = "idusuario";
                            $valorUsuario = $value["idusuario"];
                            $respuestaUsuario = UsuarioController::MostrarUsuarios($itemUsuario, $valorUsuario);
                            echo '   <td>' . $respuestaUsuario["nombres"] . '</td>';
                            $itemCliente = "idcliente";
                            $valorCliente = $value["idcliente"];
                            $respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);
                            echo '<td>' . $respuestaCliente["razonsocial"] . '</td>
                                <td>' . $value["fechaemision"] . '</td>
                                <td>' . $value["fechacancelacion"] . '</td>
                                
                                <td>' . $value["metpago"] . '</td>
                                <td>S/' . $value["total"] . '</td>
                                <td class="text-center">
                                    <button class="btn btn-success DetalleVenta" data-toggle="modal" data-target="#DetalleVenta" idventa="' . $value["idventa"] . '" ><i class="fa fa-file-text-o" aria-hidden="true"></i></button>
                                </td>
                            </tr>';
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

<div class="modal fade" id="DetalleVenta" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <form role="form" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Detalle de Venta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="box-body">
                        <table id="example1" class="table table dt-responsive" width="100%">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Código Articulo</th>
                                    <th>Articulo</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                </tr>
                            </thead>
                            <tbody id="detalle">
                                <tr>
                                    <td class="codeventa"></td>
                                    <td class="codearticulo"></td>
                                    <td class="articulo"></td>
                                    <td class="cantidad"></td>
                                    <td class="precio"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                        <input type="text" id="codeventa">
                        <input type="text" id="codearticulo">
                    </div>
                </div>
            </form>
            <?php
            // $showDetalle = new VentasController();
            // $showDetalle->mostrarDetalleVenta();
            ?>
        </div>
    </div>
</div>

<!-- AGREGAR VENTA -->
<div class="modal fade" id="modalAgregarCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <form role="form" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Registrar Venta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="box-body">
                        <!-- ENTRADA PARA EL IDVENTA -->
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="fa fa-address-card" aria-hidden="true"></i>
                            </span>
                            <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name="ruc" placeholder="Código de Venta" required>
                        </div>

                        <!-- ENTRADA PARA EL IDCLIENTE -->
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="fa fa-address-card" aria-hidden="true"></i>
                            </span>
                            <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name="ruc" placeholder="Código de Cliente" required>
                        </div>

                        <!-- ENTRADA PARA SELECCIONAR ARTICULO -->
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-th" aria-hidden="true"></i></span>
                            <select class="form-control input-lg" name="categoria">
                                <option value="" selected disabled>Selecionar Articulo</option>
                                <?php
                                $item = null;
                                $valor = null;

                                $articulos = ControladorArticulos::ctrMostrarArticulo($item, $valor);

                                foreach ($articulos as $key => $value) {
                                    echo '<option value="' . $value["idarticulo"] . '">' . $value["descripcion"] . ' - Precio: ' . $value["precioventa"] . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <!-- ENTRADA PARA CANTIDAD -->
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-check" aria-hidden="true"></i></span>
                            <input type="number" min="0" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name="cantidad" placeholder="Ingresar cantidad">
                        </div>

                        <!-- ENTRADA PARA FECHA EMISIÓN -->
                        <label for="">Fecha Emisión</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="fas fa-user-friends"></i>
                            </span>
                            <input type="datetime-local" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name="razonS" required>
                        </div>

                        <!-- ENTRADA PARA FECHA CANCELACIÓN -->
                        <label for="">Fecha Cancelación</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="fas fa-user-friends"></i>
                            </span>
                            <input type="datetime-local" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name="razonS" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer mt-0">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Guardar cliente</button>
                </div>
            </form>
            <?php

            ?>
        </div>
    </div>
</div>