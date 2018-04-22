<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 */
class Vehicle extends CI_Controller
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
    public $js = array('ie-emulation-modes-warning','func/brand','func/model');

    public function index()
    {
        $this->js[] = 'formValidation/jquery.form-validator.min';
        $this->js[] = 'func/new';
        $data = array();
        $this->load->model('vehicle_model');
        $data['vehicles'] = $this->vehicle_model->getAll();
        
        $data['list_vehicles'] = $this->load->view($this->view_folders.'adm_list_vehicle',$data,true);
        unset($data['vehicles']);

        echo $this->load->view($this->view_folders.'adm_vehicle',$data);
    }

    public function ajax_add()
    {
        $CI =& get_instance();
        $CI->layout = 'null';

        $this->load->model('vehicle_model');
        $this->form_validation->set_rules('veh_license','Placa','trim|required|max_length[10]|is_unique[vehicle.veh_license]|regex_match[/^([A-Za-z]){3}([0-9]){4}$/]');
        //$this->form_validation->set_rules('bra_name','Marca','trim|required|callback_required_brand');
        $this->form_validation->set_rules('veh_model','Modelo','trim|required|callback_required_inputs');
        $this->form_validation->set_rules('veh_year','Ano Fabricação/Modelo','trim|required|max_length[8]');

        if($this->form_validation->run())
        {
            $data = array(
                        'veh_license'=>strtoupper($this->input->post('veh_license')),
                        'veh_model'=>$this->input->post('veh_model_id'),
                        'veh_year'=>$this->input->post('veh_year')
                    );
            if($this->vehicle_model->addVehicle($data))
            {
                $retorno['vehicles'] = $this->vehicle_model->getViewId($data['veh_license']);
                $msg = array(
                                'st'=>1,
                                'msg'=>'Veiculo Adicionado com Sucesso',
                                'retorno'=>$this->load->view($this->view_folders.'adm_list_vehicle',$retorno,true)
                            );
               
            } else {
                $msg = array('st'=>0,'msg'=>'ERRO:<br /> Problema ao salvar.');
            }
        } else {
            $msg = array('st'=>0,'msg'=>'ERRO:<br />'.validation_errors());
        }
        echo json_encode($msg);
    }

    public function required_inputs()
    {
        if($this->input->post('veh_model_id'))
        {
            $this->load->model('model_model');
            $brand = $this->model_model->getId($this->input->post('veh_model_id'));
            if(isset($brand[0])) {
                return true;
            } else {
                $this->form_validation->set_message('required_inputs', 'Escolha um Modelo já Criada!');
                return false;
            }
        }
        //$this->form_validation->set_message('required_inputs', 'Preencha o campo Modelo!');
        return true;
    }

    public function ajax_update()
    {
        $CI =& get_instance();
        $CI->layout = 'null';

        $this->load->model('vehicle_model');
        $this->form_validation->set_rules('veh_vehicle','Nome','trim|required|max_length[11]');
        $this->form_validation->set_rules('veh_model','Modelo','trim|required|callback_required_inputs');
        $this->form_validation->set_rules('veh_year','Ano Fabricação/Modelo','trim|required|max_length[8]');

        if($this->form_validation->run())
        {
            $id_model = $this->input->post('veh_model_id');
            if(empty($id_model))
            {
                $this->load->model('model_model');
                $id = $this->model_model->getName($this->input->post('veh_model'));
                $id_model = (isset($id[0]->mod_id)?$id[0]->mod_id:'');
            }
            if(!empty($id_model))
            {
                $data = array(
                            'veh_license'=>$this->input->post('veh_license'),
                            'veh_model'=>$id_model,
                            'veh_year'=>$this->input->post('veh_year')
                        );

                if($this->vehicle_model->updateVehicle($data))
                {
                    $msg = array('st'=>1,'msg'=>'Veiculo Alterado com Sucesso');  
                } else {
                    $msg = array('st'=>0,'msg'=>'ERRO:<br /> Problema ao alterar.');
                }
            } else {
                $msg = array('st'=>0,'msg'=>'ERRO:<br /> Problema ao buscar Modelo.');
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

        $this->load->model('vehicle_model');

        if($this->vehicle_model->deleteVehicle($this->input->post('id')))
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
        $this->load->model('vehicle_model');
        $data = $this->vehicle_model->getLikeId($search);

        foreach ($data as $rs) {
            $seleciona[] = 
                array(    
                    'valor'     => str_replace($search, '<b>'.$search.'</b>', strtoupper($rs->veh_license)),
                    'ide'       =>$rs->veh_license,
                    'category'  =>"Placa"
                );
        }

        if(!isset($seleciona))
            $seleciona = array();
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($seleciona);
    }
}