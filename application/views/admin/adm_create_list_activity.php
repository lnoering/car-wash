<?php
	echo form_error("act_service");
	echo    '<div id="activity">
				<div class="input-group input-group">
			        <span class="input-group-addon">@</span>
			        <input type="text" id="act_service" name="act_service[data][]" class="form-control" data-validation="required" placeholder="Serviço">
		        	<input type="hidden" name="act_service[id][]">
		        </div>';
	echo form_error('act_employee');
	echo    	'<div class="input-group input-group">
			        <span class="input-group-addon"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></span>
			        <input type="text" id="act_employee" name="act_employee[data][]" class="form-control" data-validation="required" placeholder="Empregado">
		        	<input type="hidden" name="act_employee[id][]">
		        </div>';
	echo 		'<button id="btnactivity" class="none">
	                <span class="glyphicon glyphicon-remove"></span>
	          	</button>
          	</div><p></p>';
/*
	echo form_error("act_service_$count");
	echo    '<div id="activity_'.$count.'">
				<div class="input-group input-group">
			        <span class="input-group-addon">@</span>
			        <input type="text" data-id="'.$count.'" id="act_service" name="act_service_'.$count.'" class="form-control" data-validation="required" placeholder="Serviço">
			        <input type="hidden" name="act_service_id_'.$count.'">
		        </div>';
	echo form_error('act_employee_$count');
	echo    	'<div class="input-group input-group">
			        <span class="input-group-addon"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></span>
			        <input type="text" data-id="'.$count.'" id="act_employee" name="act_employee_'.$count.'" class="form-control" data-validation="required" placeholder="Empregado">
			        <input type="hidden" name="act_employee_id_'.$count.'">
		        </div>';
	echo 		'<button id="btnactivity" class="none" data-id="'.$count.'">
	                <span class="glyphicon glyphicon-remove"></span>
	          	</button>
          	</div><p></p>';
?>
*/