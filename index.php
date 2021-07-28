<?php
error_reporting(E_ALL); // Error / Exception engine, always use E_ALL
ini_set('ignore_repeated_errors', TRUE); // always use TRUE
ini_set('display_errors', FALSE); // Error / Exception display, use FALSE only in production
ini_set('log_errors', TRUE); // Error / Exception file loggin engine
ini_set("error_log", "C:/xampp/htdocs/Grifos/php-error.log");
#error_log("Start aplication web!");
require_once "controllers/plantillaController.php";
require_once "controllers/usuarioController.php";
require_once "controllers/clienteController.php";
require_once "controllers/articuloController.php";
require_once "controllers/proveedorController.php";
require_once "controllers/ventasController.php";
require_once "controllers/compraController.php";
require_once "controllers/pedidoController.php";
require_once "controllers/ordenPedidoController.php";
require_once "controllers/ventas.controlador.php";
require_once "controllers/productos.controlador.php";
require_once "controllers/clientes.controlador.php";
require_once "controllers/empresaController.php";
require_once "controllers/trabajadorController.php";
require_once "controllers/autoController.php";


require_once "models/usuarioModel.php";
require_once "models/clienteModel.php";
require_once "models/articuloModel.php";
require_once "models/proveedorModel.php";
require_once "models/ventasModel.php";
require_once "models/compraModel.php";
require_once "models/pedidoModel.php";
require_once "models/ventas.modelo.php";
require_once "models/productos.modelo.php";
require_once "models/clientes.modelo.php";
require_once "models/ordenPedidoModel.php";
require_once "models/empresaModel.php";
require_once "models/trabajadorModel.php";
require_once "models/autoModel.php";

$plantilla = new ControladorPlantilla();
$plantilla->ctrPlantilla();