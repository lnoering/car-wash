<?php
	foreach ($order as $key => $value)
	{
	  	$result = "<tr>
	          		<form id='update' class='navbar-form'  action='".base_url()."admin/order/ajax_update' method='post'>
				        <td>
				           	<input type='text' name='svo_vehicle_owner_name' value='".$value->svo_vehicle_owner_name."' class='form-control' readonly='true'>
				           	<input type='hidden' name='svo_vehicle_owner_id' value='".$value->svo_vehicle_owner."' class='form-control' readonly='true'>
				        </td>
				        <td>
				            <input type='text' name='svo_vehicle_owner_car' value='".$value->svo_vehicle_owner_car."' class='form-control' readonly='true'>
				        </td>
				        <td>
				            <input type='text' name='svo_pickup_address' value='".$value->svo_pickup_address."' class='form-control' readonly='true'>
				        </td>
				        <td>
				            <input type='date' name='svo_pickup_date' value='".explode(" ",$value->svo_pickup_datetime)[0]."' class='form-control' readonly='true'>
				        </td>
				        <td>
				            <input type='time' name='svo_pickup_time' value='".explode(" ",$value->svo_pickup_datetime)[1]."' class='form-control' readonly='true'>
				        </td>
				        <td>
				            <input type='text' name='svo_delivery_address' value='".$value->svo_delivery_address."' class='form-control' readonly='true'>
				        </td>
				        <td>
				            <input type='date' name='svo_delivery_date' value='".explode(" ",$value->svo_delivery_datetime)[0]."' class='form-control' readonly='true'>
				        </td>
				        <td>
				            <input type='time' name='svo_delivery_time' value='".explode(" ",$value->svo_delivery_datetime)[1]."' class='form-control' readonly='true'>
				        </td>
				        <td>
				            <input type='text' name='svo_more_info' value='".$value->svo_more_info."' class='form-control' readonly='true'>
				        </td>
				        <td>
				        	<button id='editActivity' class='' data-id='".$value->svo_id."'>
				                <span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>
				            </button>
				        </td>
				        <td>
				            <button id='edit' type='submit' class='' data-id='".$value->svo_id."'>
				                <span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>
				            </button>
				            <button id='delete' class='none' data-id='".$value->svo_id."'>
				                <span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
				            </button>
				        </td>
			        </form>
	          	</tr>
	      		";
	  	echo $result;
	}
?>