Number.prototype.round = function(places) {
    return +(Math.round(this + "e+" + places) + "e-" + places);
}

//AÑADIR ARTICULOS DESDE LA TABLA
var cantidadP = 0;
$(".tablaPedidos tbody").on("click", "button.agregarProductoPedido", function() {

    var idArticulo = $(this).attr("idArticulo");
    $(this).removeClass("btn-primary  agregarProductoPedido");
    $(this).addClass("btn-default");
    var datos = new FormData();
    datos.append("idArticulo", idArticulo);

    $.ajax({

        url: "ajax/articulosAjax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {

            var descripcion = respuesta["descripcion"];
            var unidad = respuesta["unidad"];

            $(".nuevoProducto").append(

                `<div class="row" style="padding:5px 15px">

               <!--Descripción del producto -->
                <div class="col-xs-6" style="padding-right:0px;     padding-right: 20px;">
                <div class="input-group">
                <span class="input-group-addon">
                <button type="button" class="btn btn-danger btn-xs quitarProducto" idArticulo=" ${idArticulo}"><i class="fa fa-times"></i></button></span>

                <input type="text" class="form-control nuevaDescripcionProducto" id="unidadP${cantidadP}" idArticulo="${idArticulo}" name="agregarProductoPedido" value="${descripcion}"  readonly required>

                </div>
                </div>

               <!--Cantidad del producto -->
                <div class="col-xs-2 ingresoCantidad">
                <input type="number" class="form-control nuevaCantidadProducto"  name="nuevaCantidadProducto[]" id="cant${cantidadP}" min="1" placeholder="1" value="1" required onchange="canti();">
                </div>


                <!-- Precio  Unitario -->
                <div class="col-xs-2 ingresoPrecio" style="padding-left:0px">
                <div class="input-group">
                <input type="number" class="form-control nuevoPrecioProducto"  name="nuevoPrecioProducto" id="pre${cantidadP}"  min="0" placeholder="000"  onchange="canti();">
                </div>
                </div>


               <!--Total -->
                <div class="col-xs-2 precioTot" style="padding-left:0px"> 
                <div class="input-group"> 
                <input type="text" class="form-control tot"  name="tot" readonly value=""> 
                </div> 
                </div> 

                <input type="hidden" name="idproducto[]" value="${idArticulo } "></input>
                <input type="hidden"  name="unidad[]" id="uniOculto ${cantidadP } " value=" ${unidad } ">
                <input type="hidden" name="cantidad[]" id="cantOculto ${cantidadP } " value="1"></input>
                <input type="hidden" name="precio[]" id="preOculto ${ cantidadP } "></input> 
                </div>`);
            cantidadP++
            // SUMAR TOTAL DE PRECIOS
            sumarTotalPrecios();

            // AGREGAR DESCUENTO
            agregarDescuentoPedido();

            // AGREGAR IMPUESTO
            agregarImpuestoPedido();

            // PONER FORMATO 
            // $(".tot").round(2);

            // DAR CAMBIO EFECTIVO
            cambioEfectivo();
        }

    })

});

function canti() {
    var newCant = $("input[name='nuevaCantidadProducto[]']").map(function() { return $(this).val(); }).get();
    for (var i = 0; i < newCant.length; i++) {
        var cant = $('#cant' + i).val();
        var pre = $('#pre' + i).val();
        $('#cantOculto' + i).val(cant);
        $('#preOculto' + i).val(pre);
    }
}
/*=============================================
CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA
=============================================*/
$(".tablaPedidos").on("draw.dt", function() {
    if (localStorage.getItem("quitarProducto") != null) {
        var listaIdProductos = JSON.parse(localStorage.getItem("quitarProducto"));
        for (var i = 0; i < listaIdProductos.length; i++) {
            $("button.recuperarBoton[idArticulo='" + listaIdProductos[i]["idArticulo"] + "']").removeClass('btn-default');
            $("button.recuperarBoton[idArticulo='" + listaIdProductos[i]["idArticulo"] + "']").addClass('btn-primary  agregarProductoPedido');
        }
    }
})

/*=============================================
QUITAR PRODUCTOS RECUPERAR BOTÓN
=============================================*/
var idQuitarProducto = [];

localStorage.removeItem("quitarProducto");

