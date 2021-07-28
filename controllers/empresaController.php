<?php
class empresaController
{
    static public function mostrarEmpresa($item, $valor)
    {
        $tabla = "empresas";
        $respuesta = modeloEmpresa::mostrarEmpresaModel($tabla, $item, $valor);
        return $respuesta;
    }

    static public function crearEmpresa()
    {
        if (isset($_POST["rucEmpresa"])) {

            $datos = array(
                "rucEmpresa"    => $_POST["rucEmpresa"],
                "nomEmpresa"   => $_POST["nombreEmpresa"],
                "domEmpresa"   => $_POST["domicilioF"],
                "monEmpresa" => $_POST["montoEmpresa"]
            );

            $respuesta = modeloEmpresa::crearEmpresaModel($datos);

            if ($respuesta == "ok") {
                //error_log('UsuarioController::createUsuario()-> OK');
                echo '<script>
                        swal({
                            type: "success",
                            title: "¡La empresa ha sido guardado correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if(result.value){
                                window.location = "empresas";
                            }
                        });
                    </script>';
            }
        }
    }

    static public function editarEmpresa()
    {
        if (isset($_POST["rucEmpresa"])) {

            $datos = array(
                "rucEmpresa"    => $_POST["rucEmpresaE"],
                "nomEmpresa"   => $_POST["nombreEmpresaE"],
                "domEmpresa"   => $_POST["domicilioFE"],
                "monEmpresa" => $_POST["montoEmpresaE"]
            );

            $respuesta = modeloEmpresa::editarEmpresaModel($datos);
            var_dump($respuesta);
            if ($respuesta == "ok") {
                echo '<script>
						swal({
							type: "success",
							title: "La empresa ha sido editado correctamente",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
						}).then(function(result) {
							if (result.value) {
								window.location = "usuarios";
							}
						})
					</script>';
            }
        }
    }

      static public function deleteEmpresa()
    {
        if (isset($_GET["empresa"])) {
            $datos = $_GET["empresa"];
            $respuesta = modeloEmpresa::deleteEmpresaModel($datos);
            if ($respuesta == "ok") {
                echo '<script>
					swal({
						type: "success",
						title: "La empresa ha sido borrada correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
					}).then(function(result) {
						if (result.value) {
							window.location = "empresas";
						}
					})
				</script>';
            }
        }
    }

}