<?php

require_once "conexion.php";

class detCompraModel {

    static public function mostrarDetalleCompraModel($item, $valor) {
        if ($item != null) {
        $stmt = Conexion::conectar()->prepare("SELECT compra.idcompra, compra.idusuario, usuarios.nombres AS usuario, compra.idproveedor, proveedores.razonsocial AS proveedor,compra.fecha, compra.observacion, detallecompra.idarticulo, detallecompra.cantidad, compra.total, articulos.descripcion AS productos FROM compra INNER JOIN usuarios ON compra.idusuario = usuarios.idusuario INNER JOIN proveedores ON compra.idproveedor = proveedores.idproveedor INNER JOIN detallecompra ON compra.idcompra = detallecompra.idcompra INNER JOIN articulos ON detallecompra.idarticulo = articulos.idarticulo WHERE compra.$item = :$item");
        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll();
        }
        $stmt = null;
    }

}
