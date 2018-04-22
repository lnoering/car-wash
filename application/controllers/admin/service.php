<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 */
class Service extends CI_Controller
{
    private $view_folders = 'admin/';
    /**
    * Layout default utilizado pelo controlador.
    */
    public $layout = 'admin';

    /**
    * Titulo default.
    */
    public $title = 'Car Wash';

    /**
    * Definindo os css default.
    */
    //public $css = array('main','normalize','normalize.min');
    public $css = array('bootstrap.min','dashboard','my');//'jquery-ui-1.11.2/jquery-ui'

    /**
    * Carregando os js default.
    */
    //public $js = array('vendor/modernizr-2.6.2-respond-1.1.0.min','main');
    public $js = array('ie-emulation-modes-warning');

    public function index()
    {
        //$this->load->view('admin');
        $this->js[] = 'formValidation/jquery.form-validator.min';
        $this->js[] = 'func/new';
        $data = array();
        $this->load->model('service_model');
        $data['services'] = $this->service_model->getAll();

        $data['list_services'] = $this->load->view($this->view_folders.'adm_list_service',$data,true);
        unset($data['services']);

        echo $this->load->view($this->view_folders.'adm_service',$data);
    }

    public function ajax_add()
    {
        $CI =& get_instance();
        $CI->layout = 'null';

        $this->load->model('service_model');
        $this->form_validation->set_rules('svc_name','Nome','trim|required');
        $this->form_validation->set_rules('svc_description','Descrição','trim|required');
        $this->form_validation->set_rules('svc_value','Valor','trim|required|numeric');
        if($this->form_validation->run())
        {
            $data = array(
                        'svc_name'=>$this->input->post('svc_name'),
                        'svc_description'=>$this->input->post('svc_description'),
                        'svc_value'=>$this->input->post('svc_value')
                    );

            $retorno['id'] = $this->service_model->addService($data);
            if($retorno['id'])
            {
                $retorno['services'] = $this->service_model->getId($retorno['id']);
                unset($retorno['id']);
                $msg = array(   
                                'st'=>1,
                                'msg'=>'Servico Adicionado com Sucesso',
                                'retorno'=>$this->load->view($this->view_folders.'adm_list_service',$retorno,true)
                            );
               
            } else {
                $msg = array('st'=>0,'msg'=>'ERRO:<br /> Problema ao salvar.');
            }
        } else {
            $msg = array('st'=>0,'msg'=>'ERRO:<br />'.validation_errors());
        }
        echo json_encode($msg);
    }

    public function ajax_update()
    {
        $CI =& get_instance();
        $CI->layout = 'null';

        $this->load->model('service_model');
        $this->form_validation->set_rules('svc_name','Nome','trim|required');
        $this->form_validation->set_rules('svc_description','Descrição','trim|required');
        $this->form_validation->set_rules('svc_value','Valor','trim|required|numeric');
        if($this->form_validation->run())
        {
            $data = array(
                        'svc_id'=>$this->input->post('svc_id'),
                        'svc_name'=>$this->input->post('svc_name'),
                        'svc_description'=>$this->input->post('svc_description'),
                        'svc_value'=>$this->input->post('svc_value')
                    );

            if($this->service_model->updateService($data))
            {
                $msg = array('st'=>1,'msg'=>'Servico Alterado com Sucesso');
               
            } else {
                $msg = array('st'=>0,'msg'=>'ERRO:<br /> Problema ao Atualizar.');
            }
        } else {
            $msg = array('st'=>0,'msg'=>'ERRO:<br />'.validation_errors());
        }
        echo json_encode($msg);
    }

    public function ajax_delete()
    {
        $CI =& get_instance();
        $CI->layout = 'null';

        $this->load->model('brand_model');

        if($this->service_model->deleteService($this->input->post('id')))
        {
            $msg = array('st'=>1,'msg'=>'Removido com Sucesso.');
        } else {
            $msg = array('st'=>0,'msg'=>'ERRO:<br /> Problema ao deletar.');
        }
        echo json_encode($msg);
    }

    public function ajax_search()
    {
        $CI =& get_instance();
        $CI->layout = 'null';

        $search = strtoupper($this->input->post('search'));
        
        $this->load->model('service_model');
        $data = $this->service_model->getLikeName($search);

        foreach ($data as $rs) {
            $seleciona[] = 
                array(    
                    'valor'     => str_replace($search, '<b>'.$search.'</b>', strtoupper($rs->svc_name)),
                    'ide'       =>$rs->svc_name,
                    'category'  =>"Serviços",
                    'ref'       => $rs->svc_id
                );
        }

        if(!isset($seleciona))
            $seleciona = array();
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($seleciona);
    }
}