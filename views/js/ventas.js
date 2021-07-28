/*=============================================
CARGAR LA TABLA DINÁMICA DE VENTAS
=============================================*/

// $.ajax({

// 	url: "ajax/datatable-ventas.ajax.php",
// 	success:function(respuesta){

// 		console.log("respuesta", respuesta);

// 	}

// })//
var idUser = $("#idUsuario").val();
$(".tablaVentas").DataTable({
  ajax: "ajax/datatable-ventas.ajax.php",
  deferRender: true,
  retrieve: true,
  processing: true,
  language: {
    sProcessing: "Procesando...",
    sLengthMenu: "Mostrar _MENU_ registros",
    sZeroRecords: "No se encontraron resultados",
    sEmptyTable: "Ningún dato disponible en esta tabla",
    sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
    sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0",
    sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
    sInfoPostFix: "",
    sSearch: "Buscar:",
    sUrl: "",
    sInfoThousands: ",",
    sLoadingRecords: "Cargando...",
    oPaginate: {
      sFirst: "Primero",
      sLast: "Último",
      sNext: "Siguiente",
      sPrevious: "Anterior",
    },
    oAria: {
      sSortAscending: ": Activar para ordenar la columna de manera ascendente",
      sSortDescending:
        ": Activar para ordenar la columna de manera descendente",
    },
  },
});

$(".tablaVentas2").DataTable({
  ajax: "ajax/datatable-ventas.ajax2.php",
  deferRender: true,
  retrieve: true,
  processing: true,
  language: {
    sProcessing: "Procesando...",
    sLengthMenu: "Mostrar _MENU_ registros",
    sZeroRecords: "No se encontraron resultados",
    sEmptyTable: "Ningún dato disponible en esta tabla",
    sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
    sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0",
    sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
    sInfoPostFix: "",
    sSearch: "Buscar:",
    sUrl: "",
    sInfoThousands: ",",
    sLoadingRecords: "Cargando...",
    oPaginate: {
      sFirst: "Primero",
      sLast: "Último",
      sNext: "Siguiente",
      sPrevious: "Anterior",
    },
    oAria: {
      sSortAscending: ": Activar para ordenar la columna de manera ascendente",
      sSortDescending:
        ": Activar para ordenar la columna de manera descendente",
    },
  },
});
/*=============================================
AGREGANDO PRODUCTOS A LA VENTA DESDE LA TABLA
=============================================*/
function agregarProducts(idProducto, descripcion, stock, precio) {

  if ($("#tipoUsuario").val() == "admin") {
    $(".nuevoProducto").append(
      '<div class="row" style="padding:5px 5px">' +
        "<!-- Descripción del producto -->" +
        '<div class="col-xs-4 descrip" style="padding-right:0px">' +
        '<div class="input-group">' +
        '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="' +
        idProducto +
        '"><i class="fa fa-times"></i></button></span>' +
        '<input type="text" class="form-control nuevaDescripcionProducto" idProducto="' +
        idProducto +
        '" name="agregarProducto" value="' +
        descripcion +
        '" readonly required>' +
        "</div>" +
        "</div>" +
        "<!-- Cantidad del producto -->" +
        '<div class="col-xs-2 ingresoCantidad">' +
        '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock="' +
        stock +
        '" nuevoStock="' +
        Number(stock - 1) +
        '" required>' +
        "</div>" +
        "<!-- Precio del producto -->" +
        '<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">' +
        '<div class="input-group">' +
        '<span class="input-group-addon">S/ </span>' +
        '<input type="text" class="form-control nuevoPrecioProducto" precioReal="' +
        precio +
        '" name="nuevoPrecioProducto" value="' +
        precio +
        '" required>' +
        "</div>" +
        "</div>" +
        "<!-- Precio del producto -->" +
        '<div class="col-xs-3 ingresoPreciosub" style="padding-left:0px">' +
        '<div class="input-group">' +
        '<span class="input-group-addon">S/ </span>' +
        '<input type="text" class="form-control nuevoPreciosub" preciosub="' +
        precio +
        '" name="nuevoPreciosub" value="' +
        precio +
        '" required>' +
        "</div>" +
        "</div>" +
        "</div>"
    );
    ActualizarStock(idUser,idProducto,1,0,null);
  } else {
    $(".nuevoProducto").append(
      '<div class="row" style="padding:2px 15px;">' +
        "<!-- Descripción del producto -->" +
        '<div class="col-xs-6 descrip" style="padding-right:0px">' +
        '<div class="input-group">' +
        '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="' +
        idProducto +
        '"><i class="fa fa-times"></i></button></span>' +
        '<input type="text" class="form-control nuevaDescripcionProducto" idProducto="' +
        idProducto +
        '" name="agregarProducto" value="' +
        descripcion +
        '" readonly required>' +
        "</div>" +
        "</div>" +
        "<!-- Cantidad del producto -->" +
        '<div class="col-xs-3 ingresoCantidad">' +
        '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock="' +
        stock +
        '" nuevoStock="' +
        Number(stock - 1) +
        '" required>' +
        "</div>" +
        "<!-- Precio del producto -->" +
        '<div class="col-xs-3 ingresoPrecio" style="display:none">' +
        '<div class="input-group">' +
        '<span class="input-group-addon">S/ </span>' +
        '<input type="text" class="form-control nuevoPrecioProducto" precioReal="' +
        precio +
        '" name="nuevoPrecioProducto" value="' +
        precio +
        '" readonly required>' +
        "</div>" +
        "</div>" +
        "<!-- Precio del producto -->" +
        '<div class="col-xs-3 ingresoPreciosub" style="padding-left:0px">' +
        '<div class="input-group">' +
        '<span class="input-group-addon">S/ </span>' +
        '<input type="text" class="form-control nuevoPreciosub" preciosub="' +
        precio +
        '" name="nuevoPreciosub" value="' +
        precio +
        '" required>' +
        "</div>" +
        "</div>" +
        "</div>"
    );
    ActualizarStock(idUser,idProducto,1,0,null);
  }
}

$(".tablaVentas tbody").on("click", "button.recuperarBoton", function () {
  var idProducto = $(this).attr("idProducto");

  var descr = $(".nuevaDescripcionProducto");
  var nuevaCant = $(".nuevaCantidadProducto");
  $(this).removeClass("btn-primary agregarProducto");

  $(this).addClass("btn-default agregarProducto");

  var datos = new FormData();
  datos.append("idProducto", idProducto);

  $.ajax({
    url: "ajax/productos.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      var descripcion = respuesta[0]["descripcion"];
      var stock = respuesta[0]["cantidad"];
      var precio = respuesta[0]["precioventa"];
   console.log(descripcion);
      /*=============================================
          EVITAR AGREGAR PRODUTO CUANDO EL STOCK ESTÁ EN CERO
      =============================================*/

      if (stock == 0) {
        swal({
          title: "No hay Stock disponible",
          type: "error",
          confirmButtonText: "¡Cerrar!",
        });

        $("button[idProducto='" + idProducto + "']").addClass(
          "btn-primary agregarProducto"
        );

        return;
      }
      if ($(".nuevoProducto").children().length > 1) {
        var idp;
        var existe;
        for (var i = 0; i <= descr.length; i++) {
          idp = $(descr[i]).attr("idProducto");
          if (idProducto == idp) {
            existe = true;
            nuevaCant = $(nuevaCant[i]);
            break;
          } else {
            existe = false;
          }
        }
        if (existe) {
          nuevaCant.val(parseInt(nuevaCant.val()) + 1);
          nuevaCantidad(nuevaCant);
        } else {
          agregarProducts(idProducto, descripcion, stock, precio);
        }
      } else {
        agregarProducts(idProducto, descripcion, stock, precio);
      }

      // SUMAR TOTAL DE PRECIOS

      sumarTotalPreciosV();

      // AGREGAR IMPUESTO

      agregarImpuestoV();

      // AGRUPAR PRODUCTOS EN FORMATO JSON

      listarProductosV();
      // document.getElementById("GuardarVenta").disabled = false;
      // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

      $(".nuevoPrecioProducto").number(true, 2);
      $(".nuevoPreciosub").number(true, 2);

      localStorage.removeItem("quitarProducto");
    },
  });
});

/*=============================================
AGREGANDO PRODUCTOS A LA VENTA DESDE LA TABLA
=============================================*/

$(".rowventas").on("click", "button.agregarProducto", function () {
  var idProducto = $(this).attr("idProducto");

  var descr = $(".nuevaDescripcionProducto");
  var nuevaCant = $(".nuevaCantidadProducto");
  $(this).removeClass("btn-primary agregarProducto");

  $(this).addClass("btn-default agregarProducto");

  var datos = new FormData();
  datos.append("idProducto", idProducto);

  $.ajax({
    url: "ajax/productos.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      var descripcion = respuesta[0]["descripcion"];
      var stock = respuesta[0]["cantidad"];
      var precio = respuesta[0]["precioventa"];

      /*=============================================
          EVITAR AGREGAR PRODUTO CUANDO EL STOCK ESTÁ EN CERO
          =============================================*/

      if (stock == 0) {
        swal({
          title: "No hay Stock disponible",
          type: "error",
          confirmButtonText: "¡Cerrar!",
        });

        $("button[idProducto='" + idProducto + "']").addClass(
          "btn-primary agregarProducto"
        );

        return;
      }
      if ($(".nuevoProducto").children().length > 1) {
        var idp;
        var existe;
        for (var i = 0; i <= descr.length; i++) {
          idp = $(descr[i]).attr("idProducto");

          if (idProducto == idp) {
            existe = true;
            nuevaCant = $(nuevaCant[i]);
            break;
          } else {
            existe = false;
          }
        }
        if (existe) {
          nuevaCant.val(parseInt(nuevaCant.val()) + 1);
          nuevaCantidad(nuevaCant);
        } else {
          agregarProducts(idProducto, descripcion, stock, precio);
        }
      } else {
        agregarProducts(idProducto, descripcion, stock, precio);
      }

      // SUMAR TOTAL DE PRECIOS

      sumarTotalPreciosV();

      // AGREGAR IMPUESTO

      agregarImpuestoV();

      // AGRUPAR PRODUCTOS EN FORMATO JSON

      listarProductosV();
      // document.getElementById("GuardarVenta").disabled = false;
      // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

      $(".nuevoPrecioProducto").number(true, 2);
      $(".nuevoPreciosub").number(true, 2);

      localStorage.removeItem("quitarProducto");
    },
  });
});

/*=============================================
AGREGANDO PRODUCTOS A LA VENTA DESDE LA TABLA LADO B
=============================================*/

