$(".foto").change(function() {
    var imagen = this.files[0];

    if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {
        $(".foto").val("");
        swal({
            type: "error",
            title: "Error al subir imagen",
            text: "¡La imagen debe estar en formato JPG o PNG!",
            confirmButtonText: "Cerrar"
        });
    } else if (imagen["size"] > 2000000000) {
        $(".foto").val("");
        swal({
            type: "error",
            title: "Error al subir imagen",
            text: "¡La imagen no debe pesar más de 2MB!",
            confirmButtonText: "Cerrar"
        });
    } else {
        var datosImagen = new FileReader;
        datosImagen.readAsDataURL(imagen);
        $(datosImagen).on("load", function(event) {
            var rutaImagen = event.target.result;
            $(".previsualizar").attr("src", rutaImagen);
        })
    }

});