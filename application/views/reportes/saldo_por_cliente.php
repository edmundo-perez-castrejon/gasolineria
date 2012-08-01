<h1><?php echo $title ?></h1>

<p>Seleccione el cliente: </p>

<?php echo form_open('reportes/'.$form_action,'method=POST') ?>
<div>
    <?php    echo form_dropdown('clientes', $clientes,0,'id="cmb_clientes"'); ?>
</div>
<span class="btn btn-success" onclick="submit();">Imprimir reporte</span>
</form>

