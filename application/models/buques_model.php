<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Buques_model extends CI_Model
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

    public function get_datos($clave_contrato = '')
    {

        $Array_result = array();

        if($clave_contrato<>''){
            $rs = $this->db_connection->execute("SELECT * FROM [datos buque] WHERE CONTRATO = '$clave_contrato'");

            $rs_fld0 = $rs->Fields(0);
            $rs_fld1 = $rs->Fields(1);
            $rs_fld2 = $rs->Fields(2);
            $rs_fld3 = $rs->Fields(3);
            $rs_fld4 = $rs->Fields(4);
            $rs_fld5 = $rs->Fields(5);
            $rs_fld6 = $rs->Fields(6);

            while (!$rs->EOF) {
                $Array_result[$rs_fld0->name] = $rs_fld0->value;
                $Array_result[$rs_fld1->name] = $rs_fld1->value;
                $Array_result[$rs_fld2->name] = $rs_fld2->value;
                $Array_result[$rs_fld3->name] = $rs_fld3->value;
                $Array_result[$rs_fld4->name] = $rs_fld4->value;
                $Array_result[$rs_fld5->name] = $rs_fld5->value;
                $Array_result[$rs_fld6->name] = $rs_fld6->value;
                $rs->MoveNext();
            }

            $rs->Close();
        }

        return $Array_result;
    }
}
//end of file Contratos_model