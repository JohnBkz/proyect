<?php require_once "conexion.php";

class ModeloUsuarios {

	static public function MostrarUsuarios($tabla, $item, $valor) {
		try {
			if ($item != '') {
				$stmt = Conexion::conectar()->prepare("SELECT $tabla.idusuario, $tabla.user, $tabla.password, $tabla.nombres, $tabla.apellidos, perfiles.idperfil, perfiles.description, $tabla.foto, $tabla.estado, $tabla.idhorario, horario.nombrehorario FROM $tabla INNER JOIN perfiles ON $tabla.idperfil = perfiles.idperfil INNER JOIN horario ON $tabla.idhorario = horario.idhorario WHERE $item = :$item  ORDER BY $tabla.estado");
				$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
				$stmt->execute();
				return $stmt->fetch();
				$stmt = null;
			} else {
				$stmt = Conexion::conectar()->prepare("SELECT $tabla.idusuario, $tabla.user, $tabla.password, $tabla.caja, $tabla.idhorario, $tabla.nombres, $tabla.apellidos, perfiles.idperfil, perfiles.description, $tabla.foto, $tabla.estado, horario.nombrehorario FROM $tabla INNER JOIN perfiles ON $tabla.idperfil = perfiles.idperfil INNER JOIN horario ON $tabla.idhorario = horario.idhorario ORDER BY $tabla.estado");
				$stmt->execute();
				return $stmt->fetchAll();
				$stmt = null;
			}
		} catch (PDOException $e) {
			error_log('UsuarioModel::mostrar() ' . $e);
		}
	}

