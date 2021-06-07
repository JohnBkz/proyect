<?php

class ControladorCategorias {

    // MOSTRAR CATEGORIA
    static public function ctrMostrarCategorias($item, $valor) {
        $tabla = "tipoarticulo";
        $respuesta = ModeloCategorias::mdlMostrarCategorias($tabla, $item, $valor);
        return $respuesta;
    }
}

class ControladorArticulos {

    // CREAR ARTICULO
    static public function ctrCrearArticulo() {
        if (isset($_POST["idArticulo"])) {
            if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["idArticulo"])   &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["descripcion"])) {

                $tabla = "articulos";

                $datos = array(
                    "idarticulo" => $_POST["idArticulo"],
                    "categoria" => $_POST["categoria"],
                    "descripcion" => $_POST["descripcion"],
                    "unidad" => $_POST["unidad"],
                    "cantidad" => $_POST["cantidad"],
                    "pVenta" => $_POST["pVenta"]
                );

                $respuesta = ModeloArticulos::mdlCrearArticulo($tabla, $datos);

                if ($respuesta == "ok") {

                    echo '<script>

            		swal({
            			  type: "success",
            			  title: "El articulo ha sido guardado correctamente",
            			  showConfirmButton: true,
            			  confirmButtonText: "Cerrar"
            			  }).then(function(result){
            						if (result.value) {
            						window.location = "articulos";
            						}
            					})
            		</script>';
                }
            } else {

                echo '<script>

            		swal({
            			  type: "error",
            			  title: "¡El articulo no puede ir vacío o llevar caracteres especiales!",
            			  showConfirmButton: true,
            			  confirmButtonText: "Cerrar"
            			  }).then(function(result){
            				if (result.value) {

            				window.location = "articulos";

            				}
            			})

              	</script>';
            }
        }
    }

    // MOSTRAR ARTICULO
    static public function ctrMostrarArticulo($item, $valor) {
        $tabla = "articulos";
        $respuesta = ModeloArticulos::mdlMostrarAticulo($tabla, $item, $valor);
        return $respuesta;
    }

    
    // EDITAR ARTICULO 
    static public function ctrEditarticulo() {
        if (isset($_POST["EidArticulo"])) {
            if ($_POST["EidArticulo"] != "") {
                if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["descripcion"])) {
                    $tabla = "articulos";

                    $datos = array(
                        "idarticulo" => $_POST["EidArticulo"],
                        "categoria" => $_POST["categoria"],
                        "descripcion" => $_POST["descripcion"],
                        "unidad" => $_POST["Eunidad"],
                        "cantidad" => $_POST["cantidad"],
                        "pVenta" => $_POST["pVenta"]
                    );

                    $respuesta = ModeloArticulos::mdlEditarArticulo($tabla, $datos);
                    var_dump($respuesta);
                    if ($respuesta == "ok") {
                        echo '<script>
                            swal({
                                type: "success",
                                title: "¡El articulo ha sido editado correctamente!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                            }).then(function(result){
                                if(result.value){						
                                    window.location = "articulos";
                                }
                            });				
                        </script>';
                    }
                } else {
                    echo '<script>
                        swal({
                            type: "error",
                            title: "¡El nombre no puede ir vacío o llevar caracteres especiales!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if(result.value){						
                                window.location = "articulos";
                            }
                        });				
                    </script>';
                }
            } else {
                echo ("no hay id");
            }
        }
    }

    // ELIMINAR ARTICULO
    static public function ctrBorrarArticulos() {
        if (isset($_GET["idarticulo"])) {
            $tabla = "articulos";
            $datos = $_GET["idarticulo"];
            $std = $_GET["estadoArt"];

            if ($std == 0) {
                $respuesta = ModeloArticulos::mdlActualizarArticulo($tabla, $datos, 1);
                
                if ($respuesta  == "ok") {
                    echo '<script>
                        swal({
                            type: "success",
                            title: "El articulo ha sido borardo correctamente",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if(result.value){						
                                window.location = "articulos";
                            }
                        });				
                    </script>';
                }
            } else {
                $respuesta = ModeloArticulos::mdlActualizarArticulo($tabla, $datos, 0);
                if ($respuesta  == "ok") {
                    echo '<script>
                        swal({
                            type: "success",
                            title: "El articulo ha sido habilitado correctamente",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if(result.value){						
                                window.location = "articulos-desabilitados";
                            }
                        });				
                    </script>';
                }
            }
        }
    }
}