function agregarProducts2(idProducto, descripcion, stock, precio) {
  if ($("#tipoUsuario").val() == "admin") {
    $(".nuevoProducto2").append(
      '<div class="row" style="padding:5px 5px">' +
        "<!-- Descripción del producto -->" +
        '<div class="col-xs-4" style="padding-right:0px">' +
        '<div class="input-group">' +
        '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto2" idProducto2="' +
        idProducto +
        '"><i class="fa fa-times"></i></button></span>' +
        '<input type="text" class="form-control nuevaDescripcionProducto2" idProducto2="' +
        idProducto +
        '" name="agregarProducto" value="' +
        descripcion +
        '" readonly required>' +
        "</div>" +
        "</div>" +
        "<!-- Cantidad del producto -->" +
        '<div class="col-xs-2 ingresoCantidad">' +
        '<input type="number" class="form-control nuevaCantidadProducto2" name="nuevaCantidadProducto2" min="1" value="1" stock2="' +
        stock +
        '" nuevoStock="' +
        Number(stock - 1) +
        '" required>' +
        "</div>" +
        "<!-- Precio del producto -->" +
        '<div class="col-xs-3 ingresoPrecio2" style="padding-left:0px">' +
        '<div class="input-group">' +
        '<span class="input-group-addon">S/ </span>' +
        '<input type="text" class="form-control nuevoPrecioProducto2" precioReal="' +
        precio +
        '" name="nuevoPrecioProducto" value="' +
        precio +
        '" required>' +
        "</div>" +
        "</div>" +
        "<!-- Precio del producto -->" +
        '<div class="col-xs-3 ingresoPreciosub2" style="padding-left:0px">' +
        '<div class="input-group">' +
        '<span class="input-group-addon">S/ </span>' +
        '<input type="text" class="form-control nuevoPreciosub2" preciosub2="' +
        precio +
        '" name="nuevoPreciosub2" value="' +
        precio +
        '" required>' +
        "</div>" +
        "</div>" +
        "</div>"
    );
  } else {
    $(".nuevoProducto2").append(
      '<div class="row" style="padding:2px 15px">' +
        "<!-- Descripción del producto -->" +
        '<div class="col-xs-6" style="padding-right:0px">' +
        '<div class="input-group">' +
        '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto2" idProducto2="' +
        idProducto +
        '"><i class="fa fa-times"></i></button></span>' +
        '<input type="text" class="form-control nuevaDescripcionProducto2" idProducto2="' +
        idProducto +
        '" name="agregarProducto2" value="' +
        descripcion +
        '" readonly required>' +
        "</div>" +
        "</div>" +
        "<!-- Cantidad del producto -->" +
        '<div class="col-xs-3 ingresoCantidad2">' +
        '<input type="number" class="form-control nuevaCantidadProducto2" name="nuevaCantidadProducto2" min="1" value="1" stock2="' +
        stock +
        '" nuevoStock2="' +
        Number(stock - 1) +
        '" required>' +
        "</div>" +
        "<!-- Precio del producto -->" +
        '<div class="col-xs-3 ingresoPrecio2" style="display:none">' +
        '<div class="input-group">' +
        '<span class="input-group-addon">S/ </span>' +
        '<input type="text" class="form-control nuevoPrecioProducto2" precioReal2="' +
        precio +
        '" name="nuevoPrecioProducto2" value="' +
        precio +
        '" readonly required>' +
        "</div>" +
        "</div>" +
        "<!-- Precio del producto -->" +
        '<div class="col-xs-3 ingresoPreciosub2" style="padding-left:0px">' +
        '<div class="input-group">' +
        '<span class="input-group-addon">S/ </span>' +
        '<input type="text" class="form-control nuevoPreciosub2" preciosub2="' +
        precio +
        '" name="nuevoPreciosub2" value="' +
        precio +
        '" required>' +
        "</div>" +
        "</div>"
    );
  }
}

$(".tablaVentas2 tbody").on("click", "button.agregarProducto", function () {
  var idProducto = $(this).attr("idProducto");
  var descr = $(".nuevaDescripcionProducto2");

  var nuevaCant = $(".nuevaCantidadProducto2");
  $(this).removeClass("btn-primary agregarProducto");

  $(this).addClass("btn-default agregarProducto");

  var datos = new FormData();
  datos.append("idProducto", idProducto);

  $.ajax({
    url: "ajax/productos.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      var descripcion = respuesta[0]["descripcion"];
      var stock = respuesta[0]["cantidad"];
      var precio = respuesta[0]["precioventa"];

      /*=============================================
            EVITAR AGREGAR PRODUTO CUANDO EL STOCK ESTÁ EN CERO
            =============================================*/

      if (stock == 0) {
        swal({
          title: "No hay Stock disponible",
          type: "error",
          confirmButtonText: "¡Cerrar!",
        });

        $("button[idProducto='" + idProducto + "']").addClass(
          "btn-primary agregarProducto"
        );

        return;
      }
      if ($(".nuevoProducto2").children().length > 1) {
        var idp;
        var existe;
        for (var i = 0; i <= descr.length; i++) {
          idp = $(descr[i]).attr("idProducto2");

          if (idProducto == idp) {
            existe = true;
            nuevaCant = $(nuevaCant[i]);
            break;
          } else {
            existe = false;
          }
        }

        if (existe) {
          nuevaCant.val(parseInt(nuevaCant.val()) + 1);
          nuevaCantidad2(nuevaCant);
        } else {
          agregarProducts2(idProducto, descripcion, stock, precio);
        }
      } else {
        agregarProducts2(idProducto, descripcion, stock, precio);
      }

      // SUMAR TOTAL DE PRECIOS

      sumarTotalPreciosV2();

      // AGREGAR IMPUESTO

      agregarImpuestoV2();

      // AGRUPAR PRODUCTOS EN FORMATO JSON

      listarProductosV2();
      document.getElementById("GuardarVenta2").disabled = false;
      // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

      $(".nuevoPrecioProducto2").number(true, 2);
      $(".nuevoPreciosub2").number(true, 2);

      localStorage.removeItem("quitarProducto2");
    },
  });
});

$(".rowventas2").on("click", "button.agregarProducto", function () {
  var idProducto = $(this).attr("idProducto");
  var descr = $(".nuevaDescripcionProducto2");

  var nuevaCant = $(".nuevaCantidadProducto2");
  $(this).removeClass("btn-primary agregarProducto");

  $(this).addClass("btn-default agregarProducto");

  var datos = new FormData();
  datos.append("idProducto", idProducto);

  $.ajax({
    url: "ajax/productos.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      var descripcion = respuesta[0]["descripcion"];
      var stock = respuesta[0]["cantidad"];
      var precio = respuesta[0]["precioventa"];

      /*=============================================
            EVITAR AGREGAR PRODUTO CUANDO EL STOCK ESTÁ EN CERO
            =============================================*/

      if (stock == 0) {
        swal({
          title: "No hay Stock disponible",
          type: "error",
          confirmButtonText: "¡Cerrar!",
        });

        $("button[idProducto='" + idProducto + "']").addClass(
          "btn-primary agregarProducto"
        );

        return;
      }
      if ($(".nuevoProducto2").children().length > 1) {
        var idp;
        var existe;
        for (var i = 0; i <= descr.length; i++) {
          idp = $(descr[i]).attr("idProducto2");

          if (idProducto == idp) {
            existe = true;
            nuevaCant = $(nuevaCant[i]);
            break;
          } else {
            existe = false;
          }
        }

        if (existe) {
          nuevaCant.val(parseInt(nuevaCant.val()) + 1);
          nuevaCantidad2(nuevaCant);
        } else {
          agregarProducts2(idProducto, descripcion, stock, precio);
        }
      } else {
        agregarProducts2(idProducto, descripcion, stock, precio);
      }

      // SUMAR TOTAL DE PRECIOS

      sumarTotalPreciosV2();

      // AGREGAR IMPUESTO

      agregarImpuestoV2();

      // AGRUPAR PRODUCTOS EN FORMATO JSON

      listarProductosV2();
      document.getElementById("GuardarVenta2").disabled = false;
      // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

      $(".nuevoPrecioProducto2").number(true, 2);
      $(".nuevoPreciosub2").number(true, 2);

      localStorage.removeItem("quitarProducto2");
    },
  });
});

/*=============================================
CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA
=============================================*/

$(".tablaVentas").on("draw.dt", function () {
  if (localStorage.getItem("quitarProducto") != null) {
    var listaIdProductos = JSON.parse(localStorage.getItem("quitarProducto"));

    for (var i = 0; i < listaIdProductos.length; i++) {
      $(
        "button.recuperarBoton[idProducto='" +
          listaIdProductos[i]["idProducto"] +
          "']"
      ).removeClass("btn-default");
      $(
        "button.recuperarBoton[idProducto='" +
          listaIdProductos[i]["idProducto"] +
          "']"
      ).addClass("btn-primary agregarProducto");
    }
  }
});

$(".tablaVentas2").on("draw.dt", function () {
  if (localStorage.getItem("quitarProducto2") != null) {
    var listaIdProductos = JSON.parse(localStorage.getItem("quitarProducto2"));

    for (var i = 0; i < listaIdProductos.length; i++) {
      $(
        "button.recuperarBoton[idProducto='" +
          listaIdProductos[i]["idProducto2"] +
          "']"
      ).removeClass("btn-default");
      $(
        "button.recuperarBoton[idProducto='" +
          listaIdProductos[i]["idProducto2"] +
          "']"
      ).addClass("btn-primary agregarProducto");
    }
  }
});
/*=============================================
QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÓN
=============================================*/

var idQuitarProducto = [];

localStorage.removeItem("quitarProducto");

$(".formularioVenta").on("click", "button.quitarProducto", function () {
  $(this).parent().parent().parent().parent().remove();

  var idProducto = $(this).attr("idProducto");
  
  var canti = $(this).parent().parent().parent().parent().children(".ingresoCantidad").children(".nuevaCantidadProducto");

   ActualizarStock(idUser,idProducto, canti.val(),1,null);
  /*=============================================
ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR
=============================================*/

  if (localStorage.getItem("quitarProducto") == null) {
    idQuitarProducto = [];
  } else {
    idQuitarProducto.concat(localStorage.getItem("quitarProducto"));
  }

  idQuitarProducto.push({ idProducto: idProducto });

  localStorage.setItem("quitarProducto", JSON.stringify(idQuitarProducto));

  $("button.recuperarBoton[idProducto='" + idProducto + "']").removeClass(
    "btn-default"
  );

  $("button.recuperarBoton[idProducto='" + idProducto + "']").addClass(
    "btn-primary agregarProducto"
  );

  if ($(".nuevoProducto").children().length == 1) {
    //$("#nuevoImpuestoVenta").val(0);
    $("#nuevoTotalVenta").val(0);
    $("#totalVenta").val(0);
    $("#TotalEfectivo").val(0);
    $("#descuento").val(0);
    $("#nuevoTotalVenta").attr("total", 0);
    document.getElementById("listaProductos").value = "[]";
    // document.getElementById("GuardarVenta").disabled = true;
  } else {
    // SUMAR TOTAL DE PRECIOS

    sumarTotalPreciosV();

    // AGREGAR IMPUESTO

    agregarImpuestoV();

    // AGRUPAR PRODUCTOS EN FORMATO JSON

    listarProductosV();

   
  }
});

/*=============================================
QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÓN
=============================================*/

var idQuitarProducto2 = [];

localStorage.removeItem("quitarProducto2");

$(".formularioVenta2").on("click", "button.quitarProducto2", function () {
  $(this).parent().parent().parent().parent().remove();

  var idProducto2 = $(this).attr("idProducto2");

  /*=============================================
ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR
=============================================*/

  if (localStorage.getItem("quitarProducto2") == null) {
    idQuitarProducto2 = [];
  } else {
    idQuitarProducto2.concat(localStorage.getItem("quitarProducto2"));
  }

  idQuitarProducto2.push({ idProducto2: idProducto2 });

  localStorage.setItem("quitarProducto2", JSON.stringify(idQuitarProducto2));

  $("button.recuperarBoton2[idProducto='" + idProducto2 + "']").removeClass(
    "btn-default"
  );

  $("button.recuperarBoton2[idProducto='" + idProducto2 + "']").addClass(
    "btn-primary agregarProducto"
  );

  if ($(".nuevoProducto2").children().length == 1) {
    //$("#nuevoImpuestoVenta").val(0);
    $("#nuevoTotalVenta2").val(0);
    $("#totalVenta2").val(0);
    $("#descuento").val(0);
    $("#nuevoTotalVenta2").attr("total", 0);
    // document.getElementById("GuardarVenta2").disabled = true;
    document.getElementById("listaProductos2").value = "[]";
  } else {
    // SUMAR TOTAL DE PRECIOS

    sumarTotalPreciosV2();

    // AGREGAR IMPUESTO

    agregarImpuestoV2();

    // AGRUPAR PRODUCTOS EN FORMATO JSON

    listarProductosV2();
  }
});

