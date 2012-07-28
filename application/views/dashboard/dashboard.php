
<div class="page-header">
    <span id='nombre_cliente'><?php echo $user->cliente->razon_social ?></span>
    <span class='saldo' id='saldo_total'>$0.00</span>
    <span class="label label-info" id="gran_total">Gran Total</span>
</div>

<div class='mainInfo'>
    <div class="row">

        <div align="center">
            <?php
                echo $partial_movimientos_pendientes;
                echo $partial_facturas_pendientes;
            ?>
            <?PHP
            //echo anchor('/reportes/dashboard','Imprimir Reporte', array('class'=>'btn success'));
            ?>
        </div>
    </div>
</div>

<script language="javascript">
    $(document).ready(function() {
        var facturado  = parseFloat(document.getElementsByName('saldo_facturado')[0].value );
        var sinfacturar  = parseFloat(document.getElementsByName('saldo_sinfacturar')[0].value );
        var grantotal = facturado + sinfacturar;

        $('#saldo_total').text(grantotal);
        $('#saldo_total').formatCurrency();
    });
</script>