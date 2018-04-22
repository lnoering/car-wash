<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  <h1 class="page-header">Cadastro de veículos</h1>
            <h2 class="sub-header"><button id="adicionar">Novo</button></h2>
            <div class="adicionando" style="display: none">
            <?php

              echo '<form id="add" class="navbar-form"  action="'.base_url().'admin/vehicle/ajax_add" method="post">';
              echo form_error('veh_license');
              echo  '<p><div class="input-group input-group">
                  <span class="input-group-addon">@</span>
                  <input type="text" name="veh_license" class="form-control" data-validation="required" placeholder="Placa">
                  </div>';
              echo form_error('bra_name');
              echo   '<div class="input-group input-group">
                  <span class="input-group-addon"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></span>
                  <input type="text" name="bra_name" class="form-control" data-validation="required" placeholder="Marca">
                  <input type="hidden" name="brand_id">
                  </div>';
              echo form_error('veh_model');
              echo   '<div class="input-group input-group">
                  <span class="input-group-addon"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></span>
                  <input type="hidden" name=veh_model_id>
                  <input type="text" name="veh_model" class="form-control" data-validation="required" placeholder="Modelo">
                  </div>';
              echo form_error('veh_year');
              echo  '<div class="input-group input-group">
                    <span class="input-group-addon">$</span>
                    <input type="text" name="veh_year" class="form-control" data-validation="required" placeholder="Ano Fabricação/Modelo">
                    </div>';
            echo '<button type="submit" class="btn btn-default right">Salvar</button></p>';

            echo form_close();
            echo '<script>$.validate();</script>';
            ?>
            </div>
            <div id="result" style="display: none">
              <button id='alert' class='btn btn-info' style="margin-left: 96%;">X</button>
              <div style="margin-top: -2%"></div>
            </div>
            <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                  <tr>
                    <th>Placa (ID)</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Ano Fabricação/Modelo</th>
                    <th></th>
                  </tr>
              </thead>
              <tbody>
                <!--Pegar os dados da Model para montar -->
                <?php 
                    print_r($list_vehicles);
                ?>
              </tbody>
            </table>
          </div>
      </div>

