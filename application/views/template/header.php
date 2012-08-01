<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>
        <?php
        if($nombre_empresa = $this->session->userdata('nombre_empresa')){
            echo $nombre_empresa;
        }else{
            echo $this->config->item('nombre_sistema');
        }
        ?>
    </title>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=Emulate7" />

    <!-- Le styles with bootstrap 2.0.4-->
    <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/gasolineria.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/grocery_crud/css/ui/simple/jquery-ui-1.8.10.custom.css" rel="stylesheet">

    <?php
    if(isset($css_files)):
        foreach($css_files as $file): ?>
            <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
            <?php endforeach; ?>
        <?php foreach($js_files as $file): ?>
        <script src="<?php echo $file; ?>"></script>
        <?php endforeach;
    else:
        ?>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/flexigrid-1.1/css/flexigrid.pack.css" />
        <script type="text/javascript" src="<?php echo base_url();?>assets/grocery_crud/js/jquery-1.7.1.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/grocery_crud/js/jquery_plugins/jquery-ui-1.8.10.custom.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/jquery/jquery.formatCurrency-1.4.0.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/flexigrid-1.1/js/flexigrid.pack.js"></script>
        <?php
    endif;
    ?>


    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->


    <style type="text/css">
            /* Override some defaults */
        html, body {
            background-color: #eee;
        }
        body {
            padding-top: 40px; /* 40px to make the container go all the way to the bottom of the topbar */
        }
        .container > footer p {
            text-align: center; /* center align it with the container */
        }
        .container {
            width: 1024px; /* downsize our container to make the content feel a bit tighter and more cohesive. NOTE: this removes two full columns from the grid, meaning you only go to 14 columns and not 16. */
        }

            /* The white background content wrapper */
        .container > .content {
            background-color: #fff;
            padding: 20px;
            margin: 0 -20px; /* negative indent the amount of the padding to maintain the grid system */
            -webkit-border-radius: 0 0 6px 6px;
            -moz-border-radius: 0 0 6px 6px;
            border-radius: 0 0 6px 6px;
            -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.15);
            -moz-box-shadow: 0 1px 2px rgba(0,0,0,.15);
            box-shadow: 0 1px 2px rgba(0,0,0,.15);
        }

            /* Page header tweaks */
        .page-header {
            background-color: #f5f5f5;
            padding: 20px 20px 10px;
            margin: -20px -20px 20px;
        }

            /* Styles you shouldn't keep as they are for displaying this base example only */
        .content .span10,
        .content .span4 {
            min-height: 500px;
        }
            /* Give a quick and non-cross-browser friendly divider */
        .content .span4 {
            margin-left: 0;
            padding-left: 19px;
            border-left: 1px solid #eee;
        }

        .topbar .btn {
            border: 0;
        }

    </style>

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">

    <?php
    if(!$this->ion_auth->is_admin()){
        ?>
        <script>
            $(function() {
                $.datepicker.regional['es'] = {
                    closeText: 'Cerrar',
                    prevText: '&#x3c;Ant',
                    nextText: 'Sig&#x3e;',
                    currentText: 'Hoy',
                    monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
                        'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
                    monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
                        'Jul','Ago','Sep','Oct','Nov','Dic'],
                    dayNames: ['Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],
                    dayNamesShort: ['Dom','Lun','Mar','Mi&eacute;','Juv','Vie','S&aacute;b'],
                    dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;'],
                    weekHeader: 'Sm',
                    dateFormat: 'dd/mm/yy',
                    firstDay: 1,
                    isRTL: false,
                    showMonthAfterYear: false,
                    yearSuffix: ''};
                $.datepicker.setDefaults($.datepicker.regional['es']);

                $( "#from").datepicker();
                $( "#to").datepicker();
            });
        </script>
        <?php
    }
    ?>



</head>

<body>

<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
        <?php
                if(isset($uri))
                {

                        $ct = $uri['ct'];
                        $cl = $uri['cl'];

                    //echo anchor('contratos/get_datos/ct/'.$ct.'/cl/'.$cl, $ct,  array('class'=>'brand'));
                }else{
                    echo anchor('#',$this->config->item('nombre_sistema'),array('class'=>'brand'));
                }

            ?>
</a>
            <ul class="nav">
                <li>
                    <?php
                    if($this->ion_auth->is_admin()){
                        echo anchor('admin/grocery_usuarios','Usuarios');
                    }else{
                      //  echo anchor('contratos','Contratos');
                    }
                    ?>
                </li>

                <?php
                    if($this->ion_auth->is_admin()):
                        ?>

                        <li>
                            <?php echo anchor('admin/configuracion','Configuracion'); ?>
                        </li>
                        <div class="btn-group pull-right">
                            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="icon-print"></i> Reportes
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- <li><a href="#">Profile</a></li> -->
                                <li><?php echo anchor('reportes/saldo_por_cliente','Matriz de vencimientos'); ?></li>
                                <li class="divider"></li>
                                <li><?php echo anchor('reportes/saldo_por_cliente','Facturas con saldo'); ?></li>
                                <li><?php echo anchor('reportes/under_construction','Facturas por vencimiento'); ?></li>
                            </ul>
                        </div>
                        <?php

                        if($this->session->userdata('username') == 'root')
                        {
                            ?>
                            <li>
                                <?php echo anchor('admin/clientes', 'Clientes'); ?>
                            </li>
                            <?php
                        }
                        ?>

                        <?php
                   else:
                    ?>
                       <li>
                           <?php echo anchor('reportes/facturas_por_periodo','Facturas por periodo'); ?>
                       </li>
                       <li>
                           <?php echo anchor('reportes/consumos_por_periodo','Consumos por periodo'); ?>
                       </li>
                       <?php
                    endif;
                ?>
            </ul>

            <!-- <span class='pull-right'>
                Sesión iniciada como <a href="#"></a>
            </span>-->
            <div class="btn-group pull-right">
                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="icon-user"></i> <?php echo $this->session->userdata('username'); ?>
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <!-- <li><a href="#">Profile</a></li> -->
                    <li class="divider"></li>
                    <li><?php  echo anchor('auth/logout','Salir');?></li>
                </ul>
            </div>

        </div>

    </div>
</div>
<div class="container">

    <div class="content">