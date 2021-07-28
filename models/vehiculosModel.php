<?php

class VehiculosModel {
    
    static public function list() {
        try {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM vehiculos");
            $stmt->execute();
            return $stmt->fetchAll();
            $stmt = null;
        } catch (PDOException $e) {
            error_log('VehiculosModel:: listAutos() -> ' . $e);
        }
    }

    static public function save($datos) {
        try {
            $stmt = Conexion::conectar()->prepare('INSERT INTO vehiculos (idvehiculo, km, rucempresa) VALUES (:idvehiculo, :km, :rucempresa)');

            $stmt->bindParam(':idvehiculo', $datos['idvehiculo'], PDO::PARAM_STR);
            $stmt->bindParam(':km', $datos['km'], PDO::PARAM_STR);
            $stmt->bindParam(':rucempresa', $datos['rucempresa'], PDO::PARAM_STR);

            if ($stmt->execute()) return "ok";
            return 'error';
            $stmt = null;
        } catch (PDOException $e) {
            error_log('VehiculosModel:: save() -> ' . $e);
        }
    }

    static public function getVehiculo($idvehiculo) {
        try {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM vehiculos WHERE idvehiculo = $idvehiculo");
            $stmt->execute();
            return $stmt->fetch();
            $stmt = null;
        } catch (PDOException $e) {
            error_log('VehiculosModel:: getVehiculo() -> ' . $e);
        }
    }

    static public function edit($datos) {
        try {
            $stmt = Conexion::conectar()->prepare("UPDATE SET placa = :placa, km = :km, rucempresa = :rucempresa WHERE idvehiculo = :idvehiculo");

            $stmt->bindParam(":idvehiculo", $datos['idvehiculo'], PDO::PARAM_STR);
            $stmt->bindParam(":placa", $datos['placa'], PDO::PARAM_STR);
            $stmt->bindParam(":km", $datos['km'], PDO::PARAM_STR);
            $stmt->bindParam(":rucempresa", $datos['rucempresa'], PDO::PARAM_STR);

            if ($stmt->execute()) return 'ok';
            return 'error';
            $stmt = null;
        } catch (PDOException $e) {
            error_log('VehiculosModel:: edit() -> ' . $e);
        }
    }

    static public function delete($idvehiculo) {
        try {
            $stmt = Conexion::conectar()->prepare("DELETE FROM vehiculos WHERE idvehiculo = :idvehiculo");
            $stmt->bindParam(':idvehiculo', $idvehiculo, PDO::PARAM_STR);
            if ($stmt->execute()) return "ok";
                return "error";
        } catch (PDOException $e) {
            error_log('VehiculosModel:: delete() -> ' . $e);
        }
    }

}