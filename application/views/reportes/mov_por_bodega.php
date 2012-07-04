<div align="center">
    <h1>RESUMEN DE BODEGAS</h1>
</div>
<div>
    <H2>
BUQUE MOTOR: <?php echo $datos_buque['BUQUE']; ?>
    </H2>
</div>
    <BR/>
<BR/>
<table border="0" width="100%">
    <tr>
        <td width="50%"><b>No. Contrato:</b>  <?php echo $datos_buque['CONTRATO']; ?></td>
        <td align="right"><b>Fecha de Arribo:</b> <?php echo $datos_buque['FECHA_ARRIBO']; ?></td>
    </tr>
    <tr>
        <td><B>Nombre del proveedor:</B><?php echo $datos_buque['NOMBRE_PROVEEDOR']; ?></td>
        <td align="right"><B>Fecha de Terminaci&oacute;n:</B> <?php echo $datos_buque['FECHA_TERMINACION']; ?></td>
    </tr>
</table>
<table border="0" width="100%">
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

<table border=0 width="70%" align="center">
    <tr>
        <td width="40px" bgcolor="#dcdcdc" align=left><strong>BODEGA</strong></td>
        <td width="50px" bgcolor="#dcdcdc" align=right><strong>PLAN DE ESTIBA</strong></td>
        <td width="50px" bgcolor="#dcdcdc" align=right><strong>DESCARGA</strong></td>
        <td width="40px" bgcolor="#dcdcdc" align=right><strong>POR DESCARGAR</strong></td>

    </tr>
    <?php
    $cantidad_total = 0;
    $peso_total_bodega_total =0;
    $diferencia_peso_total = 0;

    foreach($datos_bodegas as $nobodega=>$cantidad)
    {
        $peso_total_bodega =$this->salidas_lib->get_peso_total_bodega($cve_cliente,  $datos_buque['CONTRATO'], $nobodega);
        $diferencia_peso = $cantidad-$peso_total_bodega;

        $porciento_dif = 0;
        if($cantidad>0){
            $porciento_dif = ($peso_total_bodega*100)/$cantidad;
        }

        $cantidad_total += $cantidad;
        $peso_total_bodega_total += $peso_total_bodega;
        $diferencia_peso_total += $diferencia_peso;

        echo '<tr>';
        echo '<td>'.$nobodega.'</td>';
        echo '<td align=right>'.number_format($cantidad).'</td>';
        echo '<td  align=right>'.number_format($peso_total_bodega).'</td>';


        echo '<td align=right>';
        echo number_format($diferencia_peso);
        echo '</td>';
        echo '</tr>';
    }
    ?>
    <tr>
        <td>&nbsp;</td>
        <td align=right><b><?php echo number_format($cantidad_total); ?></b></td>
        <td align=right><b><?php echo number_format($peso_total_bodega_total); ?></b></td>
        <td align=right><b><?php echo number_format($diferencia_peso_total); ?></b></td>
    </tr>
</table>

