<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 */
class Brand extends CI_Controller
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
        $this->load->model('brand_model');
        $data['brand'] = $this->brand_model->getAll();

        $data['list'] = $this->load->view($this->view_folders.'adm_list_brand',$data,true);
        unset($data['brand']);

        echo $this->load->view($this->view_folders.'adm_brand',$data);
    }

    public function ajax_add()
    {
        $CI =& get_instance();
        $CI->layout = 'null';

        $this->load->model('brand_model');
        $this->form_validation->set_rules('bra_name','Nome','trim|required');
        if($this->form_validation->run())
        {
            $data = array(
                        'bra_name'=>$this->input->post('bra_name')
                    );

            $retorno['id'] = $this->brand_model->addBrand($data);
            if($retorno['id'])
            {
                $retorno['brand'] = $this->brand_model->getId($retorno['id']);
                unset($retorno['id']);
                $msg = array(   
                                'st'=>1,
                                'msg'=>'Marca Adicionada com Sucesso',
                                'retorno'=>$this->load->view($this->view_folders.'adm_list_brand',$retorno,true)
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

        $this->load->model('brand_model');
        $this->form_validation->set_rules('bra_name','Nome','trim|required');
        if($this->form_validation->run())
        {
            $data = array(
                        'bra_id'=>$this->input->post('bra_id'),
                        'bra_name'=>$this->input->post('bra_name')
                    );

            if($this->brand_model->updateBrand($data))
            {
                $msg = array('st'=>1,'msg'=>'Marca Alterada com Sucesso');
               
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

        if($this->brand_model->deleteBrand($this->input->post('id')))
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
        $this->load->model('brand_model');
        $data = $this->brand_model->getLikeName($search);

        foreach ($data as $rs) {
            $seleciona[] = 
                array(    
                    'valor'     => str_replace($search, '<b>'.$search.'</b>', strtoupper($rs->bra_name)),
                    'ide'       =>$rs->bra_name,
                    'category'  =>"Marca",
                    'ref'       => $rs->bra_id
                );
        }

        if(!isset($seleciona))
            $seleciona = array();
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($seleciona);
    }

}