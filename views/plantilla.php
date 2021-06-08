<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Grifos System</title>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- <link rel="icon" href="views/img/plantilla/icono-negro.png"> -->

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="views/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="views/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="views/bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="views/dist/css/AdminLTE.css">
    <link rel="stylesheet" href="views/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="views/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="views/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" href="views/dist/css/styles.css">


    <script src="views/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="views/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="views/bower_components/fastclick/lib/fastclick.js"></script>
    <script src="views/dist/js/adminlte.min.js"></script>
    <script src="views/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="views/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="views/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
    <script src="views/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>

    <!-- SweetAlert 2 -->
    <script src="views/plugins/sweetalert2/sweetalert2.all.js"></script>
    <!-- By default SweetAlert2 doesn't support IE. To enable IE 11 support, include Promise polyfill:-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>

   <!-- <script src="views/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="views/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="views/bower_components/fastclick/lib/fastclick.js"></script>
    <script src="views/dist/js/adminlte.min.js"></script>
    <script src="views/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="views/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="views/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
    <script src="views/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>-->

    <!-- SweetAlert 2 -->
    <script src="views/plugins/sweetalert2/sweetalert2.all.js"></script>
    <!-- By default SweetAlert2 doesn't support IE. To enable IE 11 support, include Promise polyfill:-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>

    <!-- JQUERY NUMBER -->
   <script src="views/plugins/jqueryNumber/jquerynumber.min.js"></script> 

</head>

<!--=====================================
CUERPO DOCUMENTO
======================================-->

<body class="hold-transition skin-blue sidebar-collapse sidebar-mini login-page">

    <?php
    if (isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok") {

        echo '<div class="wrapper">';
        include "modules/cabezote.php";
        include "modules/menu.php";

        if (isset($_GET["ruta"])) {

            if (
                $_GET["ruta"] == "inicio" ||
                $_GET["ruta"] == "usuarios" ||
                $_GET["ruta"] == "ventas" ||
                $_GET["ruta"] == "crearventa" ||
                $_GET["ruta"] == "crear-venta" ||
                $_GET["ruta"] == "reportesventas" ||
                $_GET["ruta"] == "clientes" ||
                $_GET["ruta"] == "caja" ||
                $_GET["ruta"] == "articulos-desabilitados" ||
                $_GET["ruta"] == "articulos" ||
                $_GET["ruta"] == "proveedores" ||
                $_GET["ruta"] == "compras" ||
                $_GET["ruta"] == "crearcompra" ||
                $_GET["ruta"] == "reportescompras" ||
                $_GET["ruta"] == "detcompra" ||
                $_GET["ruta"] == "pedidos" ||
                $_GET["ruta"] == "crearpedido" ||
                $_GET["ruta"] == "reportespedidos" ||
                $_GET["ruta"] == "editarOrdenPedido" ||
                $_GET["ruta"] == "empresas" ||
                $_GET["ruta"] == "trabajadores" ||
                $_GET["ruta"] == "autos" ||
                $_GET["ruta"] == "salir"
            ) {

                include "modules/" . $_GET["ruta"] . ".php";
            } else {
                include "modules/404.php";
            }
        } else {
            include "modules/inicio.php";
        }

        include "modules/footer.php";

        echo '</div>';
    } else {
        include "modules/login.php";
    }

    ?>

    <script src="views/js/plantilla.js"></script>
    <script src="views/js/clientes.js"></script>
    <script src="views/js/usuarios.js"></script>
    <script src="views/js/showimg.js"></script>
    <script src="views/js/articulos.js"></script>
    <script src="views/js/proveedor.js"></script>
    <script src="views/js/ventas.js"></script>
    <script src="views/js/venta.js"></script>
    <script src="views/js/compras.js"></script>
    <script src="views/js/pedidos.js"></script>
    <script src="views/js/empresas.js"></script>
</body>

</html>