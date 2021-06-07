<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Crear compra
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Crear compra</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-7 col-xs-12">
                <div class="box box-success">
                    <div class="box-header with-border"></div>
                    <form role="form" metohd="post" class="formularioCompra">
                        <div class="box-body">
                            <div class="box">
                                <!-- ENTRADA DEL USUARIO -->
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input type="text" class="form-control" id="nuevoUsuario" name="nuevoUsuario"
                                            value="<?php echo $_SESSION["nombre"]; ?>" readonly>
                                        <input type="hidden" name="idUsuario" value="<?php echo $_SESSION["id"]; ?>">
                                    </div>
                                </div>
                                <!-- ENTRADA DEL CODIGO VENTA -->
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                        <input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" placeholder="Ingresar código compra">
                                    </div>
                                </div>
                                <!-- ENTRADA DEL PROVEEDOR -->
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                        <select class="form-control input-lg" name="categoria">
                                            <option disabled selected>Seleccionar proveedor</option>
                                            <?php
                                            $item = null;
                                            $valor = null;
                                            $proveedor = ProveedorController::MostrarPorveedores($item, $valor);
                                            foreach ($proveedor as $key => $value) {
                                                echo '<option value="' . $value["idproveedor"] . '">' . $value["razonsocial"] . '</option>';
                                            }
                                            ?>
                                        </select>
                                        <span class="input-group-addon"><button type="button"
                                                class="btn btn-default btn-xs" data-toggle="modal"
                                                data-target="#agregarProveedor" data-dismiss="modal">Agregar
                                                proveedor</button></span>
                                    </div>
                                </div>

                                <!--=====================================
                                ENTRADA PARA AGREGAR PRODUCTO
                                ======================================-->

                                <div class="form-group row nuevoProducto">
                                    <table class="table tablaCompras center pt-5" style="width:100%;">
                                        <thead>
                                            <th>Eliminar</th>
                                            <th>Descripsión</th>
                                            <th style="text-align: center;">Precio Compra</th>
                                            <th style="text-align: left;">Cantidad</th>
                                            <th style="text-align: center;">Total precio</th>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>

                                <!--=====================================
                                BOTÓN PARA AGREGAR PRODUCTO
                                ======================================-->

                                <button type="button" class="btn btn-default hidden-lg btnAgregarPedido">Agregar
                                    producto</button>

                                <hr>

                                <div class="row">

                                    <!--=====================================
                                    ENTRADA IMPUESTOS Y TOTAL
                                    ======================================-->
                                    <div class="col-xs-8 pull-right">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Neto</th>
                                                    <th>Impuesto</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="width: 30%">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i
                                                                    class="ion ion-social-usd"></i></span>
                                                            <input type="text" class="form-control"
                                                                id="nuevoTotalCompra" name="nuevoTotalCompra" total=""
                                                                placeholder="00000" readonly required>
                                                        </div>
                                                    </td>
                                                    <td style="width: 30%">
                                                        <div class="input-group">
                                                            <input type="number" class="form-control" min="0"
                                                                id="nuevoImpuestoCompra" name="nuevoImpuestoCompra"
                                                                placeholder="0" required>
                                                            <input type="hidden" name="nuevoPrecioImpuesto"
                                                                id="nuevoPrecioImpuesto">
                                                            <input type="hidden" name="nuevoPrecioNeto"
                                                                id="nuevoPrecioNeto">
                                                            <span class="input-group-addon"><i
                                                                    class="fa fa-percent"></i></span>
                                                        </div>
                                                    </td>
                                                    <td style="width: 30%">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i
                                                                    class="ion ion-social-usd"></i></span>
                                                            <input type="text" class="form-control" id="nuevoNetoCompra"
                                                                name="nuevoNetoCompra" placeholder="00000" readonly
                                                                required>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <hr>

                                <!--=====================================
                                ENTRADA MÉTODO DE PAGO
                                ======================================-->
                                <div class="form-group row">
                                    <div class="col-xs-6" style="padding-right:0px">
                                        <div class="input-group">
                                            <select class="form-control" id="nuevoMetodoPago" name="nuevoMetodoPago"
                                                required>
                                                <option value="" selected disabled>Seleccione método de pago</option>
                                                <option value="Efectivo">Efectivo</option>
                                                <option value="TC">Tarjeta Crédito</option>
                                                <option value="TD">Tarjeta Débito</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="cajasMetodoPago"></div>
                                    <input type="hidden" id="listaMetodoPago" name="listaMetodoPago">
                                </div>
                                <br>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary pull-right">Guardar venta</button>
                        </div>
                    </form>
                </div>
            </div>

            <!--=====================================
            LA TABLA DE PRODUCTOS
            ======================================-->

            <div class="col-lg-5 hidden-md hidden-sm hidden-xs">
                <div class="box box-warning">
                    <div class="box-header with-border"></div>
                    <div class="box-body">
                        <table id="example1"
                            class="table table table-bordered table-striped dt-responsive tablaCompras">

                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Descripcion</th>
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
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary agregarProducto recuperarBoton" idArticulo="' . $value["idarticulo"] . '">Agregar</button>
                                            </div>
                                        </td>
                                    </tr> ';
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>



