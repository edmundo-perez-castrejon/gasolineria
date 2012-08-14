<table class="table" BORDER="1" cellspacing="0" cellpadding="1" width="100%">
    <tr>
    <th style="font-size: 10">No FACTURA</th>
    <th style="font-size: 10">FECHA</th>
    <th style="font-size: 10">VENCIMIENTO</th>
    <th style="font-size: 10">DIAS VENCIDOS</th>
    <th style="font-size: 10">IMPORTE</th>
    <th style="font-size: 10">ABONOS</th>
    <th style="font-size: 10">SALDO</th>
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
        echo "<td align='center' style='font-size: 12'>".anchor('facturas/detalle_factura/'.$f['FACTURA'], $f['FACTURA'])."</td>";
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
        <td colspan="4"><div align="right"> Total:</td>

        <td class="sumatoria gris" align="right" style='font-size: 13' bgcolor="#d3d3d3">
            $ <?php echo number_format($importe_sum, 2); ?>
        </td>
        <td class="sumatoria gris" align="right" style='font-size: 13' bgcolor="#d3d3d3">
            $ <?php echo number_format($abonos_sum, 2); ?>
        </td>
        <td class="sumatoria" align="right" style='font-size: 13' id="saldo_facturado" bgcolor="#d3d3d3">
            $ <?php echo number_format($saldo_sum, 2); ?>
        </td>
    </tr>

    </tbody>
</table>