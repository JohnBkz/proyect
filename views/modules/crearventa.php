<div class="content-wrapper">

    <section class="content-header">
        <h1>Registrar Nueva Venta</h1>
        <ol class="breadcrumb">
            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Registrar Nueva Venta</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <!-- FORMULARIO -->
            <div class="col-lg-7 col-xs-12">
                <div class="box box-success">
                    <div class="box-header with-border"></div>
                    <form role="form" method="post" class="formCrearVenta">
                        <div class="box-body">
                            <div class="">
                                <!-- entrada vendedor -->
<<<<<<< HEAD
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input type="text" class="form-control" value="<?php echo $_SESSION["nombre"]; ?>" readonly>
                                        <input type="hidden" name="idUsuario" value="<?php echo $_SESSION["id"]; ?>">
=======
                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                <input type="text" class="form-control"
                                                    value="<?php echo $_SESSION["nombre"]; ?>" readonly>
                                                <input type="hidden" name="idUsuario"
                                                    value="<?php echo $_SESSION["id"]; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <button class="btn btn-primary" id="desFactura"><i
                                                        class="fa fa-file-text-o" aria-hidden="true"></i>
                                                    Factura</button>
                                            </div>
                                            <div class="col-md-4">
                                                <button class="btn btn-success " id="desTarjeta"><i
                                                        class="fa fa-credit-card" aria-hidden="true"></i>
                                                    Tarjeta</button>
                                            </div>
                                            <div class="col-md-4">
                                                <button class="btn btn-danger " id="desVale"><i class="fa fa-tags"
                                                        aria-hidden="true"></i> Vales</button>
                                            </div>
                                        </div>
