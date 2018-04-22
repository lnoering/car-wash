<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 */
class Vehicle_Owner extends CI_Controller
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
    public $js = array('ie-emulation-modes-warning','func/client','func/vehicle');

    public function index()
    {
        $this->js[] = 'formValidation/jquery.form-validator.min';
        $this->js[] = 'func/new';
        $data = array();
        $this->load->model('vehicle_owner_model');
        $data['vehicles_owner'] = $this->vehicle_owner_model->getAll();
        
        $data['list'] = $this->load->view($this->view_folders.'adm_list_vehicle_owner',$data,true);
        unset($data['vehicles_owner']);

        echo $this->load->view($this->view_folders.'adm_vehicle_owner',$data);
    }

    public function ajax_add()
    {
        $CI =& get_instance();
        $CI->layout = 'null';

        $this->load->model('vehicle_owner_model');
        $this->form_validation->set_rules('vow_vehicle','Placa','trim|required|max_length[10]|regex_match[/^([A-Za-z]){3}([0-9]){4}$/]|callback_required_vehicle');
        //$this->form_validation->set_rules('bra_name','Marca','trim|required|callback_required_brand');
        $this->form_validation->set_rules('vow_client','Cliente','trim|required|callback_required_client');
        $this->form_validation->set_rules('vow_date','Data','trim');
        $this->form_validation->set_rules('vow_active','Ativo','trim|regex_match[/^(0|1)$/]');

        if($this->form_validation->run())
        {
            $id_cli = $this->input->post('cli_id');
            if(empty($id_cli))
            {
                $this->load->model('client_model');
                $id = $this->client_model->getName($this->input->post('vow_client')); 
                $id_cli = (isset($id[0]->cli_id)?$id[0]->cli_id:'');  
            }
            if(!empty($id_cli))
            {
                
                $data = array(
                            'vow_vehicle'=>$this->input->post('vow_vehicle'),
                            'vow_client'=>$id_cli,
                            'vow_date'=>$this->input->post('vow_date'),
                            'vow_active'=>$this->input->post('vow_active')
                        );
                $id = $this->vehicle_owner_model->addVehicleOwner($data);
                if($id)
                {
                    $retorno['vehicles_owner'] = $this->vehicle_owner_model->getId($id);
                    $msg = array(
                                    'st'=>1,
                                    'msg'=>'Adicionado com Sucesso',
                                    'retorno'=>$this->load->view($this->view_folders.'adm_list_vehicle_owner',$retorno,true)
                                );
                   
                } else {
                    $msg = array('st'=>0,'msg'=>'ERRO:<br /> Problema ao salvar.');
                }
            } else {
                $msg = array('st'=>0,'msg'=>'ERRO:<br /> Cliente Inexistente.');
            }
        } else {
            $msg = array('st'=>0,'msg'=>'ERRO:<br />'.validation_errors());
        }
        echo json_encode($msg);
    }

    public function required_client()
    {
        if($this->input->post('cli_id'))
        {
            $this->load->model('client_model');
            $cli = $this->client_model->getId($this->input->post('cli_id'));
            if(isset($cli[0])) {
                return true;
            } else {
                $this->form_validation->set_message('required_client', 'Escolha um Cliente já Cadastrado!');
                return false;
            }
        }
        return true;
    }

    public function required_vehicle()
    {
        if(!empty($this->input->post('vow_vehicle')))
        {
            $this->load->model('vehicle_model');
            $cli = $this->vehicle_model->getId($this->input->post('vow_vehicle'));
            if(isset($cli[0])) {
                return true;
            } else {
                $this->form_validation->set_message('required_vehicle', 'Escolha um Veículo já Cadastrado!');
                return false;
            }
        }
        $this->form_validation->set_message('required_vehicle', 'Preencha com um Veículo Válido');
        return false;
    }

    public function ajax_update()
    {
        $CI =& get_instance();
        $CI->layout = 'null';

        $this->load->model('vehicle_owner_model');
        $this->form_validation->set_rules('vow_vehicle','Placa','trim|required|max_length[10]|regex_match[/^([A-Za-z]){3}([0-9]){4}$/]|callback_required_vehicle');
        //$this->form_validation->set_rules('bra_name','Marca','trim|required|callback_required_brand');
        $this->form_validation->set_rules('vow_client','Modelo','trim|required|callback_required_inputs');
        $this->form_validation->set_rules('vow_date','Data','trim');
        $this->form_validation->set_rules('vow_active','Ativo','trim|regex_match[/^(0|1)$/]');

        if($this->form_validation->run())
        {
            $id_cli = $this->input->post('cli_id');

            if(empty($id_cli))
            {
                $this->load->model('client_model');
                $id = $this->vehicle_model->getName($this->input->post('vow_client')); 
                $id_cli = (isset($id[0]->cli_id)?$id[0]->cli_id:'');  
            }
            if(!empty($id_cli))
            {
                $data = array(
                            'vow_id'=>$this->input->post('vow_id'),
                            'vow_vehicle'=>$this->input->post('vow_vehicle'),
                            'vow_client'=>$id_cli,
                            'vow_date'=>$this->input->post('vow_date'),
                            'vow_active'=>$this->input->post('vow_active')
                        );

                if($this->vehicle_owner_model->updateVehicleOwner($data))
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

        $this->load->model('vehicle_owner_model');

        if($this->vehicle_owner_model->deleteVehicle($this->input->post('id')))
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
        
        $this->load->model('vehicle_owner_model');
        $data = $this->vehicle_owner_model->getLikeName($search);

        //pegar o nome das marcas
        /*$ids = array();
        foreach ($data as $value) {
            $ids[$value->mod_brand] = $value->mod_brand;
        }
        $this->load->model('brand_model');
        $brands = $this->brand_model->getWhereIds($ids);
*/
        foreach ($data as $rs) {
            $seleciona[] = 
                array(    
                    'valor'     => str_replace($search, '<b>'.$search.'</b>', strtoupper($rs->cli_name))." - ".$rs->veh_license,
                    'ide'       => $rs->cli_name.' - '.$rs->veh_license,
                    'category'  => "Cliente - Veiculo",//$brands[$rs->mod_brand],
                    'ref'       => $rs->vow_id
                );
        }

        if(!isset($seleciona))
            $seleciona = array();
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($seleciona);
    }
}