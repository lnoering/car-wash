<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  <h1 class="page-header">Service</h1>
            <h2 class="sub-header"><button id="adicionar">Novo</button></h2>
            <div class="adicionando" style="display: none">
            <?php

              echo '<form id="add" class="navbar-form"  action="'.base_url().'admin/service/ajax_add" method="post">';
              echo form_error('svc_name');
              echo  '<p><div class="input-group input-group">
                  <span class="input-group-addon">@</span>
                  <input type="text" name="svc_name" class="form-control" data-validation="required" placeholder="Nome">
                  </div>';
              echo form_error('svc_description');
              echo   '<div class="input-group input-group">
                  <span class="input-group-addon"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></span>
                  <input type="textarea" name="svc_description" class="form-control" data-validation="required" placeholder="Descrição">
                  </div>';
              echo form_error('svc_value');
              echo  '<div class="input-group input-group">
                    <span class="input-group-addon">$</span>
                    <input type="text" name="svc_value" class="form-control" data-validation="required" placeholder="Valor">
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
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Valor</th>
                    <th></th>
                  </tr>
              </thead>
              <tbody>
                <!--Pegar os dados da Model para montar -->
                <?php 
                    print_r($list_services);
                ?>
              </tbody>
            </table>
          </div>
      </div>

