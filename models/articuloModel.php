<?php require_once "conexion.php";

class ModeloCategorias {

	static public function mdlMostrarCategorias($tabla, $item, $valor) {
        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        } else {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
            $stmt->execute();
            return $stmt->fetchAll();
        }
        $stmt = null;
    }

}

class ModeloArticulos {
	// CREAR ARTICULOS
	static public function mdlCrearArticulo($tabla, $datos) {
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(idtipo, idarticulo,descripcion, unidad, cantidad, precioventa) VALUES (:categoria, :idarticulo, :descripcion, :unidad, :cantidad, :pVenta)");

		$stmt->bindParam(":idarticulo", $datos["idarticulo"], PDO::PARAM_STR);
		$stmt->bindParam(":categoria", $datos["categoria"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":unidad", $datos["unidad"], PDO::PARAM_STR);
		$stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_STR);
		$stmt->bindParam(":pVenta", $datos["pVenta"], PDO::PARAM_STR);

		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}
		$stmt = null;
	}

	// MOSTRAR ARTICULOS
	static public function mdlMostrarAticulo($tabla, $item, $valor) {
		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY idarticulo DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;
	}

	// ACTIVAR ARTICULO
	static public function mdlActualizarArticulo($tabla, $datos, $std) {
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado = :std WHERE idarticulo = :idArti");
		$stmt->bindParam(":std" , $std, PDO::PARAM_INT);
		$stmt->bindParam(":idArti",  $datos, PDO::PARAM_STR);

		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";		
		}

		$stmt = null;
	}

	// static public function mdlActualizarArticulo($tabla, $item1, $valor1, $item2, $valor2) {
	// 	$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");
	// 	$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_INT);
	// 	$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

	// 	if ($stmt->execute()) {
	// 		return "ok";
	// 	} else {
	// 		return "error";		
	// 	}

	// 	$stmt = null;
	// }

	//EDITAR ARTICULO
	static public function mdlEditarArticulo($tabla, $datos) {
		try {
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET idarticulo = :idarticulo, descripcion = :descripcion, unidad = :unidad,   cantidad = :cantidad,  precioventa = :precioventa WHERE idarticulo = :idarticulo");

			$stmt->bindParam(":idarticulo", $datos["idarticulo"], PDO::PARAM_STR);
			$stmt->bindParam(":idtipo", $datos["categoria"], PDO::PARAM_INT);
			$stmt->bindParam(":precioventa", $datos["pVenta"], PDO::PARAM_STR);
			$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
			$stmt->bindParam(":unidad", $datos["unidad"], PDO::PARAM_STR);
			$stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_STR);

			if($stmt->execute()) {
				return "ok";
			} else {
				return "error";
			}

			$stmt = null;

		} catch (PDOException $e) {
			// error_log('ArticuloModel::edit()->' . $e);
		}
	}

}