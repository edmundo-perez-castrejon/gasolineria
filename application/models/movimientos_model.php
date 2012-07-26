<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Movimientos_model extends CI_Model
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

    public function by_factura($numero_factura){
        $Array_result = array();

        $rs = $this->db_connection->execute("SELECT * FROM MOVIMIENTOS WHERE NUM_FACT = '$numero_factura'
        ORDER BY FECHA");

        $rs_fld0 = $rs->Fields(0); #FOLIO
        $rs_fld1 = $rs->Fields(1); #CLAVE_CLIENTE_MOV
        $rs_fld2 = $rs->Fields(2); #FECHA
        $rs_fld3 = $rs->Fields(3); #UNIDAD
        $rs_fld4 = $rs->Fields(4); #PLACAS
        $rs_fld5 = $rs->Fields(5); #TICKET
        $rs_fld6 = $rs->Fields(6); #KMS
        $rs_fld7 = $rs->Fields(7); #LTS
        $rs_fld8 = $rs->Fields(8); #CLAVE_PRODUCTO_MOV
        $rs_fld9 = $rs->Fields(9); #PRECIO_PROD_MOV
        $rs_fld10 = $rs->Fields(10); #CONSUMO
        $rs_fld11 = $rs->Fields(11); #ABONO
        $rs_fld12 = $rs->Fields(12); #REFERENCIA
        $rs_fld13 = $rs->Fields(13); #VALE_NOTA
        $rs_fld14 = $rs->Fields(14); #NUM_FACT
        $rs_fld15 = $rs->Fields(15); #FACTURADO
        $rs_fld16 = $rs->Fields(16); #CONSUMO_FACT


        while (!$rs->EOF) {

            $Array_result[] = array(
                $rs_fld0->name => $rs_fld0->value,
                $rs_fld1->name => $rs_fld1->value,
                $rs_fld2->name => $rs_fld2->value,
                $rs_fld3->name => $rs_fld3->value,
                $rs_fld4->name => $rs_fld4->value,
                $rs_fld5->name => $rs_fld5->value,
                $rs_fld6->name => $rs_fld6->value,
                $rs_fld7->name => $rs_fld7->value,
                $rs_fld8->name => $rs_fld8->value,
                $rs_fld9->name => $rs_fld9->value,
                $rs_fld10->name => $rs_fld10->value,
                $rs_fld11->name => $rs_fld11->value,
                $rs_fld12->name => $rs_fld12->value,
                $rs_fld13->name => $rs_fld13->value,
                $rs_fld14->name => $rs_fld14->value,
                $rs_fld15->name => $rs_fld15->value,
                $rs_fld16->name => $rs_fld16->value
            );

            $rs->MoveNext();
        }

        $rs->Close();
        return $Array_result;
    }

    public function get_datos($client_id)
    {
        $Array_result = array();

        $rs = $this->db_connection->execute("SELECT * FROM MOVIMIENTOS WHERE CLAVE_CLIENTE_MOV = $client_id
        ORDER BY FOLIO DESC");

        $rs_fld0 = $rs->Fields(0); #FOLIO
        $rs_fld1 = $rs->Fields(1); #CLAVE_CLIENTE_MOV
        $rs_fld2 = $rs->Fields(2); #FECHA
        $rs_fld3 = $rs->Fields(3); #UNIDAD
        $rs_fld4 = $rs->Fields(4); #PLACAS
        $rs_fld5 = $rs->Fields(5); #TICKET
        $rs_fld6 = $rs->Fields(6); #KMS
        $rs_fld7 = $rs->Fields(7); #LTS
        $rs_fld8 = $rs->Fields(8); #CLAVE_PRODUCTO_MOV
        $rs_fld9 = $rs->Fields(9); #PRECIO_PROD_MOV
        $rs_fld10 = $rs->Fields(10); #CONSUMO
        $rs_fld11 = $rs->Fields(11); #ABONO
        $rs_fld12 = $rs->Fields(12); #REFERENCIA
        $rs_fld13 = $rs->Fields(13); #VALE_NOTA
        $rs_fld14 = $rs->Fields(14); #NUM_FACT
        $rs_fld15 = $rs->Fields(15); #FACTURADO
        $rs_fld16 = $rs->Fields(16); #CONSUMO_FACT


        while (!$rs->EOF) {

            $Array_result[] = array(
                $rs_fld0->name => $rs_fld0->value,
                $rs_fld1->name => $rs_fld1->value,
                $rs_fld2->name => $rs_fld2->value,
                $rs_fld3->name => $rs_fld3->value,
                $rs_fld4->name => $rs_fld4->value,
                $rs_fld5->name => $rs_fld5->value,
                $rs_fld6->name => $rs_fld6->value,
                $rs_fld7->name => $rs_fld7->value,
                $rs_fld8->name => $rs_fld8->value,
                $rs_fld9->name => $rs_fld9->value,
                $rs_fld10->name => $rs_fld10->value,
                $rs_fld11->name => $rs_fld11->value,
                $rs_fld12->name => $rs_fld12->value,
                $rs_fld13->name => $rs_fld13->value,
                $rs_fld14->name => $rs_fld14->value,
                $rs_fld15->name => $rs_fld15->value,
                $rs_fld16->name => $rs_fld16->value
            );

            $rs->MoveNext();
        }

        $rs->Close();
        return $Array_result;
    }

    public function no_facturado($client_id)
    {
        $Array_result = array();

        $rs = $this->db_connection->execute("SELECT * FROM MOVIMIENTOS WHERE CLAVE_CLIENTE_MOV = $client_id
        AND FACTURADO = 0 AND ABONO = 0 ORDER BY FOLIO DESC");

        $rs_fld0 = $rs->Fields(0); #FOLIO
        $rs_fld1 = $rs->Fields(1); #CLAVE_CLIENTE_MOV
        $rs_fld2 = $rs->Fields(2); #FECHA
        $rs_fld3 = $rs->Fields(3); #UNIDAD
        $rs_fld4 = $rs->Fields(4); #PLACAS
        $rs_fld5 = $rs->Fields(5); #TICKET
        $rs_fld6 = $rs->Fields(6); #KMS
        $rs_fld7 = $rs->Fields(7); #LTS
        $rs_fld8 = $rs->Fields(8); #CLAVE_PRODUCTO_MOV
        $rs_fld9 = $rs->Fields(9); #PRECIO_PROD_MOV
        $rs_fld10 = $rs->Fields(10); #CONSUMO
        $rs_fld11 = $rs->Fields(11); #ABONO
        $rs_fld12 = $rs->Fields(12); #REFERENCIA
        $rs_fld13 = $rs->Fields(13); #VALE_NOTA
        $rs_fld14 = $rs->Fields(14); #NUM_FACT
        $rs_fld15 = $rs->Fields(15); #FACTURADO
        $rs_fld16 = $rs->Fields(16); #CONSUMO_FACT


        while (!$rs->EOF) {

            $Array_result[] = array(
                $rs_fld0->name => $rs_fld0->value,
                $rs_fld1->name => $rs_fld1->value,
                $rs_fld2->name => $rs_fld2->value,
                $rs_fld3->name => $rs_fld3->value,
                $rs_fld4->name => $rs_fld4->value,
                $rs_fld5->name => $rs_fld5->value,
                $rs_fld6->name => $rs_fld6->value,
                $rs_fld7->name => $rs_fld7->value,
                $rs_fld8->name => $rs_fld8->value,
                $rs_fld9->name => $rs_fld9->value,
                $rs_fld10->name => $rs_fld10->value,
                $rs_fld11->name => $rs_fld11->value,
                $rs_fld12->name => $rs_fld12->value,
                $rs_fld13->name => $rs_fld13->value,
                $rs_fld14->name => $rs_fld14->value,
                $rs_fld15->name => $rs_fld15->value,
                $rs_fld16->name => $rs_fld16->value
            );

            $rs->MoveNext();
        }

        $rs->Close();
        return $Array_result;
    }
}
//end of file Contratos_model