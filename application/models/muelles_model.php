<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Muelles_model extends CI_Model
{
    private $table_name = null;

    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'muelles';
        $this->load->database();
    }

    public function get_listado()
    {
        $query = $this->db->get($this->table_name);

        $lst = array();

        foreach ($query->result() as $row)
        {
            $lst[]   = $row;
        }

        return $lst;
    }


}