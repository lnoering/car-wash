<?php
	$result = '<tr id="infoActivitys"><td colspan="7"><table class="table table-striped">
              <thead>
                  <tr>
                    <th>act_service</th>
                    <th>act_value</th>
                    <th>act_employee</th>
                  </tr>
              </thead>
              <tbody>';
	foreach ($activity as $key => $value)
	{
	  	$result .= "<tr>
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
		          	</tr>
		      		";
	}
	$result .= '</tbody>
           	 </table></td></tr>';
	echo $result;
?>