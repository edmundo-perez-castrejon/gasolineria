<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Empresas_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_datos_empresa($id_empresa)
    {
        $query = $this->db->query('SELECT * FROM empresas WHERE id_empresa = '.$id_empresa.' LIMIT 1');
        if($query->num_rows()>0){
            return $query->row();
        }else{
            return FALSE;
        }

    }
}