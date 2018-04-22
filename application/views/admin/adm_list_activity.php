<?php
	$result = '<tr id="infoActivitys"><td colspan="8"><table class="table table-striped">
              <thead>
                  <tr>
                    <th>act_service</th>
                    <th>act_value</th>
                    <th>act_employee</th>
                    <th></th>
                  </tr>
              </thead>
              <tbody>';
              //<th>act_service_order</th>
	foreach ($activity as $key => $value)
	{
	  	$result .= "<tr>
	          		<form id='update' class='navbar-form'  action='".base_url()."admin/activity/ajax_update' method='post'>
				        <td>
				           	<input type='hidden' name='act_id' value='".$value->act_id."'>
				           	<input type='text' name='act_service_name' value='".$value->act_service_name."' class='form-control' readonly='true'>
				           	<input type='hidden' name='act_service' value='".$value->act_service."'>
				        </td>
				        <td>
				           	<input type='text' name='act_value' value='".$value->act_value."' class='form-control' readonly='true'>
				        </td>
				        <td>
				           	<input type='text' name='act_employee_name' value='".$value->act_employee_name."' class='form-control' readonly='true'>
				           	<input type='hidden' name='act_employee' value='".$value->act_employee."'>
				        </td>
				        <td>
				            <button id='edit' type='submit' class='' data-id='".$value->act_id."'>
				                <span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>
				            </button>
				            <button id='delete' class='none' data-id='".$value->act_id."'>
				                <span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
				            </button>
				        </td>
			        </form>
	          	</tr>
	      		";
	}
	/*
        <td>
           	<input type='text' name='act_service_order' value='".$value->act_service_order."' class='form-control' readonly='true'>
        </td>
	*/
	$result .= '</tbody>
           	 </table></td></tr>';
	echo $result;
?>