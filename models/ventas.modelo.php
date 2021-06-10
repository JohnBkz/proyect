<?php

require_once "conexion.php";

class ModeloVentas
{

	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function mdlMostrarVentas($tabla, $item, $valor)
	{

		if ($item != null) {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY codigo ASC");

			$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetch();
		} else {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY codigo ASC");

			$stmt->execute();

			return $stmt->fetchAll();
		}

		$stmt->close();

		$stmt = null;
	}

	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function mdlMostrarVentasfac($tabla, $item, $valor)
	{

		if ($item != null) {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY codigofac ASC");

			$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetch();
		} else {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY codigofac ASC");

			$stmt->execute();

			return $stmt->fetchAll();
		}

		$stmt->close();

		$stmt = null;
	}
	static public function mdlMostrarTotalVentas($tabla)
	{

		$stmt = Conexion::conectar()->prepare("SELECT SUM(total) as total FROM $tabla");

		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();

		$stmt = null;
	}

	/*=============================================
	REGISTRO DE VENTA
	=============================================*/

	static public function mdlIngresarVenta($tabla, $datos, $tipocomp)
	{

		try {

			$stmt = Conexion::conectar()->query("SELECT MAX( CONVERT( SUBSTRING_INDEX(codecomprobante, '$tipocomp', -1),UNSIGNED INTEGER) ) AS maxi FROM ventas WHERE comprobante = '$tipocomp'");
			if ($stmt->execute()) {
				$maxIdVenta = $stmt->fetch(PDO::FETCH_ASSOC)['maxi'];
				if ($maxIdVenta != null) {
					$maxIdVenta = $maxIdVenta + 1;
				} else {
					$maxIdVenta = 1;
				}			
			do {		
			$cod = $tipocomp.$maxIdVenta;
			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(idusuario,idcliente, comprobante, codecomprobante, productos, metpago, codetransaccion, subtotal, descuento,igv,total,estado) VALUES (:idusuario,:idcliente, :comprobante, '$cod', :productos, :metpago, :codetransaccion, :subtotal, :descuento,:igv,:total,:estado)");
			$stmt->bindParam(":idusuario", $datos["idusuario"], PDO::PARAM_INT);
			$stmt->bindParam(":idcliente", $datos["idcliente"], PDO::PARAM_INT);
			$stmt->bindParam(":comprobante", $datos["comprobante"], PDO::PARAM_STR);
			$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
			$stmt->bindParam(":metpago", $datos["metpago"], PDO::PARAM_STR);
			$stmt->bindParam(":codetransaccion", $datos["codetransaccion"], PDO::PARAM_STR);
			$stmt->bindParam(":subtotal", $datos["subtotal"], PDO::PARAM_STR);
			$stmt->bindParam(":descuento", $datos["descuento"], PDO::PARAM_STR);
			$stmt->bindParam(":igv", $datos["igv"], PDO::PARAM_STR);
			$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
			$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);

	
			if ($stmt->execute()) {
				$msj=  "ok";
				break;
			} else  {			
                $pala=$stmt->errorInfo()[2];
				// $esta = strpos($pala, 'entry');

				 if (strpos($pala, 'Duplicate') !== false) {
					$msj="error";
					$maxIdVenta = $maxIdVenta + 1;
				}else{
					$msj="errorcon";
					break;
				}	
			}
		} while ($msj=="error");
	}
		return  $msj;

			$stmt->close();
			$stmt = null;
		} catch (PDOException $e) {
			return 'errorconex';
		}
	}

	/*=============================================
	EDITAR VENTA
	=============================================*/

	static public function mdlEditarVenta($tabla, $datos)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET  id_cliente = :id_cliente, id_vendedor = :id_vendedor, productos = :productos, impuesto = :impuesto, neto = :neto, total= :total, metodo_pago = :metodo_pago WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":id_vendedor", $datos["id_vendedor"], PDO::PARAM_INT);
		$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		$stmt->bindParam(":impuesto", $datos["impuesto"], PDO::PARAM_STR);
		$stmt->bindParam(":neto", $datos["neto"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		$stmt->bindParam(":metodo_pago", $datos["metodo_pago"], PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();
		$stmt = null;
	}

	/*=============================================
	ELIMINAR VENTA
	=============================================*/

	static public function mdlEliminarVenta($tabla, $datos)
	{

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt->bindParam(":id", $datos, PDO::PARAM_INT);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();

		$stmt = null;
	}

	/*=============================================
	RANGO FECHAS
	=============================================*/

	static public function mdlRangoFechasVentas($tabla, $fechaInicial, $fechaFinal)
	{

		if ($fechaInicial == null) {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY FECHA DESC");

			$stmt->execute();

			return $stmt->fetchAll();
		} else if ($fechaInicial == $fechaFinal) {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha like '%$fechaFinal%'");

			$stmt->bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetchAll();
		} else {

			$fechaActual = new DateTime();
			$fechaActual->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

			if ($fechaFinalMasUno == $fechaActualMasUno) {

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");
			} else {


				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal'");
			}

			$stmt->execute();

			return $stmt->fetchAll();
		}
	}

	/*=============================================
	SUMAR EL TOTAL DE VENTAS
	=============================================*/

	static public function mdlSumaTotalVentas($tabla)
	{

		$stmt = Conexion::conectar()->prepare("SELECT SUM(total) as total FROM $tabla");

		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();

		$stmt = null;
	}
}
