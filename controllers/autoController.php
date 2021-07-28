<?php
class autosController
{
    static public function mostrarAuto($item, $valor)
    {
        $tabla = "vehiculos";
        $respuesta = modeloAuto::mostrarAutoModel($tabla, $item, $valor);
        return $respuesta;
    }
    static public function crearAuto()
    {
        if (isset($_POST["placa"])) {

            $datos = array(
                "placa"    => $_POST["placa"],
                "kilometraje"   => $_POST["kilometraje"],
                "empresaAuto"   => $_POST["empresaAuto"]
            );

            $respuesta = modeloAuto::crearAutoModel($datos);

            if ($respuesta == "ok") {
                //error_log('UsuarioController::createUsuario()-> OK');
                echo '<script>
                        swal({
                            type: "success",
                            title: "¡El auto se ha sido guardado correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if(result.value){
                                window.location = "autos";
                            }
                        });
                    </script>';
            }
        }
    }

    static public function editarAuto()
    {
        if (isset($_POST["placaE"])) {

            $datos = array(
                "placaE"    => $_POST["placaE"],
                "kilometrajeE"   => $_POST["kilometrajeE"]
            );

            $respuesta = modeloAuto::editarAutoModel($datos);
            if ($respuesta == "ok") {
                echo '<script>
						swal({
							type: "success",
							title: "El auto ha sido editado correctamente",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
						}).then(function(result) {
							if (result.value) {
								window.location = "autos";
							}
						})
					</script>';
            }
        }
    }


    static public function deleteAuto()
    {
        if (isset($_GET["vehiculo"])) {
            $datos = $_GET["vehiculo"];
            $respuesta = modeloAuto::deleteAutoModel($datos);
            if ($respuesta == "ok") {
                echo '<script>
					swal({
						type: "success",
						title: "El vehículo ha sido borrado correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
					}).then(function(result) {
						if (result.value) {
							window.location = "autos";
						}
					})
				</script>';
            }
        }
    }
}