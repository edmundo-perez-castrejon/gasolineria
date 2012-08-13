<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

    private $data = null;

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
            $this->load->model('clientes_model');
        }
    }

    public function grocery_usuarios()
    {

        $crud = new grocery_CRUD();

        $crud->where('username!=',"'root'", FALSE);

        $crud->set_table('users');

        #Relacion con la clientes
        $crud->set_relation('cliente_id','clientes','razon_social');
        $crud->set_relation('user_type','user_types','description');

        $crud->columns('username','active','cliente_id', 'user_type');

        $crud->fields('username','password','email','active','cliente_id','user_type');

        $crud->set_rules('username','Usuario','required');
        $crud->set_rules('password','contraseña','required');
        $crud->set_rules('active','Activo','required');
        $crud->set_rules('user_type','Tipo de usuario','required');

        $crud->change_field_type('password','password');

        $crud->display_as('username','Usuario')
            ->display_as('email','Correo Electronico')
            ->display_as('cliente_id','Razon Social')
            ->display_as('user_type','Tipo de usuario');

        $crud->callback_after_insert(array($this, 'make_admin'));

        $output = $crud->render();
        $this->load->view('template/header',$output);
        $this->load->view('admin/listado_usuarios',$output);
        $this->load->view('template/footer');
    }

    public function make_admin($post_array, $primary_key){


        $user_tmp = new User($primary_key);
        if($user_tmp->user_type == 2 or $user_tmp->user_type == 3){
    		$this->clientes_model->make_admin($primary_key);
        }
    }

    public function configuracion()
    {
        $crud = new grocery_CRUD();

        $crud->set_theme('datatables');
        $crud->set_table('configuracion');

        $crud->set_field_upload('imagen_frontal','images/front');
        $crud->unset_add();

        $crud->unset_delete();

        $output = $crud->render();

        $this->load->view('template/header',$output);
        $this->load->view('admin/configuracion',$output);
        $this->load->view('template/footer');
    }


    public function clientes()
    {


        $crud = new grocery_CRUD();

        $crud->set_table('clients');

        $crud->unset_operations();

        $output = $crud->render();

        $this->load->view('template/header',$output);
        $this->load->view('admin/clientes',$output);
        $this->load->view('template/footer');

        $lst_clientes = $this->clientes_model->get_datos();

        $this->clientes_model->sincroniza();
    }



}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */