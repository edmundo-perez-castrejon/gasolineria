<h3>Movimientos no facturados</h3>
<table class="table table-bordered">
    <thead>
    <th>FOLIO</th>
    <th>FECHA</th>
    <th>UNIDAD</th>
    <th>TICKET</th>
    <th>LTS</th>
    <th>PRECIO</th>
    <th>CONSUMO</th>
    <th>REFERENCIA</th>
    <th>VALE_NOTA</th>
    </thead>
    <tbody>

    <?php
    $consumo_sum = 0;
    $litros_sum = 0;
    foreach($movimientos as $m){
        $consumo_sum += $m['CONSUMO'];
        $litros_sum += $m['LTS'];

        echo '<tr>';
        echo '<td>'.$m['FOLIO'].'</td>';
        echo '<td>'.$m['FECHA'].'</td>';
        echo '<td>'.$m['UNIDAD'].'</td>';
        echo '<td>'.$m['TICKET'].'</td>';
        echo '<td>'.number_format($m['LTS'], 2).'</td>';
        echo '<td>'.$m['PRECIO_PROD_MOV'].'</td>';
        echo '<td>'.$m['CONSUMO'].'</td>';
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
    </tr>


    </tbody>
</table>

<input type='hidden' id='saldo_sinfacturar_hidden' value='<?php echo $consumo_sum; ?>'>