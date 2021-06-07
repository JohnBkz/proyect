<?php
require_once "../controllers/articuloController.php";
require_once "../models/articuloModel.php";

class AjaxArticulos {
	public $desactivarId;
	public $desactivarArticulo;

	public function ajaxDesactivarArticulo() {
		$tabla = "articulos";
		$item1 = "estado";
		$valor1 = $this->desactivarArticulo;
		$item2 = "idarticulo";
		$valor2 = $this->desactivarId;
        $respuesta = ModeloArticulos::mdlActualizarArticulo($tabla, $item1, $valor1, $item2, $valor2);	
        json_encode($respuesta);
	}

	// CARGAR CATEGORIA
	public $idCategoria;
	public function ajaxCargarCategoria(){
		$item = "idtipo";
		$valor = $this->idCategoria;
		$respuesta = ControladorCategorias::ctrMostrarCategorias($item, $valor);
		echo json_encode($respuesta);
	}

	// EDITAR ARTICULOS
    public $idArticulo;
	public $traerArticulos;
	public $nombreArticulo;
    public function ajaxEditarArticulo() {

	
			$item = "idarticulo";
			$valor = $this->idArticulo;
			$respuesta = ControladorArticulos::ctrMostrarArticulo($item, $valor);
			echo json_encode($respuesta);
		
    }
}

// ACTIVAR ARTICULOS
if(isset($_POST["activarEstado"])) {
	$activarArticulo = new AjaxArticulos();
	$activarArticulo -> activarEstado = $_POST["activarEstado"];
	$activarArticulo -> activarId = $_POST["activarId"];
	$activarArticulo -> ajaxDesactivarArticulo();
}

// CARGAR CATEGORIA
if(isset($_POST["categoria"])) {
	$codigoProducto = new AjaxArticulos();
	$codigoProducto -> idCategoria = $_POST["categoria"];
	$codigoProducto -> ajaxCargarCategoria();
}

// EDITAR ARTICULOS
if (isset($_POST["idArticulo"])) {
    $editar = new AjaxArticulos();
    $editar->idArticulo = $_POST["idArticulo"];
    $editar->ajaxEditarArticulo();
}

// TRAER ARTICULOS
if (isset($_POST["traerArticulos"])) {
    $traerArticulos = new AjaxArticulos();
    $traerArticulos->traerArticulos = $_POST["traerArticulos"];
    $traerArticulos->ajaxEditarArticulo();
}

// TRAER ARTICULOS
if (isset($_POST["nombreArticulo"])) {
    $traerArticulos = new AjaxArticulos();
    $traerArticulos->nombreArticulo = $_POST["nombreArticulo"];
    $traerArticulos->ajaxEditarArticulo();
}