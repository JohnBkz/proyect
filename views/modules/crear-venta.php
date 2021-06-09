<?php

if ($_SESSION["perfil"] == "Especial") {

  echo '<script>

    window.location = "inicio";

  </script>';

  return;
}

?>


<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Crear venta
      <label class="btn btn-default pull-center mas" style="margin: 0 auto;" id="aumen"> + </label>
    </h1>

    <ol class="breadcrumb">

      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Crear venta</li>

    </ol>

  </section>

  <section class="content">


    <div class="row">

      <!--=====================================
      EL FORMULARIO
      ======================================-->
      <div class="col-lg-6 col-xs-12">

        <div class="box box-success">



          <form role="form" method="post" class="formularioVenta">

            <div class="box-body">

              <div class="box">
                <div class="form-group">


                   <input type="Radio" name="comprob" id="comprobbol" value="Factura"  > Boleta 
                   <input type="Radio" name="comprob" id="comprobfac" value="Boleta"> Factura

                  <!-- ENTRADA PARA EL DOCUMENTO ID -->
                </div>
                <input type="hidden" name="documento" id="documento" value="">
                <!--=====================================
                ENTRADA DEL VENDEDOR
                ======================================-->

                <input type="hidden" class="form-control" id="nuevoVendedor" value="<?php echo $_SESSION["nombre"]; ?>" readonly>

                <input type="hidden" name="idUsuario"  id="idUsuario" value="<?php echo $_SESSION["id"]; ?>">

                <!-- ENTRADA PARA EL DOCUMENTO ID -->

                <div class="form-group" id=midocumen>

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-key"></i></span>

                    <input type="text" class="form-control input-lg" name="nuevoDocumentoId" id="nuevoDocumento" placeholder="Ingresar DNI" data-inputmask="'mask':'99999999'" data-mask>

                  </div>

                </div>

                <!-- ENTRADA PARA EL NOMBRE -->

                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-user"></i></span>

                    <input type="text" class="form-control input-lg" name="nuevoCliente" placeholder="Ingresar nombre" id="clientenombre">

                  </div>

                </div>

                <!-- ENTRADA PARA EL NOMBRE -->

                <div class="form-group" id="domici" style="display: none">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-user"></i></span>

                    <input type="text" class="form-control input-lg" name="nuevoDomicilio" placeholder="Ingresar Domicilio" id="domicilio">

                  </div>

                </div>


                <div class="row rowventas" style="display: none" id="rowventas">



                  <?php

                  $item = null;
                  $valor = null;
                  $articulos = ControladorArticulos::ctrMostrarArticulo($item, $valor);

               
                   
                  foreach ($articulos as $key => $value) {
                    if($value["unidad"]=="Gal"){
                      echo ' 
                                        <div class="col-lg-3">
                                                    <div class="btn-group ">
                                                        <button type="button" style="padding: 20px" class="btn btn-primary agregarProducto recuperarBoton" idProducto="' . $value["idarticulo"] . '">' . $value["descripcion"] . '</button>
                                                    </div>
                                                    </div>';

                    }

                    
                  }

                  ?>

                </div>


                <!--=====================================
                ENTRADA PARA AGREGAR PRODUCTO
                ======================================-->

                <div class="form-group row nuevoProducto">
                  <table id="detalles" class="table centrar">
                    <thead>
                      <tr>
                        <th class="col-xs-2">Eliminar </th>
                        <th class="col-xs-4 centrarto">Producto</th>
                        <th class="col-xs-3 centrarto">Cantidad</th>
                        <th class="col-xs-3 centrarto">SubTotal</th>
                      </tr>
                    </thead>
                  </table>

                </div>


                <input type="hidden" id="listaProductos" name="listaProductos">

                <!--=====================================
                BOTÓN PARA AGREGAR PRODUCTO
                ======================================-->

                <button type="button" class="btn btn-default hidden-lg btnAgregarProducto">Agregar producto</button>

                <hr>

                <div class="row">

                  <!--=====================================
                  ENTRADA IMPUESTOS Y TOTAL
                  ======================================-->

                  <div class="col-xs-8 pull-right">

                    <table class="table">

                      <thead>

                        <tr>
                          <th>
                            <!--impuesto -->
                          </th>
                          <th>TOTAL</th>
                        </tr>

                      </thead>

                      <tbody>

                        <tr>

                          <td style="width: 50%">

                            <div class="input-group">

                              <input type="hidden" class="form-control input-lg" min="0" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta" value="18" required>

                              <input type="hidden" name="nuevoPrecioImpuesto" id="nuevoPrecioImpuesto" required>

                              <input type="hidden" name="nuevoPrecioNeto" id="nuevoPrecioNeto" required>



                            </div>

                          </td>

                          <td style="width: 50%">

                            <div class="input-group">

                              <span class="input-group-addon">S/ </i></span>

                              <input type="text" class="form-control input-lg" id="nuevoTotalVenta" name="nuevoTotalVenta" total="" placeholder="0" readonly required>

                              <input type="hidden" name="totalVenta" id="totalVenta">


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

                      <select class="form-control" id="nuevoMetodoPago" name="nuevoMetodoPago" >
                        <option value="" selected disabled hidden>Seleccione método de pago</option>
                        <option value="Efectivo">Efectivo</option>
                        <option value="TC">Transaccion</option>


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

              <button type="button" class="btn btn-primary pull-right" id="GuardarVenta">Guardar venta</button>


            </div>

          </form>

   

        </div>

      </div>
      <!--=====================================
      LA TABLA DE PRODUCTOS
      ======================================-->

      <div class="col-lg-6 hidden-md hidden-sm hidden-xs" id="prod">

        <div class="box box-warning">

          <div class="box-header with-border"></div>

          <div class="box-body">

            <table class="table table-bordered table-striped dt-responsive tablaVentas">

              <thead>

                <tr>


                  <th style="width: 80px">Precio</th>
                  <th style="width: 20px">Descripcion</th>

                  <th style="width: 20px">Acciones</th>
                </tr>

              </thead>

            </table>

          </div>

        </div>


      </div>



      <!--=====================================
      EL FORMULARIO
      ======================================-->

      <div class="col-lg-6 col-xs-12" id="isla2" style="display:none">

        <div class="box box-success">


          <form role="form" method="post" class="formularioVenta2">

            <div class="box-body">

              <div class="box">
                <div class="form-group">


                   <input type="Radio" name="comprob2" id="comprobbol2" value="Factura" > Boleta
                  <input type="Radio" name="comprob2" id="comprobfac2" value="Boleta"> Factura

                  <!-- ENTRADA PARA EL DOCUMENTO ID -->
                </div>
                <input type="hidden" name="documento2" id="documento2" value="">
                <!--=====================================
                ENTRADA DEL VENDEDOR
                ======================================-->

                <!-- ENTRADA PARA EL DOCUMENTO ID -->

                <div class="form-group" id=midocumen>

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-key"></i></span>

                    <input type="text" class="form-control input-lg" name="nuevoDocumentoId2" id="nuevoDocumento2" placeholder="Ingresar DNI" data-inputmask="'mask':'99999999'" data-mask>

                  </div>

                </div>

                <!-- ENTRADA PARA EL NOMBRE -->

                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-user"></i></span>

                    <input type="text" class="form-control input-lg" name="nuevoCliente2" placeholder="Ingresar nombre" id="clientenombre2">

                  </div>

                </div>

                <!-- ENTRADA PARA EL NOMBRE -->

                <div class="form-group" id="domici2" style="display: none">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-user"></i></span>

                    <input type="text" class="form-control input-lg" name="nuevoDomicilio2" placeholder="Ingresar Domicilio" id="domicilio2">

                  </div>

                </div>

                <div class="row rowventas2"  id="rowventas2">

                  <?php

                  $item = null;
                  $valor = null;
                  $articulo = ControladorArticulos::ctrMostrarArticulo($item, $valor);

                  foreach ($articulos as $key => $value) {
                    if($value["unidad"]=="Gal"){
                      echo ' 
                                        <div class="col-lg-3">
                                                    <div class="btn-group ">
                                                        <button type="button" style="padding: 20px" class="btn btn-primary agregarProducto recuperarBoton2" idProducto="' . $value["idarticulo"] . '">' . $value["descripcion"] . '</button>
                                                    </div>
                                                    </div>';

                    }

                    
                  }

                  ?>

                </div>
                <!--=====================================
                ENTRADA PARA AGREGAR PRODUCTO
                ======================================-->

                <div class="form-group row nuevoProducto2">
                  <table id="detalles" class="table centrar">
                    <thead>
                      <tr>
                        <th class="col-xs-2">Eliminar </th>
                        <th class="col-xs-4 centrarto">Producto</th>
                        <th class="col-xs-3 centrarto">Cantidad</th>
                        <th class="col-xs-3 centrarto">SubTotal</th>
                      </tr>
                    </thead>
                  </table>

                </div>

                <input type="hidden" id="listaProductos2" name="listaProductos2">

                <!--=====================================
                BOTÓN PARA AGREGAR PRODUCTO
                ======================================-->

                <button type="button" class="btn btn-default hidden-lg btnAgregarProducto">Agregar producto</button>

                <hr>

                <div class="row">

                  <!--=====================================
                  ENTRADA IMPUESTOS Y TOTAL
                  ======================================-->

                  <div class="col-xs-8 pull-right">

                    <table class="table">

                      <thead>

                        <tr>
                          <th>
                            <!--impuesto -->
                          </th>
                          <th>TOTAL</th>
                        </tr>

                      </thead>

                      <tbody>

                        <tr>

                          <td style="width: 50%">

                            <div class="input-group">

                              <input type="hidden" class="form-control input-lg" min="0" id="nuevoImpuestoVenta2" name="nuevoImpuestoVenta2" value="18" required>

                              <input type="hidden" name="nuevoPrecioImpuesto2" id="nuevoPrecioImpuesto2" required>

                              <input type="hidden" name="nuevoPrecioNeto2" id="nuevoPrecioNeto2" required>



                            </div>

                          </td>

                          <td style="width: 50%">

                            <div class="input-group">

                              <span class="input-group-addon">S/ </i></span>

                              <input type="text" class="form-control input-lg" id="nuevoTotalVenta2" name="nuevoTotalVenta2" total="" placeholder="0" readonly required>

                              <input type="hidden" name="totalVenta2" id="totalVenta2">


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

                      <select class="form-control" id="nuevoMetodoPago2" name="nuevoMetodoPago2" >
                        <option value="" selected disabled hidden>Seleccione método de pago</option>
                        <option value="Efectivo">Efectivo</option>
                        <option value="TC">Transaccion</option>


                      </select>

                    </div>

                  </div>

                  <div class="cajasMetodoPago"></div>

                  <input type="hidden" id="listaMetodoPago2" name="listaMetodoPago2">

                </div>

                <br>

              </div>

            </div>

            <div class="box-footer">

              <button type="button" class="btn btn-primary pull-right" id="GuardarVenta2">Guardar venta</button>


            </div>

          </form>


        </div>

      </div>

    </div>

  </section>

</div>