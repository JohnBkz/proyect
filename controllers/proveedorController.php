<?php

class ProveedorController {
    
    static public function MostrarPorveedores($item, $valor) {
        $respuesta = ProveedorModel::MostrarProveedores($item, $valor);
        return $respuesta;
    }

    static public function createProveedor() {
        if (isset($_POST["idproveedor"])) {
            if (preg_match('/^[0-9]+$/', $_POST["idproveedor"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["razonsocial"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["domfiscal"]) &&
                preg_match('/^[()\-0-9 ]+$/', $_POST["telefono"]) &&
                preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["email"])) {

                $datos = array(
                    "idproveedor" => $_POST["idproveedor"],
                    "razonsocial" => $_POST["razonsocial"],
                    "domfiscal" => $_POST["domfiscal"],
                    "telefono" => $_POST["telefono"],
                    "email" => $_POST["email"]
                );

                $respuesta = ProveedorModel::insertProveedor($datos);

                if ($respuesta == "ok") {
                    #error_log('ProveedorController::insert()-> SUCCESS');
                    echo '<script>
                        swal({
                            type: "success",
                            title: "El Proveedor ha sido guardado correctamente",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if (result.value) {
                                window.location = "proveedores";
                            }
                        })
            		</script>';
                }
            } else {
                #error_log('ProveedorController::create()-> ERROR');
                echo '<script>
                    swal({
                        type: "error",
                        title: "¡El Proveedor no puede ir vacío o llevar caracteres especiales!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if (result.value) {
                            window.location = "proveedores";
                        }
                    })
              	</script>';
            }
        }
    }
    static public function createProveedorPedido() {
        if (isset($_POST["idproveedor"])) {
            if (preg_match('/^[0-9]+$/', $_POST["idproveedor"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["razonsocial"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["domfiscal"]) &&
                preg_match('/^[()\-0-9 ]+$/', $_POST["telefono"]) &&
                preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["email"])) {

                $datos = array(
                    "idproveedor" => $_POST["idproveedor"],
                    "razonsocial" => $_POST["razonsocial"],
                    "domfiscal" => $_POST["domfiscal"],
                    "telefono" => $_POST["telefono"],
                    "email" => $_POST["email"]
                );

                $respuesta = ProveedorModel::insertProveedor($datos);

                if ($respuesta == "ok") {
                    #error_log('ProveedorController::insert()-> SUCCESS');
                    echo '<script>
                        swal({
                            type: "success",
                            title: "El Proveedor ha sido guardado correctamente",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if (result.value) {
                                window.location = "crearpedido";
                            }
                        })
            		</script>';
                }
            } else {
                #error_log('ProveedorController::create()-> ERROR');
                echo '<script>
                    swal({
                        type: "error",
                        title: "¡El Proveedor no puede ir vacío o llevar caracteres especiales!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if (result.value) {
                            window.location = "crearpedido";
                        }
                    })
              	</script>';
            }
        }
    }


    static public function editarProveedor() {
        if (isset($_POST["Eidproveedor"])) {
            if (preg_match('/^[0-9]+$/', $_POST["Eidproveedor"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["Erazonsocial"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["Edomfiscal"]) &&
                preg_match('/^[()\-0-9 ]+$/', $_POST["Etelefono"]) &&
                preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["Eemail"])) {

                $datos = array(
                    "idproveedor" => $_POST["Eidproveedor"],
                    "razonsocial" => $_POST["Erazonsocial"],
                    "domfiscal" => $_POST["Edomfiscal"],
                    "telefono" => $_POST["Etelefono"],
                    "email" => $_POST["Eemail"]
                );
                $respuesta = ProveedorModel::editarProveedor($datos);

                if ($respuesta == "ok") {
                    echo '<script>
                        swal({
                            type: "success",
                            title: "¡El proveedor ha sido editado correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if(result.value){						
                                window.location = "proveedores";
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
            				window.location = "proveedores";
            			}
            		});				
            	</script>';
            }
        }
    }

    static public function deleteProveedor() {
        if (isset($_GET["idproveedor"])) {
            #error_log('ProveedorController::delete()-> id: ' . $_GET["idproveedor"]);
            $tabla = 'proveedores';
            $datos = $_GET["idproveedor"];

            $respuesta = ProveedorModel::deleteProveedor($tabla, $datos);

            if ($respuesta == "ok") {
                #error_log('ProveedorController::delete()-> SUCCESS');
                echo '<script>
                    swal({
                        type: "success",
                        title: "El Proveedor ha sido borardo correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if(result.value){						
                            window.location = "proveedores";
                        }
                    });				
                </script>';
            }
        }
    }

}