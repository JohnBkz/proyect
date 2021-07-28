<?php

require_once "../controllers/articuloController.php";
require_once "../models/articuloModel.php";

class TablaProductosVentas{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

	public function mostrarTablaProductosVentas(){

		$item = null;
    	$valor = null;
    

  		$productos = ControladorArticulos::ctrMostrarArticulo($item, $valor);
		//  $articulos = ControladorArticulos::ctrMostrar($item, $valor);
		if(count($productos)>0){
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($productos); $i++){

		  	/*=============================================
 	 		TRAEMOS LA IMAGEN
  			=============================================*/ 

		  	//$portada = "<img src='".$productos[$i]["portada"]."' width='40px'>";

		  	/*=============================================
 	 		cantidad
  			=============================================*/ 

  			if($productos[$i]["cantidad"] <= 10){

  				$cantidad = "<button class='btn btn-danger'>".$productos[$i]["cantidad"]."</button>";

  			}else if($productos[$i]["cantidad"] > 11 && $productos[$i]["cantidad"] <= 15){

  				$cantidad = "<button class='btn btn-warning'>".$productos[$i]["cantidad"]."</button>";

  			}else{

  				$cantidad = "<button class='btn btn-success'>".$productos[$i]["cantidad"]."</button>";

  			}

		  	/*=============================================
 	 		TRAEMOS LAS ACCIONES
  			=============================================*/ 

		  	$botones =  "<div class='btn-group'><button class='btn btn-primary agregarProducto recuperarBoton' idProducto='".$productos[$i]["idarticulo"]."'>Agregar</button></div>"; 

			  $datosJson .='[
				"S/'.$productos[$i]["precioventa"].'",
				"'.$productos[$i]["descripcion"].'",
				"'.$botones.'"
			  ],';

		  }

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
		echo $datosJson;
	}else{
		echo '{"data": []}';
	}

	}


}

/*=============================================
ACTIVAR TABLA DE PRODUCTOS
=============================================*/ 
$activarProductosVentas = new TablaProductosVentas();
$activarProductosVentas -> mostrarTablaProductosVentas();

