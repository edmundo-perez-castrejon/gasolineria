<?php
class Cliente extends DataMapper{
    var $has_one =  array('user');

    private $CI = null;

    public function __construct($id = ''){
        $this->CI =& get_instance();
        $this->CI->load->model('facturas_model');
        $this->CI->load->model('movimientos_model');
        parent::__construct($id);
    }

    public function facturas(){
        #Facturas con balance para eliminar las cuadradas

        $lst_facturas = $this->CI->facturas_model->get_datos_with_balance($this->clave_cliente);

        return $lst_facturas;
    }

    public function movimientos()
    {
        $lst_movs = $this->CI->movimientos_model->get_datos($this->clave_cliente);
        return $lst_movs;
    }

    public function movimientos_no_facturado()
    {
        $lst_movs = $this->CI->movimientos_model->no_facturado($this->clave_cliente);
        return $lst_movs;
    }
}

//end of filw