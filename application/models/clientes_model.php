<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Clientes_model extends CI_Model
{
    private $db_connection = null;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->db_connection = new COM("ADODB.Connection");

        $db_connstr = "DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=". realpath("../databases/Dropbox/Trabajo/".$this->session->userdata('nombre_bd_access')) ." ;DefaultDir=". realpath("../databasesDropbox/Trabajo");
        $this->db_connection->open($db_connstr);
    }

    public function __destruct()
    {
        $this->db_connection->Close();
    }

    public function get_claves($id_usuario)
    {
        $query = $this->db->query("SELECT clave
                                    FROM `claves_users`
                                    LEFT JOIN claves ON `claves_users`.id_clave = claves.id_clave
                                    WHERE id = ".$id_usuario);
        $lst_claves = array();
        foreach ($query->result() as $row)
        {
            $lst_claves[] = $row->clave;

        }

        return $lst_claves;
    }

    public function get_datos($clave_cliente = '')
    {

        $Array_result = array();

        if($clave_cliente<>''){
            $rs = $this->db_connection->execute("SELECT * FROM CLIENTES WHERE CLAVE_CLIENTE = '$clave_cliente'");

            $rs_fld0 = $rs->Fields(0); #Clave del contrato del cliente
            $rs_fld1 = $rs->Fields(1); #Clave del contrato del cliente
            $rs_fld2 = $rs->Fields(2); #contrato  del cliente
            $rs_fld3 = $rs->Fields(3); #nombre  del cliente

            while (!$rs->EOF) {
                $Array_result[$rs_fld0->name] = $rs_fld0->value;
                $Array_result[$rs_fld1->name] = $rs_fld1->value;
                $Array_result[$rs_fld2->name] = $rs_fld2->value;
                $Array_result[$rs_fld3->name] = $rs_fld3->value;
                $rs->MoveNext();
            }

            $rs->Close();
        }

        return $Array_result;
    }
}
//end of file Contratos_model