<?php require_once 'conexion.php';

class ProveedorModel {
    
    static public function MostrarProveedores($item, $valor) {
        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM proveedores WHERE $item = :$item");
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        } else {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM proveedores");
            $stmt->execute();
            return $stmt->fetchAll();
        }

        $stmt = null;
    }

    static public function insertProveedor($datos) {
        try {
			$stmt = Conexion::conectar()->prepare("INSERT INTO proveedores (idproveedor, razonsocial, domfiscal, telefono, email) VALUES(:idproveedor, :razonsocial, :domfiscal, :telefono, :email)");

			$stmt->bindParam(":idproveedor", $datos["idproveedor"], PDO::PARAM_STR);
			$stmt->bindParam(":razonsocial", $datos["razonsocial"], PDO::PARAM_STR);
			$stmt->bindParam(":domfiscal", $datos["domfiscal"], PDO::PARAM_STR);
			$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
			$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);

			if ($stmt->execute()) {
				#error_log('ProveedorModel::insert()-> SUCCESS');
				return "ok";
			} else {
				#error_log('ProveedorModel::insert()-> ERROR');
				return "error";
			}

			$stmt = null;
		} catch (PDOException $e) {
            #error_log('ProveedorModel::insert()-> ' . $e);
		}
    }

    static public function editarProveedor($datos) {
        try {
            $stmt = Conexion::conectar()->prepare("UPDATE proveedores SET idproveedor = :idproveedor, razonsocial = :razonsocial, domfiscal = :domfiscal, telefono = :telefono,  email = :email WHERE idproveedor = :idproveedor");

            $stmt->bindParam(":idproveedor", $datos["idproveedor"], PDO::PARAM_STR);
            $stmt->bindParam(":razonsocial", $datos["razonsocial"], PDO::PARAM_STR);
            $stmt->bindParam(":domfiscal", $datos["domfiscal"], PDO::PARAM_STR);
            $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
            $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);

            if ($stmt->execute()) {
                #error_log('ProveedorModel::edit()-> SUCCESS');
                return "ok";
            } else {
                #error_log('ProveedorModel::edit()-> SUCCESS');
                return "error";
            }
            $stmt->closeCursor();
            $stmt = null;
        } catch (PDOException $e) {
            #error_log('ProveedorModel::edit() -> ' . $e);
        }
    }

    static public function deleteProveedor($tabla, $datos) {
        try {
            $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idproveedor = :idproveedor");
            $stmt -> bindParam(":idproveedor", $datos, PDO::PARAM_STR);
            if ($stmt->execute()) {
                #error_log('ProveedorModel::delete()-> SUCCESS');
                return "ok";
            } else {
                #error_log('ProveedorModel::delete()-> ERROR');
                return "error";
            }

            $stmt->closeCursor();
            $stmt = null;
        } catch (PDOException $e) {
            #error_log('ProveedorModel::delete()-> ' . $e);
        }
    }

}