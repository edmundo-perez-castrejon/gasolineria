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
            $this->load->helper(array('dompdf', 'file','application'));
            $this->load->library('session');
            $this->load->helper(array('url','form'));
            $this->user = new User($this->session->userdata('user_id'));
            $this->user->cliente->get();
        }

    }

    public function under_construction()
    {
        $data = array();
        $html = $this->load->view('reportes/under_construction', $data, true);
        pdf_create($html, 'nodisponible'); #pdf_create_landscape
        #$this->load->view('reportes/under_construction');
    }

    public function dashboard()
    {
        $this->data['user'] = $this->user;

        $lst_facturas = $this->user->cliente->facturas();
        $lst_movimientos = $this->user->cliente->movimientos_no_facturado();

        $this->data['facturas'] = $lst_facturas;
        $this->data['movimientos'] = $lst_movimientos;

        $html = '';
        $html .= "<span id='nombre_cliente'>".$this->user->cliente->razon_social."</span><hr>";
        $html .= $this->load->view('dashboard/movimientos_pendientes', $this->data, true);
        $html .= $this->load->view('dashboard/facturas_pendientes', $this->data, true);
        $html .= "<h3>Gran total $ ".number_format(gran_total($lst_movimientos, $lst_facturas),2);

        pdf_create($html, 'ReporteGeneral'); #pdf_create_landscape
    }

    public function facturas_por_periodo()
    {
        $this->load->view('template/header');
        $this->load->view('reportes/facturas_por_periodo');
        $this->load->view('template/footer');
    }

    public function facturas_por_periodo_ajax(){
        $facturas = $this->user->cliente->facturas_por_periodo($this->input->post('inicio'), $this->input->post('fin'));
        $data['facturas'] = $facturas;
        $this->load->view('facturas/listado', $data);
    }

}