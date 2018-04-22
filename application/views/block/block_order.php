<h2 class="sub-header"><button id="adicionar">Novo</button></h2>
<div class="adicionando" style="display: none">
<?php 
    echo    '<form id="add" class="navbar-form"  action="'.base_url().'admin/order/ajax_add" method="post">';
    echo form_error('order_for');
    echo    '<p><div class="input-group input-group">
                <span class="input-group-addon">@</span>
                <input type="text" name="order_for" class="form-control" data-validation="required" placeholder="svo_vehicle_owner">
                <input type="hidden" name="svo_client_id">
                <input type="hidden" name="svo_vehicle_owner_id">
                <input type="hidden" name="svo_vehicle_id">
            </div></p>';
    echo '<div name="client" style="display:none;">';
        echo form_error('vow_client');
        echo   '<div class="input-group input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></span>
                <input type="text" name="vow_client" class="form-control" data-validation="" placeholder="Cliente">
                <input type="hidden" name="cli_id">
                </div>';
    echo '</div>';
    echo '<div name="vehicle" style="display:none;">';
        echo form_error('vow_vehicle');
        echo    '<div class="input-group input-group">
                <span class="input-group-addon">@</span>
                <input type="text" name="vow_vehicle" class="form-control" data-validation="" placeholder="Placa">
                </div>';
    echo '</div>';      
    echo form_error('svo_pickup_address');
    echo    '<p><div class="input-group input-group">
            <span class="input-group-addon"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></span>
            <input type="text" name="svo_pickup_address" class="form-control" data-validation="required" placeholder="svo_pickup_address">
            </div></p>';
    echo form_error('svo_pickup_date');
    echo    '<p><div class="input-group input-group">
            <span class="input-group-addon"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></span>
            <input type="date" name="svo_pickup_date" class="form-control" data-validation="required" placeholder="svo_pickup_date">
            </div></p>';
    echo form_error('svo_pickup_time');
    echo    '<p><div class="input-group input-group">
            <span class="input-group-addon"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></span>
            <input type="time" name="svo_pickup_time" class="form-control" data-validation="required" placeholder="svo_pickup_time">
            </div></p>';
    echo form_error('svo_delivery_address');
    echo    '<p><div class="input-group input-group">
            <span class="input-group-addon">$</span>
            <input type="text" name="svo_delivery_address" class="form-control" data-validation="required" placeholder="svo_delivery_address">
            </div></p>';
    echo form_error('svo_delivery_date');
    echo    '<p><div class="input-group input-group">
            <span class="input-group-addon">$</span>
            <input type="date" name="svo_delivery_date" class="form-control" data-validation="required" placeholder="svo_delivery_date">
            </div></p>';
    echo form_error('svo_delivery_time');
    echo    '<p><div class="input-group input-group">
            <span class="input-group-addon">$</span>
            <input type="time" name="svo_delivery_time" class="form-control" data-validation="required" placeholder="svo_delivery_time">
            </div></p>';
    echo form_error('svo_more_info');
    echo    '<p><div class="input-group input-group">
            <span class="input-group-addon">$</span>
            <input type="text" name="svo_more_info" class="form-control" data-validation="required" placeholder="svo_more_info">
            </div></p>';
    print_r($activity);
    echo    '<p><button type="submit" class="btn btn-default right">Salvar</button></p>';

    echo form_close();
    echo    '<script>$.validate();</script>';
?>
</div>
<div id="result" style="display: none">
    <button id='alert' class='btn btn-info' style="margin-left: 96%;">X</button>
    <div style="margin-top: -2%"></div>
</div>
<div class="table-responsive">
<table id="tabOrder" class="table table-striped">
    <thead>
        <tr>
            <th>Cliente</th>
            <th>Veículo</th>
            <th>Endereço Retirada</th>
            <th>Data Retirada</th>
            <th>Hora Retirada</th>
            <th>Endereço Entrega</th>
            <th>Data Entrega</th>
            <th>Hora Entrega</th>
            <th>Comentários</th>
            <th>Atividades</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
      <!--Pegar os dados da Model para montar -->
      <?php 
          print_r($list);
      ?>
    </tbody>
</table>
</div>

