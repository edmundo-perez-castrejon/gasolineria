<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo $this->config->item('nombre_sistema');?></title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le styles -->
    <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/gasolineria.css" rel="stylesheet">

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
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
            <a class="brand" href="#"><?php echo $this->config->item('nombre_sistema');?></a>
            <div class="nav-collapse">
                <ul class="nav">
                    <li class="active"><a href="#">Inicio</a></li>
                    <li><a href="#contact">Contacto</a></li>
                </ul>
            </div>

            <?php echo form_open("auth/login", array('class'=>'navbar-form pull-right'));?>
                <input class="input-small" type="text" placeholder="Usuario" id="identity" name="identity">
                <input class="input-small" type="password" placeholder="Clave" id="password" name="password">
                <button class="btn btn-success" type="submit">Acceder</button>
            </form>

            <div id="infoMessage" style="color: #FF7171;"><?php echo $message;?></div>
        </div>

    </div>
</div>

<div class="container">

    <div class="hero-unit">
        <div class="row">

            <div align="center">
                <img src="<?php echo $imagen_frontal;?>" width="600" />
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; <?php echo $this->config->item('nombre_sistema');?> 2012</p>
    </footer>

</div> <!-- /container -->

</body>
</html>