$(".formularioPedido").on("click", "button.quitarProducto", function() {

    $(this).parent().parent().parent().parent().remove();
    var idArticulo = $(this).attr("idArticulo");

    // ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR
    if (localStorage.getItem("quitarProducto") == null) {
        idQuitarProducto = [];
    } else {
        idQuitarProducto.concat(localStorage.getItem("quitarProducto"))
    }

    idQuitarProducto.push({ "idArticulo": idArticulo });
    localStorage.setItem("quitarProducto", JSON.stringify(idQuitarProducto));
    $("button.recuperarBoton[idArticulo='" + idArticulo + "']").removeClass('btn-default');
    $("button.recuperarBoton[idArticulo='" + idArticulo + "']").addClass('btn-primary agregarProductoPedido');

    if ($(".nuevoProducto").children().length == 0) {
        $("#nuevoTotalCompra").val(0);
        $("#nuevoImpuestoCompra").val(0);
        $("#nuevoPrecioNeto").val(0);
        $("#totalCompra").val(0);
        $("#nuevoTotalCompra").attr("total", 0);
        $('#nuevoValorEfectivo').val(0);
        $('#nuevoCambioEfectivo').val(0);
        $('#nuevoDescuentoPedido').val(0);
    } else {

        // AGREGAR DESCUENTO
        agregarDescuentoPedido();
        // SUMAR TOTAL DE PRECIOS
        sumarTotalPrecios()


        // AGREGAR IMPUESTO
        agregarImpuestoPedido();

        // DAR CAMBIO EFECTIVO
        cambioEfectivo();

    }

})

// AGREGAR ARTICULOS DESDE UN DISPOSITIVO PEQUEÑO
/*
var numProducto = 0;
var cantidadP = 0;
$(".btnAgregarPedido").click(function() {
    numProducto++
    var datos = new FormData();
    datos.append("traerArticulos", "ok");
    $.ajax({
        url: "ajax/articulosAjax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            //  <select class="form-control nuevaDescripsionProducto" id="producto' +
            //    numProducto + '" idProducto name="nuevaDescripsionProducto" required>' + '<option selected disabled>Seleccione el producto</option>' + ' </select>
            $(".nuevoProducto").append(

                `<div class="row" style="padding:5px 15px">

                <!-- Descripción del producto -->
                <div class="col-xs-6 style="padding-right:0px">
                <div class="input-group">
                <span class="input-group-addon">
                <button type="button" class="btn btn-danger btn-xs quitarProducto" idArticulo=" ${idArticulo}"><i class="fa fa-times"></i></button>
                </span>
                <select class="form-control nuevaDescripcionProducto" id="unidadP${cantidadP}" idArticulo="${idArticulo}" name="agregarProductoPedido" required><option selected disabled>Seleccione el producto</option></select>
                </div>
                </div>

                <!-- Precio  Unitario -->
                <div class="col-xs-2 ingresoPrecio" style="padding-left:0px">
                <div class="input-group">
                <input type="number" class="form-control nuevoPrecioProducto"  name="nuevoPrecioProducto" id="pre${cantidadP}"  min="0" placeholder="000"  onchange="canti();">
                </div>
                </div>


                <!--Total -->
                <div class="col-xs-2 precioTot" style="padding-left:0px"> 
                <div class="input-group"> 
                <input type="text" class="form-control tot"  name="tot" readonly value=""> 
                </div> 
                </div> 


                <input type="hidden" name="idproducto[]" value="${idArticulo } "></input>
                <input type="hidden"  name="unidad[]" id="uniOculto ${cantidadP } " value=" ${unidad } ">
                <input type="hidden" name="cantidad[]" id="cantOculto ${cantidadP } " value="1"></input>
                <input type="hidden" name="precio[]" id="preOculto ${ cantidadP } "></input> 
                </div>`);

            // AGREGAR LOS PRODUCTOS AL SELECT
            respuesta.forEach(functionForEach);

            function functionForEach(item, index) {
                $("#producto" + numProducto).append(
                    `<option idArticulo="' +
                    item.idarticulo + '" value="' +
                    item.descripcion + '">' + item.descripcion + '</option>`
                )
            }
            cantidadP++
            // SUMAR TOTAL DE PRECIOS
            sumarTotalPrecios();

            // AGREGAR DESCUENTO
            agregarDescuentoPedido();

            // AGREGAR IMPUESTO
            agregarImpuestoPedido();

            // PONER FORMATO 
            // $(".tot").round(2);

            // DAR CAMBIO EFECTIVO
            cambioEfectivo();
        }
    })
})
*/

