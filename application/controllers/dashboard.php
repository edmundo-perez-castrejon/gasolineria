<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('ion_auth');
        $this->load->library('grocery_CRUD');

        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }else{
            $this->load->library('session');
            $this->load->helper(array('url','form'));
            $this->user = new User($this->session->userdata('user_id'));
            $this->user->cliente->get();
        }
    }

    function index(){




        $this->data['user'] = $this->user;

        $lst_facturas = $this->user->cliente->facturas();
        $lst_movimientos = $this->user->cliente->movimientos_no_facturado();
        #$this->data['facturas'] = $lst_facturas;
        $this->data['movimientos'] = $lst_movimientos;

        $this->load->view('template/header');
        $this->load->view('dashboard/dashboard', $this->data);
        $this->load->view('template/footer');

    }

}