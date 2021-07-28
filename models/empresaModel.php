<?php
class modeloEmpresa
{
    static public function mostrarEmpresaModel($tabla, $item, $valor)
    {
        if ($item != '') {
            $stmt = Conexion::conectar()->prepare("SELECT SELECT * FROM $tabla WHERE $item = :$item");
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
            $stmt = null;
        } else {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
            $stmt->execute();
            return $stmt->fetchAll();
            $stmt = null;
        }
    }

    static public function crearEmpresaModel($datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO empresas (rucempresa, nombre, domiciliofiscal, monto ) VALUES (:rucempresa, :nombre, :domiciliofiscal, :monto)");

        $stmt->bindParam(":rucempresa", $datos["rucEmpresa"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre", $datos["nomEmpresa"], PDO::PARAM_STR);
        $stmt->bindParam(":domiciliofiscal", $datos["domEmpresa"], PDO::PARAM_STR);
        $stmt->bindParam(":monto", $datos["monEmpresa"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            error_log('UsuarioController::InsertUsuario()-> OK');
            return "ok";
        } else {
            error_log('UsuarioController::InsertUsuario()-> ERROR');
            return "error";
        }

        $stmt = null;
    }

    static public function editarEmpresaModel($datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE empresas SET rucemprea = :rucempresa, nombre = :nombre, domiciliofiscal = :domiciliofiscal, monto = :monto WHERE rucemprea = :rucemprea");

        $stmt->bindParam(":rucempresa", $datos["rucEmpresaE"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre", $datos["nombreEmpresaE"], PDO::PARAM_STR);
        $stmt->bindParam(":domiciliofiscal", $datos["domicilioFE"], PDO::PARAM_STR);
        $stmt->bindParam(":monto", $datos["montoEmpresaE"], PDO::PARAM_INT);


        if ($stmt->execute()) {
            // error_log('UsuarioModel::EdittUsuario()-> OK');
            return "ok";
        } else {
            // error_log('UsuarioModel::EdittUsuario()-> ERROR');
            return "error";
        }
        $stmt = null;
    }

    static public function deleteEmpresaModel($datos)
    {
        $stmt = Conexion::conectar()->prepare("DELETE FROM empresas WHERE rucempresa = :rucempresa");
        $stmt->bindParam(":rucempresa", $datos, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt = null;
    }

}