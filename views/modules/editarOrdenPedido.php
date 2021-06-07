<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Recibir Orden de Compra
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Recibir Orden de Compra</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <!--=====================================
      EL FORMULARIO
      ======================================-->
      <div class="col-lg-12 col-xs-12">
        <div class="box box-success">
          <div class="box-header with-border"></div>
          <form role="form" method="post" class="formularioOrdenedi">
            <div class="box-body">
              <div class="box">
                <?php
                $item = "idpedido";
                $valor = $_GET["idPedido"];
                $ordenPedido = controllerOrdenPedido::mostrarOrdenPedidoCtr($item, $valor);
                ?>

                <!-- USUARIO -->
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" class="form-control" id="nuevoUserPedido" readonly value="<?php echo $_SESSION["nombre"]; ?>">
                    <input type="hidden" name="idTraba" value="<?php echo $_SESSION["id"]; ?>">
                    <input type="hidden" value="<?php echo $ordenPedido["nombres"]; ?>" readonly>
                    <input type="hidden" name="ediUserPedido" value="<?php echo $ordenPedido["idusuario"]; ?>">
                  </div>
                </div>

                <!-- CÓDIGO -->
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                    <input type="text" class="form-control" id="editarOrdenPedido" name="editarOrdenPedido" value="<?php echo $ordenPedido["idpedido"]; ?>" readonly>
                  </div>
                </div>

                <!-- PROVEEDOR -->
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" class="form-control" id="nuevoProveedoredit" value="<?php echo $ordenPedido["razonsocial"]; ?>" readonly>
                    <input type="hidden" name="idProveedoredit" value="<?php echo $ordenPedido["idproveedor"]; ?>">
                  </div>
                </div>

                <!-- RUC PROVEEDOR -->
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" class="form-control" id="nuevorucc" value="<?php echo $ordenPedido["idproveedor"]; ?>" readonly>
                  </div>
                </div>

                <!-- COMPROBANTE PROVEEDOR -->
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-chevron-right"></i></span>
                    <input type="text" class="form-control codigoprovee" id="codigoprovee" name="codigoprovee" placeholder="nro comprobante del proveedor" required>
                  </div>
                </div>

                <div class="form-group row nuevoProducto">
                  <table id="detalles" class="table ">
                    <thead>
                      <tr>

                        <th class="col-xs-4 centrarto">Producto</th>
                        <th class="col-xs-2 centrarto">Cantidad</th>
                        <th class="col-xs-2 centrarto">Precio Compra</th>
                        <th class="col-xs-2 centrarto">SubTotal</th>
                        <th class="col-xs-2 centrarto">ingreso</th>
                      </tr>
                    </thead>
                  </table>
                  <?php

                  // $listaProducto = json_decode($ordencompra["productos"], true);

                  // var_dump($listaProducto);
                  $id = "idpedido";
                  $valorId = $_GET["idPedido"];
                  $listaProducto = controllerOrdenPedido::mostrarDetPedido($item, $valor);
                  foreach ($listaProducto as $key => $value) {

                    // $item = "id";
                    // $valor = $value["id"];
                    // $orden = "id";

                    $stockAntiguo = $value["cantidad"];

                    echo '<div class="row" style="padding:5px 15px">    
                              <!-- DESCRIPSION-->                           
                            <div class="col-xs-4" style="padding-right:0px">                                 
                                <input type="text" class="form-control nuevaDescripcionProductoedi" idProducto="' . $value["idarticulo"] . '" name="agregarProducto" value="' . $value["descripcion"] . '" readonly required>                       
                            </div>

                            <div class="col-xs-2">              
                              <input type="number" class="form-control nuevaCantidadProductoedi" name="nuevaCantidadProductoedi" min="1" value="' . $value["cantidadPedido"] . '" readonly  required>
                            </div>

                            <div class="col-xs-2 ingresoPrecioProveedoredi" style="padding-left:0px">
                              <div class="input-group">
                                <span class="input-group-addon">S/ </i></span>                  
                                <input type="text" class="form-control ProveedorPrecioedi" name="ProveedorPrecioedi" value="' . $value["valorUnitario"] . '" readonly required>   
                              </div>
                            </div>


                            <div class="col-xs-2 ingresoPrecioedi" style="padding-left:0px">
                              <div class="input-group">
                                <span class="input-group-addon">S/ </i></span>                  
                                <input type="text" class="form-control nuevoPrecioProductoedi"  name="nuevoPrecioProductoedi"  value="' . $value["valorUnitario"] * $value["cantidadPedido"] . '" readonly required>   
                              </div>
                            </div>

                            <div class="col-xs-2">              
                              <input type="number" class="form-control nuevaCantidadProveedoredi" name="edinuevaCantidadProveedoredi" min="1" value="' . $value["cantidadPedido"] . '"  required>
                            </div>
                      
                      </div>';
                  }


                  ?>
                </div>

                <div class="row">

                  <!-- OBSERVACIÓN -->
                  <div class="form-group col-xs-9">
                    <label for="exampleFormControlTextarea1">Observación</label>
                    <textarea class="form-control rounded-0" id="comentario" name="comentario" rows="10"></textarea>
                  </div>
                  <div class="col-xs-3 pull-right">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>
                            <!--Impuesto-->
                          </th>
                          <th>Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td style="width: 0%">
                            <div class="input-group">
                              <input type="hidden" class="form-control input-lg" min="0" id="nuevoImpuestoOrdenedi" name="nuevoImpuestoOrdenedi" value="18" required>
                            </div>

                          </td>

                          <td style="width: 100%">

                            <div class="input-group">

                              <span class="input-group-addon">S/ </i></span>

                              <input type="text" class="form-control input-lg" id="nuevoTotalOrdenedi" name="nuevoTotalOrdenedi" total="<?php echo $ordenPedido["total"]; ?>" value="<?php echo $ordenPedido["total"]; ?>" readonly required>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-primary pull-right" id="GuardarOrdenC">Recibir Pedido</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>