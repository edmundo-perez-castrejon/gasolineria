<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Claves_lib {

    private $CI = null;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->model(array('claves_model','claves_access_model'));
    }

    public function sincroniza()
    {
        $lst_claves = $this->CI->claves_model->get_claves ();
        $lst_claves_access = $this->CI->claves_access_model->get_claves();

        $lst_sync = array();

        foreach($lst_claves_access as $cve_accss)
        {
            $encontrado = FALSE;
            foreach($lst_claves as $cve)
            {
                if($cve == $cve_accss['clave_cliente']){
                    $encontrado = TRUE;
                }
            }

            if(!$encontrado)
            {
                $lst_sync[]= $cve_accss;
            }
        }

        foreach($lst_sync as $new_cve)
        {
            $data = array(
                'clave' => $new_cve['clave_cliente'],
                'contrato' => $new_cve['clave_contrato']
            );
            $this->CI->claves_model->nueva($data);
        }

       return count($lst_sync);
    }
}