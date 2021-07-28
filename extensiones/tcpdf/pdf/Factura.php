<?php

require_once "../../../controllers/ventas.controlador.php";
require_once "../../../models/ventas.modelo.php";

require_once "../../../controllers/clienteController.php";
require_once "../../../models/clienteModel.php";

require_once "../../../controllers/usuarioController.php";
require_once "../../../models/usuarioModel.php";

require_once "../../../controllers/articuloController.php";
require_once "../../../models/articuloModel.php";

require_once "../../../controllers/productos.controlador.php";
require_once "../../../models/productos.modelo.php";

class imprimirBoleta{

public $codigo;

public function traerImpresionBoleta(){

//TRAEMOS LA INFORMACIÓN DE LA VENTA

$itemVenta = "codecomprobante";
$valorVenta = "$this->codigo";

$respuestaVenta = ControladorVentas::ctrMostrarVentas($itemVenta, $valorVenta);

 
for ($i=0; $i <= strlen($valorVenta); $i++) { 
   if (is_numeric($valorVenta[$i]))
  {
	 $valor = $i;
	 break;
  }
}

$tipComprob= strtoupper(substr($valorVenta,0,$valor));

$nroDocum = substr($valorVenta,$valor);

if($tipComprob=="FACTURA"){
	$doc= "RUC";
	}else{
		$doc= "DNI";
	}

if ($nroDocum < 10) {
   $nroDocum = "000" . $nroDocum;
 } else if ($nroDocum < 100) {
   $nroDocum = "00" . $nroDocum;
 } else if ($nroDocum < 1000) {
   $nroDocum = "0" . $nroDocum;
  } else {
   $nroDocum = $nroDocum;
 }
 
 $fecha = substr($respuestaVenta["fechaemision"],0,-8);
 $productos = json_decode($respuestaVenta["productos"], true);
 $descuento = number_format($respuestaVenta["descuento"],2);
 $neto = number_format($respuestaVenta["subtotal"],2);
 $impuesto = number_format($respuestaVenta["igv"],2);
 $total = number_format($respuestaVenta["total"],2);

 $hora = substr($respuestaVenta["fechaemision"],-8);
//TRAEMOS LA INFORMACIÓN DEL CLIENTE

$itemCliente = "idcliente";
$valorCliente = $respuestaVenta["idcliente"];

$respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

// //TRAEMOS LA INFORMACIÓN DEL VENDEDOR

$itemVendedor = "idusuario";
$valorVendedor = $respuestaVenta["idusuario"];

$respuestaVendedor = UsuarioController::MostrarUsuarios($itemVendedor, $valorVendedor);

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->startPageGroup();

$pdf->AddPage();

// ---------------------------------------------------------

$bloque1 = <<<EOF

	<table>
		
		<tr>
			
			<td style="width:150px"><img src="images/logo-negro-bloque.png"></td>

			<td style="background-color:white; width:140px">
				
				<div style="font-size:8.5px; text-align:right; line-height:15px;">
					
				

					<br>
					Dirección: Av. Sanchez cerro 834

				</div>

			</td>

			<td style="background-color:white; width:100px">

				<div style="font-size:8.5px; text-align:right; line-height:15px;">
					
					<br>
					Teléfono: 936 522 264
					
					<br>
					ventas@ventas.com

				</div>
				
			</td>

			<td style="background-color:white; width:150px; text-align:center; color:red"><br><br>R.U.C N° 7777777<br>$tipComprob ELECTRONICA<br>001 Nº $nroDocum</td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------

$bloque2 = <<<EOF

	<table>
		
		<tr>
			
			<td style="width:540px"><img src="images/back.jpg"></td>
		
		</tr>

	</table>

	<table style="font-size:10px; padding:5px 10px;">
	
		<tr>
		
			<td style="border: 1px solid #666; background-color:white; width:390px">

				CLIENTE: $respuestaCliente[razonsocial]

			</td>

			<td style="border: 1px solid #666; background-color:white; width:150px; text-align:right">
			
				FECHA: $fecha

			</td>

		</tr>
	
		<tr>
		
		<td style="border: 1px solid #666; background-color:white; width:540px">$doc:  $respuestaCliente[ndocumento]</td>

	</tr>
	<tr>
		
	<td style="border: 1px solid #666; background-color:white; width:540px">DIRECCION:  $respuestaCliente[direccion]</td>

</tr>
		<tr>
		
			<td style="border: 1px solid #666; background-color:white; width:540px">EMITIDO: $respuestaVendedor[nombres]</td>

		</tr>

		<tr>
		
		<td style="border-bottom: 1px solid #666; background-color:white; width:540px"></td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

// ---------------------------------------------------------

$bloque3 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>
		
		<td style="border: 1px solid #666; background-color:white; width:260px; text-align:center">Producto</td>
		<td style="border: 1px solid #666; background-color:white; width:80px; text-align:center">Cantidad</td>
		<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Valor Unit.</td>
		<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Sub Total</td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

// ---------------------------------------------------------

foreach ($productos as $key => $item) {

	$itemProducto = "descripcion";
	$valorProducto = $item["descripcion"];
	$orden = null;
	
	$respuestaProducto = ControladorProductos::ctrMostrarProductos($itemProducto, $valorProducto, $orden);
	
	$valorUnitario = number_format($respuestaProducto[0]["precioventa"], 2);
	
	$precioTotal = number_format($item["total"], 2);

$bloque4 = <<<EOF

	<table style="font-size:10px; padding:5px 5px;">

		<tr>
			
			<td style="border: 1px solid #666; color:#333; background-color:white; width:260px; text-align:center">
				$item[descripcion]
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
				$item[cantidad]
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:right">S/
				$valorUnitario
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:right">S/
				$precioTotal
			</td>


		</tr>

	</table>


EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');

}

// ---------------------------------------------------------

$bloque5 = <<<EOF

	<table style="font-size:10px; padding:5px 5px;">

		<tr>

			<td style="color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border-bottom: 1px solid #666; background-color:white; width:100px; text-align:center"></td>

			<td style="border-bottom: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center"></td>

		</tr>
		
		<tr>
		
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666;  background-color:white; width:100px; text-align:center">
				Sub Total:
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:right">
				S/ $neto
			</td>

		</tr>
		<tr>
		
		<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

		<td style="border: 1px solid #666;  background-color:white; width:100px; text-align:center">
			Descuento:
		</td>

		<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:right">
			S/ $descuento
		</td>

	</tr>

		<tr>

			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
				I.G.V 18%:
			</td>
		
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:right">
			S/ $impuesto
			</td>

		</tr>

		<tr>
		
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
				Total:
			</td>
			
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:right">
			S/ $total
			</td>

		</tr>


	</table>

EOF;

$pdf->writeHTML($bloque5, false, false, false, false, '');



// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 

$pdf->Output('boleta.pdf');

}

}

$boleta = new imprimirBoleta();
$boleta -> codigo = $_GET["codigo"];
$boleta -> traerImpresionBoleta();

?>