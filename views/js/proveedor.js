//EDITAR PROVEEDOR
$(document).on("click", ".editarProveedor", function() {

    var idProveedor = $(this).attr("idProveedor");
    var datos = new FormData();
    datos.append("idProveedor", idProveedor);
    $.ajax({
        url: "ajax/proveedorAjax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            $("#Eidproveedor").val(respuesta["idproveedor"]);
            $("#Erazonsocial").val(respuesta["razonsocial"]);
            $("#Edomfiscal").val(respuesta["domfiscal"])
            $("#Etelefono").val(respuesta["telefono"]);
            $("#Eemail").val(respuesta["email"]);
        }
    });
});

// ELIMINAR PROVEEDOR
$(document).on("click", ".eliminarProveedor", function() {
    var idproveedor = $(this).attr("idproveedor");
    swal({
        title: "¿Está seguro  de borrar el Proveedor?",
        text: "¡Si no lo está puede cancelar la acción!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: "Si, borrar Proveedor"
    }).then((result) => {
        if (result.value) {
            window.location = "index.php?ruta=proveedores&idproveedor=" + idproveedor;
        }
    });
})

//NO REPETIR RAZON SOCIAL
$(".razonsocial").change(function() {
    $(".alert").remove();

    var razonsocial = $(this).val();
    var datos = new FormData();
    datos.append("validarRS", razonsocial);

    $.ajax({
        url: "ajax/proveedorAjax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {

            if (respuesta) {
                $(".razonsocial").parent().after('<div class="alert alert-warning">Razon social ya existe en la base de datos</div>');
                $(".razonsocial").val("");
                $(".razonsocial").focus()
            }

        }
    })
})

//NO REPETIR RAZON RUC
$(".ruc").change(function() {
    $(".alert").remove();

    var ruc = $(this).val();
    var datos = new FormData();
    datos.append("validarRUC", ruc);

    $.ajax({
        url: "ajax/proveedorAjax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {

            if (respuesta) {
                $(".ruc").parent().after('<div class="alert alert-warning">RUC ya existe en la base de datos</div>');
                // $(".ruc").val("");
                $(".ruc").focus()
            }

        }
    })
})