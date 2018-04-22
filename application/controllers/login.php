<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 */
class Login extends CI_Controller
{

    /**
    * Layout default utilizado pelo controlador.
    */
    public $layout = 'login';

    /**
    * Titulo default.
    */
    public $title = 'Car Wash';

    /**
    * Definindo os css default.
    */
    //public $css = array('main','normalize','normalize.min');
    public $css = array('signin');

    /**
    * Carregando os js default.
    */
    public $js = array();
    //public $js = array('ie-emulation-modes-warning');

    public function index()
    {
        $this->load->view('login');
    }
}