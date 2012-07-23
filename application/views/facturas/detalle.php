<h3>Detalle de Factura</h3>
<table>
    <thead>
    <th>FOLIO</th>
    <th>FECHA</th>

    <th>CONSUMO</th>
    <th>ABONO</th>
    <th>REFERENCIA</th>
    <th>VALE_NOTA</th>
    <th>NUM_FACT</th>
    <th>FACTURADO</th>
    <th>CONSUMO_FACT</th>
    </thead>
    <tbody>

    <?php
    foreach($movimientos as $m){
        echo '<tr>';

        echo '<td>'.$m['FOLIO'].'</td>';
        echo '<td>'.$m['FECHA'].'</td>';

        echo '<td>'.$m['CONSUMO'].'</td>';
        echo '<td>'.$m['ABONO'].'</td>';
        echo '<td>'.$m['REFERENCIA'].'</td>';
        echo '<td>'.$m['VALE_NOTA'].'</td>';
        echo '<td>'.$m['NUM_FACT'].'</td>';
        echo '<td>'.$m['FACTURADO'].'</td>';
        echo '<td>'.$m['CONSUMO_FACT'].'</td>';
        echo '</tr>';
    }
    ?>
    </tbody>
</table>