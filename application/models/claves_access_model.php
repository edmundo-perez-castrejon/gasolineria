<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Claves_access_model extends CI_Model
{
    private $db_connection = null;

    public function __construct()
    {
        parent::__construct();
        $this->db_connection = new COM("ADODB.Connection");

        $db_connstr = "DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=". realpath("../databases/Dropbox/Trabajo/".$this->session->userdata('nombre_bd_access')) ." ;DefaultDir=". realpath("../databases/Dropbox/Trabajo/");
        $this->db_connection->open($db_connstr);
    }

    public function __destruct()
    {
        $this->db_connection->Close();
    }

    public function get_claves()
    {

        $Array_result = array();


        $rs = $this->db_connection->execute("SELECT [clave_cliente], [contrato_cliente] FROM CLIENTES");

        $rs_fld0 = $rs->Fields(0);
        $rs_fld1 = $rs->Fields(1);


        while (!$rs->EOF) {
            #array_result['bodega1'] = 'cantidad de la bodega 1'
            $Array_result[] = array('clave_cliente'=>$rs_fld0->value, 'clave_contrato'=>$rs_fld1->value);

            $rs->MoveNext();
        }

        $rs->Close();

        return $Array_result;
    }
}
//end of file Contratos_model