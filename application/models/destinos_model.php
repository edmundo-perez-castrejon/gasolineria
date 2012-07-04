<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Destinos_model extends CI_Model
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

    public function get_datos($cve_cliente = '', $cve_contrato = '')
    {

        #Si es un superusuario ignoraremos la clave del cliente que traiga para traer los datos de todos lso clientes del contrato
        if($this->session->userdata('superusuario')==1){
            $cve_cliente = '';
        }

        $Array_result = array();


        if($cve_cliente<>''){
            $CadenaSQL = "SELECT * FROM DESTINOS WHERE CLIENTE_DESTINO = '$cve_cliente' and CONTRATO_DESTINO = '$cve_contrato'";
        }else{
            $CadenaSQL = "SELECT * FROM DESTINOS WHERE CONTRATO_DESTINO = '$cve_contrato'";
        }

        if($this->config->item('dev_mode')){
            echo $CadenaSQL;
        }

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



        while (!$rs->EOF) {
            $Array_result[] = array($rs_fld0->name=>$rs_fld0->value,
                $rs_fld1->name=>$rs_fld1->value,
                $rs_fld2->name=>$rs_fld2->value,
                $rs_fld3->name=>$rs_fld3->value,
                $rs_fld4->name=>$rs_fld4->value,
                $rs_fld5->name=>$rs_fld5->value,
                $rs_fld6->name=>$rs_fld6->value,
                $rs_fld7->name=>$rs_fld7->value,
                $rs_fld8->name=>$rs_fld8->value,
                $rs_fld9->name=>$rs_fld9->value,
                $rs_fld10->name=>$rs_fld10->value,
                $rs_fld11->name=>$rs_fld11->value,
                $rs_fld12->name=>$rs_fld12->value,
                $rs_fld13->name=>$rs_fld13->value);

            $rs->MoveNext();
        }

        $rs->Close();


        return $Array_result;
    }
}
//end of file Contratos_model<?php
/**
 * Created by JetBrains PhpStorm.
 * User: usuario
 * Date: 11/01/12
 * Time: 1:01
 * To change this template use File | Settings | File Templates.
 */