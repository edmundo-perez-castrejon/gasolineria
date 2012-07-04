

<H1><?PHP echo $nombre_cliente;?> </H1>

<table class="flexme1">
    <thead>
        <th WIDTH="130">Contrato/Cliente</th>
        <th width="250">Buque</th>
        <th width="300">Producto</th>
        <th width="142">Fecha de arribo</th>
        <th width="144">Fecha de terminacion</th>
    </thead>
    <tbody>
        <?php
        foreach($lst_contratos as $contrato)
        {
            ?>
            <tr>
                <td><?php echo anchor('contratos/get_datos/ct/'.$contrato['CONTRATO'].'/cl/'.$contrato['clave_cliente'], $contrato['CONTRATO'].'/'.$contrato['clave_cliente']);?> </td>
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

<div align="center">
    <button class="btn success" type="button" onclick="window.open('reportes/rpt_contratos');">Imprimir Reporte</button>
</div>


<script type="text/javascript">
    $('.flexme1').flexigrid();
</script>