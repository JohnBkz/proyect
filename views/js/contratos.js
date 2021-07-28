// /*=============================================
// CARGAR LA TABLA DINÁMICA DE VENTAS
// =============================================*/

// // $.ajax({

// // 	url: "ajax/datatable-ventas.ajax.php",
// // 	success:function(respuesta){

// // 		console.log("respuesta", respuesta);

// // 	}

// // })//
// var idUser = $("#idUsuario").val();
// $(".tablaContrato").DataTable({
//   ajax: "ajax/datatable-ventas.ajax.php",
//   deferRender: true,
//   retrieve: true,
//   processing: true,
//   language: {
//     sProcessing: "Procesando...",
//     sLengthMenu: "Mostrar _MENU_ registros",
//     sZeroRecords: "No se encontraron resultados",
//     sEmptyTable: "Ningún dato disponible en esta tabla",
//     sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
//     sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0",
//     sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
//     sInfoPostFix: "",
//     sSearch: "Buscar:",
//     sUrl: "",
//     sInfoThousands: ",",
//     sLoadingRecords: "Cargando...",
//     oPaginate: {
//       sFirst: "Primero",
//       sLast: "Último",
//       sNext: "Siguiente",
//       sPrevious: "Anterior",
//     },
//     oAria: {
//       sSortAscending: ": Activar para ordenar la columna de manera ascendente",
//       sSortDescending:
//         ": Activar para ordenar la columna de manera descendente",
//     },
//   },
// });

// /*=============================================
// AGREGANDO PRODUCTOS A LA VENTA DESDE LA TABLA
// =============================================*/
// function agregarProducts(idProducto, descripcion, stock, precio) {

//   if ($("#tipoUsuario").val() == "admin") {
//     $(".nuevoProducto").append(
//       '<div class="row" style="padding:5px 5px">' +
//         "<!-- Descripción del producto -->" +
//         '<div class="col-xs-4 descrip" style="padding-right:0px">' +
//         '<div class="input-group">' +
//         '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="' +
//         idProducto +
//         '"><i class="fa fa-times"></i></button></span>' +
//         '<input type="text" class="form-control nuevaDescripcionProducto" idProducto="' +
//         idProducto +
//         '" name="agregarProducto" value="' +
//         descripcion +
//         '" readonly required>' +
//         "</div>" +
//         "</div>" +
//         "<!-- Cantidad del producto -->" +
//         '<div class="col-xs-2 ingresoCantidad">' +
//         '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock="' +
//         stock +
//         '" nuevoStock="' +
//         Number(stock - 1) +
//         '" required>' +
//         "</div>" +
//         "<!-- Precio del producto -->" +
//         '<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">' +
//         '<div class="input-group">' +
//         '<span class="input-group-addon">S/ </span>' +
//         '<input type="text" class="form-control nuevoPrecioProducto" precioReal="' +
//         precio +
//         '" name="nuevoPrecioProducto" value="' +
//         precio +
//         '" required>' +
//         "</div>" +
//         "</div>" +
//         "<!-- Precio del producto -->" +
//         '<div class="col-xs-3 ingresoPreciosub" style="padding-left:0px">' +
//         '<div class="input-group">' +
//         '<span class="input-group-addon">S/ </span>' +
//         '<input type="text" class="form-control nuevoPreciosub" preciosub="' +
//         precio +
//         '" name="nuevoPreciosub" value="' +
//         precio +
//         '" required>' +
//         "</div>" +
//         "</div>" +
//         "</div>"
//     );
//     ActualizarStock(idUser,idProducto,1,0);
//   }
// }

// $(".tablaContrato tbody").on("click", "button.recuperarBoton", function () {
//   var idProducto = $(this).attr("idProducto");

//   var descr = $(".nuevaDescripcionProducto");
//   var nuevaCant = $(".nuevaCantidadProducto");
//   $(this).removeClass("btn-primary agregarProducto");

//   $(this).addClass("btn-default agregarProducto");

//   var datos = new FormData();
//   datos.append("idProducto", idProducto);

//   $.ajax({
//     url: "ajax/productos.ajax.php",
//     method: "POST",
//     data: datos,
//     cache: false,
//     contentType: false,
//     processData: false,
//     dataType: "json",
//     success: function (respuesta) {
//       var descripcion = respuesta[0]["descripcion"];
//       var stock = respuesta[0]["cantidad"];
//       var precio = respuesta[0]["precioventa"];
//    console.log(descripcion);
//       /*=============================================
//           EVITAR AGREGAR PRODUTO CUANDO EL STOCK ESTÁ EN CERO
//       =============================================*/

//       if (stock == 0) {
//         swal({
//           title: "No hay Stock disponible",
//           type: "error",
//           confirmButtonText: "¡Cerrar!",
//         });

//         $("button[idProducto='" + idProducto + "']").addClass(
//           "btn-primary agregarProducto"
//         );

//         return;
//       }
//       if ($(".nuevoProducto").children().length > 1) {
//         var idp;
//         var existe;
//         for (var i = 0; i <= descr.length; i++) {
//           idp = $(descr[i]).attr("idProducto");
//           if (idProducto == idp) {
//             existe = true;
//             nuevaCant = $(nuevaCant[i]);
//             break;
//           } else {
//             existe = false;
//           }
//         }
//         if (existe) {
//           nuevaCant.val(parseInt(nuevaCant.val()) + 1);
//           nuevaCantidad(nuevaCant);
//         } else {
//           agregarProducts(idProducto, descripcion, stock, precio);
//         }
//       } else {
//         agregarProducts(idProducto, descripcion, stock, precio);
//       }

//       // SUMAR TOTAL DE PRECIOS

//       sumarTotalPreciosV();

//       // AGREGAR IMPUESTO

//       agregarImpuestoV();

//       // AGRUPAR PRODUCTOS EN FORMATO JSON

//       listarProductosV();
//       // document.getElementById("GuardarVenta").disabled = false;
//       // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

//       $(".nuevoPrecioProducto").number(true, 2);
//       $(".nuevoPreciosub").number(true, 2);

//       localStorage.removeItem("quitarProducto");
//     },
//   });
// });

// /*=============================================
// AGREGANDO PRODUCTOS A LA VENTA DESDE LA TABLA
// =============================================*/

