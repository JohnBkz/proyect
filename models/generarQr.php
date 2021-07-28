<?php

class generarqr
{
    static public function generar($texto,$codvent)
    {
        if(file_exists("../../../extensiones/phpqrcode/qrlib.php")){
            require "../../../extensiones/phpqrcode/qrlib.php";
            $ruta = "../../../views/img/qr/".$codvent.".png";
            $tamaño = 1;
            $level = "Q";
            $frameSize = 3;
           
            QRcode::png($texto, $ruta, $level,$tamaño,$frameSize);
           
        //    if(file_exists($ruta)){
        //        $ruta="Archivo QR, Generado";     
        //    }
           
           }else{
               $ruta="no Existe la libreria";    
           }
     
        return ($ruta);
    }
}