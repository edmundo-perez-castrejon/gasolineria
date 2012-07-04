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
<div class="content">
<table border=0 width="100%" style="font-size: 15px; text-align: right">
    <tr>
        <td bgcolor="#dcdcdc" align="right"><b>CLAVE</b></td>
        <td bgcolor="#dcdcdc" align="right"><b>NOMBRE DE DESTINO</b></td>
        <td bgcolor="#dcdcdc" align="right"><b>TRANSPORTISTA</b></td>
        <td bgcolor="#dcdcdc" align="right"><b>CAM./TOL.</b></td>
        <td bgcolor="#dcdcdc" align="right"><b>ORDENADO</b></td>
        <td bgcolor="#dcdcdc" align="right"><b>ENVIADO</b></td>
        <td bgcolor="#dcdcdc" align="right"><b>POR ENVIAR</b></td>
        <td bgcolor="#dcdcdc" align="right"><b>%ENVIADO</b></td>

    </tr>
    <?php
    $conteo_salidas_sum =0;
    $total_de_salidas_sum = 0;
    $ordenado_sum = 0;
    $por_enviar_sum = 0;
    foreach($datos_destinos as $destino){

        $total_de_salidas = $this->salidas_lib->get_peso_total($destino['CLAVE_DESTINO']);
        $porciento_enviado = ($total_de_salidas)*100/$destino['ORDENADO'];
        $por_enviar = $destino['ORDENADO']-$total_de_salidas;
        $conteo_salidas = $datos_salidas[$destino['CLAVE_DESTINO']];


        $conteo_salidas_sum += $conteo_salidas;
        $total_de_salidas_sum += $total_de_salidas;
        $ordenado_sum += $destino['ORDENADO'];
        $por_enviar_sum += $por_enviar;
        ?>
        <tr>
            <td><?php echo $destino['CLAVE_DESTINO']; ?></td>
            <td><?php echo $destino['NOMBRE_DESTINO']; ?></td>
            <td><?php echo $destino['TRANSPORTISTA']; ?></td>
            <td><?php echo number_format($conteo_salidas); ?></td>
            <td><?php echo number_format($destino['ORDENADO']); ?></td>
            <td><?php echo number_format($total_de_salidas);?></td>
            <td><?php echo number_format($por_enviar);?></td>
            <td><?php echo round($porciento_enviado, 2); ?>%</td>
        </tr>
        <?php
    }
    ?>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><b><?php echo number_format($conteo_salidas_sum); ?></b></td>
        <td><b><?php echo number_format($ordenado_sum); ?></b></td>
        <td><b><?php echo number_format($total_de_salidas_sum);?></b></td>
        <td><b><?php echo number_format($por_enviar_sum)?></b></td>
        <td>&nbsp;</td>
    </tr>
</table>
</div>