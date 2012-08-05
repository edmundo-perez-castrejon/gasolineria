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
            $this->load->helper(array('dompdf', 'file','application','url','form'));
            $this->load->library('session');

            $this->load->library('mpdf54/mpdf');
            $this->mpdf=new mPDF('c','A4','','',32,25,27,25,16,13);

            $this->user = new User($this->session->userdata('user_id'));
            $this->user->cliente->get();

        }

    }

    public function under_construction()
    {
        $data = array();
        $html = $this->load->view('reportes/under_construction', $data, true);


        $this->mpdf->WriteHTML($html,2);
        $this->mpdf->Output('mpdf.pdf','I');

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
        $data['inicio'] = $this->input->post('inicio');
        $data['fin'] = $this->input->post('fin');
        $facturas = $this->user->cliente->facturas_por_periodo($data['inicio'], $data['fin']);
        $data['facturas'] = $facturas;

        $this->load->view('facturas/listado', $data);
        $this->load->view('facturas/boton_imprimir', $data);
    }

    public function facturas_por_periodo_pdf()
    {
        $inicio = str_replace('-','/',$this->uri->segment(3));
        $fin= str_replace('-','/',$this->uri->segment(4));

        $facturas = $this->user->cliente->facturas_por_periodo($inicio, $fin);
        $data['facturas'] = $facturas;

        $html = $this->load->view('facturas/listado', $data, true);

        pdf_create($html, 'facturas_por_periodo'); #pdf_create_landscape
    }

    public function consumos_por_periodo()
    {
        $this->load->view('template/header');
        $this->load->view('reportes/consumos_por_periodo');
        $this->load->view('template/footer');
    }

    public function movimientos_por_periodo_ajax(){
        $data['inicio'] =$this->input->post('inicio');
        $data['fin'] = $this->input->post('fin');
        $movimientos = $this->user->cliente->movimientos_por_periodo($data['inicio'],$data['fin']);
        $data['movimientos'] = $movimientos;
        $this->load->view('consumos/listado', $data);
        $this->load->view('consumos/boton_imprimir', $data);

    }

    public function movimientos_por_periodo_pdf()
    {
        $inicio = str_replace('-','/',$this->uri->segment(3));
        $fin= str_replace('-','/',$this->uri->segment(4));

        $movimientos = $this->user->cliente->movimientos_por_periodo($inicio, $fin);
        $data['movimientos'] = $movimientos;
        $html = $this->load->view('consumos/listado', $data, true);

        pdf_create($html, 'movimientos_por_periodo'); #pdf_create_landscape
    }

    public function saldo_por_cliente()
    {
        $data['title'] = 'Saldo por cliente';
        $data['form_action'] = 'saldo_por_cliente_PDF';
        $lst_clientes = $this->clientes_model->get_datos('CLAVE_CLIENTE, RAZON_SOCIAL');

        $cmb_clientes = array('0'=>'TODOS');
        foreach($lst_clientes as $c){
            $cmb_clientes[$c['CLAVE_CLIENTE']] = $c['CLAVE_CLIENTE'].' - '.$c['RAZON_SOCIAL'];
        }

        $data['clientes'] = $cmb_clientes;

        $this->load->view('template/header');
        $this->load->view('reportes/saldo_por_cliente', $data);
        $this->load->view('template/footer');
    }

    public function facturas_por_vencimiento()
    {
        $data['title'] = 'Facturas por vencimiento';
        $data['form_action'] = 'facturas_por_vencimiento_PDF';
        $lst_clientes = $this->clientes_model->get_datos('CLAVE_CLIENTE, RAZON_SOCIAL');

        $cmb_clientes = array('0'=>'TODOS');
        foreach($lst_clientes as $c){
            $cmb_clientes[$c['CLAVE_CLIENTE']] = $c['CLAVE_CLIENTE'].' - '.$c['RAZON_SOCIAL'];
        }

        $data['clientes'] = $cmb_clientes;

        $this->load->view('template/header');
        $this->load->view('reportes/saldo_por_cliente', $data);
        $this->load->view('template/footer');
    }

    public function matriz_vencimientos()
    {
        $data['title'] = 'Matriz de vencimientos';
        $data['form_action'] = 'matriz_vencimientos_PDF';
        $lst_clientes = $this->clientes_model->get_datos('CLAVE_CLIENTE, RAZON_SOCIAL');

        $cmb_clientes = array('0'=>'TODOS');
        foreach($lst_clientes as $c){
            $cmb_clientes[$c['CLAVE_CLIENTE']] = $c['CLAVE_CLIENTE'].' - '.$c['RAZON_SOCIAL'];
        }

        $data['clientes'] = $cmb_clientes;

        $this->load->view('template/header');
        $this->load->view('reportes/saldo_por_cliente', $data);
        $this->load->view('template/footer');
    }

    public function saldo_por_cliente_PDF(){
        $cliente_id = $this->input->post('clientes');
        $gran_total = 0;

        if($cliente_id > 0){
            $facturas = $this->facturas_model->get_datos_with_balance($cliente_id, 15);
            $data['facturas'] = $facturas;
            $data['cliente'] = $this->clientes_model->get_datos_access($cliente_id);
            $saldo_cliente = 0;
            foreach($facturas as $f){
                $saldo_cliente += $f['SALDO'];
            }
            $gran_total += $saldo_cliente;
            $html = $this->load->view('reportes/saldo_por_cliente_rpt', $data, true );
        }else{
            $lst_clientes = $this->clientes_model->get_datos('CLAVE_CLIENTE');
            $html = '';
            foreach($lst_clientes as $c){
                $cliente_id = $c['CLAVE_CLIENTE'];
                $facturas = $this->facturas_model->get_datos_with_balance($cliente_id, 15);

                if(count($facturas)>0){
                    $data['facturas'] = $facturas;
                    $data['cliente'] = $this->clientes_model->get_datos_access($cliente_id);

                    $saldo_cliente = 0;

                    foreach($facturas as $f){
                        $saldo_cliente += $f['SALDO'];
                    }

                    $html .= $this->load->view('reportes/saldo_por_cliente_rpt', $data, true );
                    $gran_total +=  $saldo_cliente;
                }
            }
        }

        $html .= "<hr>GRAN TOTAL : <h1>$ ".number_format($gran_total,2)."</h1>";

        $this->mpdf->WriteHTML($html,2);
        $this->mpdf->Output('mpdf.pdf','I');
    }

    public function facturas_por_vencimiento_PDF(){
        $cliente_id = $this->input->post('clientes');
        $gran_total = 0;

        if($cliente_id > 0){
            $cliente = $this->clientes_model->get_datos_access($cliente_id);
            $data['cliente'] = $cliente;
            $facturas = $this->facturas_model->get_datos_with_balance($cliente_id, $cliente[0]['PLAZO']);
            $data['facturas'] = $facturas;
            $saldo_cliente = 0;
            foreach($facturas as $f){
                $saldo_cliente += $f['SALDO'];
            }
            $gran_total += $saldo_cliente;
            $html = $this->load->view('reportes/facturas_por_vencimiento_rpt', $data, true );
        }else{
            $lst_clientes = $this->clientes_model->get_datos('CLAVE_CLIENTE, PLAZO');
            $html = '';
            foreach($lst_clientes as $c){
                $cliente_id = $c['CLAVE_CLIENTE'];
                $cliente = $this->clientes_model->get_datos_access($cliente_id);
                $data['cliente'] = $cliente;
                $facturas = $this->facturas_model->get_datos_with_balance($cliente_id, $cliente[0]['PLAZO']);

                if(count($facturas)>0){
                    $data['facturas'] = $facturas;

                    $saldo_cliente = 0;

                    foreach($facturas as $f){
                        $saldo_cliente += $f['SALDO'];
                    }

                    $html .= $this->load->view('reportes/facturas_por_vencimiento_rpt', $data, true );
                    $gran_total +=  $saldo_cliente;
                }
            }
        }

        $html .= "<hr>GRAN TOTAL : <h1>$ ".number_format($gran_total,2)."</h1>";

        $this->mpdf->WriteHTML($html,2);
        $this->mpdf->Output('facturas_por_vencimiento.pdf','I');
    }

    public function matriz_vencimientos_PDF(){

        $cliente_id = $this->input->post('clientes');

        if(!$this->ion_auth->is_admin()){
            $cliente_id =$this->user->cliente->clave_cliente;
        }

        if($cliente_id > 0){
            $html = $this->matriz_vencimientos_html($cliente_id);
        }else{
            $lst_clientes = $this->clientes_model->get_datos('CLAVE_CLIENTE, PLAZO');
            $html = '';
            foreach($lst_clientes as $c){
                $cliente_id = $c['CLAVE_CLIENTE'];
                $html .= $this->matriz_vencimientos_html($cliente_id);
            }
        }

        $this->mpdf->WriteHTML($html,2);
        $this->mpdf->Output('facturas_por_vencimiento.pdf','I');
    }

    private function matriz_vencimientos_html($cliente_id, $data_extra = null)
    {
        $cliente = $this->clientes_model->get_datos_access($cliente_id);
        $data['cliente'] = $cliente;
        $facturas = $this->facturas_model->get_datos_with_balance($cliente_id, $cliente[0]['PLAZO']);
        $new_facturas = $this->matriz_facturas($facturas);
        $data['facturas'] = $new_facturas;
        $nofacturado = $this->movimientos_model->importe_no_facturado($cliente_id);
        $data['movimientos_sum'] = $nofacturado[0]['SUM_CONSUMO'];

        $ultimo_consumo = $this->movimientos_model->get_ultimo_consumo($cliente_id);
        $data['ultimo_consumo'] = $ultimo_consumo;
        $ultimo_abono = $this->movimientos_model->get_ultimo_abono($cliente_id);
        $data['ultimo_abono'] = $ultimo_abono;

        $data['extra'] = $data_extra;
        if(count($facturas) > 0 or $nofacturado[0]['SUM_CONSUMO'] > 0 ){
            $html = $this->load->view('reportes/matriz_vencimiento_rpt', $data, true );
        }

        return $html;
    }

    private function matriz_facturas($facturas)
    {
        $new_facturas = array();
        foreach($facturas as $f){
            $f['SIN_VENCER'] = 0;
            $f['1-7'] = 0;
            $f['8-15'] = 0;
            $f['16-23'] = 0;
            $f['+23'] = 0;

            $dias = $f['DIASVENCIMIENTO'];
            $dias < 1 ? $f['SIN_VENCER'] = $f['SALDO'] : $f['SIN_VENCER']  = 0;
            $dias >= 1 AND $dias <=7 ? $f['1-7'] = $f['SALDO'] : $f['1-7']  = 0;
            $dias >= 8 AND $dias <=15 ? $f['8-15'] = $f['SALDO'] : $f['8-15']  = 0;
            $dias >= 16 AND $dias <=23 ? $f['16-23'] = $f['SALDO'] : $f['16-23']  = 0;
            $dias >23  ? $f['+23'] = $f['SALDO'] : $f['+23']  = 0;
            $new_facturas[]  = $f;
        }

        return $new_facturas;
    }

    public function sobregirados()
    {
        $lst_sobregirados = $this->clientes_model->get_lst_sobregirados();

        $html = '';
        foreach($lst_sobregirados as $c){

            $extra['estadisticas'] = $c;
            $html .= $this->matriz_vencimientos_html($c['CLAVE_CLIENTE'], $extra);
        }

        $this->mpdf->WriteHTML($html,2);
        $this->mpdf->Output('clientes_sobregirados.pdf','I');
    }

}