// $(".rowventas").on("click", "button.agregarProducto", function () {
//   var idProducto = $(this).attr("idProducto");

//   var descr = $(".nuevaDescripcionProducto");
//   var nuevaCant = $(".nuevaCantidadProducto");
//   $(this).removeClass("btn-primary agregarProducto");

//   $(this).addClass("btn-default agregarProducto");

//   var datos = new FormData();
//   datos.append("idProducto", idProducto);

//   $.ajax({
//     url: "ajax/productos.ajax.php",
//     method: "POST",
//     data: datos,
//     cache: false,
//     contentType: false,
//     processData: false,
//     dataType: "json",
//     success: function (respuesta) {
//       var descripcion = respuesta[0]["descripcion"];
//       var stock = respuesta[0]["cantidad"];
//       var precio = respuesta[0]["precioventa"];

//       /*=============================================
//           EVITAR AGREGAR PRODUTO CUANDO EL STOCK ESTÁ EN CERO
//           =============================================*/

//       if (stock == 0) {
//         swal({
//           title: "No hay Stock disponible",
//           type: "error",
//           confirmButtonText: "¡Cerrar!",
//         });

//         $("button[idProducto='" + idProducto + "']").addClass(
//           "btn-primary agregarProducto"
//         );

//         return;
//       }
//       if ($(".nuevoProducto").children().length > 1) {
//         var idp;
//         var existe;
//         for (var i = 0; i <= descr.length; i++) {
//           idp = $(descr[i]).attr("idProducto");

//           if (idProducto == idp) {
//             existe = true;
//             nuevaCant = $(nuevaCant[i]);
//             break;
//           } else {
//             existe = false;
//           }
//         }
//         if (existe) {
//           nuevaCant.val(parseInt(nuevaCant.val()) + 1);
//           nuevaCantidad(nuevaCant);
//         } else {
//           agregarProducts(idProducto, descripcion, stock, precio);
//         }
//       } else {
//         agregarProducts(idProducto, descripcion, stock, precio);
//       }

//       // SUMAR TOTAL DE PRECIOS

//       sumarTotalPreciosV();

//       // AGREGAR IMPUESTO

//       agregarImpuestoV();

//       // AGRUPAR PRODUCTOS EN FORMATO JSON

//       listarProductosV();
//       // document.getElementById("GuardarVenta").disabled = false;
//       // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

//       $(".nuevoPrecioProducto").number(true, 2);
//       $(".nuevoPreciosub").number(true, 2);

//       localStorage.removeItem("quitarProducto");
//     },
//   });
// });


// /*=============================================
// CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA
// =============================================*/

// $(".tablaVentas").on("draw.dt", function () {
//   if (localStorage.getItem("quitarProducto") != null) {
//     var listaIdProductos = JSON.parse(localStorage.getItem("quitarProducto"));

//     for (var i = 0; i < listaIdProductos.length; i++) {
//       $(
//         "button.recuperarBoton[idProducto='" +
//           listaIdProductos[i]["idProducto"] +
//           "']"
//       ).removeClass("btn-default");
//       $(
//         "button.recuperarBoton[idProducto='" +
//           listaIdProductos[i]["idProducto"] +
//           "']"
//       ).addClass("btn-primary agregarProducto");
//     }
//   }
// });


// /*=============================================
// QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÓN
// =============================================*/

// var idQuitarProducto = [];

// localStorage.removeItem("quitarProducto");

// $(".formularioContrato").on("click", "button.quitarProducto", function () {
//   $(this).parent().parent().parent().parent().remove();

//   var idProducto = $(this).attr("idProducto");
  
//   var canti = $(this).parent().parent().parent().parent().children(".ingresoCantidad").children(".nuevaCantidadProducto");

//    ActualizarStock(idUser,idProducto, canti.val(),1);
//   /*=============================================
// ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR
// =============================================*/

//   if (localStorage.getItem("quitarProducto") == null) {
//     idQuitarProducto = [];
//   } else {
//     idQuitarProducto.concat(localStorage.getItem("quitarProducto"));
//   }

//   idQuitarProducto.push({ idProducto: idProducto });

//   localStorage.setItem("quitarProducto", JSON.stringify(idQuitarProducto));

//   $("button.recuperarBoton[idProducto='" + idProducto + "']").removeClass(
//     "btn-default"
//   );

//   $("button.recuperarBoton[idProducto='" + idProducto + "']").addClass(
//     "btn-primary agregarProducto"
//   );

//   if ($(".nuevoProducto").children().length == 1) {
//     //$("#nuevoImpuestoVenta").val(0);
//     $("#nuevoTotalVent").val(0);
//     $("#totalVenta").val(0);
//     $("#TotEfectivo").val(0);
//     $("#descuento").val(0);
//     $("#nuevoTotalVent").attr("total", 0);
//     document.getElementById("listProductos").value = "[]";
//     // document.getElementById("GuardarVenta").disabled = true;
//   } else {
//     // SUMAR TOTAL DE PRECIOS

//     sumarTotalPreciosV();

//     // AGREGAR IMPUESTO

//     agregarImpuestoV();

//     // AGRUPAR PRODUCTOS EN FORMATO JSON

//     listarProductosV();

   
//   }
// });

// /*=============================================
// MODIFICAR LA CANTIDAD
// =============================================*/
// $(".formularioContrato").on("click", "input.nuevaCantidadProducto", function () {
//   $(this).select();

// });

// function nuevaCantidad(mythis) {
//   var precio = mythis
//     .parent()
//     .parent()
//     .children(".ingresoPrecio")
//     .children()
//     .children(".nuevoPrecioProducto");

//   var preciosub = mythis
//     .parent()
//     .parent()
//     .children(".ingresoPreciosub")
//     .children()
//     .children(".nuevoPreciosub");

//   sumarDescuento();
//   var idProduct = mythis
//   .parent()
//   .parent()
//   .children(".descrip")
//   .children()
//   .children(".nuevaDescripcionProducto");
// // console.log(idProduct.attr("idProducto"))
//   ActualizarStock(idUser,idProduct.attr("idProducto"), mythis.val(),2);
//   var precioFinal = mythis.val() * precio.val();

//   preciosub.val(precioFinal);

