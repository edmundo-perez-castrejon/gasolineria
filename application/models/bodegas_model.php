<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Bodegas_model extends CI_Model
{
    private $db_connection = null;

    public function __construct()
    {
        parent::__construct();
        $this->db_connection = new COM("ADODB.Connection");

        $db_connstr = "DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=". realpath("../databases/Dropbox/Trabajo/".$this->session->userdata('nombre_bd_access')) ." ;DefaultDir=". realpath("../databases/Dropbox/Trabajo");
        $this->db_connection->open($db_connstr);
    }

    public function __destruct()
    {
        $this->db_connection->Close();
    }

    public function get_datos($cve_contrato = '')
    {

        $Array_result = array();

        if($cve_contrato<>''){
            $rs = $this->db_connection->execute("SELECT * FROM bodegas WHERE CONTRATO_BODEGAS = '$cve_contrato'
                                                   ORDER BY BODEGA ");

#            $rs_fld0 = $rs->Fields(0);
            $rs_fld1 = $rs->Fields(1);
            $rs_fld2 = $rs->Fields(2);

            while (!$rs->EOF) {
                #array_result['bodega1'] = 'cantidad de la bodega 1'
                $Array_result[$rs_fld1->value] = $rs_fld2->value;

                $rs->MoveNext();
            }

            $rs->Close();
        }

        return $Array_result;
    }
}
//end of file Contratos_model