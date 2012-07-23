<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Facturas_model extends CI_Model
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

        $this->load->database();
    }

    public function __destruct()
    {
        $this->db_connection->Close();
    }

    public function get_datos($client_id)
    {

        $Array_result = array();

        $rs = $this->db_connection->execute("SELECT * FROM FACTURA WHERE CLIENTE_CLA = $client_id ORDER BY FECHA DESC");

        $rs_fld0 = $rs->Fields(0); #FACTURA
        $rs_fld1 = $rs->Fields(1); #FECHA
        $rs_fld2 = $rs->Fields(2); #IMPORTE
        $rs_fld3 = $rs->Fields(3); #CLIENTE
        $rs_fld4 = $rs->Fields(4); #VENCIMIENTO


        while (!$rs->EOF) {

            $Array_result[] = array($rs_fld0->name => $rs_fld0->value,
                $rs_fld1->name => $rs_fld1->value,
                $rs_fld2->name => $rs_fld2->value,
                $rs_fld3->name => $rs_fld3->value,
                $rs_fld4->name => $rs_fld4->valuE
            );

            $rs->MoveNext();
        }

        $rs->Close();
        return $Array_result;
    }

    public function get_datos_with_balance($client_id){

        $this->load->model('movimientos_model');

        $Array_result = array();

        $rs = $this->db_connection->execute("SELECT * FROM FACTURA WHERE CLIENTE_CLA = $client_id ORDER BY FECHA DESC");

        $rs_fld0 = $rs->Fields(0); #FACTURA
        $rs_fld1 = $rs->Fields(1); #FECHA
        $rs_fld2 = $rs->Fields(2); #IMPORTE
        $rs_fld3 = $rs->Fields(3); #CLIENTE
        $rs_fld4 = $rs->Fields(4); #VENCIMIENTO


        while (!$rs->EOF) {

            $Array_result[] = array($rs_fld0->name => $rs_fld0->value,
                $rs_fld1->name => $rs_fld1->value,
                $rs_fld2->name => $rs_fld2->value,
                $rs_fld3->name => $rs_fld3->value,
                $rs_fld4->name => $rs_fld4->value,
                'BALANCE' => $this->movimientos_model->get_balance($rs_fld0->value)
            );

            $rs->MoveNext();
        }

        $rs->Close();
        return $Array_result;
    }
}
//end of file Contratos_model