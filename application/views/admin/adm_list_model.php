<?php
	foreach ($model as $key => $value)
	{
	  $result = "<tr>
	          		<form id='update' class='navbar-form'  action='".base_url()."admin/model/ajax_update' method='post'>
				        <td>
				           	<input type='hidden' name='mod_id' value='".$value->mod_id."'>
				           	<input type='text' name='mod_name' value='".$value->mod_name."' class='form-control' readonly='true'>
				        </td>
				        <td>
				           	<input type='hidden' name='mod_brand' value='".$value->mod_brand."' class='form-control' readonly='true'>
				           	<input type='text' name='bra_name' value='".$value->bra_name."' class='form-control' readonly='true'>
				        </td>
				        <td>
				            <button id='edit' type='submit' class='' data-id='".$value->mod_id."'>
				                <span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>
				            </button>
				            <button id='delete' class='none' data-id='".$value->mod_id."'>
				                <span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
				            </button>
				        </td>
			        </form>
	          	</tr>
	      		";
	  echo $result;
	}
?>