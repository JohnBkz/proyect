// SELECCIONAR MÉTODO DE PAGO
$("#nuevoMetodoPago").change(function() {

    var metodo = $(this).val();
    // alert(metodo)
    if (metodo == "Efectivo") {
        $(this).parent().parent().removeClass("col-xs-6");
        $(this).parent().parent().addClass("col-xs-4");
        $(this).parent().parent().parent().children(".cajasMetodoPago").html(
            '<div class="col-xs-4">' +
            '<div class="input-group">' +
            '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>' +
            '<input type="text" class="form-control" id="nuevoValorEfectivo" placeholder="000000" required>' +
            '</div>' +
            '</div>' +
            '<div class="col-xs-4" id="capturarCambioEfectivo" style="padding-left:0px">' +
            '<div class="input-group">' +
            '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>' +
            '<input type="text" class="form-control" id="nuevoCambioEfectivo" placeholder="000000" readonly required>' +
            '</div>' +
            '</div>'
        )

        // Agregar formato al precio
        $('#nuevoValorEfectivo').number(true, 1);
        $('#nuevoCambioEfectivo').number(true, 1);

        // Listar método en la entrada
        listarMetodos()

    } else {
        $(this).parent().parent().removeClass('col-xs-4');
        $(this).parent().parent().addClass('col-xs-6');
        $(this).parent().parent().parent().children('.cajasMetodoPago').html(
            '<div class="col-xs-6" style="padding-left:0px">' +
            '<div class="input-group">' +
            '<input type="number" min="0" class="form-control" id="nuevoCodigoTransaccion" placeholder="Código transacción"  required>' +
            '<span class="input-group-addon"><i class="fa fa-lock"></i></span>' +
            '</div>' +
            '</div>'
        )
    }
})


// CAMBIO EN EFECTIVO
$(".formularioCompra").on("change", "input#nuevoValorEfectivo", function() {
    cambioEfectivo();
})


// FUNCION DAR VUELTO EFECTIVO
function cambioEfectivo() {
    var efectivo = $("#nuevoValorEfectivo").val();
    var cambio = Number(efectivo) - Number($('#nuevoNetoCompra').val());
    var nuevoCambioEfectivo = $("#nuevoValorEfectivo").parent().parent().parent().children('#capturarCambioEfectivo').children().children('#nuevoCambioEfectivo');
    nuevoCambioEfectivo.val(cambio);
}
/*=============================================
LISTAR MÉTODO DE PAGO
=============================================*/
function listarMetodos() {

    var listaMetodos = "";
    if ($("#nuevoMetodoPago").val() == "Efectivo") {
        $("#listaMetodoPago").val("Efectivo");
    } else {
        $("#listaMetodoPago").val($("#nuevoMetodoPago").val() + "-" + $("#nuevoCodigoTransaccion").val());
    }
}

// CAMBIO TRANSACCION
$(".formularioVenta").on("change", "input#nuevoCodigoTransaccion", function() {
    // Listar método en la entrada
    listarMetodos()
})


// LISTAR MÉTODO DE PAGO
function listarMetodos() {

    var listaMetodos = "";

    if ($("#nuevoMetodoPago").val() == "Efectivo") {

        $("#listaMetodoPago").val("Efectivo");

    } else {

        $("#listaMetodoPago").val($("#nuevoMetodoPago").val() + "-" + $("#nuevoCodigoTransaccion").val());

    }

}