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

require_once "../../../models/numeroText.php";
require_once "../../../models/generarQr.php";
class imprimirticket{

public $codigo;

public function traerImpresionticket(){

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
$docCod="01";
$docAbr="F001";
}else{
$doc= "DNI";
$docCod="03";
$docAbr="B001";
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
 $neto = number_format($respuestaVenta["subtotal"],2);
 $impuesto = number_format($respuestaVenta["igv"],2);
 $total = number_format($respuestaVenta["total"],2);
 $totalefectivo = number_format($respuestaVenta["PagoEfectivo"],2);
 $totaltarjeta = number_format($respuestaVenta["PagoTarjeta"],2);

 $hora = substr($respuestaVenta["fechaemision"],-8);

 $placa = substr($respuestaVenta["placa"],-8);

  $texto="12312312|".$docCod."|".$docAbr."|".$nroDocum."|".$impuesto."|".$total."|".$fecha."|1||";

 $codQr = generarqr::generar($texto,$valorVenta);

//  for ($j=0; $j <= strlen($total); $j++) { 
// 	if ($total[$i]=='.' or $total[$i]==',')
//    {
//       $valor = $i;
// 	  break;
//    }
// }

$centimos = substr($total,-2);

 $totalLetras = ConvertNum::convertir(substr($respuestaVenta["total"],0,-3));

if($respuestaVenta["metpago"]=="Efectivo"){
	$linecode='	<tr>
	<td style="background-color:white;">	
		<div style="font-size:8px; text-align:center;">
			CANCELO EN EFECTIVO
		</div>
	</td>
	</tr>';

	$list_metodo='
	<tr>
	<td style="width:55%;background-color:white;text-align:center;">
	<div style="font-size:8px;">
     EFECTIVO
  </div>
	</td>
		<td style="width:17%;background-color:white;text-align:center;">
	<div style="font-size:8px;">
	:&nbsp;&nbsp;&nbsp;&nbsp; S/
	  </div>
	  
		</td>
		<td style="width:28%;background-color:white; text-align:right;">
		<div style="font-size:8px;">
		'.$total.'
	</div>
		</td>

	</tr>';
}else if ($respuestaVenta["metpago"]=="Tarjeta") {

$linecode='	<tr>
<td style="background-color:white;">	
	<div style="font-size:8px; text-align:center;">
		CANCELO CON TARJETA
	</div>
</td>
</tr>
	<tr>		
	<td style="background-color:white;">			
			<div style="font-size:8px; text-align:center;">
				TERM: 03423423 ID345334
			</div>
		</td>
	</tr>
	<tr>			
	<td style="background-color:white;">		
			<div style="font-size:8px; text-align:center;">
				AP: 06645645 REF: 6545654

			</div>

		</td>
	</tr>
	<tr>
	<td style="width:55%;background-color:white;text-align:center;">
	<div style="font-size:8px;">
	TARJETA ********45454
  </div>
	</td>
		<td style="width:17%;background-color:white;text-align:center;">
	<div style="font-size:8px;">
	:&nbsp;&nbsp;&nbsp;&nbsp; S/
	  </div>
		</td>
		<td style="width:28%;background-color:white; text-align:right;">
		<div style="font-size:8px;">'.$total.'</div>
		</td>
	</tr>';

	$list_metodo='
	<tr>
	<td style="width:55%;background-color:white;text-align:center;">
	<div style="font-size:8px;">
     TARJETA
  </div>
	</td>
		<td style="width:17%;background-color:white;text-align:center;">
	<div style="font-size:8px;">
	:&nbsp;&nbsp;&nbsp;&nbsp; S/
	  </div>
	  
		</td>
		<td style="width:28%;background-color:white; text-align:right;">
		<div style="font-size:8px;">
		'.$total.'
	</div>
	</td>

	</tr>';


}else if ($respuestaVenta["metpago"]=="Efectivo/Tarjeta") {

	$linecode='	<tr>
	<td style="background-color:white;">	
		<div style="font-size:8px; text-align:center;">
			CANCELO CON TARJETA
		</div>
	</td>
	</tr>
		<tr>		
		<td style="background-color:white;">			
				<div style="font-size:8px; text-align:center;">
					TERM: 03423423 ID345334
				</div>
			</td>
		</tr>
		<tr>			
		<td style="background-color:white;">		
				<div style="font-size:8px; text-align:center;">
					AP: 06645645 REF: 6545654
	
				</div>
	
			</td>
		</tr>
		<tr>
		<td style="width:55%;background-color:white;text-align:center;">
		<div style="font-size:8px;">
		TARJETA ********45454
	  </div>
		</td>
			<td style="width:17%;background-color:white;text-align:center;">
		<div style="font-size:8px;">
		:&nbsp;&nbsp;&nbsp;&nbsp; S/
		  </div>
			</td>
			<td style="width:28%;background-color:white; text-align:right;">
			<div style="font-size:8px;">'.$totaltarjeta.'</div>
			</td>
		</tr>';
	
		$list_metodo='
		<tr>
		<td style="width:55%;background-color:white;text-align:center;">
		<div style="font-size:8px;">
		 TARJETA
	  </div>
		</td>
			<td style="width:17%;background-color:white;text-align:center;">
		<div style="font-size:8px;">
		:&nbsp;&nbsp;&nbsp;&nbsp; S/
		  </div>
		  
			</td>
			<td style="width:28%;background-color:white; text-align:right;">
			<div style="font-size:8px;">
			'.$totaltarjeta.'
		</div>
		</td>
	
		</tr>
		<tr>
		<td style="width:55%;background-color:white;text-align:center;">
		<div style="font-size:8px;">
		 EFECTIVO
	  </div>
		</td>
			<td style="width:17%;background-color:white;text-align:center;">
		<div style="font-size:8px;">
		:&nbsp;&nbsp;&nbsp;&nbsp; S/
		  </div>
		  
			</td>
			<td style="width:28%;background-color:white; text-align:right;">
			<div style="font-size:8px;">
			'.$totalefectivo.'
		</div>
		</td>
	
		</tr>';
	
	
	};

//TRAEMOS LA INFORMACIÓN DEL CLIENTE

 $itemCliente = "idcliente";
 $valorCliente = $respuestaVenta["idcliente"];

 $respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

// //TRAEMOS LA INFORMACIÓN DEL VENDEDOR

 $itemVendedor = "idusuario";
 $valorVendedor = $respuestaVenta["idusuario"];

 $respuestaVendedor = UsuarioController::MostrarUsuarios($itemVendedor, $valorVendedor);

//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');


$medidas = array(90, 600); // Ajustar aqui segun los milimetros necesarios;
$pdf = new TCPDF('P', 'mm', $medidas, true, 'UTF-8', false); 

$pdf->startPageGroup();

$pdf->AddPage();

// ---------------------------------------------------------

$bloque1 = <<<EOF

	<table>
	<tr>
	<td style="background-color:white;">
		
		<div style="font-size:8px; text-align:center;">
			NOMBRE EMPRESA

		</div>

	</td>

</tr>
		<tr>
			
		<td style="background-color:white;">
				
				<div style="font-size:8px; text-align:center;">
					Dirección De Empresa: Av. Sanchez cerro 834 aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa

				</div>

			</td>



		</tr>

		<tr>
			
		<td style="background-color:white;">
				
				<div style="font-size:8px; text-align:center;">
					RUC 123423423

				</div>

			</td>



		</tr>

		<tr>
			
		<td style="background-color:white;">
				
				<div style="font-size:8px; text-align:center;">
					MI NOMBREEEEEE DE ESTACION

				</div>

			</td>



		</tr>

		<tr>
			
		<td style="background-color:white;">
				
				<div style="font-size:8px; text-align:center;">
					Dirección: DE ESTACIONNNNNNNNNNNNNNNNNNNNNNNNN

				</div>

			</td>



		</tr>

		<tr>
			
		<td style="background-color:white;">
				
				<div style="font-size:8px; text-align:center;">
					DEPARTAMENTO - CIUDAD

				</div>

			</td>



		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------

$bloque2 = <<<EOF

	<table>
	<tr>
			
	<td>
			
			<div style="font-size:8px;text-align:center;">
			------------------------------------------------------------------------

			</div>

		</td>

	</tr>
	<tr>
			
		<td style="background-color:white;">
				
				<div style="font-size:8px; text-align:center;">
				$tipComprob ELECTRONICA
				</div>

			</td>

		</tr>
		<tr>
			
		<td style="background-color:white;">			
		<div style="font-size:8px;text-align:center;">
		------------------------------------------------------------------------

		</div>

			</td>

		</tr>
	</table>

	<table >
	
		<tr>
		<td style="width:35%;background-color:white;text-align:left;">
		<div style="font-size:8px;">
		Maq.Regist.No
	  </div>
		</td>
			<td style="width:37%;background-color:white;text-align:left;">
		<div style="font-size:8px;">
			 : IMPRESORA
		  </div>
			</td>
			<td style="width:28%;background-color:white; text-align:right;">
			<div style="font-size:8px;">
			$fecha
		</div>
			

			</td>

		</tr>
		
		<tr>
		<td style="width:35%;background-color:white;text-align:left;">
		<div style="font-size:8px;">
		Doc No
	  </div>
		</td>
			<td style="width:39%;background-color:white;text-align:left;">
			<div style="font-size:8px;">
			: $docAbr-$nroDocum
		  </div>

			</td>

			<td style="width:26%;background-color:white; text-align:right;">
			<div style="font-size:8px;">
			$hora
		</div>
			

			</td>

		</tr>


		<tr>
		<td style="width:25%;background-color:white;text-align:left;">
		<div style="font-size:8px;">
		CLIENTE
	  </div>
		</td>
			<td style="width:75%;background-color:white;text-align:left;">
			<div style="font-size:8px;">
			: $respuestaCliente[razonsocial]
		  </div>

			</td>

		</tr>

		<tr>
		<td style="width:25%;background-color:white;text-align:left;">
		<div style="font-size:8px;">
		$doc
	  </div>
		</td>
			<td style="width:75%;background-color:white;text-align:left;">
			<div style="font-size:8px;">
			: $respuestaCliente[ndocumento]
		  </div>

			</td>

		</tr>
		<tr>
			
	<td  style="width:100%; background-color:white;">
			
	<div style="font-size:8px;text-align:center;">
	------------------------------------------------------------------------

	</div>

		</td>

	</tr>
	</table>

EOF;
$pdf->writeHTML($bloque2, false, false, false, false, '');
// ---------------------------------------------------------

foreach ($productos as $key => $item) {

$itemProducto = "descripcion";
$valorProducto = $item["descripcion"];
$orden = null;

$respuestaProducto = ControladorProductos::ctrMostrarProductos($itemProducto, $valorProducto, $orden);

$valorUnitario = number_format($respuestaProducto[0]["precioventa"], 2);

$precioTotal = number_format($item["total"], 2);

$bloque4 = <<<EOF

<table >

<tr>
<td style="width:35%;background-color:white;text-align:left;">
<div style="font-size:8px;">
$item[descripcion]
</div>
</td>
<td style="width:20%;background-color:white;text-align:left;">
<div style="font-size:8px;">
$valorUnitario
</div>
</td>
<td style="width:20%;background-color:white;text-align:left;">
<div style="font-size:8px;">
$item[cantidad]
</div>
</td>
	<td style="width:25%;background-color:white;text-align:right;">
	<div style="font-size:8px;">
	$precioTotal
  </div>

	</td>

</tr>



</table>


EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');

}

// ---------------------------------------------------------

$bloque5 = <<<EOF

	<table>

<tr>
			
	<td  style="width:100%; background-color:white;">
			
	<div style="font-size:8px;text-align:center;">
	------------------------------------------------------------------------

	</div>

		</td>

	</tr>

	<tr>
	<td style="width:55%;background-color:white;text-align:center;">
	<div style="font-size:8px;">
	OP. GRAVADA
  </div>
	</td>
		<td style="width:17%;background-color:white;text-align:center;">
	<div style="font-size:8px;">
	:&nbsp;&nbsp;&nbsp;&nbsp; S/
	  </div>
		</td>
		<td style="width:28%;background-color:white; text-align:right;">
		<div style="font-size:8px;">
		$neto
	</div>
		

		</td>

	</tr>
	<tr>
	<td style="width:55%;background-color:white;text-align:center;">
	<div style="font-size:8px;">
	OP. INAFECTAS
  </div>
	</td>
		<td style="width:17%;background-color:white;text-align:center;">
	<div style="font-size:8px;">
	:&nbsp;&nbsp;&nbsp;&nbsp; S/
	  </div>
		</td>
		<td style="width:28%;background-color:white; text-align:right;">
		<div style="font-size:8px;">
		0.00
	</div>
		

		</td>

	</tr>

	<tr>
	<td style="width:55%;background-color:white;text-align:center;">
	<div style="font-size:8px;">
	IGV
  </div>
	</td>
		<td style="width:17%;background-color:white;text-align:center;">
	<div style="font-size:8px;">
	:&nbsp;&nbsp;&nbsp;&nbsp; S/
	  </div>
		</td>
		<td style="width:28%;background-color:white; text-align:right;">
		<div style="font-size:8px;">
		$impuesto
	</div>
		

		</td>

	</tr>

	<tr>
	<td style="width:55%;background-color:white;text-align:center;">
	<div style="font-size:8px;">
	TOTAL
  </div>
	</td>
		<td style="width:17%;background-color:white;text-align:center;">
	<div style="font-size:8px;">
	:&nbsp;&nbsp;&nbsp;&nbsp; S/
	  </div>
		</td>
		<td style="width:28%;background-color:white; text-align:right;">
		<div style="font-size:8px;">
		$total
	</div>
		

		</td>

	</tr>
     
	$list_metodo

	</table>

EOF;

$pdf->writeHTML($bloque5, false, false, false, false, '');


// ---------------------------------------------------------

$bloque6 = <<<EOF

	<table>
	<tr>
			
	<td style="background-color:white;">
			
	<div style="font-size:8px;text-align:center;">
	------------------------------------------------------------------------

	</div>

		</td>

	</tr>
	<tr>
			
		<td style="background-color:white;">
				
				<div style="font-size:8px; text-align:center;">
					SON: $totalLetras CON $centimos/100 SOLES
				</div>

			</td>

		</tr>
		<tr>
			
		<td style="background-color:white;">			
		<div style="font-size:8px;text-align:center;">
		------------------------------------------------------------------------

		</div>

			</td>

		</tr>

		<tr>
			
		<td style="background-color:white;">
				
				<div style="font-size:8px; text-align:left;">
					VENTA PIN PAD:
				</div>

			</td>

		</tr>
		<tr>
			
		<td style="background-color:white;">			
		<div style="font-size:8px;text-align:center;">
		------------------------------------------------------------------------

		</div>

			</td>

		</tr>

	</table>
	<table>
	$linecode

		<tr>
			
		<td style="width:100%;background-color:white;text-align:center;">
				
				<div style="font-size:8px;">
					PLACA $placa

				</div>

			</td>



		</tr>




		<tr>
			
	<td style="background-color:white;">
			
			<div style="font-size:8px;">
			--------------------------------------------------------------

			</div>

		</td>

	</tr>
	<tr>
		<td style="width:24%;background-color:white;text-align:left;">
		<div style="font-size:8px;">
		TURNO: 2
	  </div>
		</td>
			<td style="width:24%;background-color:white;text-align:left;">
		<div style="font-size:8px;">
			 CARA: 03
		  </div>
			</td>
			<td style="width:60%;background-color:white; text-align:left;">
			<div style="font-size:8px;">
			CAJERO: $respuestaVendedor[nombres]
		</div>
			

			</td>

		</tr>
		<tr>
			
		<td style="width:100%;background-color:white;">			
				<div style="font-size:8px;">
				--------------------------------------------------------------
				</div>

			</td>

		</tr>


		<tr>
	<td style="background-color:white;">
		
		<div style="font-size:8px; text-align:center;">
			PODRA SER CONSULTAO EN:

		</div>

	</td>

</tr>
		<tr>
			
		<td style="background-color:white;">
				
				<div style="font-size:8px; text-align:center;">
				https://www.primax.com.pe/fe

				</div>

			</td>



		</tr>

		<tr>
			
		<td style="background-color:white;">
				
				<div style="font-size:8px; text-align:center;">
					AUTORIZADO MEDIANTE RESOLUCION:

				</div>

			</td>



		</tr>

		<tr>
			
		<td style="background-color:white;">
				
				<div style="font-size:8px; text-align:center;">
					018000500001117

				</div>

			</td>



		</tr>

		<tr>
			
		<td style="background-color:white;">
				
				<div style="font-size:8px; text-align:center;">
				<img src="$codQr">

				</div>

			</td>



		</tr>


		
	</table>

	<table>
	<tr>
			
	<td style="background-color:white;">
			
	<div style="font-size:8px;text-align:center;">
	------------------------------------------------------------------------

	</div>

		</td>

	</tr>



		<tr>
			
		<td style="background-color:white;">
				
				<div style="font-size:8px; text-align:left;">
					ha sido un placer atenderlo en primax
				</div>

			</td>

		</tr>
		<tr>
			
		<td style="background-color:white;">			
		<div style="font-size:8px;text-align:center;">
		------------------------------------------------------------------------

		</div>

			</td>

		</tr>

		<tr>
			
		<td style="background-color:white;">			
				<div style="font-size:8px;">
				descargar primas go: asdasdasdasasdas

				asd
				a
				das
				d
				as
				</div>

			</td>

		</tr>

	</table>



EOF;
$pdf->writeHTML($bloque6, false, false, false, false, '');
	


// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 

 $pdf->Output('boleta.pdf');

}

}

$ticke = new imprimirticket();
 $ticke -> codigo = $_GET["codigo"];
$ticke -> traerImpresionticket();

?>