/*=============================================
MODIFICAR LA CANTIDAD
=============================================*/
$(".formularioVenta").on("click", "input.nuevaCantidadProducto", function () {
  $(this).select();

});

function nuevaCantidad(mythis) {
  var precio = mythis
    .parent()
    .parent()
    .children(".ingresoPrecio")
    .children()
    .children(".nuevoPrecioProducto");

  var preciosub = mythis
    .parent()
    .parent()
    .children(".ingresoPreciosub")
    .children()
    .children(".nuevoPreciosub");

  sumarDescuento();
  var idProduct = mythis
  .parent()
  .parent()
  .children(".descrip")
  .children()
  .children(".nuevaDescripcionProducto");
// console.log(idProduct.attr("idProducto"))
  ActualizarStock(idUser,idProduct.attr("idProducto"), mythis.val(),2,null);
  var precioFinal = mythis.val() * precio.val();

  preciosub.val(precioFinal);

  var nuevoStock = Number(mythis.attr("stock")) - mythis.val();

  mythis.attr("nuevoStock", nuevoStock);

  if (Number(mythis.val()) > Number(mythis.attr("stock"))) {
    /*=============================================
SI LA CANTIDAD ES SUPERIOR AL STOCK REGRESAR VALORES INICIALES
=============================================*/

    mythis.val(1);

    mythis.attr("nuevoStock", mythis.attr("stock"));

    var precioFinal = mythis.val() * precio.attr("precioReal");

    precio.val(precioFinal);

    sumarTotalPreciosV();

    swal({
      title: "La cantidad supera el Stock",
      text: "¡Sólo hay " + mythis.attr("stock") + " unidades!",
      type: "error",
      confirmButtonText: "¡Cerrar!",
    });

    return;
  }

  // SUMAR TOTAL DE PRECIOS

  sumarTotalPreciosV();

  // AGREGAR IMPUESTO

  agregarImpuestoV();

  // AGRUPAR PRODUCTOS EN FORMATO JSON

  listarProductosV();

}

$(".formularioVenta").on("change", "input.nuevaCantidadProducto", function () {
  // console.log($(this));
  nuevaCantidad($(this));
});

/*=============================================
MODIFICAR LA PRECIO SUB
=============================================*/
$(".formularioVenta").on("click", "input.nuevoPreciosub", function () {
  $(this).select();
});

$(".formularioVenta").on("change", "input.nuevoPreciosub", function () {
  // console.log("aaaaaa");
  var cantid = $(this)
    .parent()
    .parent()
    .parent()
    .children(".ingresoCantidad")
    .children(".nuevaCantidadProducto");

  var nuevcant = $(this).val() / $(this).attr("preciosub");
  cantid.val($.number(nuevcant, 3));
  // SUMAR TOTAL DE PRECIOS
  // console.log($(this).val);
  sumarTotalPreciosV();

  // AGREGAR IMPUESTO

  agregarImpuestoV();

  // AGRUPAR PRODUCTOS EN FORMATO JSON

  listarProductosV();

  ActualizarStock(idUser,idProducto, cantid,2,null);
});

/*=============================================
MODIFICAR LA PRECIO
=============================================*/

$(".formularioVenta").on("change", "input.nuevoPrecioProducto", function () {
  var preciosubt = $(this)
    .parent()
    .parent()
    .parent()
    .children(".ingresoPreciosub")
    .children()
    .children(".nuevoPreciosub");

  var cantid = $(this)
    .parent()
    .parent()
    .parent()
    .children(".ingresoCantidad")
    .children(".nuevaCantidadProducto");

  preciosubt.val($(this).val() * cantid.val());

  sumarDescuento();
  // SUMAR TOTAL DE PRECIOS

  sumarTotalPreciosV();

  // AGREGAR IMPUESTO

  agregarImpuestoV();

  // AGRUPAR PRODUCTOS EN FORMATO JSON

  listarProductosV();
});

/*=============================================
MODIFICAR LA CANTIDAD
=============================================*/
$(".formularioVenta2").on("click", "input.nuevaCantidadProducto2", function () {
  $(this).select();
});
function nuevaCantidad2(mythis) {
  var precio = mythis
    .parent()
    .parent()
    .children(".ingresoPrecio2")
    .children()
    .children(".nuevoPrecioProducto2");

  var preciosub = mythis
    .parent()
    .parent()
    .children(".ingresoPreciosub2")
    .children()
    .children(".nuevoPreciosub2");

  sumarDescuento2();

  var precioFinal = mythis.val() * precio.val();

  preciosub.val(precioFinal);

  var nuevoStock = Number(mythis.attr("stock2")) - mythis.val();

  mythis.attr("nuevoStock2", nuevoStock);

  if (Number(mythis.val()) > Number(mythis.attr("stock2"))) {
    /*=============================================
SI LA CANTIDAD ES SUPERIOR AL STOCK REGRESAR VALORES INICIALES
=============================================*/

    mythis.val(1);

    mythis.attr("nuevoStock2", mythis.attr("stock2"));

    var precioFinal = mythis.val() * precio.attr("precioReal2");

    precio.val(precioFinal);

    sumarTotalPreciosV();

    swal({
      title: "La cantidad supera el Stock",
      text: "¡Sólo hay " + mythis.attr("stock") + " unidades!",
      type: "error",
      confirmButtonText: "¡Cerrar!",
    });

    return;
  }

  // SUMAR TOTAL DE PRECIOS

  sumarTotalPreciosV2();

  // AGREGAR IMPUESTO

  agregarImpuestoV2();

  // AGRUPAR PRODUCTOS EN FORMATO JSON

  listarProductosV2();
}

$(".formularioVenta2").on(
  "change",
  "input.nuevaCantidadProducto2",
  function () {
    //  console.log($(this));
    nuevaCantidad2($(this));
  }
);

/*=============================================
MODIFICAR LA PRECIO SUB
=============================================*/
$(".formularioVenta2").on("click", "input.nuevoPreciosub2", function () {
  $(this).select();
});

$(".formularioVenta2").on("change", "input.nuevoPreciosub2", function () {
  var cantid = $(this)
    .parent()
    .parent()
    .parent()
    .children(".ingresoCantidad2")
    .children(".nuevaCantidadProducto2");

  var nuevcant = $(this).val() / $(this).attr("preciosub2");
  cantid.val($.number(nuevcant, 3));
  // SUMAR TOTAL DE PRECIOS
  // console.log($(this).val);
  sumarTotalPreciosV2();

  // AGREGAR IMPUESTO

  agregarImpuestoV2();

  // AGRUPAR PRODUCTOS EN FORMATO JSON

  listarProductosV2();
});
/*=============================================
MODIFICAR LA PRECIO
=============================================*/

$(".formularioVenta2").on("change", "input.nuevoPrecioProducto2", function () {
  var preciosubt = $(this)
    .parent()
    .parent()
    .parent()
    .children(".ingresoPreciosub2")
    .children()
    .children(".nuevoPreciosub2");

  var cantid = $(this)
    .parent()
    .parent()
    .parent()
    .children(".ingresoCantidad2")
    .children(".nuevaCantidadProducto2");

  preciosubt.val($(this).val() * cantid.val());

  sumarDescuento2();
  // SUMAR TOTAL DE PRECIOS

  sumarTotalPreciosV2();

  // AGREGAR IMPUESTO

  agregarImpuestoV2();

  // AGRUPAR PRODUCTOS EN FORMATO JSON

  listarProductosV2();
});

/*=============================================
SUMAR TODOS LOS PRECIOS
=============================================*/
var midesc;
function sumarTotalPreciosV() {
  var precioItem = $(".nuevoPreciosub");

  var arraySumaPrecio = [];

  for (var i = 0; i < precioItem.length; i++) {
    arraySumaPrecio.push(Number($(precioItem[i]).val()));
  }

  function sumaArrayPrecios(total, numero) {
    return total + numero;
  }

  var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios);

  if (typeof variable !== "undefined") {
    midesc = $("#descuento").val();
  } else {
    midesc = 0;
  }

  var prefinal = sumaTotalPrecio;

  $("#nuevoTotalVenta").val(prefinal);
  $("#totalVenta").val(prefinal);
  if(document.getElementById("vale").checked){
    $("#TotalEfectivo").val(0);
  }else{
    $("#TotalEfectivo").val(prefinal);
  }
  
  $("#nuevoTotalVenta").attr("total", prefinal);
}

/*=============================================
SUMAR TODOS LOS PRECIOS
=============================================*/
var midesc2;
function sumarTotalPreciosV2() {
  var precioItem = $(".nuevoPreciosub2");

  var arraySumaPrecio = [];

  for (var i = 0; i < precioItem.length; i++) {
    arraySumaPrecio.push(Number($(precioItem[i]).val()));
  }

  function sumaArrayPrecios(total, numero) {
    return total + numero;
  }

  var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios);

  if (typeof variable !== "undefined") {
    midesc2 = $("#descuento2").val();
  } else {
    midesc2 = 0;
  }

  var prefinal = sumaTotalPrecio;

  $("#nuevoTotalVenta2").val(prefinal);
  $("#totalVenta2").val(prefinal);
  $("#nuevoTotalVenta2").attr("total", prefinal);
}

/*=============================================
FUNCIÓN AGREGAR IMPUESTO
=============================================*/
var descu;
function agregarImpuestoV() {
  var impuesto = $("#nuevoImpuestoVenta").val();
  var precioTotal = $("#nuevoTotalVenta").attr("total");
  descu = $("#descuento").val();
  if (typeof descu !== "undefined") {
    descu = $("#descuento").val();
  } else {
    descu = 0;
  }
  var precioSinImpuesto = Number(precioTotal / (1 + impuesto / 100));
  var totalConImpuesto = Number(precioTotal);
  // console.log(precioTotal);
  var precioImpuesto = Number(totalConImpuesto - precioSinImpuesto);
  $("#nuevoTotalVenta").val(totalConImpuesto);

  $("#totalVenta").val(totalConImpuesto);

  if(document.getElementById("vale").checked){
    $("#TotalEfectivo").val(0);
  }else{
    $("#TotalEfectivo").val(totalConImpuesto);
  }

 
  $("#nuevoPrecioImpuesto").val(precioImpuesto);

  $("#nuevoPrecioNeto").val(precioSinImpuesto);
}

var descu;
function agregarImpues() {
  var impuesto = $("#nuevoImpuestoVenta").val();
  var precioTotal = $("#nuevoTotalVenta").attr("total");
  descu = $("#descuento").val();
  if (typeof descu !== "undefined") {
    descu = $("#descuento").val();
  } else {
    descu = 0;
  }
  var precioSinImpuesto = Number((precioTotal - descu) / (1 + impuesto / 100));
  var totalConImpuesto = Number(precioTotal - descu);
  // console.log(precioTotal);
  var precioImpuesto = Number(totalConImpuesto - precioSinImpuesto);
  $("#nuevoTotalVenta").val(totalConImpuesto);

  $("#totalVenta").val(totalConImpuesto);

  if(document.getElementById("vale").checked){
    $("#TotalEfectivo").val(0);
  }else{
    $("#TotalEfectivo").val(totalConImpuesto);
  }
  
  $("#nuevoPrecioImpuesto").val(precioImpuesto);

  $("#nuevoPrecioNeto").val(precioSinImpuesto);
}

/*=============================================
FUNCIÓN AGREGAR IMPUESTO
=============================================*/

