<?php

// include 'conexion.php';

class ModeloOrdencompra
{
	static public function mostrarOrdenPedidoMdl($item, $valor)
	{

		$stmt = Conexion::conectar()->prepare("SELECT pedidos.*, proveedores.*, usuarios.*
		FROM pedidos, proveedores, usuarios 
		WHERE $item = $valor
		and pedidos.idusuario =  usuarios.idusuario
		AND pedidos.idproveedor = proveedores.idproveedor
		GROUP BY pedidos.idpedido");

		$stmt->execute();

		return $stmt->fetch();
		$stmt = null;
	}

	// MOSTRAR DETALLE PEDIDO
	static public function mostrarDetPedidoMdl($id, $valorId)
	{
		$stmt = Conexion::conectar()->prepare("SELECT detallepedido.*, articulos.*,
		detallepedido.cantidad AS cantidadPedido
		FROM detallepedido, articulos
		WHERE $id = $valorId
		AND detallepedido.idarticulo = articulos.idarticulo
		GROUP BY articulos.idarticulo");

		$stmt->execute();

		return $stmt->fetchAll();
	}
}