//   var nuevoStock = Number(mythis.attr("stock")) - mythis.val();

//   mythis.attr("nuevoStock", nuevoStock);

//   if (Number(mythis.val()) > Number(mythis.attr("stock"))) {
//     /*=============================================
// SI LA CANTIDAD ES SUPERIOR AL STOCK REGRESAR VALORES INICIALES
// =============================================*/

//     mythis.val(1);

//     mythis.attr("nuevoStock", mythis.attr("stock"));

//     var precioFinal = mythis.val() * precio.attr("precioReal");

//     precio.val(precioFinal);

//     sumarTotalPreciosV();

//     swal({
//       title: "La cantidad supera el Stock",
//       text: "¡Sólo hay " + mythis.attr("stock") + " unidades!",
//       type: "error",
//       confirmButtonText: "¡Cerrar!",
//     });

//     return;
//   }

//   // SUMAR TOTAL DE PRECIOS

//   sumarTotalPreciosV();

//   // AGREGAR IMPUESTO

//   agregarImpuestoV();

//   // AGRUPAR PRODUCTOS EN FORMATO JSON

//   listarProductosV();

// }

// $(".formularioContrato").on("change", "input.nuevaCantidadProducto", function () {
//   // console.log($(this));
//   nuevaCantidad($(this));
// });

// /*=============================================
// MODIFICAR LA PRECIO SUB
// =============================================*/
// $(".formularioContrato").on("click", "input.nuevoPreciosub", function () {
//   $(this).select();
// });

// $(".formularioContrato").on("change", "input.nuevoPreciosub", function () {
//   // console.log("aaaaaa");
//   var cantid = $(this)
//     .parent()
//     .parent()
//     .parent()
//     .children(".ingresoCantidad")
//     .children(".nuevaCantidadProducto");

//   var nuevcant = $(this).val() / $(this).attr("preciosub");
//   cantid.val($.number(nuevcant, 3));
//   // SUMAR TOTAL DE PRECIOS
//   // console.log($(this).val);
//   sumarTotalPreciosV();

//   // AGREGAR IMPUESTO

//   agregarImpuestoV();

//   // AGRUPAR PRODUCTOS EN FORMATO JSON

//   listarProductosV();

//   ActualizarStock(idUser,idProducto, cantid,2);
// });

// /*=============================================
// MODIFICAR LA PRECIO
// =============================================*/

// $(".formularioContrato").on("change", "input.nuevoPrecioProducto", function () {
//   var preciosubt = $(this)
//     .parent()
//     .parent()
//     .parent()
//     .children(".ingresoPreciosub")
//     .children()
//     .children(".nuevoPreciosub");

//   var cantid = $(this)
//     .parent()
//     .parent()
//     .parent()
//     .children(".ingresoCantidad")
//     .children(".nuevaCantidadProducto");

//   preciosubt.val($(this).val() * cantid.val());

//   sumarDescuento();
//   // SUMAR TOTAL DE PRECIOS

//   sumarTotalPreciosV();

//   // AGREGAR IMPUESTO

//   agregarImpuestoV();

//   // AGRUPAR PRODUCTOS EN FORMATO JSON

//   listarProductosV();
// });



// /*=============================================
// SUMAR TODOS LOS PRECIOS
// =============================================*/
// var midesc;
// function sumarTotalPreciosV() {
//   var precioItem = $(".nuevoPreciosub");

//   var arraySumaPrecio = [];

//   for (var i = 0; i < precioItem.length; i++) {
//     arraySumaPrecio.push(Number($(precioItem[i]).val()));
//   }

//   function sumaArrayPrecios(total, numero) {
//     return total + numero;
//   }

//   var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios);

//   if (typeof variable !== "undefined") {
//     midesc = $("#descuento").val();
//   } else {
//     midesc = 0;
//   }

//   var prefinal = sumaTotalPrecio;

//   $("#nuevoTotalVent").val(prefinal);
//   $("#totalVenta").val(prefinal);
// $("#TotEfectivo").val(prefinal);
//   $("#nuevoTotalVent").attr("total", prefinal);
// }

// /*=============================================
// SUMAR TODOS LOS PRECIOS
// =============================================*/

// /*=============================================
// FUNCIÓN AGREGAR IMPUESTO
// =============================================*/
// var descu;
// function agregarImpuestoV() {
//   var impuesto = $("#nuevoImpuestoVenta").val();
//   var precioTotal = $("#nuevoTotalVent").attr("total");
//   descu = $("#descuento").val();
//   if (typeof descu !== "undefined") {
//     descu = $("#descuento").val();
//   } else {
//     descu = 0;
//   }
//   var precioSinImpuesto = Number(precioTotal / (1 + impuesto / 100));
//   var totalConImpuesto = Number(precioTotal);
//   // console.log(precioTotal);
//   var precioImpuesto = Number(totalConImpuesto - precioSinImpuesto);
//   $("#nuevoTotalVent").val(totalConImpuesto);

//   $("#totalVenta").val(totalConImpuesto);

 
//     $("#TotEfectivo").val(totalConImpuesto);
 

 
//   $("#nuevoPrecioImpuesto").val(precioImpuesto);

//   $("#nuevoPrecioNet").val(precioSinImpuesto);
// }

// var descu;
// function agregarImpues() {
//   var impuesto = $("#nuevoImpuestoVenta").val();
//   var precioTotal = $("#nuevoTotalVent").attr("total");
//   descu = $("#descuento").val();
//   if (typeof descu !== "undefined") {
//     descu = $("#descuento").val();
//   } else {
//     descu = 0;
//   }
//   var precioSinImpuesto = Number((precioTotal - descu) / (1 + impuesto / 100));
//   var totalConImpuesto = Number(precioTotal - descu);
//   // console.log(precioTotal);
//   var precioImpuesto = Number(totalConImpuesto - precioSinImpuesto);
//   $("#nuevoTotalVent").val(totalConImpuesto);

//   $("#totalVenta").val(totalConImpuesto);

 
//     $("#TotEfectivo").val(totalConImpuesto);
 
  
//   $("#nuevoPrecioImpuesto").val(precioImpuesto);

//   $("#nuevoPrecioNet").val(precioSinImpuesto);
// }

// /*=============================================
// FUNCIÓN AGREGAR IMPUESTO
// =============================================*/

