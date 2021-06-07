// EDIT USER
$(document).on("click", ".EditarUsuario", function () {
    var idusuario = $(this).attr("idusuario");
    var datos = new FormData();
    datos.append("idusuario", idusuario);
    $.ajax({
        url: "ajax/usuariosAjax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            $("#Eiduser").val(respuesta["idusuario"]);
            $("#Eusuario").val(respuesta["user"]);
            $("#passwordActual").val(respuesta["password"]);
            $("#Enombres").val(respuesta["nombres"]);
            $("#Eapellidos").val(respuesta["apellidos"]);
            $("#perfil").val(respuesta["idperfil"]);
            $("#perfil").html(respuesta["description"]);
            $("#fotoActual").val(respuesta["foto"]);
            $("#horario").val(respuesta["idhorario"]);
            $("#horario").html(respuesta["nombrehorario"]);
            if (respuesta["foto"] != "") {
                $(".Eprevisualizar").attr("src", respuesta["foto"]);
            } else {
                $(".Eprevisualizar").attr("src", "views/img/usuarios/default/anonymous.png");
            }
        }
    });
});

// DELETE USER
$(document).on("click", ".EliminarUsuario", function () {
    var idUsuario = $(this).attr("idUsuario");
    var fotoUsuario = $(this).attr("fotoUsuario");
    var usuario = $(this).attr("usuario");

    // console.log(idUsuario, fotoUsuario, usuario);
    swal({
        title: "¿Está seguro  de borrar el Usuairo?",
        text: "¡Si no lo está, puede cancelar la acción!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: "Si, borrar Usuario"
    }).then((result) => {
        if (result.value) {
            window.location = "index.php?ruta=usuarios&idusuario=" + idUsuario + "&usuario=" + usuario + "&foto=" + fotoUsuario;
        }
    });
})

// DON'T REPEAT USER

$(".usuario").change(function () {
    $(".alert").remove();

    var usuario = $(this).val();
    var datos = new FormData();
    datos.append("validarUsuario", usuario);

    $.ajax({
        url: "ajax/usuariosAjax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {

            if (respuesta) {

                $(".usuario").parent().after('<div class="alert alert-warning">Este usuario ya existe en la base de datos</div>');
                $(".usuario").val("");
                $(".usuario").focus()

            }
        }
    })
})

// DON'T REPEAT DNI

$(".dni").change(function () {
    $(".alert").remove();

    var dni = $(this).val();
    var datos = new FormData();
    datos.append("validarDNI", dni);

    $.ajax({
        url: "ajax/usuariosAjax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {

            if (respuesta) {
                $(".dni").parent().after('<div class="alert alert-warning">Este DNI de usuario ya existe en la base de datos</div>');
                $(".dni").val("");
                $(".dni").focus()
            }

        }
    })
})

// DESACTIVAR USER
$(".table").on("click", ".btnActivar", function () {

    var idUsuario = $(this).attr("idUsuario");
    var estadoUsuario = $(this).attr("estadoUsuario");
    // console.log(idUsuario + " " + estadoUsuario);
    var datos = new FormData();
    datos.append("activarId", idUsuario);
    datos.append("activarEstado", estadoUsuario);

    $.ajax({
        url: "ajax/usuariosAjax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {
            // console.log(respuesta);
            swal({
                title: "El usuario ha sido actualizado",
                type: "success",
                confirmButtonText: "¡Cerrar!"
            }).then(function (result) {
                if (result.value) {
                    window.location = "usuarios";
                }
            });
        }
    })
    if (estadoUsuario == 0) {

        $(this).removeClass('btn-success');
        $(this).addClass('btn-danger');
        $(this).html('Desactivado');
        $(this).attr('estadoUsuario', 1);

    } else {

        $(this).addClass('btn-success');
        $(this).removeClass('btn-danger');
        $(this).html('Activado');
        $(this).attr('estadoUsuario', 0);

    }

})