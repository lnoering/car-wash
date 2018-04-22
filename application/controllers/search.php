<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 */
class Search extends CI_Controller
{

    /**
    * Layout default utilizado pelo controlador.
    */
    public $layout = 'default';

    /**
    * Titulo default.
    */
    public $title = 'Car Wash';

    /**
    * Definindo os css default.
    */
    public $css = array('bootstrap.min','dashboard','my');

    /**
    * Carregando os js default.
    */
    public $js = array('formValidation/jquery.form-validator.min',
                        'func/new',
                        'func/vehicle_owner',
                        'func/activity',
                        'func/service',
                        'func/employee'
                       );

    public function index()
    {
        if(strtoupper($this->input->get('q'))){

            $search = strtoupper($this->input->get('q'));
            $this->load->model('vehicle_model');
            $data['vehicle'] = $this->vehicle_model->getIdLikeId($search);
            

            $this->load->model('client_model');
            $data['client'] = $this->client_model->getIdLikeName($search);

            //pegar todos os IDS e buscar as orders

            $this->load->model('vehicle_owner_model');
            $orders = array();
            foreach ($data['vehicle'] as $value) {
                foreach ($this->vehicle_owner_model->getByVehicle($value->veh_license) as $vow) {
                    $orders[] = $vow->vow_id;
                }
            }
            foreach ($data['client'] as $value) {
                foreach ($this->vehicle_owner_model->getByClient($value->cli_id) as $vow) {
                    $orders[] = $vow->vow_id;
                }
            }

            //limpar os IDS iguais
            $orders = array_unique($orders);

            $this->load->model('order_model');
            $data['list'] = '';
            foreach ($orders as $value) {
                $result['order'] = $this->order_model->getByVehicleOwnerId($value);
                $data['list'] .= $this->load->view('block/block_order_list',$result,true);
            }
            
            $data['activity'] = $this->load->view('admin/adm_activity',null,true);
            $data['activity'] .= $this->load->view('admin/adm_create_list_activity',array('count'=>1),true);


            $block['block'] = $this->load->view('block/block_order',$data,true);
            unset($data);
            echo $this->load->view('list_search',$block);
        }

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
                    'valor' => str_replace($search, '<b>'.$search.'</b>', $rs->veh_license),
                    'ide' =>$rs->veh_license,
                    'category' =>"Veículo"
                );
        }

        $this->load->model('client_model');
        $data = $this->client_model->getLikeName($search);
        foreach ($data as $rs) {
            $seleciona[] = 
                array(    
                    'valor' => str_replace($search, '<b>'.$search.'</b>', $rs->cli_name),
                    'ide' =>$rs->cli_name,
                    'category' =>"Cliente"
                );
        }
/*
        $this->load->model('service_model');
        $data = $this->service_model->getLikeName($search);
        foreach ($data as $rs) {
            $seleciona[] = 
                array(    
                    'valor' => str_replace($search, '<b>'.$search.'</b>', $rs->svc_name),
                    'ide' =>$rs->svc_id,
                    'category' =>"Serviço"
                );
        }
*/
        if(!isset($seleciona))
            $seleciona = array();
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($seleciona);
    }

    public function ajax_view()
    {
        $CI =& get_instance();
        $CI->layout = 'null';

        $search = strtoupper($this->input->post('id'));
        $this->load->model('vehicle_model');
        $data['vehicle'] = $this->vehicle_model->getIdLikeId($search);
        

        $this->load->model('client_model');
        $data['client'] = $this->client_model->getIdLikeName($search);

        //pegar todos os IDS e buscar as orders

        $this->load->model('vehicle_owner_model');
        $orders = array();
        foreach ($data['vehicle'] as $value) {
            foreach ($this->vehicle_owner_model->getByVehicle($value->veh_license) as $vow) {
                $orders[] = $vow->vow_id;
            }
        }
        foreach ($data['client'] as $value) {
            foreach ($this->vehicle_owner_model->getByClient($value->cli_id) as $vow) {
                $orders[] = $vow->vow_id;
            }
        }

        //limpar os IDS iguais
        $orders = array_unique($orders);

        $this->load->model('order_model');
        $data['list'] = '';
        foreach ($orders as $value) {
            $result['order'] = $this->order_model->getByVehicleOwnerId($value);
            $data['list'] .= $this->load->view('block/block_order_list',$result,true);
        }
        
        $data['activity'] = $this->load->view('admin/adm_activity',null,true);
        $data['activity'] .= $this->load->view('admin/adm_create_list_activity',array('count'=>1),true);


        $block['block'] = $this->load->view('block/block_order',$data,true);
        unset($data);
        echo $this->load->view('list_search',$block,true);

    }
}