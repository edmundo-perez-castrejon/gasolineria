<h3><?php echo $cliente[0]['CLAVE_CLIENTE'].' '.$cliente[0]['RAZON_SOCIAL'] ?></h3>
<table class="table" BORDER="1">
    <tr>
        <th>No FACTURA</th>
        <th>FECHA</th>
        <th>VENCIMIENTO</th>
        <th>SIN VENCER</th>
        <th>1-7</th>
        <th>8-15</th>
        <th>16-23</th>
        <th>+23</th>
    </tr>
    <tbody>
    <?php

    $g1_sum = 0;
    $g2_sum = 0;
    $g3_sum = 0;
    $g4_sum = 0;
    $g5_sum = 0;
    foreach($facturas as $f){

        $g1_sum += $f['SIN_VENCER'];
        $g2_sum += $f['1-7'];
        $g3_sum += $f['8-15'];
        $g4_sum += $f['16-23'];
        $g5_sum += $f['+23'];

        echo '<tr>';
        echo "<td>".$f['FACTURA']."</td>";
        echo "<td>".$f['FECHA']."</td>";
        echo "<td align='center'>".$f['VENCIMIENTO']."</td>";
        echo "<td align='center'>".number_format($f['SIN_VENCER'],2)."</td>";
        echo "<td align='center'>".number_format($f['1-7'],2)."</td>";
        echo "<td align='center'>".number_format($f['8-15'],2)."</td>";
        echo "<td align='center'>".number_format($f['16-23'],2)."</td>";
        echo "<td align='center'>".number_format($f['+23'],2)."</td>";
        echo '</tr>';
    }
    ?>
    <tr>
        <td colspan="3">Subtotal</td>
        <td align="center"><strong><?php echo number_format($g1_sum, 2)?></strong></td>
        <td align="center"><strong><?php echo number_format($g2_sum, 2)?></strong></td>
        <td align="center"><strong><?php echo number_format($g3_sum, 2)?></strong></td>
        <td align="center"><strong><?php echo number_format($g4_sum, 2)?></strong></td>
        <td align="center"><strong><?php echo number_format($g5_sum, 2)?></strong></td>
    </tr>
    <tr>
        <td colspan="7">Total</td>


        <td align="center"><strong>$<?php echo number_format($g1_sum+$g2_sum+$g3_sum+$g4_sum+$g5_sum, 2)?></strong></td>
    </tr>

    </tbody>
</table>