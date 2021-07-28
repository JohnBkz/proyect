<?php
  global  $xx;
class ConvertNum
{
  
    static public function convertir($n)
    {
        switch (true) {
            case ($n >= 1 && $n <= 29):
                return basico($n,null);
                break;
            case ($n >= 30 && $n < 100):
                return decenas($n,null);
                break;
            case ($n >= 100 && $n < 1000):
                return centenas($n,null);
                break;
            case ($n >= 1000 && $n <= 999999):
                return miles($n);
                break;
            case ($n >= 1000000):
                return millones($n);
        }
    }
}

function basico($numero,$num2)
{
    $num = (int)$num2;
    if($num == 1){
        $valor = array(
            'UN', 'DOS', 'TRES', 'CUATRO', 'CINCO', 'SEIS', 'SIETE', 'OCHO',
            'NUEVE', 'DIEZ', 'ONCE', 'DOCE', 'TRECE', 'CATORCE', 'QUINCE', 'DIECISEIS', 'DIECISIETE', 'DIECIOCHO',
            'DIECINUEVE', 'VEINTE', 'VEINTIUNO', 'VEINTIDOS', 'VEINTITRES', 'VEINTICUATRO', 'VEINTICINCO',
            'VEINTISEIS', 'VEINTISIETE', 'VEINTIOCHO', 'VEINTINUEVO'
        );
    }else{
        $valor = array(
            'UNO', 'DOS', 'TRES', 'CUATRO', 'CINCO', 'SEIS', 'SIETE', 'OCHO',
            'NUEVE', 'DIEZ', 'ONCE', 'DOCE', 'TRECE', 'CATORCE', 'QUINCE', 'DIECISEIS', 'DIECISIETE', 'DIECIOCHO',
            'DIECINUEVE', 'VEINTE', 'VEINTIUNO', 'VEINTIDOS', 'VEINTITRES', 'VEINTICUATRO', 'VEINTICINCO',
            'VEINTISEIS', 'VEINTISIETE', 'VEINTIOCHO', 'VEINTINUEVO'
        );

    }
    return $valor[$numero - 1];
}

function decenas($n,$nn)
{
    $decenas = array(
        30 => 'TREINTA', 40 => 'CUARENTA', 50 => 'CINCUENTA', 60 => 'SESENTA',
        70 => 'SETENTA', 80 => 'OCHENTA', 90 => 'NOVENTA'
    );
    if ($n <= 29) return basico($n,$nn);
    $x = $n % 10;
    if ($x == 0) {
        return $decenas[$n];
    } else return $decenas[$n - $x] . ' Y ' . basico($x,null);
}

function centenas($n,$dd)
{
    $cientos = array(
        100 => 'CIEN', 200 => 'DOSCIENTOS', 300 => 'TRECIENTOS',
        400 => 'CUATROCIENTOS', 500 => 'QUINIENTOS', 600 => 'SEISCIENTOS',
        700 => 'SETECIENTOS', 800 => 'OCHOCIENTOS', 900 => 'NOVECIENTOS'
    );
    if ($n >= 100) {
        if ($n % 100 == 0) {
            return $cientos[$n];
        } else {
            $u = (int) substr($n, 0, 1);
            $d = (int) substr($n, 1, 2);
            $ddd = (int) substr($n, 2, 1);
            if($ddd==1){
                $ddd=1;
            }else {
                $ddd=$dd; 
            }

            return (($u == 1) ? 'CIENTO' : $cientos[$u * 100]) . ' ' . decenas($d,$ddd);
        }
    } else return decenas($n,null);
}

function miles($n)
{
    if ($n > 999) {
        if ($n == 1000) {
            return 'MIL';
        } else {
            $l = strlen($n);
            $c = (int)substr($n, 0, $l - 3);
            $x = (int)substr($n, -3);
            $xx = (int)substr($n, -4, 1);
            if ($c == 1) {
                $cadena = 'MIL ' . centenas($x,$xx);              
            }else if ($x != 0) {
                $cadena = centenas($c,$xx) . ' MIL ' . centenas($x,$xx);
            } else $cadena = centenas($c,$xx) . ' MIL';
            return $cadena;
        }
    } else return centenas($n,2);
}

function millones($n)
{
    if ($n == 1000000) {
        return 'UN MILLON';
    } else {
        $l = strlen($n);
        $c = (int)substr($n, 0, $l - 6);
        $x = (int)substr($n, -6);
        if ($c == 1) {
            $cadena = ' MILLON ';
        } else {
            $cadena = ' MILLON ';
        }
        return miles($c) . $cadena . (($x > 0) ? miles($x) : '');
    }
}
