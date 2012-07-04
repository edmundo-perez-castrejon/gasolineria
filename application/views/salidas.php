<head>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/flexigrid-1.1/css/flexigrid.pack.css" />
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.5.2.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/flexigrid-1.1/js/flexigrid.pack.js"></script>

</head>
<h1>Salidas</h1>

    <hr><h3>Bodegas</h3>
<table BORDER="2">
    <tr><td>bodega</td><td>Total</td></tr>
    <?php
    foreach($lst_detalle_bodegas as $bodega)
    {
        echo '<tr>';
        echo '<td>'.$bodega['CLAVE_BODEGA_DESTINO'].'</td>';
        echo '<td>'.$bodega['TOTAL'].'</td>';
        echo '</tr>';

    }

    ?>
    <tr><td>Gran total</td><td><strong><?php echo $peso_bruto_total; ?></strong></td></tr>
</table>
<?php

?>
    <hr><h3>Detalle</h3>
    <table  class="flexme1">
        <thead>
        <tr>
            <th width="100">Bodega</th>
            <th width="100">Placas</th>
            <th width="100">Chofer</th>
            <th width="100">Marca camion</th>
            <th width="100">Sellos</th>
            <th width="100">No Carro</th>
            <th width="100">Cantidas_sacos</th>
            <th width="100">Fecha</th>
            <th width="100">Peso bruto</th>
            <th width="100">tara</th>
            <th width="100">Descargar2</th>
            <th width="100" >Placas jaula</th>
        </tr>
        </thead>
        <tbody>

        <?php

            foreach($lst_salidas as $salida){
                echo '<tr>';
                echo '<td>'.$salida['PLACAS'].'</td>';
                echo '<td>'.$salida['CHOFER'].'</td>';
                echo '<td>'.$salida['MARCA_CAMION'].'</td>';
                echo '<td>'.$salida['SELLOS'].'</td>';
                echo '<td>'.$salida['NO_CARRO'].'</td>';
                echo '<td>'.$salida['CANTIDAD_SACOS'].'</td>';
                echo '<td>'.$salida['FECHA'].'</td>';
                echo '<td>'.$salida['PESO_BRUTO'].'</td>';
                echo '<td>'.$salida['TARA'].'</td>';
                echo '<td>'.$salida['DESCARGAR2'].'</td>';
                echo '<td>'.$salida['PLACAS_JAULA'].'</td>';
                echo '</tr>';
            }
        ?>
        </tbody>
    </table>

<script type="text/javascript">
    $('.flexme1').flexigrid();
</script>