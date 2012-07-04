<div class="well">
    <h2>Seleccione el muelle</h2>


    <?php
        foreach($lst_muelles as $muelle){
            ?>
            <button class="btn primary large" type="button" onclick="window.open('select/<?php echo $muelle->archivo;?>','_self');"><?php echo $muelle->nombre; ?></button>
            <?php
        }
    ?>

</div>