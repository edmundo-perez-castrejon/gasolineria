<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contratos extends CI_Controller {

    private $user = null;
    private $data = null;

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

            $this->load->library('salidas_lib');
            $this->load->model(array('contratos_model','clientes_model','buques_model','bodegas_model','destinos_model','empresas_model'));
            $this->load->helper(array('url','form'));

            $this->load->library('session');

            $this->user = $this->ion_auth->user()->row();

            if($datos_empresa = $this->empresas_model->get_datos_empresa($this->user->id_empresa))
            {
                $this->session->set_userdata('nombre_empresa', $datos_empresa->nombre);
                $this->session->set_userdata('imagen_empresa', base_url().'images/empresas/'.$datos_empresa->imagen);
            }

            //$this->session->set_userdata('superusuario',$this->user->superusuario);
            #Parche 06/03/2012 TODOS DEBERAN SER SUPERUSUARIOS
            #Considerar tambien que se modifico el valor default de la columna en la base de datos, tabla usuarios par
            #que siempre fuera 1, cambiar esto a 0 en caso de necesitar revertir el parche
            $this->session->set_userdata('superusuario',1);
        }
    }

	public function index()
	{
        $user_id = $this->session->userData('user_id');

        #obtener los datos del cliente de MySQL
        $cves_cliente = $this->clientes_model->get_claves($user_id);

        if(count($cves_cliente)>0){

            $this->data['nombre_cliente'] = $this->user->first_name.' '.$this->user->last_name;

            $lst_contratos = array();
            foreach($cves_cliente as $cve_cliente)
            {
                $contratos_cliente =$this->contratos_model->get_contratos_by_cliente($cve_cliente);
                if(count($contratos_cliente)>0)
                {
                    $lst_contratos[] = $contratos_cliente;
                }
            }



            $lst_contratos_datos = array();
            foreach($lst_contratos as $contrato)
            {
                $datos_buque = $this->buques_model->get_datos($contrato['clave_contrato']);
                $datos_buque['clave_cliente'] = $contrato['clave_cliente'];
                $lst_contratos_datos[] = $datos_buque;
            }

            $this->data['lst_contratos'] = $lst_contratos_datos;

            $this->load->view('template/header');
            $this->load->view('contratos',$this->data);
            $this->load->view('template/footer');
        }else{
            echo 'NO EXISTEN CONTRATOS ASIGNADOS';
        }

	}

    public function get_datos()
    {

        $array = $this->uri->ruri_to_assoc(3);

        $data['uri'] = $array;

        if(count($array)>0){

            $this->session->set_userdata('cve_contrato', $array['ct']);
            $this->session->set_userdata('cve_cliente', $array['cl']);

            $this->session->set_userdata('cliente_contrato', $array);

            $cve_contrato = $array['ct'];
            $cve_cliente = $array['cl'];
        }else{
            $cve_contrato = $this->session->userdata('ct');
            $cve_cliente = $this->session->userdata('cl');
        }

        $imagen_buque = $this->contratos_model->get_imagen_contrato($cve_contrato);

        if($imagen_buque)
        {
            $data['imagen_buque'] = base_url().'images/contratos/'.$imagen_buque->imagen;
        }

        $datos_buque = $this->buques_model->get_datos($cve_contrato);
        $datos_bodegas = $this->bodegas_model->get_datos($cve_contrato);

        $data['datos_buque'] = $datos_buque;
        $data['datos_bodegas'] = $datos_bodegas;

        $data['cve_cliente'] = $cve_cliente;
        $data['cve_contrato'] = $cve_contrato;


        if($this->config->item('dev_mode')){
            echo '<pre>';
            print_r($data);
            echo '</pre>';
        }


        $this->load->view('template/header', $data);
        $this->load->view('buques',$data);
        $this->load->view('template/footer');
    }

    public function get_destinos()
    {
        $array_uri = $this->uri->ruri_to_assoc(3);

        $cve_contrato = $array_uri['ct'];
        $cve_cliente =  $array_uri['cl'];

        $datos_buque = $this->buques_model->get_datos($cve_contrato);

        $datos_destinos = $this->destinos_model->get_datos($cve_cliente, $cve_contrato);

        $data['uri'] = $array_uri;

        $data['datos_destinos'] = $datos_destinos;
        $data['datos_buque'] = $datos_buque;

        $this->load->view('template/header', $data);
        $this->load->view('destinos',$data);
        $this->load->view('template/footer');
    }



}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */