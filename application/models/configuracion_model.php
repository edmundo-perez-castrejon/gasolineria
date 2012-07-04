<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Configuracion_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_imagen_frontal()
    {
        $query = $this->db->query('SELECT imagen_frontal FROM configuracion');

        $row = $query->result();

        return $row[0]->imagen_frontal;
    }
}