	static public function openCajaUsuario($iduser) {
		$stmt = Conexion::conectar()->prepare('INSERT INTO caja (idusuario) VALUES (:iduser)');
		$stmt->bindParam(":iduser", $iduser, PDO::PARAM_STR);
		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}
		$stmt = null;
	}

	static public function maxCajaId() {
		$stmt = Conexion::conectar()->prepare('SELECT MAX(idcaja) AS caja FROM caja');
		$stmt->execute();
		$maxCajaId = $stmt->fetch(PDO::FETCH_ASSOC)['caja'];
		return $maxCajaId;
		$stmt = null;
	}

	static public function insertCajaUsuario($iduser, $maxCajaId) {
		//error_log('' . $maxCajaId . '-' . $iduser);
		$stmt = Conexion::conectar()->prepare("UPDATE usuarios SET caja = :maxCajaId WHERE idusuario = :idusuario");

		$stmt->bindParam(':maxCajaId', $maxCajaId, PDO::PARAM_INT);
		$stmt->bindParam(':idusuario', $iduser, PDO::PARAM_INT);
		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}
		$stmt = null;
	}

	static public function InsertUsuario($datos) {
		try {
			$stmt = Conexion::conectar()->prepare("INSERT INTO usuarios (idusuario, user, password, nombres, apellidos, idperfil, foto, idhorario) VALUES (:idusuario, :user, :password, :nombres, :apellidos, :idperfil, :foto, :idhorario)");

			$stmt->bindParam(":idusuario", $datos["iduser"], PDO::PARAM_STR);
			$stmt->bindParam(":user", $datos["usuario"], PDO::PARAM_STR);
			$stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
			$stmt->bindParam(":nombres", $datos["nombres"], PDO::PARAM_STR);
			$stmt->bindParam(":apellidos", $datos["apellidos"], PDO::PARAM_STR);
			$stmt->bindParam(":idperfil", $datos["idperfil"], PDO::PARAM_STR);
			$stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
			$stmt->bindParam(":idhorario", $datos["idhorario"], PDO::PARAM_STR);

			if ($stmt->execute()) {
				error_log('UsuarioController::InsertUsuario()-> OK');
				return "ok";
			} else {
				error_log('UsuarioController::InsertUsuario()-> ERROR');
				return "error";
			}

			$stmt = null;
		} catch (PDOException $e) {
			error_log('UsuarioModel::Insert()->' . $e);
		}
	}

	static public function editUsuario($datos) {
		try {
			$stmt = Conexion::conectar()->prepare("UPDATE usuarios SET user = :user, password = :password, nombres = :nombres, apellidos = :apellidos,  foto = :foto, idhorario = :idhorario WHERE idusuario = :idusuario");

			$stmt->bindParam(":idusuario", $datos["idusuario"], PDO::PARAM_STR);
			$stmt->bindParam(":user", $datos["usuario"], PDO::PARAM_STR);
			$stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
			$stmt->bindParam(":nombres", $datos["nombres"], PDO::PARAM_STR);
			$stmt->bindParam(":apellidos", $datos["apellidos"], PDO::PARAM_STR);
			$stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
			$stmt->bindParam(":idhorario", $datos["idhorario"], PDO::PARAM_STR);

			if ($stmt->execute()) {
				// error_log('UsuarioModel::EdittUsuario()-> OK');
				return "ok";
			} else {
				// error_log('UsuarioModel::EdittUsuario()-> ERROR');
				return "error";
			}
			$stmt = null;
		} catch (PDOException $e) {
			// error_log('UsuarioModel::EdittUsuario()->' . $e);
		}
	}

	static public function changeStateUsuario($datos) {
		$stmt = Conexion::conectar()->prepare("UPDATE usuarios SET id = :id");
		$stmt->bindParam(":id", $datos, PDO::PARAM_INT);
		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}

		$stmt = null;
	}

	static public function deleteUsuario($datos) {
		$stmt = Conexion::conectar()->prepare("DELETE FROM usuarios WHERE idusuario = :idusuario");
		$stmt->bindParam(":idusuario", $datos, PDO::PARAM_INT);

		if ($stmt->execute()) {
			// error_log('UsuarioModel::delte()-> SUCCESS');
			return "ok";
		} else {
			// error_log('UsuarioModel::delte()-> ERROR');
			return "error";
		}

		$stmt = null;
	}

	// ACTIVAR USER
	static public function mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2) {

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_INT);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		if ($stmt->execute()) {
			return "ok";
			// error_log('UsuarioModel::activar()-> SUCCESS');
		} else {
			return "error";
			// error_log('UsuarioModel::activar()-> ERROR');
		}

		$stmt = null;
	}

	static public function closeCaja($fechacierre, $horacierre, $idcaja) {
		try {
			$stmt = Conexion::conectar()->prepare('UPDATE caja SET fechacierre = :fechacierre, horacierre = :horacierre WHERE idcaja = :idcaja');
			
			$stmt->bindParam(':fechacierre', $fechacierre, PDO::PARAM_STR);
			$stmt->bindParam(':horacierre', $horacierre, PDO::PARAM_STR);
			$stmt->bindParam(':idcaja', $idcaja, PDO::PARAM_STR);
			
			if ($stmt->execute()) {
				return 'ok';
			}
			$stmt = null;
		} catch (PDOException $e) {
			
		}
	}

	static public function logoutUser($iduser) {
		try {
			$stmt = Conexion::conectar()->prepare('UPDATE usuarios SET caja = 0 WHERE idusuario = :iduser');	
			$stmt->bindParam(':iduser', $iduser, PDO::PARAM_STR);
			if ($stmt->execute()) {
				return 'ok';
			} else {
				return 'error';
			}
			$stmt = null;
		} catch (PDOException $e) {
			error_log('ModeloUsuario:: logout -> ' . $e);
		}
	}

	static public function saldoCaja($idcaja) {
		try {
			$stmt = Conexion::conectar()->prepare('SELECT saldo FROM caja WHERE idcaja = :idcaja');
			$stmt->bindParam(':idcaja', $idcaja, PDO::PARAM_STR);
			$stmt->execute();
			$saldoCaja = $stmt->fetch(PDO::FETCH_ASSOC)['saldo'];
			if ($saldoCaja == NULL) $saldoCaja = 0;
			return $saldoCaja;
			$stmt = null;
		} catch (PDOException $e) {
			error_log('ModeloUsuario:: saldoCaja ' .$e);
		}
	}

	static public function defineSaldoCaja($saldoCaja, $idcaja) {
		try {
			$stmt = Conexion::conectar()->prepare('UPDATE caja SET saldo = :saldo WHERE idcaja = :idcaja');
			$stmt->bindParam(':idcaja', $idcaja, PDO::PARAM_INT);
			$stmt->bindParam(':saldo', $saldoCaja, PDO::PARAM_STR);
			if ($stmt->execute()) {
				return 'ok';
				error_log('ModeloUsuario:: defineSaldoCaja -> OK');
			} else {
				return 'error';
				error_log('ModeloUsuario:: defineSaldoCaja -> ERROR');
			}
			$stmt = null;
		} catch (PDOException $e) {
			error_log('ModeloUsuario:: defineSaldoCaja -> ' . $e);
		}
	}

	static public function getPerfiles() {
		try {
			$stmt = Conexion::conectar()->prepare("SELECT * FROM perfiles");
			$stmt->execute();
			return $stmt->fetchAll();
			$stmt = null;
		} catch (PDOException $e) {
			error_log('UsuarioModel:;getPerfiles ' . $e);
		}
	}

}

// UPDATE `usuarios` SET `idperfil`= 02 WHERE `idusuario` = 1

// SELECT usuarios.idusuario, usuarios.user, usuarios.caja, usuarios.idhorario, usuarios.nombres, usuarios.apellidos, perfiles.idperfil, perfiles.description, usuarios.foto, usuarios.estado FROM usuarios INNER JOIN perfiles ON usuarios.idperfil = perfiles.idperfil INNER JOIN horario ON usuarios.idhorario = horario.idhorario ORDER BY usuarios.estado