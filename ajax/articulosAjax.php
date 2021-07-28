<?php
require_once "../controllers/articuloController.php";
require_once "../models/articuloModel.php";

class AjaxArticulos {

	// EDITAR ARTICULOS
    public $idArticulo;
    public function ajaxEditarArticulo() {

		$item = "idarticulo";
			$valor = $this->idArticulo;
			$respuesta = ControladorArticulos::ctrMostrarArticulo($item, $valor);
			echo json_encode($respuesta);		
    }
}

// EDITAR ARTICULOS
if (isset($_POST["idArticulo"])) {
    $editar = new AjaxArticulos();
    $editar->idArticulo = $_POST["idArticulo"];
    $editar->ajaxEditarArticulo();
}