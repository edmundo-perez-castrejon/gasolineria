<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Clientes_model extends CI_Model
{
    private $db_connection = null;

    public function __construct()
    {
        parent::__construct();
        $this->db_connection = new COM("ADODB.Connection");

        $db_connstr = "DRIVER={Microsoft Access Driver (*.mdb)}
        ;DBQ=". realpath("../databases/CONTROL2009.mdb") ."
        ;PWD=HUMY
        ;DefaultDir=". realpath("../databases");

        $this->db_connection->open($db_connstr);
    }

    public function __destruct()
    {
        $this->db_connection->Close();
    }

    public function get_datos()
    {

        $Array_result = array();

        $rs = $this->db_connection->execute("SELECT * FROM CLIENTES");

        $rs_fld0 = $rs->Fields(0); #CLAVE_CLIENTE
        $rs_fld1 = $rs->Fields(1); #RAZON SOCIAL
        $rs_fld2 = $rs->Fields(6); #RFC
        $rs_fld3 = $rs->Fields(2); #DOMICILIO
            $rs_fld4 = $rs->Fields(3); #COLONIA
            $rs_fld5 = $rs->Fields(4); #CIUDAD
            $rs_fld6 = $rs->Fields(5); #ESTADO
        $rs_fld7 = $rs->Fields(11); #CONTACTO

        while (!$rs->EOF) {
            $Array_result[] = array($rs_fld0->name => $rs_fld0->value,
                                    $rs_fld1->name => $rs_fld1->value,
                                    $rs_fld2->name => $rs_fld2->value,
                                    $rs_fld3->name => $rs_fld3->value,
                                    $rs_fld4->name => $rs_fld4->value,
                                    $rs_fld5->name => $rs_fld5->value,
                                    $rs_fld6->name => $rs_fld6->value,
                                    $rs_fld7->name => $rs_fld7->value);

            $rs->MoveNext();
        }

        $rs->Close();
        return $Array_result;
    }
}
//end of file Contratos_model