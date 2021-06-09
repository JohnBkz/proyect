/*=============================================
CARGAR LA TABLA DINÁMICA DE VENTAS
=============================================*/

// $.ajax({

// 	url: "ajax/datatable-ventas.ajax.php",
// 	success:function(respuesta){

// 		console.log("respuesta", respuesta);

// 	}

// })//

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

/*=============================================
AGREGANDO PRODUCTOS A LA VENTA DESDE LA TABLA
=============================================*/

$(".tablaVentas tbody").on("click", "button.agregarProducto", function () {
  var idProducto = $(this).attr("idProducto");

  $(this).removeClass("btn-primary agregarProducto");

  $(this).addClass("btn-default");

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

      $(".nuevoProducto").append(
        '<div class="row" style="padding:5px 5px">' +
          "<!-- Descripción del producto -->" +
          '<div class="col-xs-6" style="padding-right:0px">' +
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
          "</div>"
      );

      // SUMAR TOTAL DE PRECIOS

      sumarTotalPreciosV();

      // AGREGAR IMPUESTO

      agregarImpuestoV();

      // AGRUPAR PRODUCTOS EN FORMATO JSON

      listarProductosV();
      document.getElementById("GuardarVenta").disabled = false;
      // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

      $(".nuevoPrecioProducto").number(true, 2);
      
      localStorage.removeItem("quitarProducto");
    },
  });
});

/*=============================================
AGREGANDO PRODUCTOS A LA VENTA DESDE LA TABLA
=============================================*/

$(".rowventas").on("click", "button.agregarProducto", function () {
  var idProducto = $(this).attr("idProducto");

  $(this).removeClass("btn-primary agregarProducto");

  $(this).addClass("btn-default");

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

      $(".nuevoProducto").append(
        '<div class="row" style="padding:5px 5px">' +
          "<!-- Descripción del producto -->" +
          '<div class="col-xs-6" style="padding-right:0px">' +
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
          '<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">' +
          '<div class="input-group">' +
          '<span class="input-group-addon">S/ </span>' +
          '<input type="text" class="form-control nuevoPrecioProducto" precioReal="' +
          precio +
          '" name="nuevoPrecioProducto" value="' +
          precio +
          '" readonly required>' +
          "</div>" +
          "</div>" +
          "</div>"
      );

      // SUMAR TOTAL DE PRECIOS

      sumarTotalPreciosV();

      // AGREGAR IMPUESTO

      agregarImpuestoV();

      // AGRUPAR PRODUCTOS EN FORMATO JSON

      listarProductosV();
      document.getElementById("GuardarVenta").disabled = false;
      // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

       $(".nuevoPrecioProducto").number(true, 2);

      localStorage.removeItem("quitarProducto");
    },
  });
});

/*=============================================
AGREGANDO PRODUCTOS A LA VENTA DESDE LA TABLA LADO B
=============================================*/

