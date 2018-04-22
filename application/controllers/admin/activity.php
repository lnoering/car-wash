<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 */
class Activity extends CI_Controller
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
        $this->load->view($this->view_folders.'admin');
    }

    public function ajax_new()
    {
        $CI =& get_instance();
        $CI->layout = 'null';


        //$data['count'] = $this->input->post('id');
        //$data['count'] ++;

        $msg = array(
                        'st'=>1,
                        'msg'=>'',//$data['count'],
                        //'retorno'=>$this->load->view('adm_create_list_activity',$data,true)
                        'retorno'=>$this->load->view($this->view_folders.'adm_create_list_activity',null,true)
                    );

        echo json_encode($msg);
    }

    public function ajax_list()
    {
        $CI =& get_instance();
        $CI->layout = 'null';

        $this->load->model('activity_model');
        $data['activity'] = $this->activity_model->getActivitiesByOrderId($this->input->post('id'));
        
        $edit = $this->input->post('ed');
        $retorno = '';

        if($edit === 'true')
        {
            $retorno = $this->load->view($this->view_folders.'adm_list_activity',$data,true);
        } else {
            $retorno = $this->load->view('list_activity',$data,true);
        }

        $msg = array(
                        'st'=>1,
                        'msg'=>'Listando Atividades da Order '.$this->input->post('id'),
                        'retorno'=>$retorno
                    );

        echo json_encode($msg);
    }

}