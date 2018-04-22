<?php
	foreach ($services as $key => $value)
	{
	  $result = "<tr>
	          		<form id='update' class='navbar-form'  action='".base_url()."admin/service/ajax_updateService' method='post'>
				        <td>
				           	<input type='hidden' name='svc_id' value='".$value->svc_id."' class='form-control' readonly='true'>
				           	<input type='text' name='svc_name' value='".$value->svc_name."' class='form-control' readonly='true'>
				        </td>
				        <td>
				            <input type='text' name='svc_description' value='".$value->svc_description."' class='form-control' readonly='true'>
				        </td>
				        <td>
				            <input type='text' name='svc_value' value='".$value->svc_value."' class='form-control' readonly='true'>
				        </td>
				        <td>
				            <button id='edit' type='submit' class='' data-id='".$value->svc_id."'>
				                <span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>
				            </button>
				            <button id='delete' class='none' data-id='".$value->svc_id."'>
				                <span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
				            </button>
				        </td>
			        </form>
	          	</tr>
	      		";
	  echo $result;
	}
?>