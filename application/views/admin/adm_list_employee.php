<?php
	foreach ($employee as $key => $value)
	{
	  $result = "<tr>
	          		<form id='update' class='navbar-form'  action='".base_url()."admin/employee/ajax_update' method='post'>
				        <td>
				           	<input type='hidden' name='emp_id' value='".$value->emp_id."'>
				           	<input type='text' name='emp_name' value='".$value->emp_name."' class='form-control' readonly='true'>
				        </td>
				        <td>
				           	<input type='text' name='emp_email' value='".$value->emp_email."' class='form-control' readonly='true'>
				        </td>
				        <td>
				           	<input type='text' name='emp_phone' value='".$value->emp_phone."' class='form-control' readonly='true'>
				        </td>
				        <td>
				           	<input type='date' name='emp_birth' value='".$value->emp_birth."' class='form-control' readonly='true'>
				        </td>
				        <td>
				           	<input type='text' name='emp_password' value='".$value->emp_password."' class='form-control' readonly='true'>
				        </td>
				        <td>
				           	<input type='text' name='emp_password_conf' value='".$value->emp_password."' class='form-control' readonly='true'>
				        </td>
				        <td>
				            <button id='edit' type='submit' class='' data-id='".$value->emp_id."'>
				                <span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>
				            </button>
				            <button id='delete' class='none' data-id='".$value->emp_id."'>
				                <span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
				            </button>
				        </td>
			        </form>
	          	</tr>
	      		";
	  echo $result;
	}
?>