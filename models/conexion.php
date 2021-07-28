<?php

class Conexion {

	static public function conectar() {
		//servidev.tk
		//servidev_
		//servidev_dev-grifos -> grifos2020@
		$link = new PDO("mysql:host=localhost;dbname=servidev_grifos",
			            "root",
			            "");
		$link->exec("set names utf8");
		return $link;
	}

}

/*
BEFORE--- INSERT ---
BEGIN
DECLARE stockactual DECIMAL(10,2);
SET @stockactual:=(SELECT cantidad FROM articulos WHERE idarticulo = new.CODPRODUCTO);
UPDATE articulos SET 
cantidad = @stockactual - new.DETALLLECANTIDAD 
WHERE idarticulo = new.CODPRODUCTO;
END   


 ->setMtoOperGravadas(33.898305084745762711864406779661)
    ->setMtoIGV(6.101694915254237288135593220339)
    ->setTotalImpuestos(6.101694915254237288135593220339)
    ->setValorVenta(33.898305084745762711864406779661)
    ->setSubTotal(40)
    ->setMtoImpVenta(40);

$detail = new SaleDetail();
$detail->setCodProducto('P001')
    ->setUnidad('NIU')
    ->setDescripcion('PROD 1')
    ->setCantidad(2)
    ->setMtoValorUnitario(21.186440677966101694915254237288)
    ->setDescuentos([
        (new Charge())
            ->setCodTipo('00') // Catalog. 53
            ->setMontoBase(42.372881355932203389830508474576)
            ->setFactor(0.236)
            ->setMonto(10) / 1.18
			->setMonto(8.474576271186440677966101694915)
    ])
    ->setMtoValorVenta(33.898305084745762711864406779661)
    ->setMtoBaseIgv(33.898305084745762711864406779661)
    ->setPorcentajeIgv(18)
    ->setIgv(6.101694915254237288135593220339)
    ->setTipAfeIgv('10')
    ->setTotalImpuestos(6.101694915254237288135593220339)
    ->setMtoPrecioUnitario(20)
;

*/