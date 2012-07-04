        <div class="content">

                <h1>Contrato <?php echo $datos_buque['CONTRATO'];?></h1>
                <h3>Buque <?php echo $datos_buque['BUQUE']; ?> Proveedor <?php echo $datos_buque['NOMBRE_PROVEEDOR'];?></h3>
                <h3> Producto <?php echo $datos_buque['NOMBRE_PRODUCTO']; ?></h3>



            <table  class="flexme1">
                <thead>
                    <tr>
                        <th width="350">Destino</th>
                        <th width="150">Maxima captura</th>
                        <th width="150">Ordenado</th>
                        <th width="150">Total de salidas</th>
                        <th width="150">Diferencia</th>


                    </tr>
                </thead>
                <tbody>
                <?php

                foreach($datos_destinos as $destino){
                    $total_de_salidas = $this->salidas_lib->get_peso_total($destino['CLAVE_DESTINO']);
                    ?>
                    <tr>
                        <td><?php echo anchor('salidas/info_salidas/'.$destino['CLAVE_DESTINO'],$destino['NOMBRE_DESTINO']); ?></td>
                        <td><?php echo $destino['MAXIMA_CAPTURA']; ?></td>
                        <td><?php echo $destino['ORDENADO']; ?></td>
                        <td><?php echo $total_de_salidas;?></td>
                        <td><?php echo $destino['ORDENADO']-$total_de_salidas;?></td>

                    </tr>
                    <?php
                }

                ?>

                </tbody>
            </table>



        </div>

        <script type="text/javascript">
            $('.flexme1').flexigrid();
        </script>