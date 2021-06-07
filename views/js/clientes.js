//EDITAR CLIENTE
$(document).on("click", ".editarCliente", function () {
    var idCliente = $(this).attr("idCliente");
    var datos = new FormData();
    datos.append("idCliente", idCliente);
    $.ajax({
        url: "ajax/clientesAjax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            // console.log(respuesta);
            $("#Eidcliente").val(respuesta["idcliente"]);
            $("#ErazonS").val(respuesta["razonsocial"]);
            $("#Edireccion").val(respuesta["direccion"])
            $("#Etelefono").val(respuesta["telefono"]);
            $("#Eemail").val(respuesta["email"]);
        }
    });
})

//ELIMINAR CLIENTE
$(document).on("click", ".eliminarCliente", function () {
    var idCliente = $(this).attr("idCliente");
    swal({
        title: "¿Está seguro  de borrar el Cliente?",
        text: "¡Si no lo está, puede cancelar la acción!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: "Si, borrar Cliente"
    }).then((result) => {
        if (result.value) {
            window.location = "index.php?ruta=clientes&idCliente=" + idCliente;
        }
    });
})

// API Y VALIDAR QUE EL CLIENTE NO SE REPITA
$("#dni").change(function () {
    $(".alert").remove();
    var cliente = $(this).val();

    var datos = new FormData();
    datos.append("validarCliente", cliente);

    $.ajax({
        url: "ajax/clientesAjax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            if (respuesta) {
                $("#dni")
                    .parent()
                    .after(
                        '<div class="alert alert-warning">Este Documento ya existe</div>'
                    );

                // $("#nuevoDocumentoId").val("");
            } else {
                var dni = document.getElementById("dni").value;
                var nombre = document.getElementById("razonS");
                fetch("https://dniruc.apisperu.com/api/v1/dni/" + dni + "?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImpvaG54ZHhkMDFAZ21haWwuY29tIn0.ZruhemgKkC4EJUsE_A5HhhIc69anmTnmcu2tYZpuW24")

                    //fetch("https://dni.optimizeperu.com/api/persons/" + dni)  
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
                        (data) =>
                        (nombre.value =
                            data.nombres + " " + data.apellidoPaterno + " " + data.apellidoMaterno)
                    )
                    .catch(
                        (error) =>
                            $("#dni")
                                .parent()
                                .after('<div class="alert alert-warning">DNI No Existe</div>'),
                        $("#razonS").val("")
                    );
            }
        },
    });
});

$("#radioRUC").click(function () {
    console.log("RUCCC");
});