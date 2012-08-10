<h3>Movimientos no facturados</h3>
<table class="table table-bordered" BORDER="1" cellspacing="0" cellpadding="1" width="100%">
    <tr>
    <th style="font-size: 8">FOLIO</th>
    <th style="font-size: 8">FECHA</th>
    <th style="font-size: 8">UNIDAD</th>
    <th style="font-size: 8">TICKET</th>
    <th style="font-size: 8">LTS</th>
    <th style="font-size: 8">PRECIO</th>
    <th style="font-size: 8">CONSUMO</th>
    <th style="font-size: 8">REFERENCIA</th>
    <th style="font-size: 8">VALE_NOTA</th>
    </tr>
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
        echo '<td align="right" style="font-size: 12">'.number_format($m['LTS'], 2).'</td>';
        echo '<td align="right" style="font-size: 12">'.number_format($m['PRECIO_PROD_MOV'],2).'</td>';
        echo '<td align="right" style="font-size: 12">'.number_format($m['CONSUMO'],2).'</td>';
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
        <td class='sumatoria gris' bgcolor="#d3d3d3" align="right" style="font-size: 12">
            <b><?php echo number_format($litros_sum, 2 ); ?></b>
        </td>
        <td></td>
        <td class='sumatoria' id="saldo_sin_facturar" bgcolor="#d3d3d3" align="right" style="font-size: 12">
            <b>$ <?php echo number_format($consumo_sum, 2  ); ?></b>
        </td>
        <td></td>
        <td></td>
    </tr>


    </tbody>
</table>

<input type='hidden' id='saldo_sinfacturar_hidden' value='<?php echo $consumo_sum; ?>'>