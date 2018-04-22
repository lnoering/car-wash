<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 */
class Client extends CI_Controller
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
        $this->js[] = 'formValidation/jquery.form-validator.min';
        $this->js[] = 'func/new';
        $data = array();
        $this->load->model('client_model');
        $data['clientes'] = $this->client_model->getAll();

        $data['list_clientes'] = $this->load->view($this->view_folders.'adm_list_client',$data,true);
        unset($data['clientes']);

        echo $this->load->view($this->view_folders.'adm_client',$data);
    }

    public function ajax_add()
    {
        $CI =& get_instance();
        $CI->layout = 'null';

        $this->load->model('client_model');
        $this->form_validation->set_rules('cli_name','Nome','trim|required|max_length[255]');
        $this->form_validation->set_rules('cli_cpfcnpj','Descrição','trim|required|max_length[14]');
        $this->form_validation->set_rules('cli_email','Email','trim|required|max_length[255]|valid_email');
        $this->form_validation->set_rules('cli_phone','Telefone','trim|required|numeric|max_length[255]');
        $this->form_validation->set_rules('cli_birth','Data Nascimento','trim|required');
        if($this->form_validation->run())
        {
            $data = array(
                        'cli_name'=>$this->input->post('cli_name'),
                        'cli_cpfcnpj'=>$this->input->post('cli_cpfcnpj'),
                        'cli_email'=>$this->input->post('cli_email'),
                        'cli_phone'=>$this->input->post('cli_phone'),
                        'cli_birth'=>$this->input->post('cli_birth')
                    );
            $retorno['id'] = $this->client_model->addClient($data);
            if($retorno['id'])
            {
                $retorno['clientes'] = $this->client_model->getId($retorno['id']);
                unset($retorno['id']);
                $msg = array(
                                'st'=>1,
                                'msg'=>'Cliente Adicionado com Sucesso',
                                'retorno'=>$this->load->view($this->view_folders.'adm_list_client',$retorno,true)
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

        $this->load->model('client_model');
        $this->form_validation->set_rules('cli_name','Nome','trim|required|max_length[255]');
        $this->form_validation->set_rules('cli_cpfcnpj','Descrição','trim|required|max_length[14]');
        $this->form_validation->set_rules('cli_email','Email','trim|required|max_length[255]|valid_email');
        $this->form_validation->set_rules('cli_phone','Telefone','trim|required|numeric|max_length[255]');
        $this->form_validation->set_rules('cli_birth','Data Nascimento','trim|required');

        if($this->form_validation->run())
        {
            $data = array(
                        'cli_id'=>$this->input->post('cli_id'),
                        'cli_name'=>$this->input->post('cli_name'),
                        'cli_cpfcnpj'=>$this->input->post('cli_cpfcnpj'),
                        'cli_email'=>$this->input->post('cli_email'),
                        'cli_phone'=>$this->input->post('cli_phone'),
                        'cli_birth'=>$this->input->post('cli_birth')
                    );

            if($this->client_model->updateClient($data))
            {
                $msg = array('st'=>1,'msg'=>'Cliente Alterado com Sucesso');
               
            } else {
                $msg = array('st'=>0,'msg'=>'ERRO:<br /> Problema ao alterar.');
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

        $this->load->model('client_model');

        if($this->client_model->deleteClient($this->input->post('id')))
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
        $this->load->model('client_model');
        $data = $this->client_model->getLikeName($search);

        foreach ($data as $rs) {
            $seleciona[] = 
                array(    
                    'valor'     => str_replace($search, '<b>'.$search.'</b>', strtoupper($rs->cli_name)),
                    'ide'       =>$rs->cli_name,
                    'category'  =>"Cliente",
                    'ref'       => $rs->cli_id
                );
        }

        if(!isset($seleciona))
            $seleciona = array();
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($seleciona);
    }

}