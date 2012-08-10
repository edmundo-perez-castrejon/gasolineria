<h3>Facturas pendientes</h3>
<table class="table table-bordered" BORDER="1" cellspacing="0" cellpadding="1" width="100%">
    <tr>
    <th style="font-size: 8">No FACTURA</th>
    <th style="font-size: 8">FECHA</th>
    <th style="font-size: 8">VENCIMIENTO</th>
    <th style="font-size: 8">DIAS VENCIDOS</th>
    <th style="font-size: 8">IMPORTE</th>
    <th style="font-size: 8">ABONOS</th>
    <th style="font-size: 8">SALDO</th>
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
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td class="sumatoria gris" align='right' style='font-size: 12' bgcolor="#d3d3d3">
            <b>$ <?php echo number_format($importe_sum, 2); ?></b>
        </td>
        <td class="sumatoria gris" align='right' style='font-size: 12' bgcolor="#d3d3d3">
            <b>$ <?php echo number_format($abonos_sum, 2); ?></b>
        </td>
        <td class="sumatoria" id="saldo_facturado" align='right' style='font-size: 12' bgcolor="#d3d3d3">
            <b>$ <?php echo number_format($saldo_sum, 2); ?></b>
        </td>
    </tr>

    </tbody>
</table>

<input type='hidden' id='saldo_facturado_hidden' value='<?php echo $saldo_sum; ?>'>