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
        ;DBQ=". realpath("C:/SISTEMA/".$this->config->item('db_access_name')) ."
        ;PWD=HUMY
        ;DefaultDir=C:/SISTEMA/";

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

    public function get_datos_order_deuda()
    {
        $sql = "SELECT CLAVE_CLIENTE, RAZON_SOCIAL, MONTO_CREDITO
                FROM CLIENTES LEFT JOIN MOVIMIENTOS ON MOVIMIENTOS.CLAVE_CLIENTE_MOV = CLIENTES.CLAVE_CLIENTE
                GROUP BY CLAVE_CLIENTE, RAZON_SOCIAL, MONTO_CREDITO
                ORDER BY ((SUM(CONSUMO) - SUM(ABONO))) DESC";

        $rs = $this->db_connection->execute($sql);
        return make_array_result($rs);
    }

    public function get_datos_order_nombre()
    {
        $sql = "SELECT CLAVE_CLIENTE, RAZON_SOCIAL, MONTO_CREDITO
                FROM CLIENTES LEFT JOIN MOVIMIENTOS ON MOVIMIENTOS.CLAVE_CLIENTE_MOV = CLIENTES.CLAVE_CLIENTE
                GROUP BY CLAVE_CLIENTE, RAZON_SOCIAL, MONTO_CREDITO
                ORDER BY RAZON_SOCIAL";

        $rs = $this->db_connection->execute($sql);
        return make_array_result($rs);
    }

    public function get_datos($fields = '*', $where = null)
    {
        $sql = "SELECT $fields FROM CLIENTES ";

        if($where){
            $sql .= ' WHERE '.$where;
        }

        $sql .= ' ORDER BY RAZON_SOCIAL';
        $rs = $this->db_connection->execute($sql);
        return make_array_result($rs);
    }

    public function get_lst_sobregirados(){
        $sql = "SELECT CLAVE_CLIENTE, RAZON_SOCIAL, MONTO_CREDITO, SUM(CONSUMO) AS SUM_CONSUMO, SUM(ABONO) AS SUM_ABONO,
                ((SUM(CONSUMO)-SUM(ABONO)) - MONTO_CREDITO ) AS SOBREGIRO
                FROM CLIENTES LEFT JOIN MOVIMIENTOS ON MOVIMIENTOS.CLAVE_CLIENTE_MOV = CLIENTES.CLAVE_CLIENTE
                WHERE MONTO_CREDITO > 1
                GROUP BY CLAVE_CLIENTE, RAZON_SOCIAL, MONTO_CREDITO
                HAVING (MONTO_CREDITO - (SUM(CONSUMO)-SUM(ABONO)))  < 0
                ORDER BY ((SUM(CONSUMO)-SUM(ABONO)) - MONTO_CREDITO ) DESC";

        $rs = $this->db_connection->execute($sql);
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

    public function make_admin($pk){
        $data = array('user_id'=>$pk, 'group_id'=>1);
        $this->db->insert('users_groups',$data);

        $data = array('user_id'=>$pk, 'group_id'=>2);
        $this->db->insert('users_groups',$data);
    }
}
//end of file Contratos_model