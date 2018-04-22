<?php
	foreach ($brand as $key => $value)
	{
	  $result = "<tr>
	          		<form id='update' class='navbar-form'  action='".base_url()."admin/brand/ajax_update' method='post'>
				        <td>
				           	<input type='hidden' name='bra_id' value='".$value->bra_id."'>
				           	<input type='text' name='bra_name' value='".$value->bra_name."' class='form-control' readonly='true'>
				        </td>
				        <td>
				            <button id='edit' type='submit' class='' data-id='".$value->bra_id."'>
				                <span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>
				            </button>
				            <button id='delete' class='none' data-id='".$value->bra_id."'>
				                <span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
				            </button>
				        </td>
			        </form>
	          	</tr>
	      		";
	  echo $result;
	}
?>