function agregarImpuestoV2() {
  var impuesto = $("#nuevoImpuestoVenta2").val();
  var precioTotal = $("#nuevoTotalVenta2").attr("total");
  descu = $("#descuento2").val();
  if (typeof descu !== "undefined") {
    descu = $("#descuento2").val();
  } else {
    descu = 0;
  }
  var precioSinImpuesto = Number(precioTotal / (1 + impuesto / 100));
  var totalConImpuesto = Number(precioTotal);
  // console.log(precioTotal);
  var precioImpuesto = Number(totalConImpuesto - precioSinImpuesto);
  $("#nuevoTotalVenta2").val(totalConImpuesto);

  $("#totalVenta2").val(totalConImpuesto);

  $("#nuevoPrecioImpuesto2").val(precioImpuesto);

  $("#nuevoPrecioNeto2").val(precioSinImpuesto);
}

var descu2;
function agregarImpues2() {
  var impuesto = $("#nuevoImpuestoVenta2").val();
  var precioTotal = $("#nuevoTotalVenta2").attr("total");
  descu2 = $("#descuento2").val();
  if (typeof descu2 !== "undefined") {
    descu2 = $("#descuento2").val();
  } else {
    descu2 = 0;
  }
  var precioSinImpuesto = Number((precioTotal - descu2) / (1 + impuesto / 100));
  var totalConImpuesto = Number(precioTotal - descu2);
  // console.log(precioTotal);
  var precioImpuesto = Number(totalConImpuesto - precioSinImpuesto);
  $("#nuevoTotalVenta2").val(totalConImpuesto);

  $("#totalVenta2").val(totalConImpuesto);

  $("#nuevoPrecioImpuesto2").val(precioImpuesto);

  $("#nuevoPrecioNeto2").val(precioSinImpuesto);
}

/*=============================================
CUANDO CAMBIA EL IMPUESTO
=============================================*/

$("#nuevoImpuestoVenta").change(function () {
  agregarImpuestoV();
  agregarImpuestoV2();
});

function descuent() {
  var descu = $("#descuento").val();

  var precioTot = $("#nuevoTotalVenta").attr("total");

  var nuevototal = Number(precioTot - descu);

  $("#nuevoTotalVenta").val(nuevototal);

  $("#totalVenta").val(nuevototal);
  if(document.getElementById("vale").checked){
    $("#TotalEfectivo").val(0);
  }else{
    $("#TotalEfectivo").val(nuevototal);
  }
  
  agregarImpues();
}

function descuent2() {
  var descu = $("#descuento2").val();

  var precioTot = $("#nuevoTotalVenta2").attr("total");

  var nuevototal = Number(precioTot - descu);

  $("#nuevoTotalVenta2").val(nuevototal);

  $("#totalVenta2").val(nuevototal);
  agregarImpues2();
}

$("#descuento").change(function () {
  var precioItems = $(".nuevoPrecioProducto");
  var preciosub = $(".nuevoPreciosub");
  var cantsub = $(".nuevaCantidadProducto");

  for (var i = 0; i < precioItems.length; i++) {
    $(precioItems[i]).val($(precioItems[i]).attr("precioReal"));

    $(preciosub[i]).val(
      $(cantsub[i]).val() * $(precioItems[i]).attr("precioReal")
    );
  }

  sumarTotalPreciosV();
  descuent();
});

$("#descuento2").change(function () {
  var precioItems = $(".nuevoPrecioProducto2");
  var preciosub = $(".nuevoPreciosub2");
  var cantsub = $(".nuevaCantidadProducto2");

  for (var i = 0; i < precioItems.length; i++) {
    $(precioItems[i]).val($(precioItems[i]).attr("precioReal2"));

    $(preciosub[i]).val(
      $(cantsub[i]).val() * $(precioItems[i]).attr("precioReal2")
    );
  }

  sumarTotalPreciosV2();
  descuent2();
});

function sumarDescuento() {
  var precioIte = $(".nuevoPrecioProducto");
  var cant = $(".nuevaCantidadProducto");

  var arraySumaDescuentos = [];

  for (var i = 0; i < precioIte.length; i++) {
    arraySumaDescuentos.push(
      Number(
        ($(precioIte[i]).attr("precioreal") - $(precioIte[i]).val()) *
          $(cant[i]).val()
      )
    );
  }

  function sumaArrayDescuento(total, numero) {
    return total + numero;
  }

  var sumarDescuentos = arraySumaDescuentos.reduce(sumaArrayDescuento);

  $("#descuento").val(sumarDescuentos);
}

function sumarDescuento2() {
  var precioIte = $(".nuevoPrecioProducto2");
  var cant = $(".nuevaCantidadProducto2");

  var arraySumaDescuentos = [];

  for (var i = 0; i < precioIte.length; i++) {
    arraySumaDescuentos.push(
      Number(
        ($(precioIte[i]).attr("precioreal2") - $(precioIte[i]).val()) *
          $(cant[i]).val()
      )
    );
  }

  function sumaArrayDescuento(total, numero) {
    return total + numero;
  }

  var sumarDescuentos = arraySumaDescuentos.reduce(sumaArrayDescuento);

  $("#descuento2").val(sumarDescuentos);
}

/*=============================================
FORMATO AL PRECIO FINAL
=============================================*/

$("#nuevoTotalVenta").number(true, 2);
$("#TotalEfectivo").number(true, 2);
$("#TotalTarjeta").number(true, 2);
$("#vuelto").number(true, 2);
$("#nuevoTotalVenta2").number(true, 2);

/*=============================================
CAMBIO EN EFECTIVO
=============================================*/
$("#TotalEfectivo").click(function () {
  $(this).select();
});
$(".formularioVenta").on("change", "input#TotalEfectivo", function () {
  var efectivo = $(this).val();
  if ($("#Ambos").is(":checked")) {
    if (Number($("#nuevoTotalVenta").val() > Number(efectivo))) {
      // document.getElementById("GuardarVenta").disabled = true;
      var cambio = Number($("#nuevoTotalVenta").val()) - Number(efectivo);
      $("#TotalTarjeta").val(cambio);
    } else {
      // document.getElementById("GuardarVenta").disabled = true;
      var cambio = Number($("#nuevoTotalVenta").val()) - Number(efectivo);
      $("#TotalTarjeta").val(cambio);
    }
  }
  //else {

  //   if (Number($("#nuevoTotalVenta").val() > Number(efectivo))) {
  //     document.getElementById("dolar").style.borderColor = "red";
  //     document.getElementById("TotalEfectivo").style.borderColor = "red";
  //     document.getElementById("GuardarVenta").disabled = true;
  //     var cambio = Number(efectivo) - Number($("#nuevoTotalVenta").val());
  //     $("#vuelto").val(cambio)
  //   } else {
  //     document.getElementById("GuardarVenta").disabled = false;
  //     document.getElementById("TotalEfectivo").style.borderColor = null;
  //     document.getElementById("dolar").style.borderColor = null;
  //     var cambio = Number(efectivo) - Number($("#nuevoTotalVenta").val());
  //     $("#vuelto").val(cambio)
  //   }
  // }
});

/*=============================================
CAMBIO EN EFECTIVO
=============================================*/
$("#Pago").click(function () {
  $(this).select();
});
$(".formularioVenta").on("change", "input#Pago", function () {
  var Pago = $(this).val();
  // document.getElementById("GuardarVenta").disabled = false;
  // document.getElementById("Pago").style.borderColor = null;
  // document.getElementById("dolar").style.borderColor = null;
  var cambio = Number(Pago) - Number($("#TotalEfectivo").val());
  $("#vuelto").val(cambio);
});

/*=============================================
CAMBIO EN EFECTIVO
=============================================*/
$(".formularioVenta2").on("change", "input#nuevoValorEfectivo2", function () {
  var efectivo = $(this).val();
  if (Number($("#nuevoTotalVenta2").val() > Number(efectivo))) {
    document.getElementById("error2").style.visibility = "visible";
    document.getElementById("dolar2").style.borderColor = "red";
    document.getElementById("nuevoValorEfectivo2").style.borderColor = "red";
    document.getElementById("GuardarVenta2").disabled = true;
    var cambio = Number(efectivo) - Number($("#nuevoTotalVenta2").val());

    var nuevoCambioEfectivo = $(this)
      .parent()
      .parent()
      .parent()
      .children("#capturarCambioEfectivo2")
      .children()
      .children("#nuevoCambioEfectivo2");

    nuevoCambioEfectivo.val(cambio);
  } else {
    document.getElementById("error2").style.visibility = "hidden";
    document.getElementById("GuardarVenta2").disabled = false;
    document.getElementById("nuevoValorEfectivo2").style.borderColor = null;
    document.getElementById("dolar2").style.borderColor = null;
    var cambio = Number(efectivo) - Number($("#nuevoTotalVenta2").val());

    var nuevoCambioEfectivo = $(this)
      .parent()
      .parent()
      .parent()
      .children("#capturarCambioEfectivo2")
      .children()
      .children("#nuevoCambioEfectivo2");

    nuevoCambioEfectivo.val(cambio);
  }
});

$("#Tarjeta").click(function () {
  if ($("#Tarjeta").is(":checked")) {
    document.getElementById("CodigoTarjeta").style.display = "block";
    // $("#TotalTarjeta").removeAttr("readonly");
    $("#TotalTarjeta").attr("readonly", "readonly");
    $("#CodigoTarjeta").removeAttr("readonly");
    $("#TotalEfectivo").attr("readonly", "readonly");
    document.getElementById("Efectivo").checked = false;
    $("#TotalTarjeta").val(Number($("#totalVenta").val()));
    $("#TotalEfectivo").val(0);
    document.getElementById("tipopago").value = "Tarjeta";
  } else {
    document.getElementById("CodigoTarjeta").style.display = "none";
    $("#TotalTarjeta").attr("readonly", "readonly");
    $("#CodigoTarjeta").attr("readonly", "readonly");
    $("#TotalTarjeta").val(0);
    $("#TotalEfectivo").val($("#totalVenta").val());
    document.getElementById("Efectivo").checked = true;
    $("#TotalEfectivo").removeAttr("readonly");
    document.getElementById("tipopago").value = "Efectivo";
  }
  $("#vuelto").val(0);
  document.getElementById("Ambos").checked = false;
});

$("#Efectivo").click(function () {
  if ($("#Efectivo").is(":checked")) {
    document.getElementById("CodigoTarjeta").style.display = "none";
    $("#TotalEfectivo").attr("readonly", "readonly");
    $("#TotalTarjeta").attr("readonly", "readonly");
    $("#CodigoTarjeta").attr("readonly", "readonly");
    document.getElementById("Tarjeta").checked = false;
    $("#TotalEfectivo").val(Number($("#totalVenta").val()));
    $("#TotalTarjeta").val(0);
    $("#CodigoTarjeta").val("");
    document.getElementById("tipopago").value = "Efectivo";
  } else {
    document.getElementById("CodigoTarjeta").style.display = "block";
    $("#TotalTarjeta").removeAttr("readonly");
    $("#CodigoTarjeta").removeAttr("readonly");
    $("#TotalTarjeta").val($("#totalVenta").val());
    $("#TotalEfectivo").val(0);
    document.getElementById("Tarjeta").checked = true;
    $("#TotalEfectivo").attr("readonly", "readonly");
    document.getElementById("tipopago").value = "Tarjeta";
  }
  $("#vuelto").val(0);
  $("#Pago").val(0);
  document.getElementById("Ambos").checked = false;
});

