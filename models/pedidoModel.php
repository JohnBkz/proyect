<?php

class modelPedido{

    static public function insertPedidoModel($datos){
        $stmt = Conexion::conectar()->prepare("INSERT INTO pedidos (idpedido, idusuario, idproveedor, subtotal, igv, total, fechaentrega) VALUES (:idpedido, :idusuario, :idproveedor, :subtotal, :igv, :total, :fechaE)");

            $stmt->bindParam(':idpedido', $datos['codPedido'], PDO::PARAM_INT);
            $stmt->bindParam(':idusuario', $datos['idUser'], PDO::PARAM_STR);
            $stmt->bindParam(':idproveedor', $datos['proveedor'], PDO::PARAM_STR);
            // $stmt->bindParam(':descuento', $datos['descuento'], PDO::PARAM_STR);
            $stmt->bindParam(':subtotal', $datos['neto'], PDO::PARAM_STR);
            $stmt->bindParam(':igv', $datos['impuesto'], PDO::PARAM_STR);
            $stmt->bindParam(':total', $datos['total'], PDO::PARAM_STR);
            $stmt->bindParam(':fechaE', $datos['fechaE'], PDO::PARAM_STR);

            if ($stmt->execute()) {                
                return "ok";
            } else {
                return "error";
            }
            $stmt = null;
    }

    static public function maxIdPedido($idusuario) {

            $stmt = Conexion::conectar()->query("SELECT MAX(idpedido) AS idPedido FROM pedidos WHERE idusuario = $idusuario");
            $stmt->execute();
            $maxIdVenta = $stmt->fetch(PDO::FETCH_ASSOC)['idPedido'];
            return $maxIdVenta;
            $stmt = null;
    }

    // INSERTAR DETALLE PEDIDO
    static public function insertDetallePedido($datos) {
        #$idventa, $idarticulo, $cantidad, $precioventa
        try {
            $stmt = Conexion::conectar()->prepare("INSERT INTO detallepedido (idpedido, idarticulo, cantidad, unidad, valorUnitario) VALUES $datos");
            
            #(:idventa, :idarticulo, :cantidad, :precioventa)
            // $stmt->bindParam(':idventa', $idventa, PDO::PARAM_STR);
            // $stmt->bindParam(':idarticulo', $idarticulo, PDO::PARAM_STR);
            // $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_STR);
            // $stmt->bindParam(':precioventa', $precioventa, PDO::PARAM_STR);

            if ($stmt->execute()) {
                error_log('modelPedido::insertDetallePedido()-> OK');
                return "ok";
            } else {
                error_log('modelPedido::insertDetallePedido(()-> ERROR');
                return "error";
            }
            $stmt = null;
        } catch (PDOException $e) {
            error_log('modelPedido::insertDetallePedido() ' . $e);
        }
    }


    // MOSTRAR PEDIDO
    static public function mostrarPedidos($item, $valor){
        if($item != ''){
            $stmt = Conexion::conectar()->prepare("SELECT pedidos.idpedido, pedidos.idusuario, usuarios.nombres AS usuario, proveedores.razonsocial AS proveedor, pedidos.descuento, pedidos.subtotal, pedidos.igv, pedidos.estado, pedidos.total, pedidos.observacion, pedidos.fecha, pedidos.fechaentrega FROM pedidos 
            INNER JOIN usuarios ON pedidos.idusuario = usuarios.idusuario 
            INNER JOIN proveedores ON pedidos.idproveedor = proveedores.idproveedor 
            WHERE pedidos.$item = :$item");
            $stmt->bindParam(":".$item, $valor, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();
            $stmt = null;
        }else {
            $stmt = Conexion::conectar()->prepare("SELECT pedidos.idpedido, pedidos.idusuario, usuarios.nombres AS usuario, proveedores.razonsocial AS proveedor, pedidos.descuento, pedidos.subtotal, pedidos.igv, pedidos.estado, pedidos.total, pedidos.observacion, pedidos.fecha, pedidos.fechaentrega FROM pedidos 
            INNER JOIN usuarios ON pedidos.idusuario = usuarios.idusuario 
            INNER JOIN proveedores ON pedidos.idproveedor = proveedores.idproveedor");
            $stmt->execute();
            return $stmt->fetchAll();
            $stmt = null;
        }
    }
}