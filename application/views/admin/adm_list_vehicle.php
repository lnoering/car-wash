<?php 
	$this->load->helper('my_helper');
    foreach ($vehicles as $key => $value)
    {
      	$result = 	"<tr>
	              		<form id='update' class='navbar-form'  action='".base_url()."admin/vehicle/ajax_update' method='post'>
			              	<td id='id'>
			                	<input type='text' name='veh_license' value='".$value->veh_license."' class='form-control' readonly='true'>
			              	</td>
			              	<td>
			                	<input type='text' name='bra_name' value='".$value->bra_name."' class='form-control' readonly='true'>
			                	<input type='hidden' name='brand_id' value='".$value->veh_brand_id."'>
			              	</td>
			              	<td>
			                	<input type='text' name='veh_model' value='".$value->veh_model."' class='form-control' readonly='true'>
			                	<input type='hidden' name='veh_model_id' value='".$value->veh_model_id."'>
			              	</td>           	
			              	<td>
			                	<input type='text' name='veh_year' value='".$value->veh_year."' class='form-control' readonly='true'>
			              	</td>
			              	<td>
			                  	<button id='edit' type='submit' class='' data-id='".$value->veh_license."'>
			                     	<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>
			                  	</button>
			                  	<button id='delete' class='none' data-id='".$value->veh_license."'>
			                        <span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
			                  	</button>
			              	</td>
	              		</form>
              		</tr>
          			";
      echo $result;
    }
?>