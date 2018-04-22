<?php 
    $this->load->helper('my_helper');
    foreach ($clientes as $key => $value)
    {
      $result = "<tr>
                    <form id='update' class='navbar-form'  action='".base_url()."admin/client/ajax_update' method='post'>
	                    <td>
	                      	<input type='hidden' name='cli_id' value='".$value->cli_id."'>
	                      	<input type='text' name='cli_name' value='".$value->cli_name."' class='form-control' readonly='true' data-validation='required'>
	                    </td>
	                    <td>
	                      	<input type='text' name='cli_cpfcnpj' value='".$value->cli_cpfcnpj."' class='form-control' readonly='true' data-validation='required'>
	                    </td>
	                    <td>
	                      	<input type='text' name='cli_email' value='".$value->cli_email."' class='form-control' readonly='true' data-validation='required'>
	                    </td>
	                    <td>
	                      	<input type='text' name='cli_phone' value='".$value->cli_phone."' class='form-control' readonly='true' data-validation='required'>
	                    </td>
	                    <td>
	                      	<input type='date' name='cli_birth' value='".$value->cli_birth."' class='form-control' readonly='true' data-validation='required'>
	                    </td>
	              		<td>
		                  	<button id='edit' type='submit' class='' data-id='".$value->cli_id."'>
		                      <span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>
		                  	</button>
		                  	<button id='delete' class='none' data-id='".$value->cli_id."'>
		                        <span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
		                  	</button>
	              		</td>
	              </form>
              </tr>
          ";
      echo $result;
    }
    /*
    <td>
      	<input type='text' name='cli_updated_on' value='".datetime_to_human($value->cli_updated_on)."' class='form-control' disabled='true'>
    </td>
	*/
?>