<h3><?php echo $cliente[0]['CLAVE_CLIENTE'].' '.utf8_decode($cliente[0]['RAZON_SOCIAL']) ?></h3>
<table class="table">
    <tr>
    <td>No FACTURA</td>
    <td>FECHA</td>
    <td>IMPORTE</td>
    <td>ABONOS</td>
    <td>SALDO</td>
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


        echo '<tr>';
        echo "<td>".$f['FACTURA']."</td>";
        echo "<td>".$f['FECHA']."</td>";
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
        <td class="sumatoria" id="saldo_facturado">$ <?php echo number_format($saldo_sum, 2); ?></td>
    </tr>

    </tbody>
</table>