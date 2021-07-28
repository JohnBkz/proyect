<?php
require_once "conexion.php";
class modeloAuto
{


    static public function listarAutoModel($tabla, $valor)
    {
  
            $stmt = Conexion::conectar()->prepare("SELECT *   FROM $tabla WHERE rucempresa = $valor");
            // $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll();
            $stmt = null;
    

    }

    static public function mostrarAutoModel($tabla, $item, $valor)
    {
        if ($item != '') {
            $stmt = Conexion::conectar()->prepare("SELECT $tabla.idvehiculo, $tabla.placa, $tabla.km, $tabla.rucempresa, empresas.nombre AS empresa 
            FROM $tabla
            INNER JOIN empresas ON $tabla.rucempresa = empresas.rucempresa
            WHERE $tabla.$item = '$valor'");

            // $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();
            return $stmt->fetch();
            $stmt = null;
        } else {
            $stmt = Conexion::conectar()->prepare("SELECT $tabla.idvehiculo, $tabla.placa, $tabla.km, $tabla.rucempresa, empresas.nombre AS empresa 
            FROM $tabla
            INNER JOIN empresas ON $tabla.rucempresa = empresas.rucempresa");
            $stmt->execute();
            return $stmt->fetchAll();
            $stmt = null;
        }
    }
    // MOSTRAR DETALLE EMPRESA AUTOS
    static public function mostrarAutoDet($tabla, $item, $valor)
    {
        $stmt = Conexion::conectar()->prepare("SELECT $tabla.idvehiculo, $tabla.placa, $tabla.km, $tabla.rucempresa 
        FROM $tabla
        INNER JOIN empresas ON $tabla.rucempresa = empresas.rucempresa
        WHERE $tabla.$item = $valor ");
        // $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt = null;
    }
    static public function crearAutoModel($datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO vehiculos ( placa, km, rucempresa ) VALUES (:placa, :km, :rucempresa)");

        $stmt->bindParam(":placa", $datos["placa"], PDO::PARAM_STR);
        $stmt->bindParam(":km", $datos["kilometraje"], PDO::PARAM_STR);
        $stmt->bindParam(":rucempresa", $datos["empresaAuto"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt = null;
    }

    static public function editarAutoModel($datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE vehiculos SET placa = :placa, km = :km WHERE placa = :placa");

        $stmt->bindParam(":placa", $datos["placaE"], PDO::PARAM_STR);
        $stmt->bindParam(":km", $datos["kilometrajeE"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt = null;
    }

    static public function deleteAutoModel($datos)
    {
        $stmt = Conexion::conectar()->prepare("DELETE FROM vehiculos WHERE idvehiculo = :idvehiculo");
        $stmt->bindParam(":idvehiculo", $datos, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt = null;
    }
}