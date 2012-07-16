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
            $this->user = $this->ion_auth->user()->row();
        }

    }

    public function under_construction()
    {
        $data = array();
        $html = $this->load->view('reportes/under_construction', $data, true);
        pdf_create($html, 'nodisponible'); #pdf_create_landscape
        #$this->load->view('reportes/under_construction');
    }
}