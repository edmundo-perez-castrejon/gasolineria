<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function gran_total($movimientos, $facturas)
{
    $consumo_sum = 0;
    foreach($movimientos as $m){          $consumo_sum += $m['CONSUMO'];    }

    $saldo_sum = 0;
    foreach($facturas as $f){        $saldo_sum += $f['SALDO'];    }

    return $consumo_sum + $saldo_sum;

}
