<h1>Saldo por Cliente</h1>

<p>Seleccione el cliente: </p>

<?php echo form_open('reportes/saldo_por_cliente_pdf','method=POST') ?>
<div>
    <?php    echo form_dropdown('clientes', $clientes,0,'id="cmb_clientes"'); ?>
</div>
<span class="btn btn-success" onclick="submit();">Imprimir reporte</span>
</form>

