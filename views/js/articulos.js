// DESACTIVAR ARTICULO
$(".table").on("click", "#eliminarArticulo", function() {

    var idArticulo = $(this).attr("idArticulo");
    var estadoArt = $(this).attr("estadoArticulo");

    swal({
        title: "¿Está seguro  de borrar el articulo",
        text: "¡Si no lo está puede cancelar la acción!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: "si, borrar articulo"
    }).then((result) => {
        if (result.value) {
            window.location = "index.php?ruta=articulos&idarticulo=" + idArticulo + "&estadoArt=" + estadoArt;
        }
    });
})

// ACTIVAR ARTICULO
$(".table").on("click", "#btnActivar", function() {

    var idArticulo = $(this).attr("idArticulo");
    var estadoArt = $(this).attr("estadoArticulo");
    console.log('dedf');
    swal({
        title: "¿Está seguro  de habilitar el articulo",
        text: "¡Si no lo está puede cancelar la acción!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: "si, habilitar articulo"
    }).then((result) => {
        if (result.value) {
            window.location = "index.php?ruta=articulos-desabilitados&idarticulo=" + idArticulo + "&estadoArt=" + estadoArt;
        }
    });
})


//EDITAR ARTICULO
$(".table tbody").on("click", "button.EditarArticulo", function() {

    var idArticulo = $(this).attr("idArticulo");
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
            $("#idArticulo").val(respuesta["idarticulo"]);
            $("#idtipo").val(respuesta["idtipo"]);
            $("#idtipo").html(respuesta["tipoArt"]);
            $("#editarUnidad").html(respuesta["unidad"]);
            $("#editarUnidad").html(respuesta["unidad"]);
            $("#descripcion").val(respuesta["descripcion"]);
            $("#cantidad").val(respuesta["cantidad"]);
            $("#pVenta").val(respuesta["precioventa"]);
        }
    })
})