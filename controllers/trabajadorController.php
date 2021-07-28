<?php
class trabajadorController
{
    static public function mostrarTrabajador($item, $valor)
    {
        $tabla = "trabajadoresempresa";
        $respuesta = modeloTrabajador::mostrarTrabajadorModel($tabla, $item, $valor);
        return $respuesta;
    }

    static public function crearTrabajador()
    {
        if (isset($_POST["dniTrabajador"])) {

            $datos = array(
                "empresa"    => $_POST["empresaT"],
                "dniTrabajador"   => $_POST["dniTrabajador"],
                "nombreTra"   => $_POST["nombreTra"],
                "apellidoTra" => $_POST["apellidoTra"]
            );

            $respuesta = modeloTrabajador::crearTrabajadorModel($datos);

            if ($respuesta == "ok") {
                //error_log('UsuarioController::createUsuario()-> OK');
                echo '<script>
                        swal({
                            type: "success",
                            title: "¡El trabajador ha sido guardado correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if(result.value){
                                window.location = "trabajadores";
                            }
                        });
                    </script>';
            }
        }
    }

    static public function editarTrabajador()
    {
        if (isset($_POST["idTrabajdorE"])) {

            $datos = array(
                "dniTrabajadorE"   => $_POST["dniTrabajadorE"],
                "idTrabajadorE"   => $_POST["idTrabajdorE"],
                "nombreTraE"   => $_POST["nombreTraE"],
                "apellidoTraE" => $_POST["apellidoTraE"]
            );
            // var_dump($datos);
            $respuesta = modeloTrabajador::editarTrabajadorModel($datos);
            if ($respuesta == "ok") {
                echo '<script>
						swal({
							type: "success",
							title: "El trabajador ha sido editado correctamente",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
						}).then(function(result) {
							if (result.value) {
								window.location = "trabajadores";
							}
						})
					</script>';
            }
        }
    }

    static public function deleteTrabajador()
    {
        if (isset($_GET["trabajador"])) {
            // error_log('UsuarioController::delete()-> ' . $_GET['idusuario']);
            $datos = $_GET["trabajador"];
            $empresa = $_GET["e"];
            $respuesta = modeloTrabajador::deleteTrabajadorModel($datos);
            if ($respuesta == "ok") {
                echo $respuesta;
                // error_log('UsuarioController::delete()-> SUCCESS');
                echo '<script>
                	swal({
                		type: "success"' . $empresa . ',
                		title: "El trabajador ha sido actualizado correctamente",
                		showConfirmButton: true,
                		confirmButtonText: "Cerrar",
                		closeOnConfirm: false
                	}).then(function(result) {
                		if (result.value) {
                			window.location = "index.php?ruta=det-empresa&ruc="' . $empresa . '

                		}
                	})
                </script>';
            }
        }
    }

    // ELIMINAR TRABAJADOR EMPRESA
    // static public function deleteTrabajadorEmp()
    // {
    //     if (isset($_GET["trabajador"])) {
    //         // error_log('UsuarioController::delete()-> ' . $_GET['idusuario']);
    //         $datos = $_GET["trabajador"];
    //         $respuesta = modeloTrabajador::deleteTrabajadorModel($datos);
    //         if ($respuesta == "ok") {
    //             // error_log('UsuarioController::delete()-> SUCCESS');
    //             echo '<script>
    // 				swal({
    // 					type: "success",
    // 					title: "El trabajador ha sido borrado correctamente",
    // 					showConfirmButton: true,
    // 					confirmButtonText: "Cerrar",
    // 					closeOnConfirm: false
    // 				}).then(function(result) {
    // 					if (result.value) {
    // 						window.location = "trabajadores";
    // 					}
    // 				})
    // 			</script>';
    //         }
    //     }
    // }


    // BORRA MULTIPLES TRABAJADORES
    static public function borrarMulples()
    {
        if (isset($_POST["borrar"])) {
            if (empty($_POST["eliminar"])) {
                echo '<script>
                swal({
                    type: "error",
                    title: "¡Debe seleccionar trabajadores!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                });
            </script>';
            } else {
                foreach ($_POST["eliminar"] as $eliminar) {
                    $tabla = "trabajadoresempresa";
                    $item = "idtrabajador";
                    $valor = $eliminar;
                    $ruc = "rucempresa";
                    $rucValor = $_GET["ruc"];
                    $respuesta = modeloTrabajador::deleteTrabajadorMulti($tabla, $item, $valor, $ruc, $rucValor);
                    if ($respuesta == "ok") {
                        echo '<script>
                	swal({
                		type: "success",
                		title: "¡Trabajadores borrados con exito!",
                		showConfirmButton: true,
                		confirmButtonText: "Cerrar",
                		closeOnConfirm: false
                	}).then(function(result) {
                		if (result.value) {
                			window.location = "index.php?ruta=det-empresa&ruc=' . $rucValor . '";
                		}
                	})
                </script>';
                    }
                }
            }
        }
    }
}