$("#Ambos").click(function () {
  if ($("#Ambos").is(":checked")) {
    document.getElementById("CodigoTarjeta").style.display = "block";
    $("#TotalTarjeta").removeAttr("readonly");
    $("#CodigoTarjeta").removeAttr("readonly");
    $("#TotalEfectivo").removeAttr("readonly");
    document.getElementById("Tarjeta").checked = false;
    document.getElementById("Efectivo").checked = false;
    $("#TotalTarjeta").val(0);
    $("#TotalEfectivo").val(0);
    document.getElementById("tipopago").value = "Efectivo/Tarjeta";
  } else {
    document.getElementById("CodigoTarjeta").style.display = "none";
    $("#TotalTarjeta").attr("readonly", "readonly");
    $("#CodigoTarjeta").attr("readonly", "readonly");
    $("#TotalTarjeta").val(0);
    $("#TotalEfectivo").val($("#totalVenta").val());
    document.getElementById("Efectivo").checked = true;
    $("#TotalEfectivo").removeAttr("readonly");
    document.getElementById("tipopago").value = "Efectivo";
  }
  $("#vuelto").val(0);
});
/*=============================================
CAMBIO EN EFECTIVO
=============================================*/
$("#TotalTarjeta").click(function () {
  $(this).select();
});
$(".formularioVenta").on("change", "input#TotalTarjeta", function () {
  var efectivo = $(this).val();
  if ($("#Ambos").is(":checked")) {
    if (Number($("#nuevoTotalVenta").val() > Number(efectivo))) {
      var cambio = Number($("#nuevoTotalVenta").val()) - Number(efectivo);
      $("#TotalEfectivo").val(cambio);
      // document.getElementById("TotalEfectivo").value = Number(cambio);
    }
  } else {
    if (Number($("#nuevoTotalVenta").val() > Number(efectivo))) {
      document.getElementById("GuardarVenta").disabled = true;
      document.getElementById("TotalTarjeta").style.borderColor = "red";
      // var cambio = Number($("#nuevoTotalVenta").val()) - Number(efectivo);
      // document.getElementById("Efectivo").checked=true;
      // $("#TotalEfectivo").removeAttr("readonly");
      // $("#TotalEfectivo").val(cambio);

      // } else {
      //   // document.getElementById("error").style.visibility = "hidden";
      //   document.getElementById("GuardarVenta").disabled = false;
      //   document.getElementById("TotalEfectivo").style.borderColor = null;
      //   document.getElementById("dolar").style.borderColor = null;
      //   var cambio = Number(efectivo) - Number($("#nuevoTotalVenta").val());
      //   document.getElementById("vuelto").value = cambio;
    } else {
      document.getElementById("GuardarVenta").disabled = false;
      document.getElementById("TotalTarjeta").style.borderColor = null;
    }
  }
});

$("#vale").click(function () {
  $("#modalAgregarCliente").modal("show");
  document.getElementById("comprobbol").checked = false;
  document.getElementById("comprobfac").checked = false;
  document.getElementById("tipopago").value = "Vale";
  $("#TotalEfectivo").val(0);
  // if ($("#vale").is(':checked')) {
  //   document.getElementById("CodigoTarjeta").style.display = "none";
  //   $("#TotalEfectivo").attr("readonly","readonly");
  //   $("#TotalTarjeta").attr("readonly","readonly");
  //   $("#CodigoTarjeta").attr("readonly","readonly");
  //   document.getElementById("Tarjeta").checked=false;
  //   $("#TotalEfectivo").val(Number($("#totalVenta").val()));
  //   $("#TotalTarjeta").val(0);
  //   $("#CodigoTarjeta").val("");
  // }
  $("#TotalTarjeta").val(0);
  $("#CodigoTarjeta").val("");
  document.getElementById("tipopago").value = "Vale";
  $("#vuelto").val(0);
  $("#Pago").val(0);
});

/*=============================================
CAMBIO TRANSACCIÓN
=============================================*/
$(".formularioVenta").on("change", "input#nuevoCodigoTransaccion", function () {
  // Listar método en la entrada
  listarMetodos();
});
/*=============================================
CAMBIO TRANSACCIÓN
=============================================*/
$(".formularioVenta2").on(
  "change",
  "input#nuevoCodigoTransaccion2",
  function () {
    // Listar método en la entrada
    listarMetodos2();
  }
);
/*=============================================
LISTAR TODOS LOS PRODUCTOS
=============================================*/

function listarProductosV() {
  var listaProductos = [];
  var descripcion = $(".nuevaDescripcionProducto");

  var cantidad = $(".nuevaCantidadProducto");

  var precio = $(".nuevoPreciosub");

  for (var i = 0; i < descripcion.length; i++) {
    listaProductos.push({
      id: $(descripcion[i]).attr("idProducto"),
      descripcion: $(descripcion[i]).val(),
      cantidad: $(cantidad[i]).val(),
      stock: $(cantidad[i]).attr("nuevoStock"),
      precio: $(precio[i]).attr("preciosub"),
      total: $(precio[i]).val(),
    });
  }

  $("#listaProductos").val(JSON.stringify(listaProductos));
  // var Lispro = JSON.parse($("#listaProductos").val());
  // console.log(Lispro.length)
}

function listarProductosV2() {
  var listaProductos2 = [];

  var descripcion = $(".nuevaDescripcionProducto2");

  var cantidad = $(".nuevaCantidadProducto2");

  var precio = $(".nuevoPreciosub2");

  for (var i = 0; i < descripcion.length; i++) {
    listaProductos2.push({
      id: $(descripcion[i]).attr("idProducto2"),
      descripcion: $(descripcion[i]).val(),
      cantidad: $(cantidad[i]).val(),
      stock: $(cantidad[i]).attr("nuevoStock2"),
      precio: $(precio[i]).attr("preciosub2"),
      total: $(precio[i]).val(),
    });
  }

  $("#listaProductos2").val(JSON.stringify(listaProductos2));
}
//$(".formularioVenta").on("click", "button.aaaaa", function(){
//$(".formularioOrdenedi").on("change", "input#GuardarVenta", function(){

listarProductosV();
listarProductosV2();
/*=============================================
LISTAR MÉTODO DE PAGO
=============================================*/

function listarMetodos() {
  var listaMetodos = "";

  if ($("#nuevoMetodoPago").val() == "Efectivo") {
    $("#listaMetodoPago").val("Efectivo");
    document.getElementById("error").style.visibility = "hidden";
  } else {
    $("#listaMetodoPago").val(
      $("#nuevoMetodoPago").val() + "-" + $("#nuevoCodigoTransaccion").val()
    );
  }
}

function listarMetodos2() {
  var listaMetodos = "";

  if ($("#nuevoMetodoPago2").val() == "Efectivo") {
    $("#listaMetodoPago2").val("Efectivo");
    document.getElementById("error2").style.visibility = "hidden";
  } else {
    $("#listaMetodoPago2").val(
      $("#nuevoMetodoPago2").val() + "-" + $("#nuevoCodigoTransaccion2").val()
    );
  }
}

/*=============================================
BOTON EDITAR VENTA
=============================================*/
$(".tablasMventas").on("click", ".btnEditarVenta", function () {
  var idVenta = $(this).attr("idVenta");

  window.location = "index.php?ruta=editar-venta&idVenta=" + idVenta;
});

/*=============================================
FUNCIÓN PARA DESACTIVAR LOS BOTONES AGREGAR CUANDO EL PRODUCTO YA HABÍA SIDO SELECCIONADO EN LA CARPETA
=============================================*/

function quitarAgregarProductos() {
  //Capturamos todos los id de productos que fueron elegidos en la venta
  var idProductos = $(".quitarProducto");

  //Capturamos todos los botones de agregar que aparecen en la tabla
  var botonesTabla = $(".tablaVentas tbody button.agregarProducto");

  //console.log(idProductos.length);
  //Recorremos en un ciclo para obtener los diferentes idProductos que fueron agregados a la venta
  for (var i = 0; i < idProductos.length; i++) {
    //Capturamos los Id de los productos agregados a la venta
    var boton = $(idProductos[i]).attr("idProducto");

    //Hacemos un recorrido por la tabla que aparece para desactivar los botones de agregar
    for (var j = 0; j < botonesTabla.length; j++) {
      if ($(botonesTabla[j]).attr("idProducto") == boton) {
        $(botonesTabla[j]).removeClass("btn-primary agregarProducto");
        $(botonesTabla[j]).addClass("btn-default");
      }
    }
  }
}

/*=============================================
CADA VEZ QUE CARGUE LA TABLA CUANDO NAVEGAMOS EN ELLA EJECUTAR LA FUNCIÓN:
=============================================*/
$(".tablaVentas").on("draw.dt", function () {
  quitarAgregarProductos();
});

/*=============================================
BORRAR VENTA
=============================================*/

$(".tablasMventas").on("click", ".btnEliminarVenta", function () {
  var idVenta = $(this).attr("idVenta");

  swal({
    title: "¿Está seguro de borrar la venta?",
    text: "¡Si no lo está seguro puede cancelar la accíón!",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    cancelButtonText: "Cancelar",
    confirmButtonText: "Si, borrar venta!",
  }).then(function (result) {
    if (result.value) {
      window.location = "index.php?ruta=ventas&idVenta=" + idVenta;
    }
  });
});

/*=============================================
IMPRIMIR FACTURA
=============================================*/

$(".tablasMventas").on("click", ".btnImprimirFactura", function () {
  var codigoVenta = $(this).attr("codigoVentaFac");

  window.open(
    "extensiones/tcpdf/pdf/factura.php?codigo=" + codigoVenta,
    "_blank"
  );
});

$(".tablasMventas").on("click", ".btnImprimirBoleta", function () {
  var codigoVenta = $(this).attr("codigoVentaBol");

  window.open(
    "extensiones/tcpdf/pdf/boleta.php?codigo=" + codigoVenta,
    "_blank"
  );
});

/*=============================================
RANGO DE FECHAS
=============================================*/

// $('#daterange-btn').daterangepicker(
// {
//   ranges   : {
//     'Hoy'       : [moment(), moment()],
//     'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
//     'Últimos 7 días' : [moment().subtract(6, 'days'), moment()],
//     'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
//     'Este mes'  : [moment().startOf('month'), moment().endOf('month')],
//     'Último mes'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
//   },
//   startDate: moment(),
//   endDate  : moment()
// },
// function (start, end) {
//   $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

//   var fechaInicial = start.format('YYYY-MM-DD');

//   var fechaFinal = end.format('YYYY-MM-DD');

//   var capturarRango = $("#daterange-btn span").html();

//    localStorage.setItem("capturarRango", capturarRango);

//    window.location = "index.php?ruta=ventas&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

// }

// )

/*=============================================
CANCELAR RANGO DE FECHAS
=============================================*/

$(".daterangepicker.opensleft .range_inputs .cancelBtn").on(
  "click",
  function () {
    localStorage.removeItem("capturarRango");
    localStorage.clear();
    window.location = "ventas";
  }
);

/*=============================================
CAPTURAR HOY
=============================================*/

$(".daterangepicker.opensleft .ranges li").on("click", function () {
  var textoHoy = $(this).attr("data-range-key");

  if (textoHoy == "Hoy") {
    var d = new Date();

    var dia = d.getDate();
    var mes = d.getMonth() + 1;
    var año = d.getFullYear();

    if (mes < 10) {
      var fechaInicial = año + "-0" + mes + "-" + dia;
      var fechaFinal = año + "-0" + mes + "-" + dia;
    } else if (dia < 10) {
      var fechaInicial = año + "-" + mes + "-0" + dia;
      var fechaFinal = año + "-" + mes + "-0" + dia;
    } else if (mes < 10 && dia < 10) {
      var fechaInicial = año + "-0" + mes + "-0" + dia;
      var fechaFinal = año + "-0" + mes + "-0" + dia;
    } else {
      var fechaInicial = año + "-" + mes + "-" + dia;
      var fechaFinal = año + "-" + mes + "-" + dia;
    }

    localStorage.setItem("capturarRango", "Hoy");

    window.location =
      "index.php?ruta=ventas&fechaInicial=" +
      fechaInicial +
      "&fechaFinal=" +
      fechaFinal;
  }
});

