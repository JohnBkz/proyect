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
      <div class="col-lg-6 col-xs-6">

        <div class="box box-success">



          <form role="form" method="post" class="formularioVenta">

            <div class="box-body">

              <div class="box" style="margin-bottom:0px">
              <div class="col-xs-6">
                <label for="comprobbol"><input type="Radio" name="comprob" id="comprobbol" value="Boleta"> Boleta</label>
                <label for="comprobfac"><input type="Radio" name="comprob" id="comprobfac" value="Factura"> Factura</label>
                </div>
                <div class="col-xs-6">
                <label style="margin-bottom: 0px; float: right;"> <input type="Radio" name="metodopago" id="vale" value="vale"> Vale</label>
                <!-- <label style="margin-bottom: 0px; float: right;"><input type="checkbox" id="vale" value="vale">vale</label> -->
                </div>
                <input type="hidden" name="documento" id="documento" value="">
                <!--=====================================
                ENTRADA DEL VENDEDOR
                ======================================-->

                <input type="hidden" class="form-control" id="nuevoVendedor" value="<?php echo $_SESSION["nombre"]; ?>" readonly>

                <input type="hidden" name="idUsuario" id="idUsuario" value="<?php echo $_SESSION["id"]; ?>">

                <input type="hidden" name="tipoUsuario" id="tipoUsuario" value="<?php echo $_SESSION["perfi"]; ?>">
                <!-- ENTRADA PARA EL DOCUMENTO ID -->


                <table style="width: 100%; margin-bottom: 10px;">

                  <thead>

                  </thead>

                  <tbody>

                    <tr>
                      <td style="width: 50%">
                        <div class="input-group" style="margin-right:10px">

                          <span class="input-group-addon"><i class="fa fa-key"></i></span>

                          <input type="text" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" class="form-control" name="nuevoDocumentoId" id="nuevoDocumento" placeholder="Ingrese DNI/RUC" data-inputmask="'mask':'99999999'" data-mask>

                        </div>
                      </td>
                      <td style="width: 50%">
                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-key"></i></span>

                          <input type="text" class="form-control" name="nuevoPlacaId" id="nuevoPlaca" placeholder="Ingresar PLACA" required>

                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>



                <!-- ENTRADA PARA EL NOMBRE -->

                <div class="form-group" style="margin-bottom:10px">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-user"></i></span>

                    <input type="text" class="form-control" name="nuevoCliente" placeholder="Ingresar nombre" id="clientenombre">

                  </div>

                </div>

                <!-- ENTRADA PARA EL NOMBRE -->

                <div class="form-group" id="domici" style="display: none; margin-bottom:10px;">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-user"></i></span>

                    <input type="text" class="form-control" name="nuevoDomicilio" placeholder="Ingresar Domicilio" id="domicilio">

                  </div>

                </div>


                <div class="row rowventas" style="display: none" id="rowventas">



                  <?php

                  $item = null;
                  $valor = null;
                  $articulos = ControladorArticulos::ctrMostrarArticulo($item, $valor);


                  echo ' <div class="input-group">';
                  foreach ($articulos as $key => $value) {
                    if ($value["unidad"] == "Gal") {
                      echo '
                                        <div class="col-lg-3 col-xs-3">
                                                   
                                                        <button type="button" style="padding: 20px" class="btn btn-primary agregarProducto recuperarBoton" idProducto="' . $value["idarticulo"] . '">' . $value["descripcion"] . '</button>
                                              
                                                    </div>';
                    }
                  }

                  ?>
                  <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAgregarProducto" data-dismiss="modal">+ Productos</button></span>
                </div>
              </div>


              <!--=====================================
                ENTRADA PARA AGREGAR PRODUCTO
                ======================================-->

              <div class="row nuevoProducto">
                <table id="detalles" class="table centrar" style="margin-bottom:0px;">
                  <thead>
                    <tr>
                      <?php
                      if ($_SESSION['perfi'] == 'admin') {
                        echo ' <th class="col-xs-2">Eliminar </th>
                            <th class="col-xs-2 centrarto">Producto</th>
                            <th class="col-xs-3 centrarto">Cantidad</th>
                            <th class="col-xs-3 centrarto">Precio</th>
                            <th class="col-xs-4 centrarto">SubTotal</th>';
                      } else {
                        echo ' <th class="col-xs-2">Eliminar </th>
                            <th class="col-xs-4 centrarto">Producto</th>
                            <th class="col-xs-3 centrarto">Cantidad</th>
                            <th class="col-xs-2 centrarto">SubTotal</th>';
                      }
                      ?>

                    </tr>
                  </thead>
                </table>

              </div>


              <input type="hidden" id="listaProductos" name="listaProductos">

              <!--=====================================
                BOTÓN PARA AGREGAR PRODUCTO
                ======================================-->

              <!-- <button type="button" class="btn btn-default hidden-lg btnAgregarProducto">Agregar producto</button> -->

              <!-- <hr> -->

              <div class="row">
                <!--=====================================
                ENTRADA MÉTODO DE PAGO
                ======================================-->
                <div class="col-xs-6">
                
                <div class="row" style="margin-top: 10px; margin-bottom: 7px;">
                        
                <div class="col-xs-4"> <label for="Ambos"> <input type="Radio" name="metodopago" id="Ambos" value="Efectivo/Tarjeta"> Ambos</label></div>
                <div class="col-xs-4"> <label for="Tarjeta"> <input type="Radio" name="metodopago" id="Tarjeta" value="Tarjeta"> Tarjeta</label></div>
                <div class="col-xs-4"> <label for="Efectivo"> <input type="Radio" name="metodopago" id="Efectivo" value="Efectivo" checked="checked"> Efectivo</label></div>
              
                <input type="hidden" id="tipopago" name="tipopago" value="Efectivo">
                <!-- <div class="col-xs-4">  <label style="margin-bottom: 0px;"><input type="checkbox" id="Ambos" value="Efectivo/Tarjeta">Ambos</label> </div>
                <div class="col-xs-4">  <label style="margin-bottom: 0px;"><input type="checkbox" id="Tarjeta" value="Tarjeta">Tarjeta</label> </div>
                <div class="col-xs-4">  <label style="margin-bottom: 0px;"><input type="checkbox" id="Efectivo" value="Efectivo" checked="checked">Efectivo</label> </div> -->
                       </div>
                
                       <div class="row">

                       <div class="col-xs-2" style="padding-right: 0px;">
                      </div>
                       <div class="col-xs-5" style="padding-right: 0px;">
                          <div class="input-group" >
                  
                            <span class="input-group-addon" style="padding: 6px 5px;">S/</span>
                            <input type="text" class="form-control" id="TotalTarjeta" name="TotalTarjeta" total="" placeholder="0" readonly>

                          </div>
                          </div>
                          <div class="col-xs-5" style="padding-right:0px;">
                          <div class="input-group">
                            <span class="input-group-addon" style="padding: 6px 5px;" id="dolar">S/ </span>
                            <input type="text" class="form-control" id="TotalEfectivo" name="TotalEfectivo" total="" placeholder="0" readonly>

                          </div>
                          </div>
                          </div>
                          <div class="row" style="margin-top: 10px;">
                          <div class="col-xs-2" style="padding-right:0px;">
                          </div> 
                          <div class="col-xs-8" style="padding-right:0px;">
                          <input type="text" style="display:none;" class="form-control" id="CodigoTarjeta" name="CodigoTarjeta" placeholder="Código transacción" readonly>
                          </div> 
                          <div class="col-xs-2" style="padding-right:0px;">
                          </div> </div>
                     
                </div>
                <!-- <div class="col-xs-6" style="padding-right:0px">
                    <div class="input-group">
                      <!-- <select class="form-control" id="nuevoMetodoPago" name="nuevoMetodoPago">
                        <option value="" selected disabled hidden>Seleccione método de pago</option>
                        <option value="Efectivo">Efectivo</option>
                        <option value="Tarjeta">Tarjeta</option> -->
                <!--  </select>
                    </div>
                  </div> -->
                <!-- <div class="cajasMetodoPago"></div>
                  <input type="hidden" id="listaMetodoPago" name="listaMetodoPago"> -->


                <!--=====================================
                  ENTRADA IMPUESTOS Y TOTAL
                  ======================================-->

                <div class="col-xs-6 pull-right">

                  <table class="table">

                    <thead>

                      <tr>
                        <?php
                        if ($_SESSION['perfi'] == 'admin') {
                          echo '<th>DESCUENTO</th>';
                        } else {
                          echo '<th></th>';
                        }
                        ?>
                        <th>TOTAL</th>

                      </tr>

                    </thead>

                    <tbody>

                      <tr>

                        <td style="width: 50%">
                          <input type="hidden" class="form-control" min="0" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta" value="18" required>

                          <input type="hidden" name="nuevoPrecioImpuesto" id="nuevoPrecioImpuesto" required>

                          <input type="hidden" name="nuevoPrecioNeto" id="nuevoPrecioNeto" required>

                          <?php
                          if ($_SESSION['perfi'] == 'admin') {
                            echo '<div class="input-group">

                                <span class="input-group-addon">S/</span>

                                <input type="text" class="form-control" id="descuento" name="descuento" value="0" placeholder="0" >



                              </div>';
                          }
                          ?>

                        </td>

                        <td style="width: 50%; padding:0px">

                          <div class="input-group">

                            <span class="input-group-addon">S/</span>

                            <input type="text" class="form-control" id="nuevoTotalVenta" name="nuevoTotalVenta" total="" placeholder="0" readonly required>

                            <input type="hidden" name="totalVenta" id="totalVenta">


                          </div>

                        </td>

                      </tr>

                    </tbody>

                  </table>

                </div>

              </div>

              <!-- <hr> -->



            </div>

        </div>

        <div class="box-footer">
        <div class="col-xs-4">
        <div class="input-group">
          <label class="pull-right" style="padding-top: 5px;">Pago</label>
            <span class="input-group-addon">S/</span>
            <input type="text" class="form-control" id="Pago" name="Pago" placeholder="0" >
          </div>
        </div>
        <div class="col-xs-4">
     
          <div class="input-group">
          <label class="pull-right" style="padding-top: 5px;"> Vuelto </label>
            <span class="input-group-addon">S/</span>
            <input type="text" class="form-control" id="vuelto" name="vuelto" placeholder="0" readonly>
          </div>
          </div>
          <div class="col-xs-4 pull-right">
          <button type="button" class="btn btn-primary pull-right" id="GuardarVenta">Guardar venta</button>

          </div>

        </div>

        </form>



      </div>

    </div>
    <!--=====================================
      LA TABLA DE PRODUCTOS
      ======================================-->

    <div class="col-lg-6 col-xs-6" id="prod">

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

    <div class="col-lg-6 col-xs-6" id="isla2" style="display:none">

      <div class="box box-success">


        <form role="form" method="post" class="formularioVenta2">

          <div class="box-body">

            <div class="box" style="margin-bottom:0px">

        
              <label for="comprobbol2"> <input type="Radio" name="comprob2" id="comprobbol2" value="Factura"> Boleta</label>
              <label for="comprobfac2"> <input type="Radio" name="comprob2" id="comprobfac2" value="Boleta"> Factura</label>

              <input type="hidden" name="documento2" id="documento2" value="">
              
              <!--=====================================
                ENTRADA DEL VENDEDOR
                ======================================-->

              <!-- ENTRADA PARA EL DOCUMENTO ID -->
              <table style="width: 100%; margin-bottom: 10px;">

                <thead>

                </thead>

                <tbody>

                  <tr>
                    <td style="width: 50%">
                      <div class="input-group" style="margin-right:10px">

                        <span class="input-group-addon"><i class="fa fa-key"></i></span>

                        <input type="text" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" class="form-control" name="nuevoDocumentoId2" id="nuevoDocumento2" placeholder="Ingrese DNI/RUC" data-inputmask="'mask':'99999999'" data-mask>

                      </div>
                    </td>
                    <td style="width: 50%">
                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-key"></i></span>

                        <input type="text" class="form-control" name="nuevoPlacaId2" id="nuevoPlaca2" placeholder="Ingresar PLACA" required>

                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>


              <!-- ENTRADA PARA EL NOMBRE -->

              <div class="form-group" style="margin-bottom:10px">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-user"></i></span>

                  <input type="text" class="form-control" name="nuevoCliente2" placeholder="Ingresar nombre" id="clientenombre2">

                </div>

              </div>

              <!-- ENTRADA PARA EL NOMBRE -->

              <div class="form-group" id="domici2" style="display: none; margin-bottom:10px;">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-user"></i></span>

                  <input type="text" class="form-control" name="nuevoDomicilio2" placeholder="Ingresar Domicilio" id="domicilio2">

                </div>

              </div>

              <div class="row rowventas2" id="rowventas2">

                <?php

                $item = null;
                $valor = null;
                $articulo = ControladorArticulos::ctrMostrarArticulo($item, $valor);

                foreach ($articulos as $key => $value) {
                  if ($value["unidad"] == "Gal") {
                    echo ' 
                                        <div class="col-lg-3">
                                                    <div class="btn-group ">
                                                        <button type="button" style="padding: 20px" class="btn btn-primary agregarProducto recuperarBoton2" idProducto="' . $value["idarticulo"] . '">' . $value["descripcion"] . '</button>
                                                    </div>
                                                    </div>';
                  }
                }

                ?>
                <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAgregarProducto2" data-dismiss="modal">+ Productos</button></span>

              </div>
              <!--=====================================
                ENTRADA PARA AGREGAR PRODUCTO
                ======================================-->

              <div class="row nuevoProducto2">
                <table id="detalles" class="table centrar" style="margin-bottom:0px;">
                  <thead>
                    <tr>
                      <?php
                      if ($_SESSION['perfi'] == 'admin') {
                        echo ' <th class="col-xs-2">Eliminar </th>
                            <th class="col-xs-2 centrarto">Producto</th>
                            <th class="col-xs-3 centrarto">Cantidad</th>
                            <th class="col-xs-3 centrarto">Precio</th>
                            <th class="col-xs-4 centrarto">SubTotal</th>';
                      } else {
                        echo ' <th class="col-xs-2">Eliminar </th>
                            <th class="col-xs-4 centrarto">Producto</th>
                            <th class="col-xs-3 centrarto">Cantidad</th>
                            <th class="col-xs-2 centrarto">SubTotal</th>';
                      }
                      ?>
                    </tr>
                  </thead>
                </table>

              </div>

              <input type="hidden" id="listaProductos2" name="listaProductos2">

              <!--=====================================
                BOTÓN PARA AGREGAR PRODUCTO
                ======================================-->

              <!-- <button type="button" class="btn btn-default hidden-lg btnAgregarProducto">Agregar producto</button> -->
              <!-- 
                <hr> -->

              <div class="row">

                <!--=====================================
                  ENTRADA IMPUESTOS Y TOTAL
                  ======================================-->

                <div class="col-xs-6 pull-right">

                  <table class="table">

                    <thead>

                      <tr>
                        <?php
                        if ($_SESSION['perfi'] == 'admin') {
                          echo '<th>DESCUENTO</th>';
                        } else {
                          echo '<th></th>';
                        }
                        ?>
                        <th>TOTAL</th>
                      </tr>

                    </thead>

                    <tbody>

                      <tr>

                        <td style="width: 50%">

                          <div class="input-group">

                            <input type="hidden" class="form-control" min="0" id="nuevoImpuestoVenta2" name="nuevoImpuestoVenta2" value="18" required>

                            <input type="hidden" name="nuevoPrecioImpuesto2" id="nuevoPrecioImpuesto2" required>

                            <input type="hidden" name="nuevoPrecioNeto2" id="nuevoPrecioNeto2" required>

                          </div>
                          <?php
                          if ($_SESSION['perfi'] == 'admin') {
                            echo '<div class="input-group">

                                <span class="input-group-addon">S/</span>

                                <input type="text" class="form-control" id="descuento2" name="descuento2" value="0" placeholder="0" >



                              </div>';
                          }
                          ?>

                        </td>

                        <td style="width: 50%;padding: 0px;">

                          <div class="input-group">

                            <span class="input-group-addon">S/</span>

                            <input type="text" class="form-control" id="nuevoTotalVenta2" name="nuevoTotalVenta2" total="" placeholder="0" readonly required>

                            <input type="hidden" name="totalVenta2" id="totalVenta2">


                          </div>

                        </td>

                      </tr>

                    </tbody>

                  </table>

                </div>

              </div>

              <!-- <hr> -->

              <!--=====================================
                ENTRADA MÉTODO DE PAGO
                ======================================-->

              <div class="form-group row" style="margin-bottom:0px">

                <div class="col-xs-6" style="padding-right:0px">

                  <div class="input-group">

                    <select class="form-control" id="nuevoMetodoPago2" name="nuevoMetodoPago2">
                      <option value="" selected disabled hidden>Seleccione método de pago</option>
                      <option value="Efectivo">Efectivo</option>
                      <option value="Tarjeta">Tarjeta</option>


                    </select>

                  </div>

                </div>

                <div class="cajasMetodoPago2"></div>

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

