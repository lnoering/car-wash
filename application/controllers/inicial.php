<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 */
class Inicial extends CI_Controller
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
    //public $css = array('main','normalize','normalize.min');
    public $css = array();

    /**
    * Carregando os js default.
    */
    //public $js = array('vendor/modernizr-2.6.2-respond-1.1.0.min','main');
    public $js = array();

    public function index()
    {
        // Carregando a view.
        $this->load->view('inicial');
    }
}