// $("#seleccionarCliente").select2({ width: '100%' });
// $("#seleccionarClienteruc").removeAttr("required");

var tipocom = 0;
var tipodoc = "";
var namecompro = "";
function comprobfac() {
  if (tipocom == 0 || tipocom == 1) {
    document.getElementById("nuevoDocumento").value = "";
    document.getElementById("clientenombre").value = "";
    document.getElementById("domicilio").value = "";
    document.getElementById("documento").value = "RUC";
    document.getElementById("nuevoDocumento").placeholder = "Ingrese DNI/RUC";
    document.getElementById("domici").style.display = "block";
    document.getElementById("comprobfac").checked = true;
    document.getElementById("vale").checked = false;
    tipocom = 2;
    namecompro = "Factura";
    tipodoc = "RUC";
  } else if (tipocom == 2) {
    document.getElementById("comprobfac").checked = false;
    tipocom = 0;
    namecompro = "";
    tipodoc = "";
  }
}

$(window).ready(function () {
  $("#comprobfac").click(function () {
    comprobfac();
    // if (es == 0) {
    //   comprobfac();
    // } else {
    //   tipocom = 2;
    //   namecompro = "Factura";
    //   tipodoc = "RUC";
    //   document.getElementById("documento").value = "RUC";
    //   // document.getElementById("domici").style.display = "block";
    //   es = 0;
    // }
  });
});

function comprobbol() {
  if (tipocom == 0 || tipocom == 2) {
    document.getElementById("nuevoDocumento").value = "";
    document.getElementById("clientenombre").value = "";
    document.getElementById("domicilio").value = "";
    document.getElementById("documento").value = "DNI";
    document.getElementById("nuevoDocumento").placeholder = "Ingrese DNI/RUC";
    document.getElementById("domici").style.display = "none";
    document.getElementById("comprobbol").checked = true;
    document.getElementById("vale").checked = false;
    tipocom = 1;
    namecompro = "Boleta";
    tipodoc = "DNI";
  } else if (tipocom == 1) {
    document.getElementById("comprobbol").checked = false;
    tipocom = 0;
    namecompro = "";
    tipodoc = "";
  }
}

$(window).ready(function () {
  $("#comprobbol").click(function () {
    comprobbol();
   
    // if (es == 0) {
    //   comprobbol();
    // } else {
    //   tipocom = 1;
    //   namecompro = "Boleta";
    //   tipodoc = "DNI";
    //   document.getElementById("documento").value = "DNI";
    //   document.getElementById("domici").style.display = "none";
    //   es = 0;
    // }
  });
});
var tipocom2 = 0;
var tipodoc2 = "";
var namecompro2 = "";
function comprobfac2() {
  if (tipocom2 == 0 || tipocom2 == 1) {
    document.getElementById("nuevoDocumento2").value = "";
    document.getElementById("clientenombre2").value = "";
    document.getElementById("domicilio2").value = "";
    document.getElementById("documento2").value = "RUC";
    document.getElementById("nuevoDocumento2").placeholder = "Ingrese DNI/RUC";
    document.getElementById("domici2").style.display = "block";
    document.getElementById("comprobfac2").checked = true;
    tipocom2 = 2;
    namecompro2 = "Factura";
    tipodoc2 = "RUC";
  } else if (tipocom == 2) {
    document.getElementById("comprobfac2").checked = false;
    tipocom2 = 0;
    namecompro2 = "";
    tipodoc2 = "";
  }
}

$(window).ready(function () {
  $("#comprobfac2").click(function () {
    comprobfac2();
  });
});

function comprobbol2() {
  if (tipocom2 == 0 || tipocom2 == 2) {
    document.getElementById("nuevoDocumento2").value = "";
    document.getElementById("clientenombre2").value = "";
    document.getElementById("domicilio2").value = "";
    document.getElementById("documento2").value = "DNI";
    document.getElementById("nuevoDocumento2").placeholder = "Ingrese DNI/RUC";
    document.getElementById("domici2").style.display = "none";
    document.getElementById("comprobbol2").checked = true;
    tipocom2 = 1;
    namecompro2 = "Boleta";
    tipodoc2 = "DNI";
  } else if (tipocom == 1) {
    document.getElementById("comprobbol2").checked = false;
    tipocom2 = 0;
    namecompro2 = "";
    tipodoc2 = "";
  }
}

$(window).ready(function () {
  $("#comprobbol2").click(function () {
    comprobbol2();
  });
});

var ca = 0;
$(window).ready(function () {
  $("#aumen")
    .closest("label")
    .click(function () {
      var aum = document.getElementById("aumen");
      if (ca == 0) {
        document.getElementById("isla2").style.display = "block";
        document.getElementById("prod").style.display = "none";
        document.getElementById("aumen").innerHTML = "-";
        document.getElementById("rowventas").style.display = "block";
        ca = 1;
      } else {
        document.getElementById("isla2").style.display = "none";
        document.getElementById("prod").style.display = "block";
        document.getElementById("aumen").innerHTML = "+";
        document.getElementById("rowventas").style.display = "none";
        ca = 0;
      }
      // console.log(document.getElementById("nuevoDocumento").value);
    });
});

var idcli;
var buton;
var minombre;
var midoc;
var midoc2;
var midireccion;
var tdocu;
function addcliente() {
  //$(".alert").remove();
  if (buton == 1) {
    minombre = document.getElementById("clientenombre").value;
    midoc = midoc;
    midireccion = document.getElementById("domicilio").value;
    tdocu = tipodoc;
  } else {
    minombre = document.getElementById("clientenombre2").value;
    midoc = midoc2;
    midireccion = document.getElementById("domicilio2").value;
    tdocu = tipodoc2;
  }
  minombre =midoc;
  var parame = {
    tipodocu: tdocu,
    midocu: midoc,
    minombre: minombre,
    midireccion: midireccion,
  };

  $.ajax({
    data: parame,
    url: "ajax/addclientes.ajax.php",
    type: "POST",
    dataType: "json",
    // beforeSend: function () {
    //   $("#mensaje").html("antes");
    // },
    success: function (respuest) {
      //client.prop('disabled', false);
      idcli = respuest;
      addVenta();
    },
    error: function () {
      alert("Ocurrio un error en el servidor ..");
    },
  });
}

/*=============================================
GUARDAR VENTAAAAAA
=============================================*/

var namecomp;
var productos;
var total;
var subtotal;
var igv;
var plac;
var codeQr;
var codecompro;
var metodopago;
var PagoEfec;
var PagoTarj;
var PagoVale;
function addVenta() {
  var idUsuario = document.getElementById("idUsuario").value;
  if (buton == 1) {
    igv = document.getElementById("nuevoPrecioImpuesto").value;
    subtotal = document.getElementById("nuevoPrecioNeto").value;
    var extr = document.getElementById("nuevoTotalVenta").value;
    total = extr.replace(",", "");
    try {
      descuento = document.getElementById("descuento").value;
    } catch (error) {
      descuento = 0;
    }
    productos = document.getElementById("listaProductos").value;
    CodigoTarjeta = document.getElementById("CodigoTarjeta").value;
    PagoEfec = document.getElementById("TotalEfectivo").value;
    PagoTarj = document.getElementById("TotalTarjeta").value;
    if (document.getElementById("vale").checked){
      PagoVale = total;
    }else{
      PagoVale = 0;
    }
    namecomp = namecompro;
    plac = document.getElementById("nuevoPlaca").value;
    metodopago = document.getElementById("tipopago").value;
  } else {
    igv = document.getElementById("nuevoPrecioImpuesto2").value;
    subtotal = document.getElementById("nuevoPrecioNeto2").value;
    var extr = document.getElementById("nuevoTotalVenta2").value;
    total = extr.replace(",", "");
    try {
      descuento = document.getElementById("descuento2").value;
    } catch (error) {
      descuento = 0;
    }
    productos = document.getElementById("listaProductos2").value;
    namecomp = namecompro2;
    plac = document.getElementById("nuevoPlaca2").value;
  }

  var parame = {
    idusuario: idUsuario,
    idcliente: idcli,
    comprobante: namecomp,
    producto: productos,
    metpago: metodopago,
    codetransaccion: CodigoTarjeta,
    PagoVale: PagoVale,
    PagoEfectivo: PagoEfec,
    PagoTarjeta: PagoTarj,
    subtotal: subtotal,
    descuento: descuento,
    igv: igv,
    total: total,
    estado: "realizada",
    placa: plac,
    isla: "A",
    lado: buton,
  };

  $.ajax({
    data: parame,
    url: "ajax/addventas.ajax.php",
    type: "POST",
    dataType: "json",
    // beforeSend: function () {
    //   $("#mensaje").html("antes");
    // },
    success: function (respuest) {
      if (respuest == 0) {
        swal({
          type: "error",
          title: "La venta no se ha ejecuta si no hay productos",
          showConfirmButton: true,
          confirmButtonText: "Aceptar",
        });
      } else if (respuest == "errorconex") {
        swal({
          type: "error",
          title: "Error Intente Denuevo",
          showConfirmButton: true,
          confirmButtonText: "Aceptar",
        });
      } else {
        swal({
          type: "success",
          title: "Venta Realizada",
          showConfirmButton: true,
          confirmButtonText: "Aceptar",
        });
        var codi = respuest;
        ActualizarStock(idUser,null,null,3,codi);
        // console.log($("#tipoUsuario").val());
        if ($("#tipoUsuario").val() == "admin") {
          window.open(
            "extensiones/tcpdf/pdf/Boleta.php?codigo=" + codi,
            "_blank"
          );
        } else if (namecomp == "") {
          if(document.getElementById("vale").checked) {
            addVale(codi);
          }
        } else {
          window.open(
            "extensiones/tcpdf/pdf/ticketBoleta.php?codigo=" + codi,
            "_blank"
          );
        }

        limpiar();
      }
    },
    error: function () {
      alert("Ocurrio un error en el ser ..");
    },
  });
}
// var es = 0;

function addVale(idven) {

  if (buton == 1) {
 // LADO A 
    var rucempr = document.getElementById("nuevoDocumento").value
    var ext = document.getElementById("nuevoTotalVenta").value;
    total = ext.replace(",", "");
    var TrabajadoresEmpre =  $("#TrabajadoresEmpre").val();
    var AutosEmpre = $("#AutosEmpre").val();
    var idproduc = $(".nuevaDescripcionProducto").attr("idProducto");
    var cantid= $(".nuevaCantidadProducto").val();
  } else {

// LADO B

  }
  var parame = {
    idventa: idven,
    rucempresa: rucempr,
    idtrabajador: TrabajadoresEmpre,
    idvehiculo: AutosEmpre,
    idproducto: idproduc,
    cantidad: cantid,
    total: total,
  };

  $.ajax({
    data: parame,
    url: "ajax/addvales.ajax.php",
    type: "POST",
    dataType: "json",
    // beforeSend: function () {
    //   $("#mensaje").html("antes");
    // },
    success: function (respuest) {
       console.log(respuest);
      //  window.open(
      //   "extensiones/tcpdf/pdf/ticketBoleta.php?codigo=" + codi,
      //   "_blank"
      // );
    },
    error: function () {
      alert("Ocurrio un error en el ser ..");
    },
  });
}



