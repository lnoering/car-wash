<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/general/hooks.html
|
*/

//ini - vou usar hooks para não ficar incluido header e footer.

$hook['display_override'][] = array('class' => 'Layout',
'function' => 'init',
'filename' => 'Layout.php',
'filepath' => 'hooks');

//fim - vou usar hooks para não ficar incluido header e footer.

/* End of file hooks.php */
/* Location: ./application/config/hooks.php */