// /*=============================================
// CUANDO CAMBIA EL IMPUESTO
// =============================================*/

// $("#nuevoImpuestoVenta").change(function () {
//   agregarImpuestoV();
//   agregarImpuestoV2();
// });

// function descuent() {
//   var descu = $("#descuento").val();

//   var precioTot = $("#nuevoTotalVent").attr("total");

//   var nuevototal = Number(precioTot - descu);

//   $("#nuevoTotalVent").val(nuevototal);

//   $("#totalVenta").val(nuevototal);
 
//     $("#TotEfectivo").val(nuevototal);
  
  
//   agregarImpues();
// }


// $("#descuento").change(function () {
//   var precioItems = $(".nuevoPrecioProducto");
//   var preciosub = $(".nuevoPreciosub");
//   var cantsub = $(".nuevaCantidadProducto");

//   for (var i = 0; i < precioItems.length; i++) {
//     $(precioItems[i]).val($(precioItems[i]).attr("precioReal"));

//     $(preciosub[i]).val(
//       $(cantsub[i]).val() * $(precioItems[i]).attr("precioReal")
//     );
//   }

//   sumarTotalPreciosV();
//   descuent();
// });


// function sumarDescuento() {
//   var precioIte = $(".nuevoPrecioProducto");
//   var cant = $(".nuevaCantidadProducto");

//   var arraySumaDescuentos = [];

//   for (var i = 0; i < precioIte.length; i++) {
//     arraySumaDescuentos.push(
//       Number(
//         ($(precioIte[i]).attr("precioreal") - $(precioIte[i]).val()) *
//           $(cant[i]).val()
//       )
//     );
//   }

//   function sumaArrayDescuento(total, numero) {
//     return total + numero;
//   }

//   var sumarDescuentos = arraySumaDescuentos.reduce(sumaArrayDescuento);

//   $("#descuento").val(sumarDescuentos);
// }


// /*=============================================
// FORMATO AL PRECIO FINAL
// =============================================*/

// $("#nuevoTotalVent").number(true, 2);
// $("#TotEfectivo").number(true, 2);
// $("#TotTarjeta").number(true, 2);
// $("#vuelto").number(true, 2);


// /*=============================================
// CAMBIO EN EFECTIVO
// =============================================*/
// $("#TotEfectivo").click(function () {
//   $(this).select();
// });
// $(".formularioContrato").on("change", "input#TotEfectivo", function () {
//   var efectivo = $(this).val();
//   if ($("#Ambos").is(":checked")) {
//     if (Number($("#nuevoTotalVent").val() > Number(efectivo))) {
 
//       var cambio = Number($("#nuevoTotalVent").val()) - Number(efectivo);
//       $("#TotTarjeta").val(cambio);
//     } else {
  
//       var cambio = Number($("#nuevoTotalVent").val()) - Number(efectivo);
//       $("#TotTarjeta").val(cambio);
//     }
//   }

// });

// /*=============================================
// CAMBIO EN EFECTIVO
// =============================================*/
// $("#Pago").click(function () {
//   $(this).select();
// });
// $(".formularioContrato").on("change", "input#Pago", function () {
//   var Pago = $(this).val();

//   var cambio = Number(Pago) - Number($("#TotEfectivo").val());
//   $("#vuelto").val(cambio);
// });



// $("#Tarjeta").click(function () {
//   if ($("#Tarjeta").is(":checked")) {
//     document.getElementById("CodTarjeta").style.display = "block";
//     // $("#TotTarjeta").removeAttr("readonly");
//     $("#TotTarjeta").attr("readonly", "readonly");
//     $("#CodTarjeta").removeAttr("readonly");
//     $("#TotEfectivo").attr("readonly", "readonly");
//     document.getElementById("Efectivo").checked = false;
//     $("#TotTarjeta").val(Number($("#totalVenta").val()));
//     $("#TotEfectivo").val(0);
//     document.getElementById("tippago").value = "Tarjeta";
//   } else {
//     document.getElementById("CodTarjeta").style.display = "none";
//     $("#TotTarjeta").attr("readonly", "readonly");
//     $("#CodTarjeta").attr("readonly", "readonly");
//     $("#TotTarjeta").val(0);
//     $("#TotEfectivo").val($("#totalVenta").val());
//     document.getElementById("Efectivo").checked = true;
//     $("#TotEfectivo").removeAttr("readonly");
//     document.getElementById("tippago").value = "Efectivo";
//   }
//   $("#vuelto").val(0);
//   document.getElementById("Ambos").checked = false;
// });

// $("#Efectivo").click(function () {
//   if ($("#Efectivo").is(":checked")) {
//     document.getElementById("CodTarjeta").style.display = "none";
//     $("#TotEfectivo").attr("readonly", "readonly");
//     $("#TotTarjeta").attr("readonly", "readonly");
//     $("#CodTarjeta").attr("readonly", "readonly");
//     document.getElementById("Tarjeta").checked = false;
//     $("#TotEfectivo").val(Number($("#totalVenta").val()));
//     $("#TotTarjeta").val(0);
//     $("#CodTarjeta").val("");
//     document.getElementById("tippago").value = "Efectivo";
//   } else {
//     document.getElementById("CodTarjeta").style.display = "block";
//     $("#TotTarjeta").removeAttr("readonly");
//     $("#CodTarjeta").removeAttr("readonly");
//     $("#TotTarjeta").val($("#totalVenta").val());
//     $("#TotEfectivo").val(0);
//     document.getElementById("Tarjeta").checked = true;
//     $("#TotEfectivo").attr("readonly", "readonly");
//     document.getElementById("tippago").value = "Tarjeta";
//   }
//   $("#vuelto").val(0);
//   $("#Pago").val(0);
//   document.getElementById("Ambos").checked = false;
// });

