<h1><?php echo $title ?></h1>

<p>Seleccione el cliente: </p>

<?php echo form_open('reportes/'.$form_action,'method=POST') ?>
<div>
    <?php    
    	echo form_dropdown('clientes', $clientes,0,'id="cmb_clientes"');
    ?>
</div>
<div>
	<?php
		$data = array(
			    'name'        => 'radioorden',
			    'id'          => 'radioorden_deuda',
			    'value'       => 'deuda',
			    'checked'	  => TRUE
			    );
		echo form_radio($data);
		echo form_label('Ordenado por deuda','radioorden_deuda');
		echo '<br>';
		$data = array(
			    'name'        => 'radioorden',
			    'id'          => 'radioorden_nombre',
			    'value'       => 'nombre',
			    );
		echo form_radio($data);
		echo form_label('Ordenado por nombre','radioorden_nombre');
	?>
</div>

<span class="btn btn-success" onclick="submit();">Imprimir reporte</span>
</form>

