<?php
echo anchor('/reportes/movimientos_por_periodo_pdf/'.str_replace('/','-',$inicio).'/'.str_replace('/','-',$fin),'Imprimir', array('class'=>'btn btn-success'));
?>