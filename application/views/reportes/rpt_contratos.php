<div class="content">
<H1>REPORTE DE CONTRATOS</H1>
<br>
    <br>
    <hr>
<table >
    <tr>
    <td width="150px">Contrato/Cliente</td>
    <td width="250px">Buque</td>
    <td width="250px">Producto</td>
    <td width="140px">Fecha de arribo</td>
    <td width="140px">Fecha de terminacion</td>
    </tr>
    <tbody>
    <?php
    foreach($lst_contratos as $contrato)
    {
        ?>
    <tr>
        <td><?php echo $contrato['CONTRATO'].'/'.$contrato['clave_cliente'];?> </td>
        <td><?php echo $contrato['BUQUE'];?></td>
        <td><?php echo $contrato['NOMBRE_PRODUCTO'];?></td>
        <td><?php echo $contrato['FECHA_ARRIBO'];?></td>
        <td><?php echo $contrato['FECHA_TERMINACION'];?></td>
    </tr>
        <?php
    }
    ?>
    </tbody>
</table>

</DIV>