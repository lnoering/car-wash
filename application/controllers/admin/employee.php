<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 */
class Employee extends CI_Controller
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
        $this->load->model('employee_model');
        $data['employee'] = $this->employee_model->getAll();

        $data['list'] = $this->load->view($this->view_folders.'adm_list_employee',$data,true);
        unset($data['employee']);

        echo $this->load->view($this->view_folders.'adm_employee',$data);
    
    }

    public function ajax_add()
    {
        $CI =& get_instance();
        $CI->layout = 'null';
        
        $this->form_validation->set_rules('emp_name','Nome','trim|required');
        $this->form_validation->set_rules('emp_email','Marca','required|valid_email');
        $this->form_validation->set_rules('emp_phone','Telefone','trim|required');
        //$this->form_validation->set_rules('emp_birth','Data Aniversário','trim|required');
        $this->form_validation->set_rules('emp_password','Senha','required|matches[emp_password_conf]');
        $this->form_validation->set_rules('emp_password_conf','Confirmação de Senha','required|email');


        if($this->form_validation->run())
        {
            $data = array(
                        'emp_name'=>$this->input->post('emp_name'),
                        'emp_email'=>$this->input->post('emp_email'),
                        'emp_phone'=>$this->input->post('emp_phone'),
                        'emp_birth'=>$this->input->post('emp_birth'),
                        'emp_password'=>$this->input->post('emp_password')
                    );

            $this->load->model('employee_model');
            $retorno['id'] = $this->employee_model->addEmployee($data);
            if($retorno['id'])
            {
                $retorno['employee'] = $this->employee_model->getId($retorno['id']);
                unset($retorno['id']);
                $msg = array(   
                                'st'=>1,
                                'msg'=>'Modelo Adicionado com Sucesso',
                                'retorno'=>$this->load->view($this->view_folders.'adm_list_employee',$retorno,true)
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

        $this->form_validation->set_rules('emp_name','Modelo','trim|required');
        $this->form_validation->set_rules('emp_email','Marca','required|valid_email');
        $this->form_validation->set_rules('emp_phone','Telefone','trim|required');
        //$this->form_validation->set_rules('emp_birth','Data Aniversário','trim|required');
        $this->form_validation->set_rules('emp_password','Senha','required|matches[emp_password_conf]');
        $this->form_validation->set_rules('emp_password_conf','Confirmação de Senha','required|email');

        if($this->form_validation->run())
        {
            $data = array(
                        'emp_id'=>$this->input->post('emp_id'),
                        'emp_name'=>$this->input->post('emp_name'),
                        'emp_email'=>$this->input->post('emp_email'),
                        'emp_phone'=>$this->input->post('emp_phone'),
                        'emp_birth'=>$this->input->post('emp_birth'),
                        'emp_password'=>$this->input->post('emp_password')
                    );
            $this->load->model('employee_model');

            if($this->employee_model->updateEmployee($data))
            {
                $msg = array('st'=>1,'msg'=>'Modelo Alterada com Sucesso');
               
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

        $this->load->model('employee_model');

        if($this->employee_model->deleteEmployee($this->input->post('id')))
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
        $brand = strtoupper($this->input->post('brand'));
        
        $this->load->model('employee_model');
        $data = $this->employee_model->getLikeName($search);

        foreach ($data as $rs) {
            $seleciona[] = 
                array(    
                    'valor'     => str_replace($search, '<b>'.$search.'</b>', strtoupper($rs->emp_name)),
                    'ide'       => $rs->emp_name,
                    'category'  => 'Empregados',
                    'ref'       => $rs->emp_id
                );
        }

        if(!isset($seleciona))
            $seleciona = array();
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($seleciona);
    }

}