<!--=====================================
MODAL AGREGAR PRODUCTOS
======================================-->

<div id="modalAgregarProducto" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">
      <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

      <div class="modal-header" style="background:#3c8dbc; color:white">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Agregar Producto</h4>

      </div>

      <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
      <div class="col-lg-12" id="produ">

        <div class="box box-warning">

          <div class="box-header with-border"></div>

          <div class="box-body">

            <table class="table table-bordered table-striped dt-responsive tablaVentas" style="width:100%">
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
        PIE DEL MODAL
        ======================================-->
      <div class="modal-footer">

        <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Salir</button>


      </div>

    </div>

  </div>

</div>
<!--=====================================
MODAL AGREGAR PRODUCTOS2
======================================-->

<div id="modalAgregarProducto2" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">
      <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

      <div class="modal-header" style="background:#3c8dbc; color:white">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Agregar Producto</h4>

      </div>

      <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
      <div class="col-lg-12" id="produ">

        <div class="box box-warning">

          <div class="box-header with-border"></div>

          <div class="box-body">

            <table class="table table-bordered table-striped dt-responsive tablaVentas2" style="width:100%">
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
        PIE DEL MODAL
        ======================================-->
      <div class="modal-footer">

        <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Salir</button>


      </div>

    </div>

  </div>