>>>>>>> e33bc66f3757a958f43a9dac3062b2936a6f8a96
                                    </div>
                                </div>

                                <!-- entrada producto tablaVentas-->
                                <div class="form-group row nuevoProducto">
                                    <table class="table tablaVentas table-striped table-condensed">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center;">Descripsión</th>
                                                <th style="text-align: right;">Cantidad G</th>
                                                <th style="text-align: right;">Precio</th>
                                                <th style="text-align: center;">Sub Total</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                                <input type="hidden" id="listProducts" name="listProducts">
                                <!-- botón agregar producto-->
                                <div class="row hidden-lg">
                                    <div class="col-sm-3">
                                        <button type="button" class="form-control btn btn-default btnAddProd">
                                            <i class="fa fa-refresh" aria-hidden="true"></i>Cargar Lista</button>
                                    </div>
                                    <div class="col-sm-6">
                                        <select class="form-control selectProd" id="selecP" name="selecP">
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <button type="button" class="form-control btn btn-default btnAddToList" data-toggle="tooltip" title="Agregar producto"><i class="fa fa-plus-square" aria-hidden="true"></i> Agregar</button>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- <div class="col-sm-3">
                                        <button type="button" id="calcular" class="btn btn-success"
                                            title="Agregar producto">Calcular</button>
                                    </div> -->
                                    <!-- entrada de impuestos y total-->
                                    <div class="col-sm-12">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Descuento</th>
                                                    <th>SubTotal</th>
                                                    <th>Impuesto</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="col-sm-4 col-xs-4">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i
                                                                    class="fa fa-money"></i></span>
                                                            <input type="number" step="any" class="form-control"
                                                                id="descuentoVenta" name="descuentoVenta" min="1"
                                                                value="<?php echo $_SESSION['descuento']; ?>" readonly
                                                                required autocomplete="off">
                                                        </div>
                                                    </td>
                                                    <td class="col-sm-4 col-xs-4">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                                            <input type="number" step="any" class="form-control" id="newSubtotVent" name="newSubtotVent" min="1" placeholder="0000" readonly required autocomplete="off">
                                                        </div>
                                                    </td>

                                                    <td class="col-sm-4 col-xs-4">
                                                        <div class="input-group">
                                                            <input type="number" step="any" class="form-control" id="impuesto" name="newImpuestVent" min="0" placeholder="00.00" readonly required autocomplete="off">
                                                            <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">
                                                        <h4><label>TOTAL (S&#47;.)</label></h4>
                                                    </td>
                                                    <td>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                                            <input type="number" step="any" class="form-control" id="newTotVent" name="newTotVent" placeholder="0000" required autocomplete="off" readonly>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- entrada forma de pago-->
                                <!-- SE LLENA CON JS JQUERY-->
                                <div class="form-group row">
                                    <div class="col-xs-6" style="padding-right:0px">
                                        <div class="input-group">
                                            <select class="form-control" id="metodoPago" name="metodoPago" required>
                                                <option value="" selected disabled>Seleccione método de pago
                                                </option>
                                                <option value="Efectivo">Efectivo</option>
                                                <option value="TC">Tarjeta Crédito</option>
                                                <option value="TD">Tarjeta Débito</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="cajasMetodoPago"></div>
                                    <input type="hidden" id="listaMetodoPago" name="listaMetodoPago">
                                </div>
                                <div class="row">
                                    <div class="form-group col-xs-6 datcomprob" style="right: 0;">
                                        <label>Comprobante</label>
                                        <select class="form-control" name="comprobante" id="comprobante">
                                            <option value=""></option>
                                            <option value="Boleta">Boleta</option>
                                            <option value="Factura">Factura</option>
                                        </select>
                                        <input type="hidden" class="form-control" id="newSerieV" name="codecomprobante">
                                    </div>
                                </div>
                                <!-- entrada cliente -->
                                <div class="row boxClienteVent">
                                    <div class="form-group col-xs-4" style="padding-right: 0px">
                                        <label id="lblDniC">DNI</label>
                                        <input type="text" class="form-control" id="dniCliente" name="dniCliente" maxlength="8" value="1">
                                    </div>
                                    <div class="form-group col-xs-8">
                                        <label id="lblNomC">Nombre</label>
                                        <input type="text" class="form-control" id="nombreCliente" name="nombreCliente" onkeyup="">
                                    </div>
                                    <div class="form-group col-xs-12">
                                        <label>Dirección</label>
                                        <input type="text" class="form-control" id="direCliente" name="direCliente">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" id="creaVenta" class="btn btn-primary">Guardar Venta</button>
                        </div>
                        <?php
                        $saveVenta = new VentasController();
                        $saveVenta->addVenta();
                        ?>
                    </form>
                </div>
            </div>
            <!-- TABLA -->
            <div class="col-lg-5 hidden-md hidden-sm hidden-xs">
                <div class="box box-primary">
                    <div class="box-header with-border"></div>
                    <div class="box-body">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                            <input type="text" class="form-control" id="newCodBarr" name="newCodBarr" placeholder="Esperando código de barras..." required>
                        </div>
                    </div>
                </div>
                <div class="box box-warning">
                    <div class="box-header with-border"></div>
                    <div class="box-body">
                        <table class="table table-bordered table-striped dt-responsive tablaProducts">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Precio</th>
                                    <th>Descripción</th>
                                    <th>Stock</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="tablaProducts">
                                <?php
                                $item = null;
                                $valor = null;
                                $articulos = ControladorArticulos::ctrMostrarArticulo($item, $valor);
                                foreach ($articulos as $key => $value) {
                                    if ($value["estado"] == 0) {
                                        echo '<tr>
                                                <td>' . $value["idarticulo"] . '</td>
                                                <td> S/' . $value["precioventa"] . '</td>
                                                <td>' . $value["descripcion"] . '</td>
                                                <td>' . $value["cantidad"] . '</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-primary agregarProducto recuperarBoton" idArticulo="' . $value["idarticulo"] . '">Agregar</button>
                                                    </div>
                                                </td>
                                            </tr>';
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <button class="btn btn-primary" data-target="#Descuento">
                    Vale de descuento
                </button>
            </div>
        </div>
    </section>
</div>

<div id="Descuento">

</div>