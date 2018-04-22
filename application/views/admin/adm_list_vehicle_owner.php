<?php 
	$this->load->helper('my_helper');
    foreach ($vehicles_owner as $key => $value)
    {
      	$result = 	"<tr>
	              		<form id='update' class='navbar-form'  action='".base_url()."admin/vehicle_owner/ajax_update' method='post'>
			              	<td>
			                	<input type='text' name='vow_vehicle' value='".$value->vow_vehicle."' class='form-control' readonly='true'>
			              	</td>
			              	<td>
			                	<input type='text' name='vow_client' value='".$value->vow_client."' class='form-control' readonly='true'>
			                	<input type='hidden' name='cli_id' value='".$value->cli_id."'>
			              	</td>
			              	<td>
			                	<input type='date' name='vow_date' value='".remove_time($value->vow_date)."' class='form-control' readonly='true'>
			              	</td>           	
			              	<td>
			                	<input type='checkbox' name='active' value='".$value->vow_active."' class='form-control' readonly='true' onclick='$(this).next().val(this.checked?1:0)'>
			              		<input type='hidden' name='vow_active' value='".$value->vow_active."'/>
			              	</td>
			              	<td>
			                  	<button id='edit' type='submit' class='' data-id='".$value->vow_id."'>
			                     	<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>
			                  	</button>
			                  	<button id='delete' class='none' data-id='".$value->vow_id."'>
			                        <span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
			                  	</button>
			              	</td>
	              		</form>
              		</tr>
          			";
      echo $result;
    }
?>