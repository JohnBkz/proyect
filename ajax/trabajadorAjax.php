<?php

require_once "../controllers/trabajadorController.php";
require_once "../models/trabajadorModel.php";

class AjaxTrabajadores
{
    // VALIDAR NO REPETIR EMPRESA
    public $validarTrabajador;
    public $empresaT;

    public function ajaxValidarTrabajador()
    {
        $tabla = "trabajadoresempresa";
        $item = "dnitrabajador";
        $valor = $this->validarTrabajador;
        $empresaTra = "rucempresa";
        $empresaT = $this->empresaT;
        $respuesta = modeloTrabajador::mostrarTrabajadorEmp($tabla, $item, $valor, $empresaTra, $empresaT);
        echo json_encode($respuesta);
    }

    public $rucempresa;
    public function ajaxListarTrabajador()
    {
        $tabla = "trabajadoresempresa";

        $valor = $this->rucempresa;
        $respuesta = modeloTrabajador::listarTrabajadorModel($tabla, $valor);
        echo json_encode($respuesta);
    }

    // EDITAR TRABAJADOR
    public $idtrabajador;
    public function ajaxEditarTrabajador()
    {
        $item = "idtrabajador";
        $valor = $this->idtrabajador;
        $respuesta = trabajadorController::mostrarTrabajador($item, $valor);
        echo json_encode($respuesta);
    }
}

// AGREGAR TRABAJADOR
if (isset($_POST["empresaTra"])) {
    if (true) {
        $tabla = "trabajadoresempresa";
        $datos = array(
            "empresa" => $_POST["empresaTra"],
            "dniTrabajador" => $_POST["dniTra"],
            "nombreTra" => $_POST["nomTra"],
            "apellidoTra" => $_POST["apeTra"]
        );

        $respuesta = modeloTrabajador::crearTrabajadorModel($datos);
        echo json_encode($respuesta);
    }
}

// DESABILITAR TRABAJADOR
if (isset($_POST["trabajador"])) {
    // error_log('UsuarioController::delete()-> ' . $_GET['idusuario']);
    $datos = $_POST["trabajador"];
    $empresa = $_POST["empresa"];
    $respuesta = modeloTrabajador::deleteTrabajadorModel($datos);
    // error_log('UsuarioController::delete()-> SUCCESS');
    echo json_encode($respuesta);
}

// VALIDAR NO REPETIR TRABAJADOR EN EMPRESA
if (isset($_POST["validarTrabajador"])) {

    $valTrabajador = new AjaxTrabajadores();
    $valTrabajador->validarTrabajador = $_POST["validarTrabajador"];
    $valTrabajador->empresaT = $_POST["empresaT"];
    $valTrabajador->ajaxValidarTrabajador();
}

// EDITAR USUARIO
if (isset($_POST["idtrabajador"])) {
    $editar = new AjaxTrabajadores();
    $editar->idtrabajador = $_POST["idtrabajador"];
    $editar->ajaxEditarTrabajador();
}

// Listar todos USUARIO POR RUC
if (isset($_POST["rucempresa"])) {
    $listar = new AjaxTrabajadores();
    $listar->rucempresa = $_POST["rucempresa"];
    $listar->ajaxListarTrabajador();
}