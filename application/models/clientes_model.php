<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Clientes_model extends CI_Model
{
    private $db_connection = null;

    public function __construct()
    {
        parent::__construct();

        $this->load->helper('application');
        $this->db_connection = new COM("ADODB.Connection");

        $db_connstr = "DRIVER={Microsoft Access Driver (*.mdb)}
        ;DBQ=". realpath("../databases/".$this->config->item('db_access_name')) ."
        ;PWD=HUMY
        ;DefaultDir=". realpath("../databases");

        $this->db_connection->open($db_connstr);

        $this->load->database();
    }

    public function get_datos_access($cve_cliente)
    {
        $sql = "SELECT * FROM CLIENTES WHERE CLAVE_CLIENTE = $cve_cliente";
        $rs = $this->db_connection->execute($sql);
        return make_array_result($rs);
    }

    public function __destruct()
    {
        $this->db_connection->Close();
    }

    public function get_datos($fields = '*')
    {
        $rs = $this->db_connection->execute("SELECT $fields FROM CLIENTES ORDER BY RAZON_SOCIAL");
        return make_array_result($rs);
    }

    /** sincroniza los clientes de la base de datos de access con la tabla mysql de clientes */
    public function sincroniza()
    {
        $lst_access  = $this->get_datos();

        #TODO : implementar una sincronia mas inteligente
        $this->db->query("delete from clientes");
        foreach($lst_access as $cliente_access)
        {
            $datos_insert = array("CLAVE_CLIENTE" => $cliente_access['CLAVE_CLIENTE'],
                "RAZON_SOCIAL"=>$cliente_access['RAZON_SOCIAL']);
            $this->nuevo_cliente($datos_insert);
        }
    }

    public function nuevo_cliente($data)
    {
        if($this->db->insert('clientes', $data))
        {
            return TRUE;
        }else{
            return FALSE;
        }
    }
}
//end of file Contratos_model