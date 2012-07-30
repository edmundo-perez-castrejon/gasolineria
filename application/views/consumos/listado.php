<h3>Movimientos</h3>
<table>
    <thead>
    <th>FOLIO</th>
    <th>FECHA</th>
    <th>UNIDAD</th>
    <th>TICKET</th>
    <th>LTS</th>
    <th>PRECIO</th>
    <th>CONSUMO</th>
    <th>ABONO</th>
    <th>REFERENCIA</th>
    <th>VALE_NOTA</th>
    </thead>
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
        echo '<td>'.$m['FOLIO'].'</td>';
        echo '<td>'.$m['FECHA'].'</td>';
        echo '<td>'.$m['UNIDAD'].'</td>';
        echo '<td>'.$m['TICKET'].'</td>';
        echo '<td>'.number_format($m['LTS'], 2).'</td>';
        echo '<td>'.number_format($m['PRECIO_PROD_MOV']).'</td>';
        echo '<td>'.number_format($m['CONSUMO']).'</td>';
        echo '<td class="'.$abono_class.'">'.number_format($m['ABONO']).'</td>';
        echo '<td>'.$m['REFERENCIA'].'</td>';
        echo '<td>'.$m['VALE_NOTA'].'</td>';
        echo '</tr>';
    }
    ?>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td class='sumatoria gris' ><?php echo number_format($litros_sum, 2 ); ?></td>
        <td></td>
        <td class='sumatoria' id="saldo_sin_facturar">$ <?php echo number_format($consumo_sum, 2  ); ?></td>
        <td class='sumatoria'>$ <?php echo number_format($abono_sum, 2  ); ?></td>
        <td></td>

    </tr>


    </tbody>
</table>