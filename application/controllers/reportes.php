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


        $html .= $this->load->view('dashboard/movimientos_pendientes', $this->data, true);
        #$html .= $this->load->view('dashboard/facturas_pendientes', $this->data, true);

        pdf_create_landscape($html, 'ReporteGeneral'); #pdf_create_landscape



        #pdf_create($html, 'nodisponible'); #pdf_create_landscape

    }
}