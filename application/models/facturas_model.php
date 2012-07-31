<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Facturas_model extends CI_Model
{
    private $db_connection = null;

    public function __construct()
    {
        parent::__construct();

        $this->db_connection = new COM("ADODB.Connection");

        $db_connstr = "DRIVER={Microsoft Access Driver (*.mdb)}
        ;DBQ=". realpath("../databases/".$this->config->item('db_access_name')) ."
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


    public function get_datos_with_balance($client_id, $plazo){
        $hoy_dmy = date('m/d/Y');
        $sql = "
        SELECT FACTURA.FACTURA,
               FACTURA.FECHA,
               FACTURA.FECHA+$plazo AS VENCIMIENTO,
               #$hoy_dmy#-(FACTURA.FECHA+$plazo) AS DIASVENCIMIENTO,
               FACTURA.IMPORTE,
               SUM(ABONO) AS ABONOS,
               SUM(CONSUMO)-SUM(ABONO) AS SALDO
        FROM FACTURA LEFT JOIN MOVIMIENTOS
            ON FACTURA.FACTURA = MOVIMIENTOS.NUM_FACT
        WHERE FACTURA.CLIENTE_CLA = $client_id
            GROUP BY FACTURA.FACTURA,
                        FACTURA.FECHA,
                        FACTURA.IMPORTE
            HAVING SUM(CONSUMO)-SUM(ABONO)>0.1
            ORDER BY FACTURA.FECHA DESC
";
        $rs = $this->db_connection->execute($sql);

        return make_array_result($rs);
    }

    public function facturas_por_periodo($client_id, $inicio, $fin){
        $sql = "

        SELECT FACTURA.FACTURA,
               FACTURA.FECHA,
               FACTURA.VENCIMIENTO,
               FACTURA.VENCIMIENTO-FACTURA.FECHA AS DIASVENCIMIENTO,
               FACTURA.IMPORTE,
               SUM(ABONO) AS ABONOS,
               SUM(CONSUMO)-SUM(ABONO) AS SALDO
        FROM FACTURA LEFT JOIN MOVIMIENTOS
            ON FACTURA.FACTURA = MOVIMIENTOS.NUM_FACT
        WHERE FACTURA.CLIENTE_CLA = $client_id
            AND FACTURA.FECHA >= #".date_mdy($inicio)."# AND FACTURA.FECHA<=#".date_mdy($fin)."#
        GROUP BY FACTURA.FACTURA,
                FACTURA.FECHA,
                FACTURA.VENCIMIENTO,
                FACTURA.IMPORTE
        ORDER BY FACTURA.FECHA DESC
        ";

        $rs = $this->db_connection->execute($sql);

        return make_array_result($rs);
    }
}
//end of file Contratos_model