// $("#Ambos").click(function () {
//   if ($("#Ambos").is(":checked")) {
//     document.getElementById("CodTarjeta").style.display = "block";
//     $("#TotTarjeta").removeAttr("readonly");
//     $("#CodTarjeta").removeAttr("readonly");
//     $("#TotEfectivo").removeAttr("readonly");
//     document.getElementById("Tarjeta").checked = false;
//     document.getElementById("Efectivo").checked = false;
//     $("#TotTarjeta").val(0);
//     $("#TotEfectivo").val(0);
//     document.getElementById("tippago").value = "Efectivo/Tarjeta";
//   } else {
//     document.getElementById("CodTarjeta").style.display = "none";
//     $("#TotTarjeta").attr("readonly", "readonly");
//     $("#CodTarjeta").attr("readonly", "readonly");
//     $("#TotTarjeta").val(0);
//     $("#TotEfectivo").val($("#totalVenta").val());
//     document.getElementById("Efectivo").checked = true;
//     $("#TotEfectivo").removeAttr("readonly");
//     document.getElementById("tippago").value = "Efectivo";
//   }
//   $("#vuelto").val(0);
// });
// /*=============================================
// CAMBIO EN EFECTIVO
// =============================================*/
// $("#TotTarjeta").click(function () {
//   $(this).select();
// });
// $(".formularioContrato").on("change", "input#TotTarjeta", function () {
//   var efectivo = $(this).val();
//   if ($("#Ambos").is(":checked")) {
//     if (Number($("#nuevoTotalVent").val() > Number(efectivo))) {
//       var cambio = Number($("#nuevoTotalVent").val()) - Number(efectivo);
//       $("#TotEfectivo").val(cambio);

//     }
//   } else {
//     if (Number($("#nuevoTotalVent").val() > Number(efectivo))) {
//       document.getElementById("GuardarVenta").disabled = true;
//       document.getElementById("TotTarjeta").style.borderColor = "red";
 
//     } else {
//       document.getElementById("GuardarVenta").disabled = false;
//       document.getElementById("TotTarjeta").style.borderColor = null;
//     }
//   }
// });


// /*=============================================
// CAMBIO TRANSACCIÓN
// =============================================*/
// $(".formularioContrato").on("change", "input#nuevoCodigoTransaccion", function () {
//   // Listar método en la entrada
//   listarMetodos();
// });

// /*=============================================
// LISTAR TODOS LOS PRODUCTOS
// =============================================*/

// function listarProductosV() {
//   var listaProductos = [];
//   var descripcion = $(".nuevaDescripcionProducto");

//   var cantidad = $(".nuevaCantidadProducto");

//   var precio = $(".nuevoPreciosub");

//   for (var i = 0; i < descripcion.length; i++) {
//     listaProductos.push({
//       id: $(descripcion[i]).attr("idProducto"),
//       descripcion: $(descripcion[i]).val(),
//       cantidad: $(cantidad[i]).val(),
//       stock: $(cantidad[i]).attr("nuevoStock"),
//       precio: $(precio[i]).attr("preciosub"),
//       total: $(precio[i]).val(),
//     });
//   }

//   $("#listProductos").val(JSON.stringify(listaProductos));
//   // var Lispro = JSON.parse($("#listaProductos").val());
//   // console.log(Lispro.length)
// }

// //$(".formularioVenta").on("click", "button.aaaaa", function(){
// //$(".formularioOrdenedi").on("change", "input#GuardarVenta", function(){

// listarProductosV();

// /*=============================================
// LISTAR MÉTODO DE PAGO
// =============================================*/

// function listarMetodos() {
//   var listaMetodos = "";

//   if ($("#nuevoMetodoPago").val() == "Efectivo") {
//     $("#listaMetodoPago").val("Efectivo");
//     document.getElementById("error").style.visibility = "hidden";
//   } else {
//     $("#listaMetodoPago").val(
//       $("#nuevoMetodoPago").val() + "-" + $("#nuevoCodigoTransaccion").val()
//     );
//   }
// }



// /*=============================================
// BOTON EDITAR VENTA
// =============================================*/
// $(".tablasMventas").on("click", ".btnEditarVenta", function () {
//   var idVenta = $(this).attr("idVenta");

//   window.location = "index.php?ruta=editar-venta&idVenta=" + idVenta;
// });

// /*=============================================
// FUNCIÓN PARA DESACTIVAR LOS BOTONES AGREGAR CUANDO EL PRODUCTO YA HABÍA SIDO SELECCIONADO EN LA CARPETA
// =============================================*/

// function quitarAgregarProductos() {
//   //Capturamos todos los id de productos que fueron elegidos en la venta
//   var idProductos = $(".quitarProducto");

//   //Capturamos todos los botones de agregar que aparecen en la tabla
//   var botonesTabla = $(".tablaVentas tbody button.agregarProducto");

//   //console.log(idProductos.length);
//   //Recorremos en un ciclo para obtener los diferentes idProductos que fueron agregados a la venta
//   for (var i = 0; i < idProductos.length; i++) {
//     //Capturamos los Id de los productos agregados a la venta
//     var boton = $(idProductos[i]).attr("idProducto");

//     //Hacemos un recorrido por la tabla que aparece para desactivar los botones de agregar
//     for (var j = 0; j < botonesTabla.length; j++) {
//       if ($(botonesTabla[j]).attr("idProducto") == boton) {
//         $(botonesTabla[j]).removeClass("btn-primary agregarProducto");
//         $(botonesTabla[j]).addClass("btn-default");
//       }
//     }
//   }
// }

// /*=============================================
// CADA VEZ QUE CARGUE LA TABLA CUANDO NAVEGAMOS EN ELLA EJECUTAR LA FUNCIÓN:
// =============================================*/
// $(".tablaVentas").on("draw.dt", function () {
//   quitarAgregarProductos();
// });

// /*=============================================
// BORRAR VENTA
// =============================================*/

// $(".tablasMventas").on("click", ".btnEliminarVenta", function () {
//   var idVenta = $(this).attr("idVenta");

//   swal({
//     title: "¿Está seguro de borrar la venta?",
//     text: "¡Si no lo está seguro puede cancelar la accíón!",
//     type: "warning",
//     showCancelButton: true,
//     confirmButtonColor: "#3085d6",
//     cancelButtonColor: "#d33",
//     cancelButtonText: "Cancelar",
//     confirmButtonText: "Si, borrar venta!",
//   }).then(function (result) {
//     if (result.value) {
//       window.location = "index.php?ruta=ventas&idVenta=" + idVenta;
//     }
//   });
// });

// /*=============================================
// IMPRIMIR FACTURA
// =============================================*/

