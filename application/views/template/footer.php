
</div>

<footer>
    <p>&copy;
        <?php
        if($nombre_empresa = $this->session->userdata('nombre_empresa')){
            echo $nombre_empresa;
        }else{
            echo $this->config->item('nombre_sistema');
        }
        ?>
    </p>

</footer>

</div> <!-- /container -->

<script type="text/javascript" src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.js"></script>

</body>
</html>
