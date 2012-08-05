<table class="table" BORDER="0" cellspacing="0" cellpadding="2" width="70%">
    <tr>
        <td colspan="2"><h3><?php echo $cliente[0]['CLAVE_CLIENTE'].' '.utf8_decode($cliente[0]['RAZON_SOCIAL'])  ?></h3></td>
    </tr>
    <tr>
        <td width="150px" STYLE="font-size: 12px; border-right: 0px">LIMITE DE CREDITO: </td>
        <td align="right" style="border-left: 0px"><?php echo number_format($cliente[0]['MONTO_CREDITO'],2) ?></td>


    </tr>
    <?php
    if($extra){
    ?>
        <tr>
            <td width="150px" STYLE="font-size: 12px; border-right: 0px">SALDO TOTAL: </td>
            <td align="right" style="border-left: 0px"><?php echo number_format($extra['estadisticas']['SUM_CONSUMO'] - $extra['estadisticas']['SUM_ABONO'],2) ?></td>
        </tr>
        <tr>
            <td width="150px" STYLE="font-size: 12px; border-right: 0px">SOBREGIRO: </td>
            <td  align="right" style="border-left: 0px; color: red; font-weight: bold"><?php echo number_format($extra['estadisticas']['SOBREGIRO'],2) ?></td>
        </tr>
    <?php
    }
    ?>
    <tr>
        <td width="200px" STYLE="font-size: 12px; border-right: 0px">ULTIMO CONSUMO (<?php echo $ultimo_consumo['FECHA'];?>) : </td>
        <td align="right" style="border-left: 0px"><?php echo number_format($ultimo_consumo['CONSUMO'],2) ?></td>
    </tr>
    <tr>
        <td width="200px" STYLE="font-size: 12px; border-right: 0px">ULTIMO ABONO (<?php echo $ultimo_abono['FECHA'];?>) : </td>
        <td align="right" style="border-left: 0px"><?php echo number_format($ultimo_abono['CONSUMO'],2) ?></td>
    </tr>
</table>
<br/>
<table class="table" BORDER="1" cellspacing="0" cellpadding="1" width="100%">
    <tr>
        <th style="font-size: 11" WIDTH="70px">#FACT.</th>
        <th style="font-size: 11" WIDTH="70px">FECHA</th>
        <th style="font-size: 11" WIDTH="70px">VENCIM.</th>
        <th style="font-size: 11" WIDTH="100px">POR VENCER</th>
        <th style="font-size: 11" WIDTH="100px">1-7</th>
        <th style="font-size: 11" WIDTH="100px">8-15</th>
        <th style="font-size: 11" WIDTH="100px">16-23</th>
        <th style="font-size: 11" WIDTH="100px">+23</th>
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
        echo "<td align='center' style='font-size: 12'>".$f['FACTURA']."</td>";
        echo "<td align='center' style='font-size: 12'>".$f['FECHA']."</td>";
        echo "<td align='center' style='font-size: 12'>".$f['VENCIMIENTO']."</td>";
        echo "<td align='center' style='font-size: 12'>".number_format($f['SIN_VENCER'],2)."</td>";
        echo "<td align='center' style='font-size: 12'>".number_format($f['1-7'],2)."</td>";
        echo "<td align='center' style='font-size: 12'>".number_format($f['8-15'],2)."</td>";
        echo "<td align='center' style='font-size: 12'>".number_format($f['16-23'],2)."</td>";
        echo "<td align='center' style='font-size: 12'>".number_format($f['+23'],2)."</td>";
        echo '</tr>';
    }
    ?>
    <tr>
        <td colspan="3" align="right" >Subtotal : </td>
        <td align="center" style='font-size: 13'><strong><?php echo number_format($g1_sum, 2)?></strong></td>
        <td align="center" style='font-size: 13'><strong><?php echo number_format($g2_sum, 2)?></strong></td>
        <td align="center" style='font-size: 13'><strong><?php echo number_format($g3_sum, 2)?></strong></td>
        <td align="center" style='font-size: 13'><strong><?php echo number_format($g4_sum, 2)?></strong></td>
        <td align="center" style='font-size: 13'><strong><?php echo number_format($g5_sum, 2)?></strong></td>
    </tr>
    <tr>
        <td colspan="7" align="right" style="border-right: 0px">Total facturado : </td>
        <td align="right" style="border-left: 0px"><strong>$<?php echo number_format($g1_sum+$g2_sum+$g3_sum+$g4_sum+$g5_sum, 2)?></strong></td>
    </tr>
    <tr>
        <td colspan="7" align="right" style="border-right: 0px">Total sin facturar : </td>
        <td align="right" style="border-left: 0px"><strong>$<?php echo number_format($movimientos_sum, 2)?></strong></td>
    </tr>
    <tr>
        <td colspan="7" align="right" style="border-right: 0px" bgcolor="#d3d3d3">GRAN TOTAL : </td>
        <td align="right" style="border-left: 0px; font-size: 16px" BGCOLOR="#d3d3d3">
            <strong>$<?php echo number_format($g1_sum+$g2_sum+$g3_sum+$g4_sum+$g5_sum+$movimientos_sum, 2)?></strong>
        </td>
    </tr>

    </tbody>
</table>