// MODIFICAR CANTIDAD
$(".formularioPedido").on("change", "input.nuevaCantidadProducto", function() {
    var precio = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");
    var preTot = $(this).parent().parent().children(".precioTot").children().children(".tot");
    var precioFinal = $(this).val() * precio.val();
    preTot.val(precioFinal.round(2));

    // SUMAR TOTAL DE PRECIO
    sumarTotalPrecios();

    // AGREGAR DESCUENTO
    agregarDescuentoPedido();

    // AGREGAR IMPUESTO
    agregarImpuestoPedido();

    // DAR CAMBIO EFECTIVO
    cambioEfectivo();
})

// MODIFICAR PRECIO COMPRA
$(".formularioPedido").on("change", "input.nuevoPrecioProducto", function() {
    // var precio = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");
    // console.log(precio);
    var cantidad = $(this).parent().parent().parent().children(".ingresoCantidad").children(".nuevaCantidadProducto");
    // console.log(precio);
    var preTot = $(this).parent().parent().parent().children(".precioTot").children().children(".tot");
    var precioFinal = $(this).val() * cantidad.val();
    preTot.val(precioFinal.round(2));

    // SUMAR TOTAL DE PRECIO
    sumarTotalPrecios();

    // AGREGAR DESCUENTO
    agregarDescuentoPedido();

    // AGREGAR IMPUESTO
    agregarImpuestoPedido();

    // DAR CAMBIO EFECTIVO
    cambioEfectivo();
})

// SUMAR TODOS LOS PRECIOS
function sumarTotalPrecios() {
    var totItem = $(".tot");
    var arraySumaTotal = [];
    for (var i = 0; i < totItem.length; i++) {
        arraySumaTotal.push(Number($(totItem[i]).val()));
    }

    function sumaArrayPrecios(total, numero) {
        return total + numero;
    }
    var sumaTotal = arraySumaTotal.reduce(sumaArrayPrecios);
    $("#nuevoTotalPedido").val(sumaTotal.round(2));
    $("#nuevoTotalPedido").attr("total", sumaTotal.round(2));
}

// AGREGAR IMPUESTO 
function agregarImpuestoPedido() {

    var impuesto = $("#impuestoPedido").val();
    var precioTotal = $("#nuevoTotalPedido").attr("total");

    var precioImpuesto = Number(precioTotal * impuesto / 100);
    var totalConImpuesto = Number(precioTotal - (precioTotal * impuesto / 100));
    var precioSinImpuesto = Number(precioTotal);

    $("#nuevoPrecioImpuesto").val(precioImpuesto.round(2));
    $("#nuevoTotalPedido").val(precioSinImpuesto.round(2));
    $("#nuevoPrecioNeto").val(totalConImpuesto.round(2));

}


function agregarDescuentoPedido() {
    var descuento = $(".nuevoDescuentoUnitario").val();
    var precioTotal = $(".nuevoPrecioProducto").val();
    // precioTotal = precioTotal + impuesto;
    var precioDescuento = descuento;
    var totalConDescuento = Number(precioTotal) - Number(precioDescuento);
    $(".valUniNeto").val(totalConDescuento.round(2));
    // console.log(totalConDescuento);
}

// CUANDO CAMBIE EL DESCUENTO
$(".formularioPedido").on("change", "input.nuevoDescuentoUnitario", function() {
    // SUMAR TOTAL DE PRECIO
    sumarTotalPrecios();
    agregarImpuestoPedido();
    // AGREGAR DESCUENTO
    agregarDescuentoPedido();


    // DAR CAMBIO EFECTIVO
    cambioEfectivo();
})


/*=============================================
BOTON EDITAR PEDIDO
=============================================*/
$(".tablasOrdenPedido").on("click", ".btnEditarPedido", function() {

    var idPedido = $(this).attr("idpedido");

    window.location = "index.php?ruta=editarOrdenPedido&idPedido=" + idPedido;

})