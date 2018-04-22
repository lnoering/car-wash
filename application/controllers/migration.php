<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration extends CI_Controller {       

/**
* Método construtor
*/
public function __construct() {
parent::__construct();
}

public function index() {
$this->load->library('migration');

if ($this->migration->current()) {
echo "Migração bem sucedida!";
}
else {
echo $this->migration->error_string();
}
}


/*
    public function __construct() {

        parent::__construct();

        if (!$this->input->is_cli_request()) {
            show_error('You don\'t have permission for this action');
        }

        $this->load->library('migration');
    }

    public function index()
    {
        $this->current();
    }

    public function current()
    {
        if ( ! $this->migration->current())
        {
        	echo 'WARNING: ' . $this->migration->error_string() . PHP_EOL;
        } else
        {
            echo 'SUCCESS: Migration(s) done'.PHP_EOL;
        }
    }

    public function latest()
    {
        if ( ! $this->migration->latest())
        {
        	echo 'WARNING: ' . $this->migration->error_string() . PHP_EOL;
        } else
        {
            echo 'SUCCESS: Migration(s) done'.PHP_EOL;
        }
    }
    */


}