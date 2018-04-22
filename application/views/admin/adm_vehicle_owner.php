<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  <h1 class="page-header">Cadastro - Donos de Veículos</h1>
            <h2 class="sub-header"><button id="adicionar">Novo</button></h2>
            <div class="adicionando" style="display: none">
            <?php

              echo '<form id="add" class="navbar-form"  action="'.base_url().'admin/vehicle_owner/ajax_add" method="post">';
              echo form_error('vow_vehicle');
              echo  '<p><div class="input-group input-group">
                  <span class="input-group-addon">@</span>
                  <input type="text" name="vow_vehicle" class="form-control" data-validation="required" placeholder="Placa">
                  </div>';
              echo form_error('vow_client');
              echo   '<div class="input-group input-group">
                  <span class="input-group-addon"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></span>
                  <input type="text" name="vow_client" class="form-control" data-validation="required" placeholder="Cliente">
                  <input type="hidden" name="cli_id">
                  </div>';
              echo form_error('vow_date');
              echo   '<div class="input-group input-group">
                  <span class="input-group-addon"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></span>
                  <input type="date" name="vow_date" class="form-control" data-validation="required" placeholder="Data">
                  </div>';
              echo form_error('vow_active');
              echo  '<div class="input-group">
                      <span class="form-control">
                        Ativo&nbsp;&nbsp;<input type="checkbox" name="active" value="0" onclick="$(this).next().val(this.checked?1:0)">
                        <input type="hidden" name="vow_active" value="0"/>
                      </span>
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
                    <th>Placa</th>
                    <th>Cliente</th>
                    <th>Data</th>
                    <th>Ativo</th>
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
      </div>