$("#GuardarVenta").click(function () {
   if(document.getElementById("vale").checked && $(".nuevaDescripcionProducto").length>1){
    swal({
      type: "error",
      title: "Solo Un Producto En los Vales",
      showConfirmButton: true,
      confirmButtonText: "Aceptar",
    });
    return;
   }
  if (
    document.getElementById("Tarjeta").checked ||
    document.getElementById("Ambos").checked
  ) {
    var trans = document.getElementById("CodigoTarjeta").value;
    if (trans.length < 5) {
      alert("Debe ingresar codigo de transaccion");
      document.getElementById("CodigoTarjeta").focus();
      return 0;
    }
  }

  midoc = document.getElementById("nuevoDocumento").value;
  var placa = document.getElementById("nuevoPlaca").value;
  var RucEmpresa = document.getElementById("nuevoDocumento").value;
  var products = document.getElementById("listaProductos").value;
  if (products == "" || products == "[]") {
    swal({
      type: "error",
      title: "La venta no se ha ejecuta si no hay productos",
      showConfirmButton: true,
      confirmButtonText: "Aceptar",
    });
  } else if (document.getElementById("comprobbol").checked) {
    buton = 1;
    addcliente();
  } else if (document.getElementById("vale").checked) {
    tipocom = 0;
    namecompro = "";
    tipodoc = "";
    buton = 1;
    addcliente();
  } else if ( midoc.length < 8 && document.getElementById("comprobbol").checked == false && document.getElementById("comprobfac").checked == false) {
    tipocom = 0;
    namecompro = "";
    tipodoc = "";
    buton = 1;
    addcliente();
  } else {
    if (midoc.length < 9 && midoc.length >= 8 &&
      document.getElementById("comprobbol").checked == false
    ) {
      comprobbol();
      buton = 1;
      addcliente();
    } else {
      placa = placa == undefined ? "" : placa;
      if (placa.trim().length > 4 && document.getElementById("comprobfac").checked) {
        // document.getElementById("comprobfac").checked = true;
        buton = 1;
        addcliente();
      } else if (RucEmpresa.trim().length < 9) {
        // swal({
        //   type: "error",
        //   title: "ingrese RUC",
        //   showConfirmButton: true,
        //   confirmButtonText: "Aceptar",
        // });
        alert("Debe ingresar Ruc");
        document.getElementById("nuevoDocumento").focus();
      } else {
        // swal({
        //   type: "error",
        //   title: "ingrese una placa",
        //   showConfirmButton: true,
        //   confirmButtonText: "Aceptar",
        // });
        alert("Debe ingresar la Placa");
        document.getElementById("nuevoPlaca").focus();
      }
    }
  }
});

$("#GuardarVenta2").click(function () {
  midoc2 = document.getElementById("nuevoDocumento2").value;
  var placa = document.getElementById("nuevoPlaca2").value;
  var products = document.getElementById("listaProductos2").value;
  if (products == "" || products == "[]") {
    swal({
      type: "error",
      title: "La venta no se ha ejecuta si no hay productos",
      showConfirmButton: true,
      confirmButtonText: "Aceptar",
    });
  } else if (document.getElementById("comprobbol2").checked) {
    buton = 2;
    addcliente();
  } else if (
    midoc2.length < 8 &&
    document.getElementById("comprobbol2").checked == false &&
    document.getElementById("comprobfac2").checked == false
  ) {
    tipocom = 0;
    namecompro = "";
    tipodoc = "";
    buton = 2;
    addcliente();
  } else {
    if (
      midoc2.length < 9 &&
      midoc2.length >= 8 &&
      document.getElementById("comprobbol2").checked == false
    ) {
      comprobbol2();
      buton = 2;
      addcliente();
    } else {
      placa = placa == undefined ? "" : placa;
      if (
        placa.trim().length > 4 &&
        document.getElementById("comprobfac2").checked
      ) {
        // document.getElementById("comprobfac").checked = true;
        buton = 2;
        addcliente();
      } else {
        swal({
          type: "error",
          title: "ingrese una placa",
          showConfirmButton: true,
          confirmButtonText: "Aceptar",
        });
      }
    }
  }
});
/*=============================================
REVISAR SI EL CLIENTE YA ESTÁ REGISTRADO
=============================================*/
function BuscarCliente(cliente){
  midoc = document.getElementById("nuevoDocumento").value;
  if (midoc.length > 9 && document.getElementById("vale").checked==false) {
    document.getElementById("domicilio").value = "";
    document.getElementById("domici").style.display = "block";
    document.getElementById("comprobfac").checked = true;
    tipocom = 2;
    document.getElementById("documento").value = "RUC";
    namecompro = "Factura";
    tipodoc = "RUC";
  } else if (midoc.length < 9 && midoc.length > 7) {
    document.getElementById("domicilio").value = "";
    document.getElementById("domici").style.display = "none";
    document.getElementById("comprobbol").checked = true;
    tipocom = 1;
    document.getElementById("domicilio").value = "";
    document.getElementById("documento").value = "DNI";
    namecompro = "Boleta";
    tipodoc = "DNI";
  } else if (document.getElementById("vale").checked){
    document.getElementById("domicilio").value = "";
    document.getElementById("domici").style.display = "block";
    document.getElementById("comprobbol").checked = false;
    document.getElementById("comprobfac").checked = false;
    tipocom = 0;
    namecompro = "";
    tipodoc = "RUC";
  }else {
    document.getElementById("comprobbol").checked = false;
    document.getElementById("comprobfac").checked = false;
    document.getElementById("clientenombre").value = "";
    document.getElementById("domicilio").value = "";
    tipocom = 0;
    namecompro = "";
    tipodoc = "";
  }

  // console.log(tipocom);
  var docum = document.getElementById("nuevoDocumento").value;
  var nombree = document.getElementById("clientenombre");
  var direccionn = document.getElementById("domicilio");

  var datos = new FormData();
  datos.append("validarCliente", cliente);

  $.ajax({
    url: "ajax/clientes.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      if (respuesta) {
        // if (tipodoc == "RUC" && cliente.length < 9) {
        //   $("#nuevoDocumento")
        //     .parent()
        //     .after('<div class="alert alert-warning">RUC No Existe</div>'),
        //     $("#clientenombre").val(""),
        //     $("#domicilio").val("");
        // } else if (tipodoc == "DNI" && cliente.length > 9) {
        //   $("#nuevoDocumento")
        //     .parent()
        //     .after('<div class="alert alert-warning">DNI No Existe</div>'),
        //     $("#clientenombre").val("");
        // } else {
        //   nombree.value = respuesta["razonsocial"];
        //   direccionn.value = respuesta["direccion"];
        // }
        nombree.value = respuesta["razonsocial"];
        direccionn.value = respuesta["direccion"];
      } else if (!navigator.onLine) {
        $("#nuevoDocumento")
          .parent()
          .after('<div class="alert alert-warning">ingrese nombre</div>');
      } else {
        if (tipocom == 2) {
          //console.log('https://dniruc.apisperu.com/api/v1/dni/'+dni+'?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImpvaG54ZHhkMDFAZ21haWwuY29tIn0.ZruhemgKkC4EJUsE_A5HhhIc69anmTnmcu2tYZpuW24');

          fetch(
            "https://dniruc.apisperu.com/api/v1/ruc/" +
              docum +
              "?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImpvaG54ZHhkMDFAZ21haWwuY29tIn0.ZruhemgKkC4EJUsE_A5HhhIc69anmTnmcu2tYZpuW24"
          )
            .then((response) => {
              if (response.ok) {
                return response.json();
              } else if (response.status === 404) {
                return Promise.reject("error 404");
              } else {
                return Promise.reject("error: " + response.status);
              }
            })
            .then(
              (data) => (
                (nombree.value = data.razonSocial),
                (direccionn.value = data.direccion + " - " + data.departamento)
              )
            )
            .catch(
              (error) =>
                $("#nuevoDocumento")
                  .parent()
                  .after(
                    '<div class="alert alert-warning">RUC No Existe</div>'
                  ),
              $("#clientenombre").val(""),
              $("#domicilio").val("")
            );
        } else {
          var nombre = document.getElementById("clientenombre");

          fetch(
            "https://dniruc.apisperu.com/api/v1/dni/" +
              docum +
              "?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImpvaG54ZHhkMDFAZ21haWwuY29tIn0.ZruhemgKkC4EJUsE_A5HhhIc69anmTnmcu2tYZpuW24"
          )
            //fetch("https://dni.optimizeperu.com/api/persons/" + dni)
            .then((response) => {
              if (response.ok) {
                var res = response.json();

                // console.log (res);
                return res;
              } else if (res.status === 404) {
                return Promise.reject("error 404");
              } else {
                return Promise.reject("error: " + res.status);
              }
            })
            .then(function (res) {
              if (res.message) {
                $("#nuevoDocumento")
                  .parent()
                  .after(
                    '<div class="alert alert-warning">DNI No Existe</div>'
                  ),
                  $("#clientenombre").val("");
              } else {
                nombre.value =
                  res.nombres +
                  " " +
                  res.apellidoPaterno +
                  " " +
                  res.apellidoMaterno;
                /// console.log (res);
              }
            })
            .catch(
              (error) =>
                $("#nuevoDocumento")
                  .parent()
                  .after(
                    '<div class="alert alert-warning">DNI No Existe</div>'
                  ),
              $("#clientenombre").val("")
            );
        }
      }
    },
  });
}

$("#nuevoDocumento").change(function () {
  $(".alert").remove();
  var cliente = $(this).val();
  BuscarCliente(cliente);
});

/*=============================================
REVISAR SI EL CLIENTE YA ESTÁ REGISTRADO
=============================================*/

