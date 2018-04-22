<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 */
class Order extends CI_Controller
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
    public $js = array('ie-emulation-modes-warning','func/order', 'func/activity', 'func/service', 'func/employee', 'func/client', 'func/vehicle');

    public function index()
    {
        $this->js[] = 'formValidation/jquery.form-validator.min';
        $this->js[] = 'func/new';
        $data = array();
        $this->load->model('order_model');
        $data['order'] = $this->order_model->getAll();

        $data['list'] = $this->load->view('block/block_order_list',$data,true);
        $data['activity'] = $this->load->view($this->view_folders.'adm_activity',null,true);
        $data['activity'] .= $this->load->view($this->view_folders.'adm_create_list_activity',array('count'=>1),true);
        //echo $this->load->view('adm_order',$data);
        $block['block'] = $this->load->view('block/block_order',$data,true);
        unset($data);
        echo $this->load->view($this->view_folders.'adm_order',$block);
    }


    public function ajax_add()
    {
        $CI =& get_instance();
        $CI->layout = 'null';
        
        $act_services = $this->input->post('act_service');
        $act_employers = $this->input->post('act_employee');

        foreach ($act_services['data'] as $key => $value) {
            $this->form_validation->set_rules($key,'Serviço '.$key,'required|callback_required_activity['.$key.']');
            $this->form_validation->set_rules($key,'Empregado '.$key,'required|callback_required_employee['.$key.']');
        }
        
        $this->form_validation->set_rules('order_for','Placa','trim|required|callback_required_vehicle_owner');
        $this->form_validation->set_rules('svo_pickup_address','Endereço de Busca','trim|required');
        $this->form_validation->set_rules('svo_pickup_date','Data Para Buscar','trim|valid_date[d/m/y,/]');
        $this->form_validation->set_rules('svo_pickup_time','Horário Para Buscar','trim');
        $this->form_validation->set_rules('svo_delivery_address','Endereço de Entrega','trim|required');
        $this->form_validation->set_rules('svo_delivery_date','Data de Entrega','trim|valid_date[d/m/y,/]');
        $this->form_validation->set_rules('svo_delivery_time','Horário de Entrega','trim');
        //$this->form_validation->set_rules('svo_more_info','Ativo','trim');
        //$this->form_validation->set_rules('svo_created_on','Ativo','trim');
        $this->load->helper('my_helper');

        $this->db->trans_begin();

        if($this->form_validation->run())
        { 
            $data = array(
                        'svo_vehicle_owner'=>$this->input->post('svo_vehicle_owner_id'),
                        'svo_pickup_address'=>$this->input->post('svo_pickup_address'),
                        'svo_pickup_datetime'=>datetime_to_mysql($this->input->post('svo_pickup_date'),$this->input->post('svo_pickup_time')),
                        'svo_delivery_address'=>$this->input->post('svo_delivery_address'),
                        'svo_delivery_datetime'=>datetime_to_mysql($this->input->post('svo_delivery_date'),$this->input->post('svo_delivery_time')),
                        'svo_more_info'=>$this->input->post('svo_more_info'),
                        'svo_created_on'=>date("Y-m-d H:i:s")
                    );
            $this->load->model('order_model','order_model');
            $id = $this->order_model->addOrder($data);
            if($id)
            {
                $this->load->model('service_model','service_model');
                $this->load->model('activity_model','activity_model');
                $activities = array();
                foreach ($act_services['data'] as $key => $value) {
                    $activity = $this->service_model->getId($act_services['id'][$key]);
                    if(isset($activity[0]))
                    {
                        $data = array(
                                'act_service' => $activity[0]->svc_id,
                                'act_value' => $activity[0]->svc_value,
                                'act_employee' => $act_employers['id'][$key],
                                'act_service_order' => $id
                            );
                        $this->activity_model->addActivity($data);
                    }
                    
                }
                $msg = array(
                                'st'=>1,
                                'msg'=>'Adicionado com Sucesso',
                                'retorno'=>''//$this->load->view('adm_list_vehicle_owner',$retorno,true)
                            );
            } else {
                $msg = array('st'=>0,'msg'=>'ERRO:<br /> Problema ao salvar.');
            }
        } else {
            $msg = array('st'=>0,'msg'=>'ERRO:<br />'.validation_errors());
        }

        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
        }
        else
        {
            $this->db->trans_commit();
        }

        echo json_encode($msg);
    }

    public function required_activity($str, $campo)
    {
        if($this->input->post('act_service')[$campo])
        {
            $this->load->model('service_model');
            $service = $this->service_model->getId($this->input->post('act_service')[$campo]);
            if(isset($service[0])) {
                return true;
            } else {
                $this->form_validation->set_message('required_activity', 'Serviço Inexistente.');
                return false;
            }
        }
        $this->form_validation->set_message('required_activity', 'Escolha um Serviço cadastrado.');
        return false;
    }
    public function required_employee($str, $campo)
    {
        if($this->input->post('act_employee')[$campo])
        {
            $this->load->model('employee_model');
            $emp = $this->employee_model->getId($this->input->post('act_employee')[$campo]);
            if(isset($emp[0])) {
                return true;
            } else {
                $this->form_validation->set_message('required_employee', 'Empregado Inexistente.');
                return false;
            }
        }
        $this->form_validation->set_message('required_employee', 'Escolha um Empregado cadastrado.');
        return false;
    }

    public function required_vehicle_owner()
    {

        if($this->input->post('svo_vehicle_owner_id') != '') 
        {
            $this->load->model('vehicle_owner_model');
            $cli = $this->vehicle_owner_model->getId($this->input->post('svo_vehicle_owner_id'));
            if(isset($cli[0])) {
                return true;
            } else {
                $this->form_validation->set_message('required_vehicle_owner', 'Cliente não associado com veículo.');
                return false;
            }
        } 
        else if(!empty($this->input->post('svo_vehicle_id'))) 
        {
            $veh = $this->form_validation->set_rules('vow_vehicle','Placa','trim|required|max_length[10]|regex_match[/^([A-Za-z]){3}([0-9]){4}$/]|callback_required_vehicle');
            if(!empty($this->input->post('cli_id')) && $veh)
            {
                $veh = $this->form_validation->set_rules('vow_client','Cliente','trim|required|callback_required_client');
            }
            return $veh;
        }
        else if(!empty($this->input->post('svo_client_id'))) 
        {
            $cli = $this->form_validation->set_rules('vow_client','Cliente','trim|required|callback_required_client');
            if(!empty($this->input->post('vow_vehicle')) && $cli)
            {   
                $cli = $this->form_validation->set_rules('vow_vehicle','Placa','trim|required|max_length[10]|regex_match[/^([A-Za-z]){3}([0-9]){4}$/]|callback_required_vehicle');
            }
            return $cli;
        }
        /*
        if($this->input->post('svo_vehicle_owner_id'))
        {
            $this->load->model('vehicle_owner_model');
            $cli = $this->vehicle_owner_model->getId($this->input->post('svo_vehicle_owner_id'));
            if(isset($cli[0])) {
                return true;
            } else {
                $this->form_validation->set_message('required_vehicle_owner', 'Cliente não associado com veículo.');
                return false;
            }
        }
        */
        $this->form_validation->set_message('required_vehicle_owner', 'Escolha um Cliente que esteja associado com um Veículo.');
        return false;
    }

    //reutilizar a função do controller vehicle owner
    public function required_client()
    {
        $this->load->library('../controllers/vehicle_owner');
        return $this->client->required_client();
    }

    public function required_vehicle()
    {
        $this->load->library('../controllers/vehicle_owner');
        return $this->client->required_vehicle();
    }

