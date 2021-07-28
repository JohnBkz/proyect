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

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

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
			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(idusuario,idcliente, comprobante, codecomprobante, productos, metpago, codetransaccion,PagoVale,PagoEfectivo,PagoTarjeta, subtotal, descuento,igv,total,estado,placa,isla,lado) VALUES (:idusuario,:idcliente, :comprobante, '$cod', :productos, :metpago, :codetransaccion,:PagoVale,:PagoEfectivo,:PagoTarjeta, :subtotal, :descuento,:igv,:total,:estado,:placa,:isla,:lado)");
			$stmt->bindParam(":idusuario", $datos["idusuario"], PDO::PARAM_INT);
			$stmt->bindParam(":idcliente", $datos["idcliente"], PDO::PARAM_INT);
			$stmt->bindParam(":comprobante", $datos["comprobante"], PDO::PARAM_STR);
			$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
			$stmt->bindParam(":metpago", $datos["metpago"], PDO::PARAM_STR);
			$stmt->bindParam(":codetransaccion", $datos["codetransaccion"], PDO::PARAM_STR);
			$stmt->bindParam(":PagoVale", $datos["PagoVale"], PDO::PARAM_STR);
			$stmt->bindParam(":PagoEfectivo", $datos["PagoEfectivo"], PDO::PARAM_STR);
			$stmt->bindParam(":PagoTarjeta", $datos["PagoTarjeta"], PDO::PARAM_STR);
			$stmt->bindParam(":subtotal", $datos["subtotal"], PDO::PARAM_STR);
			$stmt->bindParam(":descuento", $datos["descuento"], PDO::PARAM_STR);
			$stmt->bindParam(":igv", $datos["igv"], PDO::PARAM_STR);
			$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
			$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
			$stmt->bindParam(":placa", $datos["placa"], PDO::PARAM_STR);
			$stmt->bindParam(":isla", $datos["isla"], PDO::PARAM_STR);
			$stmt->bindParam(":lado", $datos["lado"], PDO::PARAM_STR);

	
			if ($stmt->execute()) {
				$msj=  $cod;
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

	/*=============================================
	REGISTRO DE VENTA
	=============================================*/

	static public function mdlIngresarVale($datos)
	{

			$stmt = Conexion::conectar()->prepare("INSERT INTO Vales(idventa,rucempresa, idtrabajador, idvehiculo, idproducto, cantidad, total) VALUES (:idventa,:rucempresa,:idtrabajador,:idvehiculo,:idproducto,:cantidad,:total)");
			
			$stmt->bindParam(":idventa", $datos["idventa"], PDO::PARAM_INT);
			$stmt->bindParam(":rucempresa", $datos["rucempresa"], PDO::PARAM_STR);
			$stmt->bindParam(":idtrabajador", $datos["idtrabajador"], PDO::PARAM_INT);
			$stmt->bindParam(":idvehiculo", $datos["idvehiculo"], PDO::PARAM_INT);
			$stmt->bindParam(":idproducto", $datos["idproducto"], PDO::PARAM_INT);
			$stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_INT);
			$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
			if ($stmt->execute()) {
				$msj=  "Ok";
			
			} else  {			
				$msj="error";
			}

	     return  $msj;
			$stmt->close();
			$stmt = null;
	
	}
			/*=============================================
	AUMENTAR Y DISMUNUIR STOCK
	=============================================*/

	static public function mdlActualizaridventaDetalleTemp($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE detalle_temp SET idventa = :idventa WHERE idusuario=:idusuario AND idventa IS NULL");
		
		$stmt->bindParam(":idusuario", $datos["idusuario"], PDO::PARAM_STR);
		$stmt -> bindParam(":idventa", $datos["idventa"], PDO::PARAM_STR);


		if($stmt -> execute()){

			return "ok";
		
	}else{
			return "error";	
		}
		$stmt -> close();

		$stmt = null;
	}


			/*=============================================
	AUMENTAR Y DISMUNUIR STOCK
	=============================================*/

	static public function mdlActualizarStock($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE detalle_temp SET cantidad = :cantidad WHERE idarticulo = :idarticulo AND idusuario=:idusuario AND idventa IS NULL");
		
		$stmt->bindParam(":idusuario", $datos["idusuario"], PDO::PARAM_STR);
		$stmt -> bindParam(":idarticulo", $datos["idarticulo"], PDO::PARAM_STR);
		$stmt -> bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
	}else{
			return "error";	
		}
		$stmt -> close();

		$stmt = null;
	}


	/*=============================================
	DISMINUIR STOCK
	=============================================*/

	static public function mdlIngresarDetalleTemp($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO detalle_temp(idusuario, idarticulo, cantidad) VALUES (:idusuario,:idarticulo,:cantidad)");

		$stmt->bindParam(":idusuario", $datos["idusuario"], PDO::PARAM_STR);
		$stmt->bindParam(":idarticulo", $datos["idarticulo"], PDO::PARAM_STR);
		$stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_STR);
	
		if($stmt -> execute()){

			return "ok";	
	    }else{
		
			
			return $stmt->errorInfo();	
		}
		$stmt -> close();

		$stmt = null;
	}

	/*=============================================
	AUMENTAR STOCK AL ELIMINAR
	=============================================*/

	static public function mdlAumenEliminarStock($datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM detalle_temp WHERE idarticulo = :idarticulo AND idusuario=:idusuario AND idventa IS NULL");

		$stmt->bindParam(":idusuario", $datos["idusuario"], PDO::PARAM_STR);
		$stmt -> bindParam(":idarticulo", $datos["idarticulo"], PDO::PARAM_STR);
		if($stmt -> execute()){

			return "ok";
		
	}else{
			return "error";	
		}
		$stmt -> close();

		$stmt = null;
	}

}
