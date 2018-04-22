<?php 
    //$this->load->helper('my_helper');
    foreach ($clientes as $key => $value)
    {
      $result = "<tr>
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
              	</tr>
          		";
      echo $result;
    }
?>