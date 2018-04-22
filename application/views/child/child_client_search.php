<?php

echo form_error('vow_client');
echo   '<div class="input-group input-group">
    <span class="input-group-addon"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></span>
    <input type="text" name="vow_client" class="form-control" data-validation="required" placeholder="Cliente">
    <input type="hidden" name="cli_id">
    </div>';

?>