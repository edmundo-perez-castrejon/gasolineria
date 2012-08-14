<table class="table" BORDER="1" cellspacing="0" cellpadding="1" width="100%">
    <tr>
    <th style="font-size: 10">FOLIO</th>
    <th style="font-size: 10">FECHA</th>
    <th style="font-size: 10">UNIDAD</th>
    <th style="font-size: 10">TICKET</th>
    <th style="font-size: 10">LTS</th>
    <th style="font-size: 10">PRECIO</th>
    <th style="font-size: 10">CONSUMO</th>
    <th style="font-size: 10">ABONO</th>
    <th style="font-size: 10">REFERENCIA</th>
    <th style="font-size: 10">VALE_NOTA</th>
    </tr>
    <tbody>

    <?php
    $consumo_sum = 0;
    $litros_sum = 0;
    $abono_sum = 0;
    foreach($movimientos as $m){
        $consumo_sum += $m['CONSUMO'];
        $litros_sum += $m['LTS'];
        $abono_sum += $m['ABONO'];
        $abono_class =  $m['ABONO']>0 ? 'abono' : '';

        echo '<tr>';
        echo '<td align="center" style="font-size: 12">'.$m['FOLIO'].'</td>';
        echo '<td align="center" style="font-size: 12">'.$m['FECHA'].'</td>';
        echo '<td align="centert" style="font-size: 12">'.$m['UNIDAD'].'</td>';
        echo '<td align="center" style="font-size: 12">'.$m['TICKET'].'</td>';
        echo '<td align="right" style="font-size: 12">'.number_format($m['LTS'], 2).'</td>';
        echo '<td align="right" style="font-size: 12">'.number_format($m['PRECIO_PROD_MOV']).'</td>';
        echo '<td align="right" style="font-size: 12">'.number_format($m['CONSUMO']).'</td>';
        echo '<td align="right" style="font-size: 12" class="'.$abono_class.'">'.number_format($m['ABONO']).'</td>';
        echo '<td align="right" style="font-size: 12">'.$m['REFERENCIA'].'</td>';
        echo '<td align="right" style="font-size: 12">'.$m['VALE_NOTA'].'</td>';
        echo '</tr>';
    }
    ?>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td class='sumatoria gris' align="right" style='font-size: 13' bgcolor="#d3d3d3">
            <?php echo number_format($litros_sum, 2 ); ?></td>
        <td></td>
        <td class='sumatoria' id="saldo_sin_facturar" align="right" style='font-size: 13' bgcolor="#d3d3d3">
            $ <?php echo number_format($consumo_sum, 2  ); ?></td>
        <td class='sumatoria' align="right" style='font-size: 13' bgcolor="#d3d3d3">
            $ <?php echo number_format($abono_sum, 2  ); ?></td>
        <td></td>
        <td></td>
    </tr>


    </tbody>
</table>