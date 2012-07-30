<table class="table-bordered table">
    <thead>
    <th>No FACTURA</th>
    <th>FECHA</th>
    <th>FECHA DE VENCIMIENTO</th>
    <th>DIAS VENCIDOS</th>
    <th>IMPORTE</th>
    <th>ABONOS</th>
    <th>SALDO</th>
    </thead>
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
        echo "<td>".anchor('facturas/detalle_factura/'.$f['FACTURA'], $f['FACTURA'])."</td>";
        echo "<td>".$f['FECHA']."</td>";
        echo "<td>".$f['VENCIMIENTO']."</td>";
        echo "<td>".$dias_vencidos."</td>";
        echo "<td>".number_format($f['IMPORTE'],2)."</td>";
        echo "<td>".number_format($abonos, 2)."</td>";
        echo "<td>".number_format($f['SALDO'], 2)."</td>";
        echo '</tr>';
    }
    ?>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td class="sumatoria gris" >$ <?php echo number_format($importe_sum, 2); ?></td>
        <td class="sumatoria gris" >$ <?php echo number_format($abonos_sum, 2); ?></td>
        <td class="sumatoria" id="saldo_facturado">$ <?php echo number_format($saldo_sum, 2); ?></td>
    </tr>

    </tbody>
</table>