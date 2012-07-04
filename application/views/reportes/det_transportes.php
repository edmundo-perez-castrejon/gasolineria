<div align="center">
    <h2><?php echo $title; ?></h2>
</div>
<div>
    <H3>
        BUQUE MOTOR: <?php echo $datos_buque['BUQUE']; ?>
    </H3>
</div>
<BR/>
<BR/>
<table border="0" width="100%" style="font-size: 12px;">
    <tr>
        <td width="50%"><b>No. Contrato:</b>  <?php echo $datos_buque['CONTRATO']; ?></td>
        <td align="right"><b>Fecha de Arribo:</b> <?php echo $datos_buque['FECHA_ARRIBO']; ?></td>
    </tr>
    <tr>
        <td><B>Nombre del proveedor:</B><?php echo $datos_buque['NOMBRE_PROVEEDOR']; ?></td>
        <td align="right"><B>Fecha de Terminaci&oacute;n:</B> <?php echo $datos_buque['FECHA_TERMINACION']; ?></td>
    </tr>
</table>
<table border="0" width="100%" style="font-size: 12px;">
    <tr>
        <td><b>Nombre de la plaza:</b>MANZANILLO COLIMA MEX</td>
    </tr>
    <tr>
        <td><B>Agente aduanal:</B> TRAMITADORA DEL PACIFICO S.A DE C.V</td>
    </tr>
    <tr>
        <td>
            <b>Nombre del producto:</b> <?php echo $datos_buque['NOMBRE_PRODUCTO']; ?>
        </td>
    </tr>
</table>
<br/>
<br/>
<?php
echo '<pre>';


?>
<div class="content">
    <?php

    $conteo_gran_total = 0;
    $peso_gran_total = 0;

    foreach($datos_destinos as $destino)
    {
        ?>
        <h3><?php echo $destino['CLAVE_DESTINO'].' '.$destino['NOMBRE_DESTINO']?></h3>
        <table width="60%" align="center" style="text-align: right;">
        <?php
        $conteo_total = 0;
        $peso_total_total = 0;
        foreach($datos_salidas[$destino['CLAVE_DESTINO']] as $fecha_destino => $lst_fechas){

            $conteo = count($lst_fechas);
            $conteo_total += $conteo;

            echo '<tr>';
            echo '<td width="200">CAMION</td>';
            echo "<td width='100'>$fecha_destino</td>";
            echo "<td width='100'>".count($lst_fechas)."</td>";

            $total_peso = 0;
            foreach($lst_fechas as $fecha)
            {
                $total_peso += $fecha['PESO_BRUTO']-$fecha['TARA'];
            }

            $peso_total_total += $total_peso;

            echo '<td width="200">';
            echo number_format($total_peso);
            echo '</td>';

            echo '</tr>';
        }
        echo '<tr>';
        echo '<td>&nbsp;</td>';
        echo '<td>&nbsp;</td>';
        echo '<td bgcolor="#dcdcdc" ><b>'.$conteo_total.'</td>';
        echo '<td bgcolor="#dcdcdc" ><b>'.number_format($peso_total_total).'</b></td>';
        echo '</tr>';
        echo '</table><br><br><br><br><br>';
        $conteo_gran_total += $conteo_total;
        $peso_gran_total += $peso_total_total;
    }
    echo '<table width="60%" align="right" style="text-align: right; font-size: 18px;">';
    echo '<tr>';
    echo '<td>&nbsp;</td>';
    echo '<td>&nbsp;</td>';
    echo '<td bgcolor="#dcdcdc" ><b>'.$conteo_gran_total.'</td>';
    echo '<td bgcolor="#dcdcdc" ><b>'.number_format($peso_gran_total).'</b></td>';
    echo '</tr>';
    echo '</table>';

    echo '</pre>';
    ?>

</div>