// $(".tablasMventas").on("click", ".btnImprimirFactura", function () {
//   var codigoVenta = $(this).attr("codigoVentaFac");

//   window.open(
//     "extensiones/tcpdf/pdf/Factura.php?codigo=" + codigoVenta,
//     "_blank"
//   );
// });

// $(".tablasMventas").on("click", ".btnImprimirBoleta", function () {
//   var codigoVenta = $(this).attr("codigoVentaBol");

//   window.open(
//     "extensiones/tcpdf/pdf/Factura.php?codigo=" + codigoVenta,
//     "_blank"
//   );
// });

// /*=============================================
// RANGO DE FECHAS
// =============================================*/

// // $('#daterange-btn').daterangepicker(
// // {
// //   ranges   : {
// //     'Hoy'       : [moment(), moment()],
// //     'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
// //     'Últimos 7 días' : [moment().subtract(6, 'days'), moment()],
// //     'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
// //     'Este mes'  : [moment().startOf('month'), moment().endOf('month')],
// //     'Último mes'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
// //   },
// //   startDate: moment(),
// //   endDate  : moment()
// // },
// // function (start, end) {
// //   $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

// //   var fechaInicial = start.format('YYYY-MM-DD');

// //   var fechaFinal = end.format('YYYY-MM-DD');

// //   var capturarRango = $("#daterange-btn span").html();

// //    localStorage.setItem("capturarRango", capturarRango);

// //    window.location = "index.php?ruta=ventas&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

// // }

// // )

// /*=============================================
// CANCELAR RANGO DE FECHAS
// =============================================*/

// $(".daterangepicker.opensleft .range_inputs .cancelBtn").on(
//   "click",
//   function () {
//     localStorage.removeItem("capturarRango");
//     localStorage.clear();
//     window.location = "ventas";
//   }
// );

// /*=============================================
// CAPTURAR HOY
// =============================================*/

// $(".daterangepicker.opensleft .ranges li").on("click", function () {
//   var textoHoy = $(this).attr("data-range-key");

//   if (textoHoy == "Hoy") {
//     var d = new Date();

//     var dia = d.getDate();
//     var mes = d.getMonth() + 1;
//     var año = d.getFullYear();

//     if (mes < 10) {
//       var fechaInicial = año + "-0" + mes + "-" + dia;
//       var fechaFinal = año + "-0" + mes + "-" + dia;
//     } else if (dia < 10) {
//       var fechaInicial = año + "-" + mes + "-0" + dia;
//       var fechaFinal = año + "-" + mes + "-0" + dia;
//     } else if (mes < 10 && dia < 10) {
//       var fechaInicial = año + "-0" + mes + "-0" + dia;
//       var fechaFinal = año + "-0" + mes + "-0" + dia;
//     } else {
//       var fechaInicial = año + "-" + mes + "-" + dia;
//       var fechaFinal = año + "-" + mes + "-" + dia;
//     }

//     localStorage.setItem("capturarRango", "Hoy");

//     window.location =
//       "index.php?ruta=ventas&fechaInicial=" +
//       fechaInicial +
//       "&fechaFinal=" +
//       fechaFinal;
//   }
// });

// var tipocom = 0;
// var tipodoc = "";
// var namecompro = "";
// function contratofac() {
//     document.getElementById("documento").value = "RUC";
//     document.getElementById("nuevoDocumentoRuc").placeholder = "Ingrese RUC";
//     document.getElementById("contratoFac").checked = true;
//     document.getElementById("metodosPago").style.display = "block";
//     tipocom = 2;
//     namecompro = "Factura";  
// }
// $(window).ready(function () {
//   $("#contratoFac").click(function () {
//     contratofac();
//   });
// });

// function contratoporFac() {
//     document.getElementById("nuevoDocumentoRuc").placeholder = "Ingrese RUC";
//     document.getElementById("contratoporFac").checked = true;
//     document.getElementById("metodosPago").style.display = "none";
//     tipocom = 1;
//     namecompro = "PorFacturar"; 
// }

// $(window).ready(function () {
//   $("#contratoporFac").click(function () {
//     contratoporFac();

//   });
// });


// var ca = 0;

// var idcli;
// var buton;
// var minombre;
// var midoc;
// var midireccion;
// var tdocu;
// function addclient() {
//   //$(".alert").remove();
//     minombre = document.getElementById("cliente").value;
//     midoc = midoc;
//     midireccion = document.getElementById("domicil").value;
//     tdocu = tipodoc;
//   minombre =midoc;
//   var parame = {
//     tipodocu: tdocu,
//     midocu: midoc,
//     minombre: minombre,
//     midireccion: midireccion,
//   };

//   $.ajax({
//     data: parame,
//     url: "ajax/addclientes.ajax.php",
//     type: "POST",
//     dataType: "json",
//     // beforeSend: function () {
//     //   $("#mensaje").html("antes");
//     // },
//     success: function (respuest) {
//       //client.prop('disabled', false);
//       idcli = respuest;
//       if (document.getElementById("contratoFac").checked == true)  {
//         addVent();
//     }else{
//       alert("Contrato Guardado");
//       limpia();
//     }
    
//     },
//     error: function () {
//       alert("Ocurrio un error en el servidor ..");
//     },
//   });
// }

// /*=============================================
// GUARDAR VENTAAAAAA
// =============================================*/

// var namecomp;
// var productos;
// var total;
// var subtotal;
// var igv;
// var plac;
// var codeQr;
// var codecompro;
// var metodopago;
// var PagoEfec;
// var PagoTarj;
// var PagoVale;
// function addVent() {
//   var idUsuario = document.getElementById("idUsuario").value;
//     igv = document.getElementById("nuevoPrecioImpuesto").value;
//     subtotal = document.getElementById("nuevoPrecioNet").value;
//     var extr = document.getElementById("nuevoTotalVent").value;
//     total = extr.replace(",", "");
//     try {
//       descuento = document.getElementById("descuent").value;
//     } catch (error) {
//       descuento = 0;
//     }
//     productos = document.getElementById("listProductos").value;
//     CodigoTarjeta = document.getElementById("CodTarjeta").value;
//     PagoEfec = document.getElementById("TotEfectivo").value;
//     PagoTarj = document.getElementById("TotTarjeta").value;
//     PagoVale = 0;
//     namecomp = "Factura";
//     metodopago = document.getElementById("tippago").value;
//   var parame = {
//     idusuario: idUsuario,
//     idcliente: idcli,
//     comprobante: namecomp,
//     producto: productos,
//     metpago: metodopago,
//     codetransaccion: CodigoTarjeta,
//     PagoVale: PagoVale,
//     PagoEfectivo: PagoEfec,
//     PagoTarjeta: PagoTarj,
//     subtotal: subtotal,
//     descuento: descuento,
//     igv: igv,
//     total: total,
//     estado: "realizada",
//     placa: "",
//     isla: "",
//     lado: "",
//   };

