<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reportes extends CI_Controller {

    private $data = null;
    private $user = null;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('ion_auth');
        $this->load->library('grocery_crud');

        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }else{
            $this->load->helper(array('dompdf', 'file'));
            $this->load->library('session');
            $this->load->library('salidas_lib');
            $this->load->model(array('contratos_model','clientes_model','buques_model','bodegas_model','destinos_model','salidas_model'));
            $this->load->helper(array('url','form'));

            $array_uri = $this->uri->ruri_to_assoc(3);

            if(isset($array_uri['ct']) and isset($array_uri['cl']))
            {
                $cve_contrato = $array_uri['ct'];
                $cve_cliente = $array_uri['cl'];
            }else
            {
                $cliente_contrato = $this->session->userdata('cliente_contrato');
                $cve_contrato = $cliente_contrato['ct'];
                $cve_cliente = $cliente_contrato['cl'];

            }


            $datos_bodegas = $this->bodegas_model->get_datos($cve_contrato);
            $datos_buque = $this->buques_model->get_datos($cve_contrato);
            $datos_destinos = $this->destinos_model->get_datos($cve_cliente, $cve_contrato);

            $this->data['datos_buque'] = $datos_buque;
            $this->data['datos_bodegas'] = $datos_bodegas;
            $this->data['cve_cliente'] = $cve_cliente;
            $this->data['cve_contrato'] = $cve_contrato;
            $this->data['datos_destinos'] = $datos_destinos;

            $this->user = $this->ion_auth->user()->row();
        }

    }

    public function mov_por_bodega()
    {
        $html = $this->load->view('reportes/mov_por_bodega', $this->data, true);
        pdf_create($html, 'Movimientos_por_bodega_contrato'.$this->data['datos_buque']['CONTRATO']);
        #$this->load->view('reportes/mov_por_bodega', $data);
    }

    public function det_envios()
    {
        $this->data['title'] = 'DETALLE DE ENVIOS';


        $lst_salidas = array();
        foreach($this->data['datos_destinos'] as $destino){
            $lst_salidas[$destino['CLAVE_DESTINO']] = $this->salidas_model->get_datos($destino['CLAVE_DESTINO']);
        }

        $this->data['datos_salidas'] = $lst_salidas;

        #$data['peso_bruto_total'] = $this->salidas_lib->get_peso_total($this->cve_destino);

        $html = $this->load->view('reportes/det_envios', $this->data, true);
        pdf_create_landscape($html, 'Detalle_de_envios_contrato'.$this->data['datos_buque']['CONTRATO']);
        #$this->load->view('reportes/det_envios', $this->data);
    }

    public function det_destinos()
    {
        $this->data['title'] = 'DETALLE DE DESTINOS';

        $lst_salidas = array();
        foreach($this->data['datos_destinos'] as $destino){
            $lst_salidas[$destino['CLAVE_DESTINO']] = count($this->salidas_model->get_datos($destino['CLAVE_DESTINO']));
        }
        $this->data['datos_salidas'] = $lst_salidas;

        $html = $this->load->view('reportes/det_destinos', $this->data, true);
        pdf_create_landscape($html, 'Detalle_de_destinos_contrato'.$this->data['datos_buque']['CONTRATO']);
        #$this->load->view('reportes/det_destinos', $this->data);
    }


    public function det_transportes()
    {
        $this->data['title'] = 'DETALLE DE TRANSPORTES POR FECHA';

        $lst_salidas = array();
        foreach($this->data['datos_destinos'] as $destino){
            $lst_tmp = $this->salidas_model->get_datos($destino['CLAVE_DESTINO']);
            $lst_por_fecha = array();
            foreach($lst_tmp as $elemento){
                $lst_por_fecha[(string)$elemento['FECHA']][] = $elemento;
            }

            $lst_salidas[$destino['CLAVE_DESTINO']] = $lst_por_fecha;
        }
        $this->data['datos_salidas'] = $lst_salidas;

        $html = $this->load->view('reportes/det_transportes', $this->data, true);
        pdf_create($html, 'Detalle_de_destinos_contrato'.$this->data['datos_buque']['CONTRATO']);
        #$this->load->view('reportes/det_transportes', $this->data);
    }

    public function rpt_contratos()
    {

        $user_id = $this->session->userData('user_id');

        #obtener los datos del cliente
        $cves_cliente = $this->clientes_model->get_claves($user_id);

        $cve_cliente = $cves_cliente[0];

        $data_cliente = $this->clientes_model->get_datos($cve_cliente);

        if(count($data_cliente)>0){

            $this->data['nombre_cliente'] = $this->user->first_name.' '.$this->user->last_name;

            $lst_contratos = array();
            foreach($cves_cliente as $cve_cliente)
            {
                $lst_contratos[] = $this->contratos_model->get_contratos_by_cliente($cve_cliente);
            }

            $lst_contratos_datos = array();
            foreach($lst_contratos as $contrato)
            {
                $datos_buque = $this->buques_model->get_datos($contrato['clave_contrato']);
                $datos_buque['clave_cliente'] = $contrato['clave_cliente'];
                $lst_contratos_datos[] = $datos_buque;
            }

            $this->data['lst_contratos'] = $lst_contratos_datos;

            $html = $this->load->view('reportes/rpt_contratos', $this->data, true);
            pdf_create_landscape($html, 'Reporte_contratos');
            #$this->load->view('reportes/rpt_contratos', $this->data);
        }


    }

    public function under_construction()
    {
        $data = array();
        $html = $this->load->view('reportes/under_construction', $data, true);
        pdf_create($html, 'nodisponible');
    }
}