</div>



<!--=====================================
MODAL AGREGAR CLIENTE
======================================-->

<div id="modalAgregarCliente" class="modal fade" role="dialog">

  <div class="modal-dialog" style="width: 40%;">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
 
        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Buscar Cliente</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">
            <!--=====================================
                ENTRADA DEL EMPRESA
                ======================================--> 

              
                  <div class="row">
                  <div class="input-group" style="padding-bottom: 15px;">
                    
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
<!--                     
                    <select class="form-control" id="seleccionarCliente" name="seleccionarCliente" required> -->
                    <!-- <select class="form-control select2 select2-hidden-accessible" multiple="" data-placeholder="Seleccionar Empresa" style="width: 100%;" tabindex="-1" aria-hidden="true"> -->
                    <select class="js-example-basic-single" name="Empresas"  id="Empresas" data-placeholder="Buscar Empresa" style="width: 100%">
                   
                    <?php
                      $item = null;
                      $valor = null;
                      $empresa = empresaController::mostrarEmpresa($item, $valor);
                       foreach ($empresa as $key => $value) {
                         echo '<option value="'.$value["rucempresa"].'">'.$value["rucempresa"]." - ".$value["nombre"].'</option>';
                       }
                    ?>
                    </select>
                    </div>
                    </div>

                    <div class="row">
                    <div class="input-group" style="padding-bottom: 15px;">
                    
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    <select class="js-example-basic-single" name="TrabajadoresEmpre"  id="TrabajadoresEmpre" data-placeholder="Buscar Trabajador" style="width: 100%">
            
                    </select>
                    </div> </div>
                    <div class="row">
                    <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    <select class="js-example-basic-single" name="AutosEmpre"  id="AutosEmpre" data-placeholder="Buscar Placa" style="width: 100%">
                 
                    </select>
                  </div>
                   </div>
                
      



          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div style="text-align:center; padding-bottom: 10px">

          <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>

        </div>

      </form>

    </div>

  </div>

</div>