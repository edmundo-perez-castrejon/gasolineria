<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Claves_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_claves()
    {
        $query = $this->db->query('SELECT clave FROM claves');

        $lst_claves = array();

        foreach ($query->result() as $row)
        {
            $lst_claves[] = $row->clave;
        }

        return $lst_claves;
    }

    public function nueva($data)
    {
        if($this->db->insert('claves', $data))
        {
            return TRUE;
        }else{
            return FALSE;
        }
    }

}