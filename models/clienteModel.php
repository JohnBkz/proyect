<?php require_once "conexion.php";

class ModeloClientes {

    static public function mdlIngresarCliente($tabla, $datos) {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla( documento, ndocumento, razonsocial, direccion,telefono,email) VALUES (:documento, :ndocumento, :razonsocial, :direccion,:telefono,:email)");

        $stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_STR);
        $stmt->bindParam(":ndocumento", $datos["ndocumento"], PDO::PARAM_STR);
        $stmt->bindParam(":razonsocial", $datos["razonsocial"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
        $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
        $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt = null;
    }


    // MOSTRAR CLIENTES
    static public function mdlMostrarClientes($tabla, $item, $valor) {
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

    // EDITAR CLIENTES
    static public function mdlEditarClientes($tabla, $datos) {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET idcliente = :idcliente, razonsocial = :razonsocial, direccion = :direccion, telefono = :telefono,  email = :email WHERE idcliente = :idcliente");

        $stmt->bindParam(":idcliente", $datos["idcliente"], PDO::PARAM_STR);
        $stmt->bindParam(":razonsocial", $datos["razonsocial"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
        $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
        $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    // ELIMINAR CLIENTES
    static public function mdlBorrarCliente($tabla, $datos){
        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idcliente = :idcliente");
        $stmt -> bindParam(":idcliente", $datos, PDO::PARAM_INT);
        if ($stmt->execute()) {
            #error_log('ClienteModel::deleteCliente()-> SUCCESS');
            return "ok";
        } else {
            #error_log('ClienteModel::deleteCliente()-> ERROR');
            return "error";
        }

        $stmt->closeCursor();
        $stmt = null;
    }
}