$(".rowventas2").on("click", "button.agregarProducto", function () {
  var idProducto = $(this).attr("idProducto");

  $(this).removeClass("btn-primary agregarProducto");

  $(this).addClass("btn-default");

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

      $(".nuevoProducto2").append(
        '<div class="row" style="padding:5px 5px">' +
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
          '<div class="col-xs-3">' +
          '<input type="number" class="form-control nuevaCantidadProducto2" name="nuevaCantidadProducto2" min="1" value="1" stock2="' +
          stock +
          '" nuevoStock2="' +
          Number(stock - 1) +
          '" required>' +
          "</div>" +
          "<!-- Precio del producto -->" +
          '<div class="col-xs-3 ingresoPrecio2" style="padding-left:0px">' +
          '<div class="input-group">' +
          '<span class="input-group-addon">S/ </span>' +
          '<input type="text" class="form-control nuevoPrecioProducto2" precioReal2="' +
          precio +
          '" name="nuevoPrecioProducto2" value="' +
          precio +
          '" readonly required>' +
          "</div>" +
          "</div>" +
          "</div>"
      );

      // SUMAR TOTAL DE PRECIOS

      sumarTotalPreciosV2();

      // AGREGAR IMPUESTO

      agregarImpuestoV2();

      // AGRUPAR PRODUCTOS EN FORMATO JSON

      listarProductosV2();
      document.getElementById("GuardarVenta2").disabled = false;
      // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

       $(".nuevoPrecioProducto2").number(true, 2);

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

/*=============================================
QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÓN
=============================================*/

var idQuitarProducto = [];

localStorage.removeItem("quitarProducto");

$(".formularioVenta").on("click", "button.quitarProducto", function () {
  $(this).parent().parent().parent().parent().remove();

  var idProducto = $(this).attr("idProducto");

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
    $("#nuevoTotalVenta").attr("total", 0);
    document.getElementById("GuardarVenta").disabled = true;
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

  var idProducto = $(this).attr("idProducto2");

  /*=============================================
ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR
=============================================*/

  if (localStorage.getItem("quitarProducto2") == null) {
    idQuitarProducto2 = [];
  } else {
    idQuitarProducto2.concat(localStorage.getItem("quitarProducto2"));
  }

  idQuitarProducto2.push({ idProducto2: idProducto });

  localStorage.setItem("quitarProducto2", JSON.stringify(idQuitarProducto2));

  $("button.recuperarBoton2[idProducto='" + idProducto + "']").removeClass(
    "btn-default"
  );

  $("button.recuperarBoton2[idProducto='" + idProducto + "']").addClass(
    "btn-primary agregarProducto"
  );

  if ($(".nuevoProducto2").children().length == 1) {
    //$("#nuevoImpuestoVenta").val(0);
    $("#nuevoTotalVenta2").val(0);
    $("#totalVenta2").val(0);
    $("#nuevoTotalVenta2").attr("total", 0);
    document.getElementById("GuardarVenta2").disabled = true;
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
SELECCIONAR PRODUCTO
=============================================*/

$(".formularioVenta").on(
  "change",
  "select.nuevaDescripcionProducto",
  function () {
    var nombreProducto = $(this).val();

    var nuevaDescripcionProducto = $(this)
      .parent()
      .parent()
      .parent()
      .children()
      .children()
      .children(".nuevaDescripcionProducto");

    var nuevoPrecioProducto = $(this)
      .parent()
      .parent()
      .parent()
      .children(".ingresoPrecio")
      .children()
      .children(".nuevoPrecioProducto");

    var nuevaCantidadProducto = $(this)
      .parent()
      .parent()
      .parent()
      .children(".ingresoCantidad")
      .children(".nuevaCantidadProducto");

    var datos = new FormData();
    datos.append("nombreProducto", nombreProducto);

    $.ajax({
      url: "ajax/productos.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (respuesta) {
        $(nuevaDescripcionProducto).attr("idProducto", respuesta["id"]);
        $(nuevaCantidadProducto).attr("stock", respuesta["stock"]);
        $(nuevaCantidadProducto).attr(
          "nuevoStock",
          Number(respuesta["stock"]) - 1
        );
        $(nuevoPrecioProducto).val(respuesta["precio"]);
        $(nuevoPrecioProducto).attr("precioReal", respuesta["precio"]);

        // AGRUPAR PRODUCTOS EN FORMATO JSON

        listarProductosV();
      },
    });
  }
);

/*=============================================
MODIFICAR LA CANTIDAD
=============================================*/

$(".formularioVenta").on("change", "input.nuevaCantidadProducto", function () {
  var precio = $(this)
    .parent()
    .parent()
    .children(".ingresoPrecio")
    .children()
    .children(".nuevoPrecioProducto");

  var precioFinal = $(this).val() * precio.attr("precioReal");

  precio.val(precioFinal);

  var nuevoStock = Number($(this).attr("stock")) - $(this).val();

  $(this).attr("nuevoStock", nuevoStock);

  if (Number($(this).val()) > Number($(this).attr("stock"))) {
    /*=============================================
  SI LA CANTIDAD ES SUPERIOR AL STOCK REGRESAR VALORES INICIALES
  =============================================*/

    $(this).val(1);

    $(this).attr("nuevoStock", $(this).attr("stock"));

    var precioFinal = $(this).val() * precio.attr("precioReal");

    precio.val(precioFinal);

    sumarTotalPreciosV();

    swal({
      title: "La cantidad supera el Stock",
      text: "¡Sólo hay " + $(this).attr("stock") + " unidades!",
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
});



/*=============================================
MODIFICAR LA PRECIO
=============================================*/

$(".formularioVenta").on("change", "input.nuevoPrecioProducto", function () {
  var cantid = $(this)
    .parent()
    .parent()
    .parent()
    .children(".ingresoCantidad")
    .children(".nuevaCantidadProducto");

  
  var nuevcant = $(this).val() / $(this).attr("precioReal");
  cantid.val($.number( nuevcant, 3 ));
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

$(".formularioVenta2").on(
  "change",
  "input.nuevaCantidadProducto2",
  function () {
    var precio = $(this)
      .parent()
      .parent()
      .children(".ingresoPrecio2")
      .children()
      .children(".nuevoPrecioProducto2");

    var precioFinal = $(this).val() * precio.attr("precioReal2");

    precio.val(precioFinal);

    var nuevoStock = Number($(this).attr("stock2")) - $(this).val();

    $(this).attr("nuevoStock2", nuevoStock);

    if (Number($(this).val()) > Number($(this).attr("stock2"))) {
      /*=============================================
    SI LA CANTIDAD ES SUPERIOR AL STOCK REGRESAR VALORES INICIALES
    =============================================*/

      $(this).val(1);

      $(this).attr("nuevoStock2", $(this).attr("stock2"));

      var precioFinal = $(this).val() * precio.attr("precioReal2");

      precio.val(precioFinal);

      sumarTotalPreciosV2();

      swal({
        title: "La cantidad supera el Stock",
        text: "¡Sólo hay " + $(this).attr("stock") + " unidades!",
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
);

/*=============================================
SUMAR TODOS LOS PRECIOS
=============================================*/

function sumarTotalPreciosV() {
  var precioItem = $(".nuevoPrecioProducto");

  var arraySumaPrecio = [];

  for (var i = 0; i < precioItem.length; i++) {
    arraySumaPrecio.push(Number($(precioItem[i]).val()));
  }

  function sumaArrayPrecios(total, numero) {
    return total + numero;
  }

  var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios);

  $("#nuevoTotalVenta").val(sumaTotalPrecio);
  $("#totalVenta").val(sumaTotalPrecio);
  $("#nuevoTotalVenta").attr("total", sumaTotalPrecio);
}

/*=============================================
SUMAR TODOS LOS PRECIOS
=============================================*/

function sumarTotalPreciosV2() {
  var precioItem = $(".nuevoPrecioProducto2");

  var arraySumaPrecio2 = [];

  for (var i = 0; i < precioItem.length; i++) {
    arraySumaPrecio2.push(Number($(precioItem[i]).val()));
  }

  function sumaArrayPrecios2(total, numero) {
    return total + numero;
  }

  var sumaTotalPrecio2 = arraySumaPrecio2.reduce(sumaArrayPrecios2);

  $("#nuevoTotalVenta2").val(sumaTotalPrecio2);
  $("#totalVenta2").val(sumaTotalPrecio2);
  $("#nuevoTotalVenta2").attr("total", sumaTotalPrecio2);
}

/*=============================================
FUNCIÓN AGREGAR IMPUESTO
=============================================*/

function agregarImpuestoV() {
  var impuesto = $("#nuevoImpuestoVenta").val();
  var precioTotal = $("#nuevoTotalVenta").attr("total");

  var precioImpuesto = Number((precioTotal * impuesto) / 100);
  var precioSinImpuesto = Number(precioTotal - (precioTotal * impuesto) / 100);
  var totalConImpuesto = Number(precioTotal);

  $("#nuevoTotalVenta").val(totalConImpuesto);

  $("#totalVenta").val(totalConImpuesto);

  $("#nuevoPrecioImpuesto").val(precioImpuesto);

  $("#nuevoPrecioNeto").val(precioSinImpuesto);
}

/*=============================================
FUNCIÓN AGREGAR IMPUESTO
=============================================*/

function agregarImpuestoV2() {
  var impuesto = $("#nuevoImpuestoVenta2").val();
  var precioTotal = $("#nuevoTotalVenta2").attr("total");

  var precioImpuesto = Number((precioTotal * impuesto) / 100);
  var precioSinImpuesto = Number(precioTotal - (precioTotal * impuesto) / 100);
  var totalConImpuesto = Number(precioTotal);

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
});

/*=============================================
FORMATO AL PRECIO FINAL
=============================================*/

$("#nuevoTotalVenta").number(true, 2);

/*=============================================
SELECCIONAR MÉTODO DE PAGO
=============================================*/

$("#nuevoMetodoPago").change(function () {
  var metodo = $(this).val();

  if (metodo == "Efectivo") {
    $(this).parent().parent().removeClass("col-xs-6");

    $(this).parent().parent().addClass("col-xs-4");

    $(this)
      .parent()
      .parent()
      .parent()
      .children(".cajasMetodoPago")
      .html(
        '<div class="col-xs-4">' +
          '<div class="input-group">' +
          '<span class="input-group-addon" id="dolar">S/ </i></span>' +
          '<input type="text" class="form-control" id="nuevoValorEfectivo" placeholder="000000" required>' +
          "</div>" +
          '<th><p id="error" style="color:red;">Monto Menor al Total </p></th>' +
          "</div>" +
          '<div class="col-xs-4" id="capturarCambioEfectivo" style="padding-left:0px">' +
          '<div class="input-group">' +
          '<span class="input-group-addon">S/ </i></span>' +
          '<input type="text" class="form-control" id="nuevoCambioEfectivo" placeholder="000000" readonly required>' +
          "</div>" +
          "<p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Vuelto </p>" +
          "</div>"
      );

    // Agregar formato al precio

    $("#nuevoValorEfectivo").number(true, 2);
    $("#nuevoCambioEfectivo").number(true, 2);

    // Listar método en la entrada
    listarMetodos();
  } else {
    $(this).parent().parent().removeClass("col-xs-4");

    $(this).parent().parent().addClass("col-xs-6");

    $(this)
      .parent()
      .parent()
      .parent()
      .children(".cajasMetodoPago")
      .html(
        '<div class="col-xs-6" style="padding-left:0px">' +
          '<div class="input-group">' +
          '<input type="number" min="0" class="form-control" name="codetransaccion" id="nuevoCodigoTransaccion" placeholder="Código transacción"  required>' +
          '<span class="input-group-addon"><i class="fa fa-lock"></i></span>' +
          "</div>" +
          "</div>"
      );
  }
});

/*=============================================
CAMBIO EN EFECTIVO
=============================================*/
$(".formularioVenta").on("change", "input#nuevoValorEfectivo", function () {
  var efectivo = $(this).val();
  if (Number($("#nuevoTotalVenta").val() > Number(efectivo))) {
    document.getElementById("error").style.visibility = "visible";
    document.getElementById("dolar").style.borderColor = "red";
    document.getElementById("nuevoValorEfectivo").style.borderColor = "red";
    document.getElementById("GuardarVenta").disabled = true;
    var cambio = Number(efectivo) - Number($("#nuevoTotalVenta").val());

    var nuevoCambioEfectivo = $(this)
      .parent()
      .parent()
      .parent()
      .children("#capturarCambioEfectivo")
      .children()
      .children("#nuevoCambioEfectivo");

    nuevoCambioEfectivo.val(cambio);
  } else {
    document.getElementById("error").style.visibility = "hidden";
    document.getElementById("GuardarVenta").disabled = false;
    document.getElementById("nuevoValorEfectivo").style.borderColor = null;
    document.getElementById("dolar").style.borderColor = null;
    var cambio = Number(efectivo) - Number($("#nuevoTotalVenta").val());

    var nuevoCambioEfectivo = $(this)
      .parent()
      .parent()
      .parent()
      .children("#capturarCambioEfectivo")
      .children()
      .children("#nuevoCambioEfectivo");

    nuevoCambioEfectivo.val(cambio);
  }
});

/*=============================================
CAMBIO TRANSACCIÓN
=============================================*/
$(".formularioVenta").on("change", "input#nuevoCodigoTransaccion", function () {
  // Listar método en la entrada
  listarMetodos();
});

/*=============================================
LISTAR TODOS LOS PRODUCTOS
=============================================*/

function listarProductosV() {
  var listaProductos = [];

  var descripcion = $(".nuevaDescripcionProducto");

  var cantidad = $(".nuevaCantidadProducto");

  var precio = $(".nuevoPrecioProducto");

  for (var i = 0; i < descripcion.length; i++) {
    listaProductos.push({
      id: $(descripcion[i]).attr("idProducto"),
      descripcion: $(descripcion[i]).val(),
      cantidad: $(cantidad[i]).val(),
      stock: $(cantidad[i]).attr("nuevoStock"),
      precio: $(precio[i]).attr("precioReal"),
      total: $(precio[i]).val(),
    });
  }

  $("#listaProductos").val(JSON.stringify(listaProductos));
}

function listarProductosV2() {
  var listaProductos2 = [];

  var descripcion = $(".nuevaDescripcionProducto2");

  var cantidad = $(".nuevaCantidadProducto2");

  var precio = $(".nuevoPrecioProducto2");

  for (var i = 0; i < descripcion.length; i++) {
    listaProductos2.push({
      id: $(descripcion[i]).attr("idProducto2"),
      descripcion: $(descripcion[i]).val(),
      cantidad: $(cantidad[i]).val(),
      stock: $(cantidad[i]).attr("nuevoStock2"),
      precio: $(precio[i]).attr("precioReal2"),
      total: $(precio[i]).val(),
    });
  }

  $("#listaProductos2").val(JSON.stringify(listaProductos2));
}
//$(".formularioVenta").on("click", "button.aaaaa", function(){
//$(".formularioOrdenedi").on("change", "input#GuardarVenta", function(){

listarProductosV();

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
var tipodoc="";
var namecompro="";

$(window).ready(function () {
  $("#comprobfac").click(function () {
    if( tipocom == 0 || tipocom == 1){
      document.getElementById("nuevoDocumento").value = "";
      document.getElementById("clientenombre").value = "";
      document.getElementById("domicilio").value = "";
      document.getElementById("documento").value = "RUC";
      document.getElementById("nuevoDocumento").placeholder = "Ingrese RUC";
      document.getElementById("domici").style.display = "block";
      tipocom = 2;
      namecompro="Factura";
      tipodoc = "RUC";
    } else if( tipocom == 2){
      document.getElementById("comprobfac").checked=false;
      tipocom = 0;
      namecompro="";
      tipodoc="";
    }
    });
});

$(window).ready(function () {
  $("#comprobbol").click(function () {
     if( tipocom == 0 || tipocom == 2){
      document.getElementById("nuevoDocumento").value = "";
      document.getElementById("clientenombre").value = "";
      document.getElementById("domicilio").value = "";
      document.getElementById("documento").value = "DNI";
      document.getElementById("nuevoDocumento").placeholder = "Ingrese DNI";
      document.getElementById("domici").style.display = "none";
      tipocom = 1;
      namecompro="Boleta";
      tipodoc = "DNI";
   
     } else if( tipocom == 1){
        document.getElementById("comprobbol").checked=false;
        tipocom = 0;
        namecompro="";
        tipodoc="";
      }

    });
});
var tipocom2 = 0;
var tipodoc2="";
var namecompro2="";
$(window).ready(function () {
 $("#comprobfac2").click(function () {
    if( tipocom2 == 0 || tipocom2 == 1){
      document.getElementById("nuevoDocumento2").value = "";
      document.getElementById("clientenombre2").value = "";
      document.getElementById("domicilio2").value = "";
      document.getElementById("documento2").value = "RUC";
      document.getElementById("nuevoDocumento2").placeholder = "Ingrese RUC";
      document.getElementById("domici2").style.display = "block";
      tipocom2 = 2;
      namecompro2="Factura";
      tipodoc2 = "RUC";
    } else if( tipocom2 == 2){
      document.getElementById("comprobfac2").checked=false;
      tipocom2 = 0;
      namecompro2="";
      tipodoc2="";
    }
    });
});

$(window).ready(function () {
  $("#comprobbol2").click(function () {
    if( tipocom2 == 0 || tipocom2 == 2){
      document.getElementById("nuevoDocumento2").value = "";
      document.getElementById("clientenombre2").value = "";
      document.getElementById("domicilio2").value = "";
      document.getElementById("documento2").value = "DNI";
      document.getElementById("nuevoDocumento2").placeholder = "Ingrese DNI";
      document.getElementById("domici2").style.display = "none";
      tipocom2 = 1;
      namecompro2="Boleta";
      tipodoc2 = "DNI";
   
     } else if( tipocom2 == 1){
        document.getElementById("comprobbol2").checked=false;
        tipocom2 = 0;
        namecompro2="";
        tipodoc2="";
      }
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
    });
});

var idcli;
var buton;
var minombre;
var midocu;
var midireccion; 
function addcliente() {
  //$(".alert").remove();
  var tdocu;
if (buton==0){
   minombre = document.getElementById("clientenombre").value;
   midocu = document.getElementById("nuevoDocumento").value;
   midireccion = document.getElementById("domicilio").value;
  tdocu= tipodoc;
}else{
   minombre = document.getElementById("clientenombre2").value;
   midocu = document.getElementById("nuevoDocumento2").value;
   midireccion = document.getElementById("domicilio2").value;
  tdocu= tipodoc2;
}
  var parame = {
    "tipodocu": tdocu,
    "midocu": midocu,
    "minombre": minombre,
    "midireccion": midireccion,
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
function addVenta() {
  var idUsuario = document.getElementById("idUsuario").value;
  if (buton==0){
   igv = document.getElementById("nuevoPrecioImpuesto").value;
   subtotal = document.getElementById("nuevoPrecioNeto").value;
   total = document.getElementById("nuevoTotalVenta").value;
   productos = document.getElementById("listaProductos").value;
  namecomp=namecompro;
  }else{
     igv = document.getElementById("nuevoPrecioImpuesto2").value;
     subtotal = document.getElementById("nuevoPrecioNeto2").value;
     total = document.getElementById("nuevoTotalVenta2").value;
     productos = document.getElementById("listaProductos2").value;
    namecomp=namecompro2;
  }
  console.log(productos);
  console.log(buton);
  var parame = {
    "idusuario": idUsuario,
    "idcliente": idcli,
    "comprobante": namecomp,
    "producto": productos,
    "metpago": "Efectivo",
    "codetransaccion": "",
    "subtotal": subtotal,
    "descuento": "0",
    "igv": igv,
    "total": total,
    "estado": "realizada"
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
     if(respuest==0){
      swal({
        type: "error",
        title: "La venta no se ha ejecuta si no hay productos",
        showConfirmButton: true,
        confirmButtonText: "Cerrar"
        })
              
     }
     if(respuest=="ok"){
      swal({
        type: "success",
        title: "Venta Realizada",
        showConfirmButton: true,
        confirmButtonText: "Cerrar"
        });
        limpiar();         
     }

    },
    error: function () {
      alert("Ocurrio un error en el ser ..");
    },
  });
}



$("#GuardarVenta").click(function () { 
  buton=0;
addcliente(); 
});

$("#GuardarVenta2").click(function () { 
  buton=1;
  addcliente(); 
  });
/*=============================================
REVISAR SI EL CLIENTE YA ESTÁ REGISTRADO
=============================================*/

$("#nuevoDocumento").change(function () {
  $(".alert").remove();

  var docum = document.getElementById("nuevoDocumento").value;
  var nombree = document.getElementById("clientenombre");
  var direccionn = document.getElementById("domicilio");

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
          var dni = document.getElementById("nuevoDocumento").value;
          var nombre = document.getElementById("clientenombre");
          var error;
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
});

/*=============================================
REVISAR SI EL CLIENTE YA ESTÁ REGISTRADO
=============================================*/

$("#nuevoDocumento2").change(function () {
  $(".alert").remove();

  var documento2 = document.getElementById("nuevoDocumento2").value;
  var nombree2 = document.getElementById("clientenombre2");
  var direccionn2 = document.getElementById("domicilio2");
  var cliente2 = $(this).val();

  var datos = new FormData();
  datos.append("validarCliente", cliente2);

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
        nombree2.value = respuesta["razonsocial"];
        direccionn2.value = respuesta["direccion"];

        // $("#nuevoDocumentoId").val("");
      } else if (!navigator.onLine) {
        $("#nuevoDocumento2")
          .parent()
          .after('<div class="alert alert-warning">ingrese nombre</div>');
      } else {
        if (tipocom2 == 2) {
          var rucc = document.getElementById("nuevoDocumento2").value;
          var nombree = document.getElementById("clientenombre2");
          var direccionn = document.getElementById("domicilio2");

          //console.log('https://dniruc.apisperu.com/api/v1/dni/'+dni+'?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImpvaG54ZHhkMDFAZ21haWwuY29tIn0.ZruhemgKkC4EJUsE_A5HhhIc69anmTnmcu2tYZpuW24');

          fetch(
            "https://dniruc.apisperu.com/api/v1/ruc/" +
              rucc +
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
          var dni = document.getElementById("nuevoDocumento2").value;
          var nombre = document.getElementById("clientenombre2");
          var error;
          fetch(
            "https://dniruc.apisperu.com/api/v1/dni/" +
              dni +
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

$("#GuardarCliente").click(function () {
  //  $(".alert").remove();

  var client = $("#seleccionarCliente");

  var minombre = $("#nuevoCliente").val();
  var midni = $("#nuevoDocumentoId").val();
  var miemail = $("#mail").val();
  var mitelefono = $("#nuevoTelefono").val();
  var midireccion = $("#nuevaDireccion").val();
  var minacimiento = $("#nuevaFechaNacimiento").val();

  var parame = {
    nuevoCliente: minombre,
    nuevoDocumentoId: midni,
    nuevoDocumentoRuc: "0",
    nuevoEmail: miemail,
    nuevoTelefono: mitelefono,
    nuevaDireccion: midireccion,
    nuevaFechaNacimiento: minacimiento,
  };

  $.ajax({
    data: parame,
    url: "ajax/addclientes.ajax.php",
    type: "POST",
    dataType: "json",

    beforeSend: function () {
      $("#mensaje").html("antes");
    },
    success: function (respuest) {
      // Limpiamos el select
      client.find("option").remove();

      $(respuest).each(function (i, v) {
        // indice, valor
        client.append(
          '<option value="' +
            v.id +
            '">' +
            v.nombre +
            " " +
            v.documento +
            "</option>"
        );
      });
      //client.prop('disabled', false);
      $("#modalAgregarCliente").modal("hide");
    },
    error: function () {
      alert("Ocurrio un error en el servidor ..");
    },
  });
});

/*=============================================
LIMPIAR LOS CAMPOS
=============================================*/


function limpiar() {

  if (buton==0){
    document.getElementById("nuevoDocumento").value = "";
    document.getElementById("clientenombre").value = "";
    document.getElementById("domicilio").value = "";
    document.getElementById("listaProductos").value = "[]";
    $("#nuevoTotalVenta").val(0);
      $("#totalVenta").val(0);
      $("#nuevoTotalVenta").attr("total", 0);
      document.getElementById("GuardarVenta").disabled = true;
      //localStorage.clear();
  
    var descrip = $(".nuevaDescripcionProducto");
  
    for (var i = 0; i < descrip.length; i++) {
     const idpro =  $(descrip[i]).attr("idProducto");
      $("button.recuperarBoton[idProducto='" + idpro + "']").removeClass(
        "btn-default"
      );
    
      $("button.recuperarBoton[idProducto='" + idpro + "']").addClass(
        "btn-primary agregarProducto"
      );
      }
      $(".nuevoProducto").children('div').remove();
  }else {
  document.getElementById("nuevoDocumento2").value = "";
  document.getElementById("clientenombre2").value = "";
  document.getElementById("domicilio2").value = "";
  document.getElementById("listaProductos2").value = "[]";
  $("#nuevoTotalVenta2").val(0);
    $("#totalVenta2").val(0);
    $("#nuevoTotalVenta2").attr("total", 0);
    document.getElementById("GuardarVenta2").disabled = true;
    //localStorage.clear();

  var descrip2 = $(".nuevaDescripcionProducto2");

  for (var i = 0; i < descrip2.length; i++) {
   const idpro2 =  $(descrip2[i]).attr("idProducto2");
    $("button.recuperarBoton2[idProducto='" + idpro2 + "']").removeClass(
      "btn-default"
    );
  
    $("button.recuperarBoton2[idProducto='" + idpro2 + "']").addClass(
      "btn-primary agregarProducto"
    );
    }
    $(".nuevoProducto2").children('div').remove();
  }
}