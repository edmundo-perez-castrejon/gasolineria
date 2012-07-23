<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Facturas extends CI_Controller {
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

    function detalle_factura(){
        $this->load->model('movimientos_model');
        $numero_factura = $this->uri->segment(3);

        $detalle = $this->movimientos_model->by_factura($numero_factura);

        $this->data['movimientos'] = $detalle;

        $this->load->view('template/header');
        $this->load->view('facturas/detalle', $this->data);
        $this->load->view('template/footer');
    }

}