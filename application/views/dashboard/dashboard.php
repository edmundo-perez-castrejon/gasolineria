<h2><?php echo $user->cliente->razon_social ?> - <?php echo $user->cliente->clave_cliente ?></h2>
    <h1 class='saldo' id="saldo_total">0</h1>

<div class='mainInfo'>
    <div class="row">

        <div align="center">
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
                <th>NUM_FACT</th>
                <th>FACTURADO</th>
                <th>CONSUMO_FACT</th>
                </thead>
                <tbody>

            <?php
            $consumo_sum = 0;
            foreach($movimientos as $m){
                $consumo_sum += $m['CONSUMO'];
                echo '<tr>';

                echo '<td>'.$m['FOLIO'].'</td>';
                echo '<td>'.$m['FECHA'].'</td>';
                echo '<td>'.$m['UNIDAD'].'</td>';

                echo '<td>'.$m['TICKET'].'</td>';

                echo '<td>'.$m['LTS'].'</td>';
                echo '<td>'.$m['PRECIO_PROD_MOV'].'</td>';
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
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="saldo" id="saldo_sin_facturar"><?php echo number_format($consumo_sum); ?></td>
            </tr>


                </tbody>
            </table>
        <h3>Facturas</h3>
            <table>
                <thead>
                <th>No Factura</th>
                <th>Fecha</th>
                <th>Importe</th>
                <th>Vencimiento</th>
                <th>Saldo</th>
                </thead>
                <tbody>
        <?php
            $saldo_sum = 0;
            foreach($facturas as $f){

                #Para no pintar las que ya estan cuadradas
                if($f['BALANCE']<0.1){
                    continue;
                }

                $saldo_sum += $f['BALANCE'];

                echo '<tr>';
                echo "<td>".anchor('facturas/detalle_factura/'.$f['FACTURA'], $f['FACTURA'])."</td>";
                echo "<td>".$f['FECHA']."</td>";
                echo "<td>".number_format($f['IMPORTE'])."</td>";
                echo "<td>".$f['VENCIMIENTO']."</td>";
                echo "<td>".number_format($f['BALANCE'], 2)."</td>";
                echo '</tr>';
            }
            ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="saldo" id="saldo_facturado"><?php echo number_format($saldo_sum); ?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script language="javascript">
    $(document).ready(function() {
        $('#saldo_total').text("<?php echo number_format($saldo_sum + $consumo_sum); ?>");
    });
</script>