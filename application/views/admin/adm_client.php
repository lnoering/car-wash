<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  <h1 class="page-header">Cliente</h1>
            <h2 class="sub-header"><button id="adicionar">Novo</button></h2>
            <div class="adicionando" style="display: none">
            <?php

              echo '<form id="add" class="navbar-form"  action="'.base_url().'admin/client/ajax_add" method="post">';
              echo form_error('cli_name');
              echo  '<p><div class="input-group input-group">
                  <span class="input-group-addon">@</span>
                  <input type="text" name="cli_name" class="form-control" data-validation="required" placeholder="Nome">
                  </div>';
              echo form_error('cli_cpfcnpj');
              echo  '<div class="input-group input-group">
                  <span class="input-group-addon">@</span>
                  <input type="text" name="cli_cpfcnpj" class="form-control" data-validation="required" placeholder="CPF/CNPJ">
                  </div>';
              echo form_error('cli_email');
              echo   '<div class="input-group input-group">
                  <span class="input-group-addon"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></span>
                  <input type="text" name="cli_email" class="form-control" data-validation="required" placeholder="Email">
                  </div>';
              echo form_error('cli_phone');
              echo   '<div class="input-group input-group">
                  <span class="input-group-addon"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></span>
                  <input type="text" name="cli_phone" class="form-control" data-validation="required" placeholder="Telefone">
                  </div>';
              echo form_error('cli_birth');
              echo   '<div class="input-group input-group">
                  <span class="input-group-addon"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></span>
                  <input type="date" name="cli_birth" class="form-control" data-validation="required" placeholder="Data Nascimento">
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
                    <th>CPF / CNPJ</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Data Nascimento</th>
                    <th></th>
                  </tr>
              </thead>
              <tbody>
                <!--Pegar os dados da Model para montar -->
                <?php 
                  print_r($list_clientes);
                ?>
              </tbody>
            </table>
          </div>
      </div>