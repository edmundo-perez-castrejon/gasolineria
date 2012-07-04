<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Salidas_lib {

    private $CI = null;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->model(array('salidas_model','destinos_model'));
    }

    public function get_peso_total($cve_destino = '')
    {
        $this->lst_salidas = array();
        $this->lst_salidas = $this->CI->salidas_model->get_datos($cve_destino);

        $suma_peso_bruto = 0;
        foreach($this->lst_salidas as $salida){
            $suma_peso_bruto += $salida['PESO_BRUTO']-$salida['TARA'];
        }

        return $suma_peso_bruto;
    }

    public function get_peso_total_bodega($cve_cliente = '', $cve_contrato ='', $cve_bodega = '')
    {
        $lst_destinos = $this->CI->destinos_model->get_datos($cve_cliente, $cve_contrato);

        $suma_bodega = 0;
        foreach($lst_destinos as $destino){
            $lst_bodegas_destino = $this->CI->salidas_model->get_salidas_por_bodega($destino['CLAVE_DESTINO']);
            foreach($lst_bodegas_destino as $bodega_destino){
                if($bodega_destino['CLAVE_BODEGA_DESTINO']==$cve_bodega){
                    $suma_bodega += $bodega_destino['TOTAL'];
                }
            }
        }

        return $suma_bodega;
    }
}
// fin del archivo de libreria