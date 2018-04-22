<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 */
class Admin extends CI_Controller
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
    public $css = array();//'jquery-ui-1.11.2/jquery-ui'

    /**
    * Carregando os js default.
    */
    //public $js = array('vendor/modernizr-2.6.2-respond-1.1.0.min','main');
    public $js = array('func/activity');

    public function index()
    {

        $this->load->model('order_model');
        $data['order'] = $this->order_model->getAll();

        $data['orders'] = $this->load->view('block/block_order_list',$data,true);
        unset($data['order']);
        $this->load->view($this->view_folders.'admin',$data);
    }
}