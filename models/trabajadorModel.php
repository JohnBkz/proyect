<?php
require_once 'conexion.php';
class modeloTrabajador
{

    static public function listarTrabajadorModel($tabla, $valor)
    {
  
            $stmt = Conexion::conectar()->prepare("SELECT *   FROM $tabla WHERE rucempresa = $valor");
            // $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll();
            $stmt = null;
    

    }

    static public function mostrarTrabajadorModel($tabla, $item, $valor)
    {
        if ($item != '') {
            $stmt = Conexion::conectar()->prepare("SELECT $tabla.dnitrabajador, $tabla.idtrabajador, $tabla.nombres, $tabla.apellidos, $tabla.rucempresa, empresas.nombre AS empresa 
            FROM $tabla
            INNER JOIN empresas ON $tabla.rucempresa = empresas.rucempresa
            WHERE $tabla.$item = $valor");
            // $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
            $stmt = null;
        } else {
            $stmt = Conexion::conectar()->prepare("SELECT $tabla.dnitrabajador,$tabla.idtrabajador,  $tabla.nombres, $tabla.apellidos, $tabla.rucempresa, empresas.nombre AS empresa 
            FROM $tabla
            INNER JOIN empresas ON $tabla.rucempresa = empresas.rucempresa");
            $stmt->execute();
            return $stmt->fetchAll();
            $stmt = null;
        }
    }
    // NO REPETIR TRABAJADOR
    static public function mostrarTrabajadorEmp($tabla, $item, $valor, $empresaTra, $empresaT)
    {
        $stmt = Conexion::conectar()->prepare("SELECT $tabla.dnitrabajador,$tabla.idtrabajador,  $tabla.nombres, $tabla.apellidos, $tabla.rucempresa, empresas.nombre AS empresa 
        FROM $tabla
        INNER JOIN empresas ON $tabla.rucempresa = empresas.rucempresa
        WHERE $item = $valor AND 
        $tabla.$empresaTra = $empresaT");
        // $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
        $stmt = null;
    }

    // MOSTRAR DETALLE EMPRESA TRABAJADORES
    static public function mostrarTrabajadorDet($tabla, $item, $valor)
    {
        $stmt = Conexion::conectar()->prepare("SELECT $tabla.dnitrabajador, $tabla.idtrabajador, $tabla.nombres, $tabla.apellidos, $tabla.rucempresa,$tabla.estado, empresas.nombre AS empresa 
            FROM $tabla
            INNER JOIN empresas ON $tabla.rucempresa = empresas.rucempresa
            WHERE $tabla.$item = $valor 
            ORDER BY $tabla.estado");
        // $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt = null;
    }
    // static public function mostrarTrabajadorController(){
    //     $tabla = "trabajadoresempresa";
    //     $item = "dnitrabajador";
    //     $valor = $this->validarTrabajador;
    //     $empresaTra = "rucempresa";
    //     $empresaT = $this->empresaT;
    //     $respuesta = modeloTrabajador::mostrarTrabajadorEmp($tabla, $item, $valor, $empresaTra, $empresaT);
    //     echo json_encode($respuesta);
    // }

    // CREAR TRABAJADORES
    static public function crearTrabajadorModel($datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO trabajadoresempresa (dnitrabajador, nombres, apellidos, rucempresa ) VALUES (:dnitrabajador, :nombres, :apellidos, :rucempresa)");

        $stmt->bindParam(":dnitrabajador", $datos["dniTrabajador"], PDO::PARAM_STR);
        $stmt->bindParam(":nombres", $datos["nombreTra"], PDO::PARAM_STR);
        $stmt->bindParam(":apellidos", $datos["apellidoTra"], PDO::PARAM_STR);
        $stmt->bindParam(":rucempresa", $datos["empresa"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }

    static public function editarTrabajadorModel($datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE trabajadoresempresa SET dnitrabajador = :dnitrabajador, nombres = :nombres, apellidos = :apellidos WHERE idtrabajador = :idtrabajador");
        $stmt->bindParam(":dnitrabajador", $datos["dniTrabajadorE"], PDO::PARAM_STR);
        $stmt->bindParam(":idtrabajador", $datos["idTrabajadorE"], PDO::PARAM_INT);
        $stmt->bindParam(":nombres", $datos["nombreTraE"], PDO::PARAM_STR);
        $stmt->bindParam(":apellidos", $datos["apellidoTraE"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt = null;
    }

    static public function deleteTrabajadorModel($datos)
    {
        $cod = Conexion::conectar()->prepare("SELECT estado AS esta FROM trabajadoresempresa  WHERE idtrabajador = '$datos'");
        if ($cod->execute()) {
            $estaTra = $cod->fetch(PDO::FETCH_ASSOC)['esta'];
            if ($estaTra == 0) {
                $estaTra = 1;
            } else {
                $estaTra = 0;
            }
        } else {
            return "error";
        }
        $stmt = Conexion::conectar()->prepare("UPDATE trabajadoresempresa SET estado = '$estaTra' WHERE idtrabajador = :idtrabajador");
        $stmt->bindParam(":idtrabajador", $datos, PDO::PARAM_STR);

        if ($stmt->execute()) {
            // error_log('TrabajadorModel::delte()-> SUCCESS');
            return "ok";
        } else {
            // error_log('TrabajadorModel::delte()-> ERROR');
            return "error";
        }
        $stmt = null;
    }

    // BORRAR MULTIPLES TRABAJADORES
    static public function deleteTrabajadorMulti($tabla, $item, $valor, $ruc, $rucValor)
    {
        $cod = Conexion::conectar()->prepare("SELECT $tabla.estado AS esta FROM $tabla  WHERE $tabla.$item = '$valor'");
        if ($cod->execute()) {
            $estaTra = $cod->fetch(PDO::FETCH_ASSOC)['esta'];
            if ($estaTra == 0) {
                $estaTra = 1;
            } else {
                $estaTra = 0;
            }
        } else {
            return "error";
        }
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $tabla.estado = '$estaTra' WHERE $tabla.$item = $valor");
        if ($stmt->execute()) {
            // error_log('TrabajadorModel::delte()-> SUCCESS');
            return "ok";
        } else {
            // error_log('TrabajadorModel::delte()-> ERROR');
            return "error";
        }
        $stmt = null;
    }
}