/*
    public function required_vehicle()
    {
        if(!empty($this->input->post('vow_vehicle')))
        {
            $this->load->model('vehicle_model');
            $cli = $this->vehicle_model->getId($this->input->post('vow_vehicle'));
            if(isset($cli[0])) {
                return true;
            } else {
                $this->form_validation->set_message('required_inputs', 'Escolha um Veículo já Cadastrado!');
                return false;
            }
        }
        $this->form_validation->set_message('required_inputs', 'Preencha com um Veículo Válido');
        return false;
    }
*/
    public function ajax_update()
    {
        $CI =& get_instance();
        $CI->layout = 'null';
/*
        $campos_posts = $this->input->post();

        foreach ($campos_posts as $key => $value) 
        {
            if(preg_match('/act_service_[0-9]/',$key))
            {
                $this->form_validation->set_rules($key,'Serviço '.$key,'required|callback_required_activity['.$key.']');
            }
            if(preg_match('/act_employee_[0-9]/',$key))
            {
                $this->form_validation->set_rules($key,'Empregado '.$key,'required|callback_required_employee['.$key.']');
            }
        }
*/
        
        $this->form_validation->set_rules('svo_vehicle_owner','Placa','trim|required|callback_required_vehicle_owner');
        $this->form_validation->set_rules('svo_pickup_address','Endereço de Busca','trim|required');
        $this->form_validation->set_rules('svo_delivery_address','Endereço de Entrega','trim|required');
        //$this->form_validation->set_rules('svo_more_info','Ativo','trim');
        //$this->form_validation->set_rules('svo_created_on','Ativo','trim');
        $this->db->trans_begin();

        if($this->form_validation->run())
        { 
            $data = array(
                        'svo_id'=>$this->input->post('svo_id'),
                        'svo_vehicle_owner'=>$this->input->post('svo_vehicle_owner_id'),
                        'svo_pickup_address'=>$this->input->post('svo_pickup_address'),
                        'svo_delivery_address'=>$this->input->post('svo_delivery_address'),
                        'svo_more_info'=>$this->input->post('svo_more_info'),
                        'svo_created_on'=>$this->input->post('svo_created_on')
                    );
            $this->load->model('order_model');
            if($this->order_model->updateOrder($data))
            {
                /*
                $this->load->model('activity_model');
                $activities = array();
                foreach ($campos_posts as $key => $value) {
                    if(preg_match('/act_service_id_[0-9]/',$key))
                    {
                        $id_campo = explode("_",$key);
                        $id_campo = $id_campo[(count($id_campo)-1)];

                        //$activity = $this->service_model->getId($this->input->post($key));
                        //if(isset($activity[0]))
                        //{
                            $data = array(
                                    'act_id' => $this->input->post('act_id'),
                                    'act_service' => $this->input->post($key),
                                    //'act_value' => $activity[0]->svc_value,
                                    'act_employee' => $this->input->post('act_employee_id_'.$id_campo),
                                    'act_service_order' => $this->input->post('svo_id')
                                );
                        //}
                            $this->activity_model->updateActivity($data);
                    }
                }
                */

                $msg = array(
                                'st'=>1,
                                'msg'=>'Alterado com Sucesso',
                                'retorno'=>$this->load->view('block/block_order_list',$retorno,true)
                            );
            } else {
                $msg = array('st'=>0,'msg'=>'ERRO:<br /> Problema ao Atualizar.');
            }
        } else {
            $msg = array('st'=>0,'msg'=>'ERRO:<br />'.validation_errors());
        }

        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }

        echo json_encode($msg);
    }

    public function ajax_delete()
    {
        $CI =& get_instance();
        $CI->layout = 'null';   
    
        $this->db->trans_begin();
        $this->load->model('activity_model');
        if($this->activity_model->deleteActivitiesByOrderId($this->input->post('id')))
        {
            $this->load->model('order_model');
            if($this->order_model->deleteOrder($this->input->post('id')))
            {
                $msg = array('st'=>1,'msg'=>'Removido com Sucesso.');
            } else {
                $msg = array('st'=>0,'msg'=>'ERRO:<br /> Problema ao deletar atividades.');
            }
        } else {
            $msg = array('st'=>0,'msg'=>'ERRO:<br /> Problema ao deletar.');
        }

        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }

        echo json_encode($msg);
    }

    public function ajax_search_order_for()
    {
        $CI =& get_instance();
        $CI->layout = 'null';

        $search = strtoupper($this->input->post('search'));
        
        $this->load->model('vehicle_owner_model');
        $data['vehicle_owner'] = $this->vehicle_owner_model->getLikeName($search);

        $seleciona = array();

        foreach ($data['vehicle_owner'] as $rs) {
            $seleciona[] = 
                array(    
                    'valor'     => str_replace($search, '<b>'.$search.'</b>', strtoupper($rs->cli_name))." - ".$rs->veh_license,
                    'ide'       => $rs->cli_name.' - '.$rs->veh_license,
                    'category'  => "Cliente - Veiculo",
                    'ref'       => $rs->vow_id,
                    'tpCategory'=> 2
                );
        }

        $this->load->model('client_model');
        $data['client'] = $this->client_model->getLikeName($search);

        foreach ($data['client'] as $rs) {
            $seleciona[] = 
                array(    
                    'valor'     => str_replace($search, '<b>'.$search.'</b>', strtoupper($rs->cli_name)),
                    'ide'       =>$rs->cli_name,
                    'category'  =>"Cliente",
                    'ref'       => $rs->cli_id,
                    'tpCategory'=> 1
                );
        }

        $this->load->model('vehicle_model');
        $data['vehicle'] = $this->vehicle_model->getLikeId($search);

        foreach ($data['vehicle'] as $rs) {
            $seleciona[] = 
                array(    
                    'valor'     => str_replace($search, '<b>'.$search.'</b>', strtoupper($rs->veh_license)),
                    'ide'       =>$rs->veh_license,
                    'category'  =>"Placa",
                    'ref'       =>$rs->veh_license,
                    'tpCategory'=> 3
                );
        }

        unset($data);

        if(!isset($seleciona))
            $seleciona = array();
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($seleciona);
    }

    public function ajax_get_child()
    {
        $CI =& get_instance();
        $CI->layout = 'null';

        $q = strtoupper($this->input->post('category'));

        if($q == 1)
        {
            echo $this->load->view('child/child_vehicle_search',null,true);
        } 
        else if($q == 3) 
        {
            echo $this->load->view('child/child_client_search',null,true);
        } 
    }

}