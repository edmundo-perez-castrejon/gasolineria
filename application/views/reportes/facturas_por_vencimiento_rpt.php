<h3><?php echo $cliente[0]['CLAVE_CLIENTE'].' '.utf8_decode($cliente[0]['RAZON_SOCIAL']) ?></h3>
<table class="table" BORDER="1" cellspacing="0" cellpadding="1" width="100%">
    <tr>
        <td style="font-size: 11" width="50px">#FACTURA</td>
        <td style="font-size: 11" width="70px" align="center">FECHA</td>
        <td style="font-size: 11" width="70px" align="center">VENCIMIENTO</td>
        <td style="font-size: 11" width="50px" align="center">DIAS VENCIDOS</td>
        <td style="font-size: 11" align="right">IMPORTE</td>
        <td style="font-size: 11" align="right">ABONOS</td>
        <td style="font-size: 11" align="right">SALDO</td>
    </tr>
    <tbody>
    <?php
    $saldo_sum = 0;
    $abonos_sum = 0;
    $importe_sum = 0;
    foreach($facturas as $f){

        $abonos = $f['ABONOS'];
        $saldo_sum += $f['SALDO'];
        $abonos_sum += $abonos;
        $importe_sum += $f['IMPORTE'];
        $dias_vencidos = $f['DIASVENCIMIENTO'];

        echo '<tr>';
        echo "<td align='center' style='font-size: 12'>".$f['FACTURA']."</td>";
        echo "<td align='center' style='font-size: 12'>".$f['FECHA']."</td>";
        echo "<td align='center' style='font-size: 12'>".$f['VENCIMIENTO']."</td>";
        echo "<td align='center' style='font-size: 12'>".$dias_vencidos."</td>";
        echo "<td align='right' style='font-size: 12'>".number_format($f['IMPORTE'],2)."</td>";
        echo "<td align='right' style='font-size: 12'>".number_format($abonos, 2)."</td>";
        echo "<td align='right' style='font-size: 12'>".number_format($f['SALDO'], 2)."</td>";
        echo '</tr>';
    }
    ?>
    <tr>

        <td colspan="6" align="right" BGCOLOR="#d3d3d3" style="border-right: none">
            <strong>Total</strong>
        </td>

        <td class="sumatoria" id="saldo_facturado" align='right' style='font-size: 14; border-left: none'  BGCOLOR="#d3d3d3">
            $ <?php echo number_format($saldo_sum, 2); ?></td>
    </tr>

    </tbody>
</table>