$("#nuevoDocumento2").change(function () {
  $(".alert").remove();
  midoc2 = document.getElementById("nuevoDocumento2").value;
  if (midoc2.length > 9) {
    document.getElementById("domicilio2").value = "";
    document.getElementById("domici2").style.display = "block";
    document.getElementById("comprobfac2").checked = true;
    tipocom2 = 2;
    document.getElementById("documento2").value = "RUC";
    namecompro2 = "Factura";
    tipodoc2 = "RUC";
  } else if (midoc2.length < 9 && midoc2.length > 4) {
    document.getElementById("domicilio2").value = "";
    document.getElementById("domici2").style.display = "none";
    document.getElementById("comprobbol2").checked = true;
    tipocom2 = 1;
    document.getElementById("domicilio2").value = "";
    document.getElementById("documento2").value = "DNI";
    namecompro2 = "Boleta";
    tipodoc2 = "DNI";
  } else {
    document.getElementById("comprobbol2").checked = false;
    document.getElementById("comprobfac2").checked = false;
    document.getElementById("clientenombre2").value = "";
    document.getElementById("domicilio2").value = "";
    tipocom2 = 0;
    namecompro2 = "";
    tipodoc2 = "";
  }

  // console.log(tipocom);
  var docum = document.getElementById("nuevoDocumento2").value;
  var nombree = document.getElementById("clientenombre2");
  var direccionn = document.getElementById("domicilio2");

  var cliente = $(this).val();

  var datos = new FormData();
  datos.append("validarCliente", cliente);

  $.ajax({
    url: "ajax/clientes.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      if (respuesta) {
        // if (tipodoc == "RUC" && cliente.length < 9) {
        //   $("#nuevoDocumento")
        //     .parent()
        //     .after('<div class="alert alert-warning">RUC No Existe</div>'),
        //     $("#clientenombre").val(""),
        //     $("#domicilio").val("");
        // } else if (tipodoc == "DNI" && cliente.length > 9) {
        //   $("#nuevoDocumento")
        //     .parent()
        //     .after('<div class="alert alert-warning">DNI No Existe</div>'),
        //     $("#clientenombre").val("");
        // } else {
        //   nombree.value = respuesta["razonsocial"];
        //   direccionn.value = respuesta["direccion"];
        // }
        nombree.value = respuesta["razonsocial"];
        direccionn.value = respuesta["direccion"];
      } else if (!navigator.onLine) {
        $("#nuevoDocumento2")
          .parent()
          .after('<div class="alert alert-warning">ingrese nombre</div>');
      } else {
        if (tipocom == 2) {
          //console.log('https://dniruc.apisperu.com/api/v1/dni/'+dni+'?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImpvaG54ZHhkMDFAZ21haWwuY29tIn0.ZruhemgKkC4EJUsE_A5HhhIc69anmTnmcu2tYZpuW24');

          fetch(
            "https://dniruc.apisperu.com/api/v1/ruc/" +
              docum +
              "?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImpvaG54ZHhkMDFAZ21haWwuY29tIn0.ZruhemgKkC4EJUsE_A5HhhIc69anmTnmcu2tYZpuW24"
          )
            .then((response) => {
              if (response.ok) {
                return response.json();
              } else if (response.status === 404) {
                return Promise.reject("error 404");
              } else {
                return Promise.reject("error: " + response.status);
              }
            })
            .then(
              (data) => (
                (nombree.value = data.razonSocial),
                (direccionn.value = data.direccion + " - " + data.departamento)
              )
            )
            .catch(
              (error) =>
                $("#nuevoDocumento2")
                  .parent()
                  .after(
                    '<div class="alert alert-warning">RUC No Existe</div>'
                  ),
              $("#clientenombre2").val(""),
              $("#domicilio2").val("")
            );
        } else {
          var nombre = document.getElementById("clientenombre2");

          fetch(
            "https://dniruc.apisperu.com/api/v1/dni/" +
              docum +
              "?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImpvaG54ZHhkMDFAZ21haWwuY29tIn0.ZruhemgKkC4EJUsE_A5HhhIc69anmTnmcu2tYZpuW24"
          )
            //fetch("https://dni.optimizeperu.com/api/persons/" + dni)
            .then((response) => {
              if (response.ok) {
                var res = response.json();

                // console.log (res);
                return res;
              } else if (res.status === 404) {
                return Promise.reject("error 404");
              } else {
                return Promise.reject("error: " + res.status);
              }
            })
            .then(function (res) {
              if (res.message) {
                $("#nuevoDocumento2")
                  .parent()
                  .after(
                    '<div class="alert alert-warning">DNI No Existe</div>'
                  ),
                  $("#clientenombre2").val("");
              } else {
                nombre.value =
                  res.nombres +
                  " " +
                  res.apellidoPaterno +
                  " " +
                  res.apellidoMaterno;
                /// console.log (res);
              }
            })
            .catch(
              (error) =>
                $("#nuevoDocumento2")
                  .parent()
                  .after(
                    '<div class="alert alert-warning">DNI No Existe</div>'
                  ),
              $("#clientenombre2").val("")
            );
        }
      }
    },
  });
});

// STILES FOR BUTTON DESCUENTOS
$(document).on("click", "#desFactura", function () {
  if ($(this).hasClass("btn-primary")) {
    $(this).removeClass("btn-primary");
    $(this).addClass("desFactura");
  } else {
    $(this).removeClass("desFactura");
    $(this).addClass("btn-primary");
  }
});
$(document).on("click", "#desTarjeta", function () {
  if ($(this).hasClass("btn-success")) {
    $(this).removeClass("btn-success");
    $(this).addClass("desTarjeta");
  } else {
    $(this).removeClass("desTarjeta");
    $(this).addClass("btn-success");
  }
});
$(document).on("click", "#desVale", function () {
  if ($(this).hasClass("btn-danger")) {
    $(this).removeClass("btn-danger");
    $(this).addClass("desVale");
  } else {
    $(this).removeClass("desVale");
    $(this).addClass("btn-danger");
  }
});

// $("#GuardarCliente").click(function () {
//   //  $(".alert").remove();

//   var client = $("#seleccionarCliente");

//   var minombre = $("#nuevoCliente").val();
//   var midni = $("#nuevoDocumentoId").val();
//   var miemail = $("#mail").val();
//   var mitelefono = $("#nuevoTelefono").val();
//   var midireccion = $("#nuevaDireccion").val();
//   var minacimiento = $("#nuevaFechaNacimiento").val();

//   var parame = {
//     nuevoCliente: minombre,
//     nuevoDocumentoId: midni,
//     nuevoDocumentoRuc: "0",
//     nuevoEmail: miemail,
//     nuevoTelefono: mitelefono,
//     nuevaDireccion: midireccion,
//     nuevaFechaNacimiento: minacimiento,
//   };

//   $.ajax({
//     data: parame,
//     url: "ajax/addclientes.ajax.php",
//     type: "POST",
//     dataType: "json",

//     beforeSend: function () {
//       $("#mensaje").html("antes");
//     },
//     success: function (respuest) {
//       // Limpiamos el select
//       client.find("option").remove();

//       $(respuest).each(function (i, v) {
//         // indice, valor
//         client.append(
//           '<option value="' +
//           v.id +
//           '">' +
//           v.nombre +
//           " " +
//           v.documento +
//           "</option>"
//         );
//       });
//       //client.prop('disabled', false);
//       $("#modalAgregarCliente").modal("hide");
//     },
//     error: function () {
//       alert("Ocurrio un error en el servidor ..");
//     },
//   });
// });

/*=============================================
LIMPIAR LOS CAMPOS
=============================================*/
$('#Empresas').val('0').trigger('change.select2');

function limpiar() {
  if (buton == 1) {
    document.getElementById("nuevoDocumento").value = "";
    document.getElementById("clientenombre").value = "";
    document.getElementById("domicilio").value = "";
    document.getElementById("nuevoPlaca").value = "";
    document.getElementById("CodigoTarjeta").value = "";
    try {
      document.getElementById("descuento").value = "";
    } catch (error) {}
    document.getElementById("listaProductos").value = "[]";
    $("#nuevoTotalVenta").val(0);
    $("#totalVenta").val(0);
    $("#TotalEfectivo").val(0);
    $("#Pago").val(0);
    $("#CodigoTarjeta").val("");
    $("#TotalTarjeta").val(0);
    $("#nuevoTotalVenta").attr("total", 0);
    $("#TotalTarjeta").attr("readonly", "readonly");
    document.getElementById("comprobbol").checked = false;
    document.getElementById("comprobfac").checked = false;
    document.getElementById("Efectivo").checked = true;
    document.getElementById("tipopago").value = "Efectivo";
    document.getElementById("CodigoTarjeta").style.display = "none";

    // document.getElementById("GuardarVenta").disabled = true;
    document.getElementById("domici").style.display = "none";
    namecompro = "";
    $('#Empresas').val('0').trigger('change.select2');
    $('#TrabajadoresEmpre').val('0').trigger('change.select2');
    $('#AutosEmpre').val('0').trigger('change.select2');
    tipocom = 0;
    tipodoc = "";

    //localStorage.clear();

    var descrip = $(".nuevaDescripcionProducto");

    for (var i = 0; i < descrip.length; i++) {
      const idpro = $(descrip[i]).attr("idProducto");
      $("button.recuperarBoton[idProducto='" + idpro + "']").removeClass(
        "btn-default"
      );

      $("button.recuperarBoton[idProducto='" + idpro + "']").addClass(
        "btn-primary agregarProducto"
      );
    }
    $(".nuevoProducto").children("div").remove();
  } else {
    document.getElementById("nuevoDocumento2").value = "";
    document.getElementById("clientenombre2").value = "";
    document.getElementById("domicilio2").value = "";
    document.getElementById("nuevoPlaca2").value = "";
    try {
      document.getElementById("descuento2").value = "";
    } catch (error) {}
    document.getElementById("listaProductos2").value = "[]";
    $("#nuevoTotalVenta2").val(0);
    $("#totalVenta2").val(0);
    $("#nuevoTotalVenta2").attr("total", 0);
    document.getElementById("comprobbol2").checked = false;
    document.getElementById("comprobfac2").checked = false;
    // document.getElementById("GuardarVenta").disabled = true;
    document.getElementById("domici2").style.display = "none";
    namecompro2 = "";

    tipocom2 = 0;
    tipodoc2 = "";

    //localStorage.clear();

    var descrip2 = $(".nuevaDescripcionProducto2");

    for (var i = 0; i < descrip2.length; i++) {
      const idpro2 = $(descrip2[i]).attr("idProducto2");
      $("button.recuperarBoton2[idProducto='" + idpro2 + "']").removeClass(
        "btn-default"
      );

      $("button.recuperarBoton2[idProducto='" + idpro2 + "']").addClass(
        "btn-primary agregarProducto"
      );
    }
    $(".nuevoProducto2").children("div").remove();
  }
}

// ATAJOS CON TECLAS//
// $(document).ready(function () {
//   //Presionamos ctrl + 1 para mostrar el toast
//   shortcut.add("Ctrl+1", function () {
//     comprobbol();

//     document.getElementById("nuevoDocumento").focus();
//   });

//   //Presionamos ctrl + 1 para mostrar el toast
//   shortcut.add("Ctrl+2", function () {
//     comprobfac();
//     document.getElementById("nuevoDocumento").focus();
//   });
// });
$("#Empresas").change(function () {

  var miempresa = $(this).val();

  $("#nuevoDocumento").val(miempresa);

  BuscarCliente(miempresa);
  var Empre = $("#TrabajadoresEmpre");
  var autos = $("#AutosEmpre");

  var datos = new FormData();
  datos.append("rucempresa", miempresa);

  $.ajax({
    url: "ajax/trabajadorAjax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuest) {
  // Limpiamos el select
  Empre.find('option').remove();
  
  // Empre.append('<option value="" selected disabled hidden>Seleccionar Trabajador</option>');
  $(respuest).each(function(i, v){ // indice, valor
    Empre.append('<option value="' + v.idtrabajador + '">' + v.dnitrabajador + ' ' +v.nombres + '</option>');
   })
   
    },
    error: function () {
      console.log("Error")
    },
  });


  $.ajax({
    url: "ajax/autosAjax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuest) {
  // Limpiamos el select
  autos.find('option').remove();
  try {
    $("#nuevoPlaca").val(respuest[0]['placa']);
  } catch (error) {
    $("#nuevoPlaca").val("");
  }
  // autos.append('<option value="" selected disabled hidden>Seleccionar Placa</option>');
  $(respuest).each(function(i, v){ // indice, valor
    autos.append('<option value="' + v.idvehiculo + '">' + v.placa + '</option>');
   })
    },
    error: function () {
      console.log("Error")
    },
  });

});

$("#AutosEmpre").change(function () {
  var AutosEmpre = $('#AutosEmpre option:selected').text();
  $("#nuevoPlaca").val(AutosEmpre);
});


// ActualizarStock("asdas","5",1);
function ActualizarStock(idusuario,idp,ca,tipo,idven) {
  var parame = {
    tipo: tipo,
    idusuario: idusuario,
    idarticulo: idp,
    cantidad: ca,
    idventa: idven,
  };
  $.ajax({
    data: parame,
    url: "ajax/adddetalletemp.ajax.php",
    type: "POST",
    dataType: "json",
    // beforeSend: function () {
    //   $("#mensaje").html("antes");
    // },
    success: function (respuest) {
       console.log(respuest);
    },
    error: function () {
      alert("Ocurrio un error en el ser ..");
    },
  });
}

// $(window).bind('beforeunload', function(){
//   var Lispro = JSON.parse($("#listaProductos").val());
//     for (var i = 0; i < Lispro.length; i++){
//    ActualizarStock(idUser,Lispro[i]['id'], Lispro[i]['cantidad'],1,null);
//   }
//   return "Do you really want to close?";
// });

// window.onbeforeunload = function () {
//   var Lispro = JSON.parse($("#listaProductos").val());
//   for (var i = 0; i < Lispro.length; i++){
//  ActualizarStock(idUser,Lispro[i]['id'], Lispro[i]['cantidad'],1);
// }
//   return "Do you really want to close?";
// };