//   $.ajax({
//     data: parame,
//     url: "ajax/addventas.ajax.php",
//     type: "POST",
//     dataType: "json",
//     // beforeSend: function () {
//     //   $("#mensaje").html("antes");
//     // },
//     success: function (respuest) {
//       if (respuest == 0) {
//         swal({
//           type: "error",
//           title: "La venta no se ha ejecuta si no hay productos",
//           showConfirmButton: true,
//           confirmButtonText: "Aceptar",
//         });
//       } else if (respuest == "errorconex") {
//         swal({
//           type: "error",
//           title: "Error Intente Denuevo",
//           showConfirmButton: true,
//           confirmButtonText: "Aceptar",
//         });
//       } else {
//         swal({
//           type: "success",
//           title: "Venta Realizada",
//           showConfirmButton: true,
//           confirmButtonText: "Aceptar",
//         });
//         var codi = respuest;

//         // console.log($("#tipoUsuario").val());
   
//           window.open(
//             "extensiones/tcpdf/pdf/Factura.php?codigo=" + codi,
//             "_blank"
//           );
    
//         limpia();
//       }
//     },
//     error: function () {
//       alert("Ocurrio un error en el ser ..");
//     },
//   });
// }
// // var es = 0;



// $("#GuardarContrato").click(function () {
 
//   if (
//     document.getElementById("Tarjeta").checked ||
//     document.getElementById("Ambos").checked
//   ) {
//     var trans = document.getElementById("CodTarjeta").value;
//     if (trans.length < 5) {
//       alert("Debe ingresar codigo de transaccion");
//       document.getElementById("CodTarjeta").focus();
//       return 0;
//     }
//   }

//   midoc = document.getElementById("nuevoDocumentoRuc").value;
//   var RucEmpresa = document.getElementById("nuevoDocumentoRuc").value;
//   var products = document.getElementById("listProductos").value;
//   if (products == "" || products == "[]") {
//     swal({
//       type: "error",
//       title: "La venta no se ha ejecuta si no hay productos",
//       showConfirmButton: true,
//       confirmButtonText: "Aceptar",
//     });
//   }  else if ( midoc.length < 10) {
//    alert("Ingrese un Ruc")
//   } else {
//     if (document.getElementById("contratoporFac").checked == true) {
//       addclient();
//     } else if (document.getElementById("contratoFac").checked == true)  {
//         addclient();  
//     }else{
//       alert("Marcar una opcion Factura o Por Facturar")
//     }
//   }
// });


// /*=============================================
// REVISAR SI EL CLIENTE YA ESTÁ REGISTRADO
// =============================================*/
// function BuscarCliente(cliente){

//   midoc = document.getElementById("nuevoDocumentoRuc").value;
//     document.getElementById("domicil").value = "";
//     tipocom = 2;
//     document.getElementById("documento").value = "RUC";
//     namecompro = "Factura";
//     tipodoc = "RUC";
  
//   // console.log(tipocom);
//   var docum = document.getElementById("nuevoDocumentoRuc").value;
//   var nombree = document.getElementById("cliente");
//   var direccionn = document.getElementById("domicil");

//   var datos = new FormData();
//   datos.append("validarCliente", cliente);

//   $.ajax({
//     url: "ajax/clientes.ajax.php",
//     method: "POST",
//     data: datos,
//     cache: false,
//     contentType: false,
//     processData: false,
//     dataType: "json",
//     success: function (respuesta) {
//       if (respuesta) {
//         // if (tipodoc == "RUC" && cliente.length < 9) {
//         //   $("#nuevoDocumentoRuc")
//         //     .parent()
//         //     .after('<div class="alert alert-warning">RUC No Existe</div>'),
//         //     $("#cliente").val(""),
//         //     $("#domicil").val("");
//         // } else if (tipodoc == "DNI" && cliente.length > 9) {
//         //   $("#nuevoDocumentoRuc")
//         //     .parent()
//         //     .after('<div class="alert alert-warning">DNI No Existe</div>'),
//         //     $("#cliente").val("");
//         // } else {
//         //   nombree.value = respuesta["razonsocial"];
//         //   direccionn.value = respuesta["direccion"];
//         // }
//         nombree.value = respuesta["razonsocial"];
//         direccionn.value = respuesta["direccion"];
//       } else if (!navigator.onLine) {
//         $("#nuevoDocumentoRuc")
//           .parent()
//           .after('<div class="alert alert-warning">ingrese nombre</div>');
//       } else {     
//           fetch(
//             "https://dniruc.apisperu.com/api/v1/ruc/" +
//               docum +
//               "?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImpvaG54ZHhkMDFAZ21haWwuY29tIn0.ZruhemgKkC4EJUsE_A5HhhIc69anmTnmcu2tYZpuW24"
//           )
//             .then((response) => {
//               if (response.ok) {
//                 return response.json();
//               } else if (response.status === 404) {
//                 return Promise.reject("error 404");
//               } else {
//                 return Promise.reject("error: " + response.status);
//               }
//             })
//             .then(
//               (data) => (
//                 (nombree.value = data.razonSocial),
//                 (direccionn.value = data.direccion + " - " + data.departamento)
//               )
//             )
//             .catch(
//               (error) =>
//                 $("#nuevoDocumentoRuc")
//                   .parent()
//                   .after(
//                     '<div class="alert alert-warning">RUC No Existe</div>'
//                   ),
//               $("#cliente").val(""),
//               $("#domicil").val("")
//             );
        
//       }
//     },
//   });
// }

