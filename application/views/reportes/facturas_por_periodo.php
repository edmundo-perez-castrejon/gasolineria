<div class="page-header">
    <h2>Reporte de facturas por periodo
</div>
Consultar las facturas en el periodo:
<input type="text" id="from" value="<?php echo '01/'.date('m').'/'.date('Y');?>"/> -
<input type="text" id="to" value="<?php echo date('d/m/Y');?>"/>
    <span class='btn success' id='btn_consulta'>Consultar</span>
<div id='resultados'>
    ---
</div>

<script language="javascript">
    $('#btn_consulta').click(function(e){
        e.preventDefault();
        var from    = $('#from').val();
        var to      = $('#to').val();

        if(from=='' || to==''){
            alert('Seleccione un rango válido de fechas');
            return;
        }

        $('#resultados').html('Cargando datos...');
        $.ajax({
            url: '<?php echo base_url(); ?>/index.php/reportes/facturas_por_periodo_ajax',
            type: 'POST',
            data: {inicio: from, fin: to},
            success: function(data) {
                $('#resultados').html(data);
            }
        });
    })
</script>