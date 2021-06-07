<?php

class ControladorClientes {

    // Crear CLIENTES
    static public function ctrCrearCliente() {
        if (isset($_POST["ruc"])) {
            if (preg_match('/^[0-9]+$/', $_POST["ruc"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["razonS"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["direccion"]) &&
                preg_match('/^[()\-0-9 ]+$/', $_POST["telefono"]) &&
                preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["email"])) {

                $tabla = "clientes";

                $datos = array(
                    "idcliente" => $_POST["ruc"],
                    "razonsocial" => $_POST["razonS"],
                    "direccion" => $_POST["direccion"],
                    "telefono" => $_POST["telefono"],
                    "email" => $_POST["email"]
                );

                $respuesta = ModeloClientes::mdlIngresarCliente($tabla, $datos);

                if ($respuesta == "ok") {
                    echo '<script>
            		swal({
                        type: "success",
                        title: "El cliente ha sido guardado correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if (result.value) {
                            window.location = "clientes";
                        }
                    })
            		</script>';
                }
            } else {
                echo '<script>
            		swal({
                        type: "error",
                        title: "¡El cliente no puede ir vacío o llevar caracteres especiales!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if (result.value) {
                            window.location = "clientes";
                        }
                    })
              	</script>';
            }
        }
    }

    // MOSTRAR CLIENTES
    static public function ctrMostrarClientes($item, $valor) {
        $tabla = "clientes";
        $respuesta = ModeloClientes::mdlMostrarClientes($tabla, $item, $valor);
        return $respuesta;
    }

    // Editar CLientes
    static public function ctrEditarCliente() {
        if (isset($_POST["Eidcliente"])) {
            if (preg_match('/^[0-9]+$/', $_POST["Eidcliente"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["ErazonS"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["Edireccion"]) &&
                preg_match('/^[()\-0-9 ]+$/', $_POST["Etelefono"]) &&
                preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["Eemail"])) {

                $tabla = "clientes";

                $datos = array(
                    "idcliente" => $_POST["Eidcliente"],
                    "razonsocial" => $_POST["ErazonS"],
                    "direccion" => $_POST["Edireccion"],
                    "telefono" => $_POST["Etelefono"],
                    "email" => $_POST["Eemail"]
                );
                $respuesta = ModeloClientes::mdlEditarClientes($tabla, $datos);

                if ($respuesta == "ok") {
                    echo '<script>
                        swal({
                            type: "success",
                            title: "¡El cliente ha sido editado correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if(result.value){						
                                window.location = "clientes";
                            }
                        });				
                    </script>';
                }
            } else {
                echo '<script>
            		swal({
            			type: "error",
            			title: "¡El nombre no puede ir vacío o llevar caracteres especiales!",
            			showConfirmButton: true,
            			confirmButtonText: "Cerrar"
            		}).then(function(result){
            			if(result.value){						
            				window.location = "clientes";
            			}
            		});				
            	</script>';
            }
        }
    }

    // ELIMINAR CLIENTES
    static public function ctrBorrarCliente() {
        if (isset($_GET["idCliente"])) {
            #error_log('ClienteController::deleteCliente()->' . $_GET["idCliente"]);
            $tabla = "clientes";
            $datos = $_GET["idCliente"];

            $respuesta = ModeloClientes::mdlBorrarCliente($tabla, $datos);
            if ($respuesta  == "ok") {
                #error_log('ClienteController::deleteCliente()-> SUCCESS');
                echo '<script>
                    swal({
                        type: "success",
                        title: "El cliente ha sido borardo correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if(result.value){						
                            window.location = "clientes";
                        }
                    });				
                </script>';
            }
        }
    }
}