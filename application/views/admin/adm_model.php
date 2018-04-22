<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  <h1 class="page-header">Model</h1>
            <h2 class="sub-header"><button id="adicionar">Novo</button></h2>
            <div class="adicionando" style="display: none">
            <?php

              echo '<form id="add" class="navbar-form"  action="'.base_url().'admin/model/ajax_add" method="post">';
              echo form_error('mod_name');
              echo  '<p><div class="input-group input-group">
                  <span class="input-group-addon">@</span>
                  <input type="text" name="mod_name" class="form-control" data-validation="required" placeholder="Nome">
                  </div>';
              echo form_error('bra_name');
              echo   '<div class="input-group input-group">
                  <span class="input-group-addon"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></span>
                  <input type="hidden" name="mod_brand">
                  <input type="textarea" name="bra_name" class="form-control" data-validation="required" placeholder="Marca">
                  </div>';
            echo '<button name="btn_submit" type="submit" class="btn btn-default right">Salvar</button></p>';

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
                    <th>Marca</th>
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

