<?php

class VehiculosController {
    
    static public function listar() {
        return $res = VehiculosModel::list();
    }

    static public function addVehiculo() {
        if (isset($_POST['idvehiculo'])) {
            $datos = array(
                'idvehiculo' => $_POST['idvehiculo'],
                'km' => $_POST['km'],
                'rucempresa' => $_POST['rucempresa']
            );

            $res = VehiculosModel::save($datos);

            if ($res == 'ok') {
                echo '<script>
                    swal({
                    type: "success",
                        title: "¡El vehiculo se registro correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if(result.value){
                            window.location = "vehiculos";
                        }
                    });
                </script>';
            } else {
                echo '<script>
                    swal({
                        type: "error",
                        title: "¡Error al registrar el vehiculo!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if(result.value){
                            window.location = "vehiculos";
                        }
                    });
                </script>';
            }
        }
    }

    static public function getVehiculo($idvehiculo) {
        return $res = VehiculosModel::getVehiculo($idvehiculo);
    }

    static public function edit() {
        if (isset($_POST['idvehiculo'])) {
            $datos = array(
                'idvehiculo' => $_POST['idvehiculo'],
                'placa' => $_POST['placa'],
                'km' => $_POST['km'],
                'rucempresa' => $_POST['rucempresa']
            );
        }
    }

    static public function delete() {
        if (isset($_GET['idvehiculo'])) {
            $idvehiculo = $_GET['idvehiculo'];
            $res = VehiculosModel::delete($idvehiculo);
            if ($res == 'ok') {
                echo '<script>
                    swal({
                       type: "success",
                        title: "¡El vehiculo se elimino correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if(result.value){
                            window.location = "vehiculos";
                        }
                    });
                </script>';
            } else {
                echo '<script>
					swal({
						type: "error",
						title: "¡Error al eliminar vehiculo!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
					}).then(function(result){
						if(result.value){
							window.location = "vehiculos";
						}
					});
                </script>';
            }
        }
    }

}