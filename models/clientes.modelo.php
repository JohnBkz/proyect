<?php

require_once "conexion.php";
$dni = 11111111;
class ModeloCliente
{

	/*=============================================
	CREAR CLIENTE
	=============================================*/

	static public function mdlIngresarCliente($tabla, $datos)
	{

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE ndocumento = :ndocumento");
		$stmt->bindParam(":ndocumento", $datos["ndocumento"], PDO::PARAM_STR);

		if ($stmt->execute()) {
			$count = $stmt->rowCount();
			if ($count > 0) {
				$stmtt = Conexion::conectar()->prepare("SELECT idcliente  AS idcli FROM clientes WHERE ndocumento = :ndocumento");
					$stmtt->bindParam(":ndocumento", $datos["ndocumento"], PDO::PARAM_STR);
					if ($stmtt->execute()) {
						  $codcli = $stmtt->fetch(PDO::FETCH_ASSOC)['idcli'];
						  return  $codcli;
					  }
			} else {

				$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla( documento, ndocumento, razonsocial, direccion,telefono,email) VALUES (:documento, :ndocumento, :razonsocial, :direccion,:telefono,:email)");

				$stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_STR);
				$stmt->bindParam(":ndocumento", $datos["ndocumento"], PDO::PARAM_STR);
				$stmt->bindParam(":razonsocial", $datos["razonsocial"], PDO::PARAM_STR);
				$stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
				$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
				$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);


				if ($stmt->execute()) {
					$stmtt = Conexion::conectar()->prepare("SELECT idcliente  AS idcli FROM clientes WHERE ndocumento = :ndocumento");
					$stmtt->bindParam(":ndocumento", $datos["ndocumento"], PDO::PARAM_STR);
					if ($stmtt->execute()) {
						  $codcli = $stmtt->fetch(PDO::FETCH_ASSOC)['idcli'];
						  return  $codcli;
					  }

				} else {
					return "error";
				}

			

			}
		} else {
             
			return "error";
		}


		$stmt->close();
		$stmt = null;
	}
	/*=============================================
	REPETIDOS CLIENTES
	=============================================*/


/*=============================================
	MOSTRAR CLIENTES
	=============================================*/

	static public function mdlMostrarCliente($tabla, $item, $valor)
	{
		
		if ($item != null) {

			
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ");

			$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetch();
		} else {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ");

		
			$stmt->execute();

			return $stmt->fetchAll();
		}

		$stmt->close();

		$stmt = null;
	}

	/*=============================================
	MOSTRAR CLIENTES
	=============================================*/

	static public function mdlMostrarClientes($tabla, $item, $valor)
	{
		
		if ($item != null) {

			
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY idcliente DESC ");

			$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetch();
		} else {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla  ORDER BY idcliente DESC");

		
			$stmt->execute();

			return $stmt->fetchAll();
		}

		$stmt->close();

		$stmt = null;
	}

	
	static public function mdlMostrarClientesuser($tabla, $item, $valor)
	{
		
		if ($item != null) {

			
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND tipocliente ='usuario'");

			$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetch();
		} else {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE tipocliente ='usuario'");

		
			$stmt->execute();

			return $stmt->fetchAll();
		}

		$stmt->close();

		$stmt = null;
	}
	/*=============================================
	MOSTRAR CLIENTES
	=============================================*/

	static public function mdlMostrarClientesandroid($tabla, $item, $valor)
	{
		
		if ($item != null) {

			
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND tipocliente ='usuario'");

			$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetch();
		} else {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE tipocliente ='usuario'");

		
			$stmt->execute();

			return $stmt->fetchAll();
		}

		$stmt->close();

		$stmt = null;
	}
	/*=============================================
	EDITAR CLIENTE
	=============================================*/

	static public function mdlEditarCliente($tabla, $datos)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, documento = :documento, email = :email, telefono = :telefono, direccion = :direccion, fecha_nacimiento = :fecha_nacimiento WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_INT);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_nacimiento", $datos["fecha_nacimiento"], PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();
		$stmt = null;
	}

	/*=============================================
	ELIMINAR CLIENTE
	=============================================*/

	static public function mdlEliminarCliente($tabla, $datos)
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
	ACTUALIZAR CLIENTE
	=============================================*/

	static public function mdlActualizarCliente($tabla, $item1, $valor1, $valor)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE id = :id");

		$stmt->bindParam(":" . $item1, $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":id", $valor, PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();

		$stmt = null;
	}
}
