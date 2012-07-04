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
<table border=0 width="100%" style="font-size: 11px;">
    <tr>
        <td bgcolor="#dcdcdc" align="right"><b>FOLIO</b></td>
        <td bgcolor="#dcdcdc" align="right"><b>FECHA</b></td>
        <td bgcolor="#dcdcdc" align="right"><b>PLACAS</b></td>
        <td bgcolor="#dcdcdc" align="right"><b>C. PORTE</b></td>
        <td bgcolor="#dcdcdc" align="right"><b>CHOFER</b></td>
        <td bgcolor="#dcdcdc" align="right"><b>No. CARRO</b></td>
        <td bgcolor="#dcdcdc" align="right"><b>TRANSPORTISTA</b></td>
        <td bgcolor="#dcdcdc" align="right"><b>TICKET</b></td>
        <td bgcolor="#dcdcdc" align="right"><b>BGA.</b></td>
        <td bgcolor="#dcdcdc" align="right"><b>P. BRUTO</b></td>
        <td bgcolor="#dcdcdc" align="right"><b>P. TARA</b></td>
        <td bgcolor="#dcdcdc" align="right"><b>NETO</b></td>
        <td bgcolor="#dcdcdc" align="right"><b>SACOS</b></td>
    </tr>
</table>
<div class="content">

        <?php

        foreach($datos_destinos as $destino):
            $total_de_salidas = $this->salidas_lib->get_peso_total($destino['CLAVE_DESTINO']);
            ?>
            <table border=0 >
                <tbody>
                <tr>
                    <td><?php echo $destino['CLAVE_DESTINO'].' '.$destino['NOMBRE_DESTINO']; ?></td>
                </tr>
                <tr>
                    <td>CAMION</td>
                </tr>
                </tbody>
            </table>
            <HR size="1"/>
            <table border=0 width="100%"  style="font-size: 11px; text-align: right">

            <?php
            $conteo_salidas=0;
            $peso_bruto_total =0;
            $peso_tara_total = 0;
            $neto_total = 0;
            foreach($datos_salidas[$destino['CLAVE_DESTINO']] as $salida)
            {
                $neto = $salida['PESO_BRUTO']-$salida['TARA'];

                echo '<tr>';
                echo '<td>'.$salida['PROGRESIVO'].'</td>';
                echo '<td>'.$salida['FECHA'].'</td>';
                echo '<td>'.$salida['PLACAS'].'</td>';
                echo '<td>'.$salida['CARTA_PORTE'].'</td>';
                echo '<td>'.$salida['CHOFER'].'</td>';
                echo '<td>'.$salida['NO_CARRO'].'</td>';
                echo '<td>'.$salida['SERIE_CAMION'].'</td>';
                echo '<td>'.$salida['TICKET'].'</td>';
                echo '<td>0</td>';
                echo '<td>'.number_format($salida['PESO_BRUTO']).'</td>';
                echo '<td>'.number_format($salida['TARA']).'</td>';
                echo '<td>'.number_format($neto).'</td>';
                echo '<td>'.$salida['CANTIDAD_SACOS'].'</td>';
                echo '</tr>';

                $conteo_salidas++;
                $peso_bruto_total += $salida['PESO_BRUTO'];
                $peso_tara_total +=$salida['TARA'];
                $neto_total += $neto;
            }
            ?>
            </table>
                <br>
            <br>
            <table border=0 align="right" width="40%" style="font-size: 13px; text-align: right">
                <tr>
                    <td bgcolor="#dcdcdc"><b>TOTAL DE ENVIOS: <?php echo $conteo_salidas;?></b></td>
                    <td bgcolor="#dcdcdc"><b><?php echo number_format($peso_bruto_total);?></b></td>
                    <td bgcolor="#dcdcdc"><b><?php echo number_format($peso_tara_total);?></b></td>
                    <td bgcolor="#dcdcdc"><b><?php echo number_format($neto_total);?></b></td>
                    <td bgcolor="#dcdcdc"><b><?php echo number_format(0);?></b></td>
                </tr>
            </table>
                <br>
            <br>
            <br>
            <?php
        endforeach;
        ?>

</div>