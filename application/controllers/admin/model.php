<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 */
class Model extends CI_Controller
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
        $this->js[] = 'func/brand';
        $data = array();
        $this->load->model('model_model');
        $data['model'] = $this->model_model->getAll();

        $data['list'] = $this->load->view($this->view_folders.'adm_list_model',$data,true);
        unset($data['model']);

        echo $this->load->view($this->view_folders.'adm_model',$data);
    
    }

    public function ajax_add()
    {
        $CI =& get_instance();
        $CI->layout = 'null';
        
        $this->form_validation->set_rules('mod_name','Modelo','trim|required');
        $this->form_validation->set_rules('bra_name','Marca','trim|required|callback_required_inputs');
        if($this->form_validation->run())
        {
            $id_brand = $this->input->post('mod_brand');
            //caso nao selecione a marca, vai procurar se existe pelo nome digitado
            if(empty($id_brand))
            {
                $this->load->model('brand_model');
                $id = $this->brand_model->getName($this->input->post('bra_name'));
                $id_brand =  (isset($id[0]->bra_id)?$id[0]->bra_id:'');
            }
            
            //$id_brand = $this->input->post('mod_brand');
            if(!empty($id_brand))
            {
                $data = array(
                            'mod_name'=>$this->input->post('mod_name'),
                            'mod_brand'=>$id_brand
                        );

                $this->load->model('model_model');
                $retorno['id'] = $this->model_model->addModel($data);
                if($retorno['id'])
                {
                    $retorno['model'] = $this->model_model->getId($retorno['id']);
                    unset($retorno['id']);
                    $msg = array(   
                                    'st'=>1,
                                    'msg'=>'Modelo Adicionado com Sucesso',
                                    'retorno'=>$this->load->view($this->view_folders.'adm_list_model',$retorno,true)
                                );
                   
                } else {
                    $msg = array('st'=>0,'msg'=>'ERRO:<br /> Problema ao salvar.');
                }
            } else {
                $msg = array('st'=>0,'msg'=>'ERRO:<br /> Problema ao buscar Marca.');
            }
        } else {
            $msg = array('st'=>0,'msg'=>'ERRO:<br />'.validation_errors());
        }
        echo json_encode($msg);
    }

    public function required_inputs()
    {
        if($this->input->post('mod_brand '))
        {
            $this->load->model('brand_model');
            $brand = $this->brand_model->getId($this->input->post('mod_brand '));
            if(isset($brand[0])) {
                return true;
            } else {
                $this->form_validation->set_message('required_inputs', 'Marca não encontrada!');
                return false;
            }
        }
        //$this->form_validation->set_message('required_inputs', 'Preencha o campo de Marca!');
        return true;
    }

    public function ajax_update()
    {
        $CI =& get_instance();
        $CI->layout = 'null';

        $this->load->model('model_model');
        $this->form_validation->set_rules('mod_name','Nome','trim|required');
        $this->form_validation->set_rules('bra_name','Marca','trim|required|callback_required_inputs');
        if($this->form_validation->run())
        {

            $id_brand = $this->input->post('mod_brand');
            //caso nao selecione a marca, vai procurar se existe pelo nome digitado
            if(empty($id_brand))
            {
                $this->load->model('brand_model');
                $id = $this->brand_model->getName($this->input->post('bra_name'));
                $id_brand =  (isset($id[0]->bra_id)?$id[0]->bra_id:'');
            }
            
            //$id_brand = $this->input->post('mod_brand');
            if(!empty($id_brand))
            {
                $data = array(
                            'mod_id'=>$this->input->post('mod_id'),
                            'mod_name'=>$this->input->post('mod_name'),
                            'mod_brand'=>$id_brand
                        );

                if($this->model_model->updateModel($data))
                {
                    $msg = array('st'=>1,'msg'=>'Modelo Alterada com Sucesso');
                   
                } else {
                    $msg = array('st'=>0,'msg'=>'ERRO:<br /> Problema ao Atualizar.');
                }
            } else {
                $msg = array('st'=>0,'msg'=>'ERRO:<br /> Problema ao buscar Marca.');
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

        $this->load->model('model_model');

        if($this->model_model->deleteModel($this->input->post('id')))
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
        
        $this->load->model('model_model');
        $data = $this->model_model->getLikeNameFilterByBrand($search, $brand);

        //pegar o nome das marcas
        $ids = array();
        foreach ($data as $value) {
            $ids[$value->mod_brand] = $value->mod_brand;
        }
        $this->load->model('brand_model');
        $brands = $this->brand_model->getWhereIds($ids);

        foreach ($data as $rs) {
            $seleciona[] = 
                array(    
                    'valor'     => str_replace($search, '<b>'.$search.'</b>', strtoupper($rs->mod_name)),
                    'ide'       => $rs->mod_name,
                    'category'  => $brands[$rs->mod_brand],
                    'ref'       => $rs->mod_id
                );
        }

        if(!isset($seleciona))
            $seleciona = array();
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($seleciona);
    }

}