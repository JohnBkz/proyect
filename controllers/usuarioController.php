<?php

class UsuarioController {

	public function IngresoUsuario() {
		if (isset($_POST["ingUsuario"])) {
			if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUsuario"])) {

				$encriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
				$tabla = "usuarios";
				$item = "user";
				$valor = $_POST["ingUsuario"];
				$respuesta = ModeloUsuarios::MostrarUsuarios($tabla, $item, $valor);
				if ($respuesta["user"] == $_POST["ingUsuario"] && $respuesta["password"] == $encriptar) {
					// error_log('INGuser->' . $respuesta["password"] . ' - encry' . $encriptar);
					if ($respuesta["estado"] == 0) {
						$_SESSION["iniciarSesion"] = "ok";
						$_SESSION["id"] = $respuesta["idusuario"];
						$_SESSION["nombre"] = $respuesta["nombres"];
						$_SESSION["usuario"] = $respuesta["user"];
						$_SESSION["foto"] = $respuesta["foto"];
						$_SESSION["perfi"] = $respuesta["description"];
	
						if ($respuesta['idperfil'] == 02) {
							$_SESSION['perfil'] = 'grifero';
							$iduser = $respuesta['idusuario'];
							$openCaja = ModeloUsuarios::openCajaUsuario($iduser);
							$maxCajaId = ModeloUsuarios::maxCajaId();
							$cajaUsurio = ModeloUsuarios::insertCajaUsuario($iduser, $maxCajaId);

							if ($openCaja == 'ok' && $cajaUsurio == 'ok') {
								$_SESSION['idcaja'] = $maxCajaId;
								echo '<br>
									<div class="alert alert-success">Caja apertura con exito</div>';
								echo '<script>
									setTimeout(() => {
										window.location = "inicio";
									}, 2000);
								</script>';
							} else {
								echo '<br>
								<div class="alert alert-danger">Error al abrir la caja</div>';
							}
						} else {
							//$_SESSION['perfil'] = 'admin';
							echo '<script>
								setTimeout(() => {
									window.location = "inicio";
								}, 2000);
							</script>';
						}
					} else {
						echo '<br>
							<div class="alert alert-danger">El usuario aún no está activado</div>';
					}
				} else {
					echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentarlo</div>';
				}
			}
		}
	}

	static public function MostrarUsuarios($item, $valor) {
		$tabla = "usuarios";
		$respuesta = ModeloUsuarios::MostrarUsuarios($tabla, $item, $valor);
		return $respuesta;
	}

	static public function createUsuario() {
		if (isset($_POST["iduser"])) {
			//('UsuarioController::existPost()->' . $_POST['iduser']);
			if (preg_match('/^[0-9]+$/', $_POST["iduser"]) &&
				preg_match('/^[a-zA-Z0-9]+$/',  $_POST["usuario"]) &&
				preg_match('/^[a-zA-Z0-9]+$/',  $_POST["password"]) &&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nombres"]) &&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["apellidos"])) {

				$ruta = "";

				if (isset($_FILES["foto"]["tmp_name"])) {
					// CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO					
					$directorio = "views/img/usuarios/" . $_POST["usuario"];
					mkdir($directorio, 0755);

					// DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					if ($_FILES["foto"]["type"] == "image/jpeg") {
						// GUARDAMOS LA IMAGEN EN EL DIRECTORIO						
						$aleatorio = mt_rand(100, 999);
						$ruta = $directorio . "/" . $aleatorio . ".jpg";
						move_uploaded_file($_FILES["foto"]["tmp_name"], $ruta);
					}

					if ($_FILES["foto"]["type"] == "image/png") {
						// GUARDAMOS LA IMAGEN EN EL DIRECTORIO						
						$aleatorio = mt_rand(100, 999);
						$ruta = $directorio . "/" . $aleatorio . ".png";
						move_uploaded_file($_FILES["foto"]["tmp_name"], $ruta);
					}
				}

				$encriptar = crypt($_POST["password"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$datos = array(
					"iduser"    => $_POST["iduser"],
					"usuario"   => $_POST["usuario"],
					"password"  => $encriptar,
					"nombres"   => $_POST["nombres"],
					"apellidos" => $_POST["apellidos"],
					"idperfil"  => $_POST["perfil"],
					"foto"      => $ruta,
					"idhorario"   => $_POST["horario"]
				);

				$respuesta = ModeloUsuarios::InsertUsuario($datos);

				if ($respuesta == "ok") {
					//error_log('UsuarioController::createUsuario()-> OK');
					echo '<script>
                        swal({
                            type: "success",
                            title: "¡El usuario ha sido guardado correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if(result.value){
                                window.location = "usuarios";
                            }
                        });
                    </script>';
				}
			} else {
				// error_log('UsuarioController::createUsuario()-> ERROR VALIDATION');
				echo '<script>
					swal({
						type: "error",
						title: "¡El usuario no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
					}).then(function(result){
						if(result.value){
							window.location = "usuarios";
						}
					});
                </script>';
			}
		}
	}

	public function editUsuario() {
		if (isset($_POST["Eiduser"])) {
			if (preg_match('/^[0-9]+$/', $_POST["Eiduser"])) {

				$ruta = $_POST["fotoActual"];
				if (isset($_FILES["Efoto"]["tmp_name"]) && !empty($_FILES["Efoto"]["tmp_name"])) {
					$directorio = "views/img/usuarios/" . $_POST["Eusuario"];
					if (!empty($_POST["fotoActual"])) {
						unlink($_POST["fotoActual"]);
					} else {
						mkdir($directorio, 0755);
					}
					if ($_FILES["Efoto"]["type"] == "image/jpeg") {
						// GUARDAMOS LA IMAGEN EN EL DIRECTORIO						
						$aleatorio = mt_rand(100, 999);
						$ruta = $directorio . "/" . $aleatorio . ".jpg";
						move_uploaded_file($_FILES["Efoto"]["tmp_name"], $ruta);
					}
					if ($_FILES["Efoto"]["type"] == "image/png") {
						// GUARDAMOS LA IMAGEN EN EL DIRECTORIO						
						$aleatorio = mt_rand(100, 999);
						$ruta = $directorio . "/" . $aleatorio . ".png";
						move_uploaded_file($_FILES["Efoto"]["tmp_name"], $ruta);
					}
				}

				if ($_POST["Epassword"] != "") {
					if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["Epassword"])) {
						$encriptar = crypt($_POST["Epassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
					} else {
						echo '<script>
							swal({
								type: "error",
								title: "¡La contraseña no puede ir vacía o llevar caracteres especiales!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
							}).then(function(result) {
								if (result.value) {
									window.location = "usuarios";
								}
							})
						</script>';
						return;
					}
				} else {
					$encriptar = $_POST["passwordActual"];
				}

				$datos = array(
					"idusuario"	=> $_POST["Eiduser"],
					"usuario"	=> $_POST["Eusuario"],
					"password"	=> $encriptar,
					"nombres"	=> $_POST["Enombres"],
					"apellidos"	=> $_POST["Eapellidos"],
					"foto" 		=> $ruta,
					"horario"	=> $_POST["Ehorario"]
				);

				$respuesta = ModeloUsuarios::editUsuario($datos);
				var_dump($respuesta);
				if ($respuesta == "ok") {
					error_log('UsuarioController::editar()-> OK');
					echo '<script>
						swal({
							type: "success",
							title: "El usuario ha sido editado correctamente",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
						}).then(function(result) {
							if (result.value) {
								window.location = "usuarios";
							}
						})
					</script>';
				}
			} else {
				error_log('UsuarioController :: editar()-> ERROR');
				echo '<script>
					swal({
						type: "error",
						title: "¡El nombre no puede ir vacío o llevar caracteres especiales!",
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

	static public function deleteUsuario() {
		if (isset($_GET["idusuario"])) {
			// error_log('UsuarioController::delete()-> ' . $_GET['idusuario']);
			$datos = $_GET["idusuario"];
			if ($_GET["foto"] != "") {
				unlink($_GET["foto"]);
				rmdir('views/img/usuarios/' . $_GET["usuario"]);
			}
			$respuesta = ModeloUsuarios::deleteUsuario($datos);
			if ($respuesta == "ok") {
				// error_log('UsuarioController::delete()-> SUCCESS');
				echo '<script>
					swal({
						type: "success",
						title: "El usuario ha sido borrado correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
					}).then(function(result) {
						if (result.value) {
							window.location = "usuarios";
						}
					})
				</script>';
			} else {
				#error_log('UsuarioController::delete()-> ERROR');
			}
		}
	}

	static public function logout() {
		if ($_SESSION['perfil'] != 'admin') {
			date_default_timezone_set("America/Lima");

			$iduser = $_SESSION["id"];
			$fechacierre = date('Y-m-d');
			$horacierre = date('h:i:s');
			$idcaja = $_SESSION["idcaja"];
			$closeBox = ModeloUsuarios::closeCaja($fechacierre, $horacierre, $idcaja);
			$res = ModeloUsuarios::logoutUser($iduser);
			if ($res == 'ok' && $closeBox == 'ok') {
				session_destroy();
			}
		} else {
			session_destroy();
		}
		
	}

	static public function saldoCaja() {
		$idcaja = $_SESSION['idcaja'];
		$res = ModeloUsuarios::saldoCaja($idcaja);
		return $res;
	}

	static public function defineSaldoCaja() {
		if (isset($_POST['saldoCaja'])) {
			error_log('UsuarioController:: defineSaldoCaja -> ' . $_POST['saldoCaja']);
			if (preg_match('/^[0-9]+$/', $_POST["saldoCaja"])) {
				$saldoCaja = $_POST['saldoCaja'];
				$idcaja = $_SESSION['idcaja'];
				$res = ModeloUsuarios::defineSaldoCaja($saldoCaja, $idcaja);
				if ($res == "ok") {
					error_log('UsuarioController::defineSaldoCaja::OK ->' . $saldoCaja . '-' . $idcaja);
					echo '<script>
						swal({
							type: "success",
							title: "¡Saldo guardado correctamente!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
						}).then(function(result){
							if(result.value){
								window.location = "caja";
							}
						});
					</script>';
				}
			} else {
				echo '<script>
            		swal({
                        type: "error",
                        title: "¡El saldo no puede ir vacío o llevar caracteres especiales!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if (result.value) {
                            window.location = "ventas";
                        }
                    })
              	</script>';
			}
		}
	}

	static public function showPerfiles() {
		$res = ModeloUsuarios::getPerfiles();
		return $res;
	}

	static public function defineDescuento() {
		if (isset($_POST['descuento'])) {
			error_log('UsuarioController:: defineDescuento -> ' . $_POST['descuento']);
			if (preg_match('/^[0-9]+$/', $_POST["descuento"])) {
				$_SESSION['descuento'] = $_POST['descuento'];
			}
		}
	}

}
/**
 * Funcion que dado un valor timestamp, devuelve el numero de dias, horas
 * minutos y segundos
 * Ejemplo: timestampToHuman(strtotime(date1) - strtotime(date2))
 * http://www.lawebdelprogramador.com
 */
// function timestampToHuman() {
// 	$fecha_salida = strtotime("2021-04-19 08:00:06");
// 	$fecha_entrada = strtotime("2021-04-19 12:30:05");

// 	if($fecha_salida > $fecha_entrada) {
// 		echo "Hora de salir";
// 	} else {
// 	echo "Aun no es hora bb";
// 	}
// }