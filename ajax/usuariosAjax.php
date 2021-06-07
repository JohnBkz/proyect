<?php
require_once "../controllers/usuarioController.php";
require_once "../models/usuarioModel.php";

class AjaxUsuarios {
    // EDITAR CLIENTES
    public $idusuario;
    public function ajaxEditarUsuario() {
        $item = "idusuario";
        $valor = $this->idusuario;
        $respuesta = UsuarioController::MostrarUsuarios($item, $valor);
        echo json_encode($respuesta);
    }

    // NO REPETIR USUARIO
    public $validarUsuario;

    public function ajaxValidarUsuario() {
        $item = "user";
        $valor = $this->validarUsuario;
        $respuesta = UsuarioController::MostrarUsuarios($item, $valor);
        echo json_encode($respuesta);
    }

    // NO REPETIR DNI
    public $validarDNI;

    public function ajaxValidarDNI() {
        $item = "idusuario";
        $valor = $this->validarDNI;
        $respuesta = UsuarioController::MostrarUsuarios($item, $valor);
        echo json_encode($respuesta);
    }

    // ACTIVAR USUARIO
    public $activarEstado;
	public $activarId;

	public function ajaxActivarUsuario(){

        $tabla = "usuarios";
		$item1 = "estado";
		$valor1 = $this->activarEstado;
		$item2 = "idusuario";
		$valor2 = $this->activarId;
		$respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla,$item1, $valor1, $item2, $valor2);
        // json_encode($respuesta);
	}
}

// EDITAR USUARIO
if (isset($_POST["idusuario"])) {
    #error_log('UsuarioAjax::->' . $_POST["idusuario"]);
    $editar = new AjaxUsuarios();
    $editar->idusuario = $_POST["idusuario"];
    $editar->ajaxEditarUsuario();
}

// NO REPEITR USUARIO
if (isset($_POST["validarUsuario"])) {
    $valUsuario = new AjaxUsuarios();
    $valUsuario->validarUsuario = $_POST["validarUsuario"];
    $valUsuario->ajaxValidarUsuario();
}

// NO REPEITR DNI
if (isset($_POST["validarDNI"])) {
    $valDNI = new AjaxUsuarios();
    $valDNI->validarDNI = $_POST["validarDNI"];
    $valDNI->ajaxValidarDNI();
}

// ACTIVAR USER
if(isset($_POST["activarEstado"])){
    // error_log('UsuarioAjax::->' . $_POST["activarEstado"]);
	$activarUsuario = new AjaxUsuarios();
	$activarUsuario -> activarEstado = $_POST["activarEstado"];
	$activarUsuario -> activarId = $_POST["activarId"];
	$activarUsuario -> ajaxActivarUsuario();

}