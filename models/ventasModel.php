<?php require_once "conexion.php";

class VentasModel {
    
    static public function mostrarVentas($item, $valor) {
        try {
            if ($item != null) {
                $stmt = Conexion::conectar()->prepare("SELECT * FROM ventas WHERE $item = :$item");
                $stmt->bindParam(':' . $item, $valor, PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->fetch();
            } else {
                $stmt = Conexion::conectar()->prepare("SELECT * FROM ventas");
                $stmt->execute();
                return $stmt->fetchAll();
            }
            $stmt = null;
        } catch (PDOException $e) {
            error_log('VentasController::mostrarventas()' . $e);
        }
    }

    static public function mostrarDetalleVenta($tabla, $item, $valor) {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
        $stmt->bindParam(':', $item, $valor, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
    }

    // static public function mostrarDetalleVenta($tabla, $item, $valor) {
    //     try {
    //         $stmt = Conexion::conectar()->prepare("SELECT detalleventa.idventa, articulos.idarticulo, articulos.descripcion, detalleventa.cantidad, detalleventa.precioventa FROM articulos, tipoarticulo, detalleventa, ventas WHERE articulos.idtipo = tipoarticulo.idtipo AND detalleventa.idarticulo = articulos.idarticulo AND detalleventa.idventa = :ideventa");

    //         $stmt->bindParam(':idventa', $idventa, PDO::PARAM_STR);
    //         $stmt->execute();
    //         return $stmt->fetch();
    //     } catch (PDOException $e) {
    //         error_log('VentasModel::MostrarDetalleVentas()' . $e);
    //     }
        
    // }

    static public function insertVenta($datos) {
        try {
            $stmt = Conexion::conectar()->prepare("INSERT INTO ventas (idusuario, idcliente, comprobante, CODCOMPRO(), metpago, codetransaccion, subtotal, igv, total) VALUES (:idusuario, :idcliente, :comprobante, :metpago, :codetransaccion, :subtotal, :igv, :total)");

            $stmt->bindParam(':idusuario', $datos['idusuario'], PDO::PARAM_STR);
            $stmt->bindParam(':idcliente', $datos['idcliente'], PDO::PARAM_STR);
            $stmt->bindParam(':comprobante', $datos['comprobante'], PDO::PARAM_STR);
            $stmt->bindParam(':metpago', $datos['metpago'], PDO::PARAM_STR);
            $stmt->bindParam(':codetransaccion', $datos['codetransaccion'], PDO::PARAM_STR);
            $stmt->bindParam(':subtotal', $datos['subtotal'], PDO::PARAM_STR);
            $stmt->bindParam(':igv', $datos['igv'], PDO::PARAM_STR);
            $stmt->bindParam(':total', $datos['total'], PDO::PARAM_STR);

            if ($stmt->execute()) {
                error_log('VentasModel::insert()-> OK');
                return 'ok';
            } else {
                error_log('VentasModel::insert()-> ERROR');
                return;
            }
            $stmt = null;
        } catch (PDOException $e) {
            error_log('VentasModel::insert()-> ' . $e);
        }
    }

    static public function maxIdVenta($idusuario) {
        try {
            $stmt = Conexion::conectar()->query("SELECT MAX(idventa) AS venta FROM ventas WHERE idusuario = $idusuario");

            if ($stmt->execute()) {
                $maxIdVenta = $stmt->fetch(PDO::FETCH_ASSOC)['venta'];

                return $maxIdVenta;
            }
            $stmt = null;
        } catch (PDOException $e) {
            error_log('VentasModel::maxIdVenta =>' . $e);
        }
    }

    static public function insertDetalleVenta($datos) {
        try {
            $stmt = Conexion::conectar()->prepare("INSERT INTO detalleventa (idventa, idarticulo, cantidad, precioventa, totalcompra) VALUES $datos");

            if ($stmt->execute()) {
                error_log('VentasModel::insertDetalleVenta()-> OK');
                return "ok";
            } else {
                error_log('VentasModel::insertDetalleVenta()-> ERROR');
                return "error";
            }
            $stmt = null;
        } catch (PDOException $e) {
            error_log('VentaModel::insertDetalleVenta() ' . $e);
        }
    }

}