<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Salidas_model extends CI_Model
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

    public function get_salidas_por_bodega($cve_destino ='')
    {
        $CadenaSQL = "SELECT CLAVE_BODEGA_DESTINO, SUM(PESO_BRUTO-TARA) AS TOTAL
                        FROM SALIDAS
                        WHERE DESTINO_SALIDA = '$cve_destino'
                        GROUP BY CLAVE_BODEGA_DESTINO";

        $Array_result = array();

        if($cve_destino<>''){
            $rs = $this->db_connection->execute($CadenaSQL);

            $rs_fld0 = $rs->Fields(0);
            $rs_fld1 = $rs->Fields(1);

            $i = 0;
            while (!$rs->EOF) {
                $Array_result[$i][$rs_fld0->name] = $rs_fld0->value;
                $Array_result[$i][$rs_fld1->name] = $rs_fld1->value;
                $rs->MoveNext();

                $i++;
            }

            $rs->Close();
        }

        return $Array_result;
    }

    public function get_datos($cve_destino = '')
    {
        $CadenaSQL = "SELECT * FROM SALIDAS WHERE DESTINO_SALIDA = '$cve_destino' ORDER BY FECHA";

        $Array_result = array();

        if($cve_destino<>''){
            $rs = $this->db_connection->execute($CadenaSQL);

            $rs_fld0 = $rs->Fields(0);
            $rs_fld1 = $rs->Fields(1);
            $rs_fld2 = $rs->Fields(2);
            $rs_fld3 = $rs->Fields(3);
            $rs_fld4 = $rs->Fields(4);
            $rs_fld5 = $rs->Fields(5);
            $rs_fld6 = $rs->Fields(6);
            $rs_fld7 = $rs->Fields(7);
            $rs_fld8 = $rs->Fields(8);
            $rs_fld9 = $rs->Fields(9);
            $rs_fld10 = $rs->Fields(10);
            $rs_fld11 = $rs->Fields(11);
            $rs_fld12 = $rs->Fields(12);
            $rs_fld13 = $rs->Fields(13);
            $rs_fld14 = $rs->Fields(14);
            $rs_fld15 = $rs->Fields(15);
            $rs_fld16 = $rs->Fields(16);
            $rs_fld17 = $rs->Fields(17);
            $rs_fld18 = $rs->Fields(18);
            $rs_fld19 = $rs->Fields(19);
            $i = 0;
            while (!$rs->EOF) {
                $Array_result[$i][$rs_fld0->name] = $rs_fld0->value;
                $Array_result[$i][$rs_fld1->name] = $rs_fld1->value;
                $Array_result[$i][$rs_fld2->name] = $rs_fld2->value;
                $Array_result[$i][$rs_fld3->name] = $rs_fld3->value;
                $Array_result[$i][$rs_fld4->name] = $rs_fld4->value;
                $Array_result[$i][$rs_fld5->name] = $rs_fld5->value;
                $Array_result[$i][$rs_fld6->name] = $rs_fld6->value;
                $Array_result[$i][$rs_fld7->name] = $rs_fld7->value;
                $Array_result[$i][$rs_fld8->name] = $rs_fld8->value;
                $Array_result[$i][$rs_fld9->name] = $rs_fld9->value;
                $Array_result[$i][$rs_fld10->name] = $rs_fld10->value;
                $Array_result[$i][$rs_fld11->name] = $rs_fld11->value;
                $Array_result[$i][$rs_fld12->name] = $rs_fld12->value;
                $Array_result[$i][$rs_fld13->name] = $rs_fld13->value;
                $Array_result[$i][$rs_fld14->name] = $rs_fld14->value;
                $Array_result[$i][$rs_fld15->name] = $rs_fld15->value;
                $Array_result[$i][$rs_fld16->name] = $rs_fld16->value;
                $Array_result[$i][$rs_fld17->name] = $rs_fld17->value;
                $Array_result[$i][$rs_fld18->name] = $rs_fld18->value;
                $Array_result[$i][$rs_fld19->name] = $rs_fld19->value;
                $rs->MoveNext();

                $i++;
            }

            $rs->Close();
        }

        return $Array_result;
    }
}
//end of file Contratos_model