<?php
// include 'conexion.php';

class ModeloCompras{
    static public function mostrarCompras($item, $valor){
        if($item != ''){
            $stmt = Conexion::conectar()->prepare("SELECT compra.idcompra, compra.idusuario, usuarios.nombres AS usuario, compra.idproveedor, proveedores.razonsocial AS proveedor, compra.fecha, compra.observacion, compra.neto, compra.impuesto, compra.total FROM compra INNER JOIN usuarios ON compra.idusuario = usuarios.idusuario INNER JOIN proveedores ON compra.idproveedor = proveedores.idproveedor WHERE compra.$item = :$item");
            $stmt->bindParam(":".$item, $valor, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();
            $stmt = null;
        }else {
            $stmt = Conexion::conectar()->prepare("SELECT compra.idcompra, compra.idusuario, usuarios.nombres AS usuario, compra.idproveedor, proveedores.razonsocial AS proveedor, compra.fecha, compra.observacion, compra.neto, compra.impuesto, compra.total FROM compra INNER JOIN usuarios ON compra.idusuario = usuarios.idusuario INNER JOIN proveedores ON compra.idproveedor = proveedores.idproveedor");
            $stmt->execute();
            return $stmt->fetchAll();
            $stmt = null;
        }
    }

    static public function mostrarDetalleCompras($item, $valor){
        if($item != ''){
            $stmt = Conexion::conectar()->prepare("SELECT compra.idcompra, detallecompra.idarticulo, detallecompra.cantidad, articulos.descripcion AS productos FROM compra INNER JOIN detallecompra ON compra.idcompra = detallecompra.idcompra INNER JOIN articulos ON detallecompra.idarticulo = articulos.idarticulo WHERE compra.$item = :$item");
            $stmt->bindParam(":".$item, $valor, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();
            $stmt = null;
        }else {
            $stmt = Conexion::conectar()->prepare("SELECT compra.idcompra, detallecompra.idarticulo, detallecompra.cantidad, articulos.descripcion AS productos FROM compra INNER JOIN detallecompra ON compra.idcompra = detallecompra.idcompra INNER JOIN articulos ON detallecompra.idarticulo = articulos.idarticulo");
            $stmt->execute();
            return $stmt->fetchAll();
            $stmt = null;
        }
    }
}