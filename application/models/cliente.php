<?php
class Cliente extends DataMapper{
    var $has_one =  array('user');

    private $CI = null;
    public $access_data = null;

    public function __construct($id = ''){
        $this->CI =& get_instance();
        $this->CI->load->model(array('facturas_model', 'movimientos_model','clientes_model'));
        parent::__construct($id);
    }

    public function facturas(){
        #Facturas con balance para eliminar las cuadradas
        $lst_facturas = $this->CI->facturas_model->get_datos_with_balance($this->clave_cliente, $this->get_plazo());

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

    public function facturas_por_periodo($inicio, $fin)
    {
        $lst_facturas = $this->CI->facturas_model->facturas_por_periodo($this->clave_cliente, $inicio, $fin);
        return $lst_facturas;
    }

    public function movimientos_por_periodo($inicio, $fin)
    {
        $lst_movs = $this->CI->movimientos_model->movimientos_por_periodo($this->clave_cliente, $inicio, $fin);
        return $lst_movs;
    }

    public function get_plazo()
    {
        $this->load_access_data();
        return $this->access_data[0]['PLAZO'];
    }

    private function load_access_data()
    {
        if($this->access_data == null){
            $this->access_data = $this->CI->clientes_model->get_datos_access($this->clave_cliente);
        }
    }
}

//end of filw