// $("#nuevoDocumentoRuc").change(function () {
//   $(".alert").remove();
//   var cliente = $(this).val();
//   if (cliente.length<10){
//       alert("Ingrese un Ruc");
//   }else{
//   BuscarCliente(cliente);
//   }
// });

// /*=============================================
// REVISAR SI EL CLIENTE YA ESTÁ REGISTRADO
// =============================================*/


// // STILES FOR BUTTON DESCUENTOS
// $(document).on("click", "#desFactura", function () {
//   if ($(this).hasClass("btn-primary")) {
//     $(this).removeClass("btn-primary");
//     $(this).addClass("desFactura");
//   } else {
//     $(this).removeClass("desFactura");
//     $(this).addClass("btn-primary");
//   }
// });
// $(document).on("click", "#desTarjeta", function () {
//   if ($(this).hasClass("btn-success")) {
//     $(this).removeClass("btn-success");
//     $(this).addClass("desTarjeta");
//   } else {
//     $(this).removeClass("desTarjeta");
//     $(this).addClass("btn-success");
//   }
// });
// $(document).on("click", "#desVale", function () {
//   if ($(this).hasClass("btn-danger")) {
//     $(this).removeClass("btn-danger");
//     $(this).addClass("desVale");
//   } else {
//     $(this).removeClass("desVale");
//     $(this).addClass("btn-danger");
//   }
// });


// /*=============================================
// LIMPIA LOS CAMPOS
// =============================================*/
// $('#Empresas').val('0').trigger('change.select2');

// function limpia() {
//     document.getElementById("nuevoDocumentoRuc").value = "";
//     document.getElementById("cliente").value = "";
//     document.getElementById("domicil").value = "";
//     document.getElementById("CodTarjeta").value = "";
//     try {
//       document.getElementById("descuento").value = "";
//     } catch (error) {}
//     document.getElementById("listProductos").value = "[]";
//     $("#nuevoTotalVent").val(0);
//     $("#totalVenta").val(0);
//     $("#TotEfectivo").val(0);
//     $("#Pago").val(0);
//     $("#CodTarjeta").val("");
//     $("#TotTarjeta").val(0);
//     $("#nuevoTotalVent").attr("total", 0);
//     $("#TotTarjeta").attr("readonly", "readonly");
//     document.getElementById("contratoporFac").checked = false;
//     document.getElementById("contratoFac").checked = false;
//     document.getElementById("Efectivo").checked = true;
//     document.getElementById("tippago").value = "Efectivo";
//     document.getElementById("CodTarjeta").style.display = "none";

//     namecompro = "";
//     $('#Empresas').val('0').trigger('change.select2');
//     $('#TrabajadoresEmpre').val('0').trigger('change.select2');
//     $('#AutosEmpre').val('0').trigger('change.select2');
//     tipocom = 0;
//     tipodoc = "";

//     //localStorage.clear();

//     var descrip = $(".nuevaDescripcionProducto");

//     for (var i = 0; i < descrip.length; i++) {
//       const idpro = $(descrip[i]).attr("idProducto");
//       $("button.recuperarBoton[idProducto='" + idpro + "']").removeClass(
//         "btn-default"
//       );

//       $("button.recuperarBoton[idProducto='" + idpro + "']").addClass(
//         "btn-primary agregarProducto"
//       );
//     }
//     $(".nuevoProducto").children("div").remove();
  
// }

// $("#Empresas").change(function () {

//   var miempresa = $(this).val();

//   $("#nuevoDocumentoRuc").val(miempresa);

//   BuscarCliente(miempresa);
//   var Empre = $("#TrabajadoresEmpre");
//   var autos = $("#AutosEmpre");

//   var datos = new FormData();
//   datos.append("rucempresa", miempresa);

//   $.ajax({
//     url: "ajax/trabajadorAjax.php",
//     method: "POST",
//     data: datos,
//     cache: false,
//     contentType: false,
//     processData: false,
//     dataType: "json",
//     success: function (respuest) {
//   // Limpiamos el select
//   Empre.find('option').remove();
  
//   // Empre.append('<option value="" selected disabled hidden>Seleccionar Trabajador</option>');
//   $(respuest).each(function(i, v){ // indice, valor
//     Empre.append('<option value="' + v.idtrabajador + '">' + v.dnitrabajador + ' ' +v.nombres + '</option>');
//    })
   
//     },
//     error: function () {
//       console.log("Error")
//     },
//   });


//   $.ajax({
//     url: "ajax/autosAjax.php",
//     method: "POST",
//     data: datos,
//     cache: false,
//     contentType: false,
//     processData: false,
//     dataType: "json",
//     success: function (respuest) {
//   // Limpiamos el select
//   autos.find('option').remove();
//   try {
//     $("#nuevoPlaca").val(respuest[0]['placa']);
//   } catch (error) {
//     $("#nuevoPlaca").val("");
//   }
//   // autos.append('<option value="" selected disabled hidden>Seleccionar Placa</option>');
//   $(respuest).each(function(i, v){ // indice, valor
//     autos.append('<option value="' + v.idvehiculo + '">' + v.placa + '</option>');
//    })
//     },
//     error: function () {
//       console.log("Error")
//     },
//   });

// });

// $("#AutosEmpre").change(function () {
//   var AutosEmpre = $('#AutosEmpre option:selected').text();
//   $("#nuevoPlaca").val(AutosEmpre);
// });


// // ActualizarStock("asdas","5",1);
// function ActualizarStock(idusuario,idp,ca,tipo) {
//   var parame = {
//     tipo: tipo,
//     idusuario: idusuario,
//     idarticulo: idp,
//     cantidad: ca,
//   };
//   $.ajax({
//     data: parame,
//     url: "ajax/adddetalletemp.ajax.php",
//     type: "POST",
//     dataType: "json",
//     // beforeSend: function () {
//     //   $("#mensaje").html("antes");
//     // },
//     success: function (respuest) {
//        console.log(respuest);
//     },
//     error: function () {
//       alert("Ocurrio un error en el ser ..");
//     },
//   });
// }

// $(window).bind('beforeunload', function(){
//   var Lispro = JSON.parse($("#listProductos").val());
//     for (var i = 0; i < Lispro.length; i++){
//    ActualizarStock(idUser,Lispro[i]['id'], Lispro[i]['cantidad'],1);
//   }
    
// });
